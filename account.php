<?php

require_once 'src/autoload.php';

use Mess\Application\ViewProfile;
use Mess\Http\HttpHeader;
use Mess\Http\Requests\AccountRequest;
use Mess\Persistence\ConnectionString;
use Mess\Persistence\CredentialsFile;
use Mess\Persistence\Database\User\AccountRepository;
use Mess\Persistence\Session\HttpSession;
use Mess\View\View;

$string = new ConnectionString(new CredentialsFile("connection.txt"));
$account = new AccountRepository($string->getPdo());

$session = new HttpSession();
$accountRequest = new AccountRequest($_POST);

if ($session->userLoggedIn()) {
    $userId = $session->userId();

    if ($accountRequest->isDelete()) {
        $account->delete($userId);
        $session->userLogOut();
    }

    $view = new View('src/mess/view/pages/account.phtml', [
        'profile' => new ViewProfile($userId),
    ]);
    $view->render();
} else {
    $header = HttpHeader::homepage();
    $header->send();
}
