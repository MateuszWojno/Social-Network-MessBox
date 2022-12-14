<?php

require_once 'src/autoload.php';

use Mess\Application\ViewProfile;
use Mess\Http\Headers;
use Mess\Http\Requests\AccountRequest;
use Mess\Persistence\ConnectionString;
use Mess\Persistence\CredentialsFile;
use Mess\Persistence\Database\User\AccountRepository;
use Mess\Persistence\Session\Session;
use Mess\View\View;

return function (Headers $headers, Session $session) {
    $string = new ConnectionString(new CredentialsFile("connection.txt"));
    $account = new AccountRepository($string->getPdo());

    $accountRequest = new AccountRequest($_POST);

    if ($session->userLoggedIn()) {
        $userId = $session->userId();

        if ($accountRequest->isDelete()) {
            $account->delete($userId);
            $session->userLogOut();
        }

        $view = new View('src/Mess/View/pages/account.phtml', [
            'profile' => new ViewProfile($userId),
        ]);
        $view->render();
    } else {
        $header = $headers->homepage();
        $header->send();
    }
};