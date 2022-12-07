<?php

require_once 'src/autoload.php';

use Mess\Http\HttpHeader;
use Mess\Http\Requests\LoginRequest;
use Mess\Persistence\ConnectionString;
use Mess\Persistence\CredentialsFile;
use Mess\Persistence\Database\User\SignInRepository;
use Mess\Persistence\Database\User\StatisticsRepository;
use Mess\Persistence\Session\HttpSession;
use Mess\Persistence\Session\Session;
use Mess\View\Validation;
use Mess\View\View;
use Mess\View\Views\EmptyView;
use Mess\View\Views\LoginView;

$login = function (Session $session) {
    $string = new ConnectionString(new CredentialsFile("connection.txt"));
    $loginView = function (SignInRepository $signIn, LoginRequest $request, StatisticsRepository $statistics, $session): View {
        if ($request->isSignIn()) {
            if ($request->login() === '' || !$signIn->loginExists($request->login())) {
                return new LoginView(Validation::failure('login', 'Niepoprawny login'));
            }
            if ($request->password() === '') {
                return new LoginView(Validation::failure('password', 'Hasło nie może być puste'));
            }
            if (password_verify($request->password(), $signIn->passwordHash($request->login()))) {
                $userId = $signIn->userId($request->login());
                $session->userLogIn($userId);
                $statistics->setStatus($request->login());
                $statistics->setCountLogging($request->login());
                $header = HttpHeader::profile($userId);
                $header->send();

                return new EmptyView();
            }
            return new LoginView(Validation::failure('password', 'Niepoprawne hasło'));
        }
        return new LoginView(Validation::success());
    };

    $view = $loginView(new SignInRepository($string->getPdo()), new LoginRequest($_POST), new StatisticsRepository($string->getPdo()), $session);
    $view->render();
};

$login (new HttpSession());