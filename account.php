<?php

require_once 'src/autoload.php';

use Mess\Application\Profile;
use Mess\Http\Header;
use Mess\Http\Requests\AccountRequest;
use Mess\Persistence\ConnectionString;
use Mess\Persistence\CredentialsFile;
use Mess\Persistence\Database\User\AccountRepository;
use Mess\Persistence\Session\Session;
use Mess\View\View;

$string = new ConnectionString(new CredentialsFile("connection.txt"));
$account = new AccountRepository($string->getPdo());

$session = new Session();
$accountRequest = new AccountRequest($_POST);

if ($session->userLoggedIn()) {
    $userId = $session->userId();

    if ($accountRequest->isDelete()) {
        $account->delete($userId);
        $session->userLogOut();
    }

    $view = new View('src/mess/view/pages/account.php', [
        'profile' => new Profile($userId),
    ]);
    $view->render();
} else {
    $header = Header::homepage();
    $header->send();
}
