<?php

require_once 'src/autoload.php';

use Mess\Application\Constraints\AllowedImage;
use Mess\Application\Constraints\Constraints;
use Mess\Application\Constraints\DateLaterThanYears;
use Mess\Application\Constraints\FormatEmail;
use Mess\Application\Constraints\FormatFirstName;
use Mess\Application\Constraints\FormatLastName;
use Mess\Application\Constraints\FormatPassword;
use Mess\Application\Constraints\FormatPhoneNumber;
use Mess\Application\Constraints\IdenticalPasswords;
use Mess\Application\Constraints\NonDuplicateEmail;
use Mess\Application\Constraints\NonDuplicateLogin;
use Mess\Application\Constraints\NonDuplicatePhoneNumber;
use Mess\Application\Constraints\NonEmpty;
use Mess\Application\CurrentDate;
use Mess\Application\HashPassword;
use Mess\Application\NewUser;
use Mess\Http\Requests\RegistrationRequest;
use Mess\Persistence\ConnectionString;
use Mess\Persistence\CredentialsFile;
use Mess\Persistence\Database\User\RegistrationRepository;
use Mess\Persistence\Database\User\UserRepository;
use Mess\View\Action;
use Mess\View\View;
use Mess\View\Views\RegistrationView;

$string = new ConnectionString(new CredentialsFile("connection.txt"));

function getView(PDO $pdo, RegistrationRepository $registration, RegistrationRequest $request): View
{
    if (!$request->wantsSignUp()) {
        return new RegistrationView(Action::clean());
    }

    $constraints = new Constraints([
        new NonEmpty($request->login(), 'login', 'Podaj login'),
        new NonEmpty($request->password(), 'password', 'Podaj hasło'),
        new NonEmpty($request->firstName(), 'firstName', 'Podaj imię'),
        new NonEmpty($request->lastName(), 'lastName', 'Podaj nazwisko'),
        new NonEmpty($request->email(), 'email', 'Podaj email'),
        new NonEmpty($request->passwordRepeat(), 'passwordRepeat', 'Nieprawidłowe hasło'),
        new NonEmpty($request->phoneNumber(), 'phoneNumber', 'Podaj numer telefonu'),
        new NonEmpty($request->date(), 'birthDate', 'Wybierz datę urodzenia'),
        new NonEmpty($request->gender(), 'gender', 'Wybierz płeć'),
        new FormatPassword($request->password()),
        new FormatFirstName($request->firstName()),
        new FormatEmail($request->email()),
        new FormatLastName($request->lastName()),
        new FormatPhoneNumber($request->phoneNumber()),
        new NonDuplicateLogin($registration, $request->login()),
        new NonDuplicateEmail($registration, $request->email()),
        new NonDuplicatePhoneNumber($registration, $request->phoneNumber()),
        new IdenticalPasswords($request->password(), $request->passwordRepeat()),
        new AllowedImage($request->avatar(), 'avatar'),
        new DateLaterThanYears(new CurrentDate(), $request->date())
    ]);

    if ($constraints->failed()) {
        return new RegistrationView($constraints->action());
    }

    $password = new HashPassword($request->password());
    $userRepo = new UserRepository($pdo);

    $userRepo->insertUser(new NewUser($request->login(),
        $password->hash(),
        $request->firstName(),
        $request->lastName(),
        $request->email(),
        $request->avatar(),
        $request->phoneNumber(),
        $request->date(),
        $request->gender(),
        date("Y-m-d:H:i:s")));

    return new RegistrationView(Action::success('Pomyślna rejestracja'));
}

$view = getView($string->getPdo(), new RegistrationRepository($string->getPdo()), new RegistrationRequest($_POST));
$view->render();