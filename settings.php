<?php

require_once 'src/autoload.php';

use Mess\Application\Settings;
use Mess\Http\HttpHeader;
use Mess\Http\Requests\SettingsRequest;
use Mess\Persistence\ConnectionString;
use Mess\Persistence\CredentialsFile;
use Mess\Persistence\Database\Photo\PhotoRepository;
use Mess\Persistence\Database\User\AvatarUpdateRepository;
use Mess\Persistence\Database\User\LastNameUpdateRepository;
use Mess\Persistence\Database\User\PhoneNumberRepository;
use Mess\Persistence\Database\User\PlaceUpdateRepository;
use Mess\Persistence\Database\User\RelationshipUpdateRepository;
use Mess\Persistence\Database\User\SchoolUpdateRepository;
use Mess\Persistence\Database\User\WorkUpdateRepository;
use Mess\Persistence\Session\HttpSession;
use Mess\View\View;
use Mess\View\Views\SettingsView;
use Mess\View\Views\ValidationErrors;

$session = new HttpSession();
$string = new ConnectionString(new CredentialsFile("connection.txt"));

if ($session->userLoggedIn()) {
    function getView(SettingsRequest $request, HttpSession $session, Settings $settings): View
    {
        $errors = new ValidationErrors();
        foreach ($settings->operations($request, $session) as $operation) {
            $operation->apply($errors);
        }
        return new SettingsView($session->userId(), $errors->validation());
    }

    $settings = new Settings(new PhotoRepository($string->getPdo()),
        new AvatarUpdateRepository($string->getPdo()),
        new LastNameUpdateRepository($string->getPdo()),
        new WorkUpdateRepository($string->getPdo()),
        new SchoolUpdateRepository($string->getPdo()),
        new RelationshipUpdateRepository($string->getPdo()),
        new PhoneNumberRepository($string->getPdo()),
        new PlaceUpdateRepository($string->getPdo()),
        date('Y-m-d'));

    $view = getView(new SettingsRequest($_POST), $session, $settings);
    $view->render();
} else {
    $header = HttpHeader::homepage();
    $header->send();
}
