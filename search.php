<?php

require_once 'src/autoload.php';

use Mess\Http\HttpHeader;
use Mess\Http\Requests\SearchRequest;
use Mess\Persistence\ConnectionString;
use Mess\Persistence\CredentialsFile;
use Mess\Persistence\Database\User\UserSearchRepository;
use Mess\Persistence\Session\HttpSession;
use Mess\View\Result;
use Mess\View\View;
use Mess\View\Views\SearchView;

$session = new HttpSession();

if ($session->userLoggedIn()) {
    $string = new ConnectionString(new CredentialsFile("connection.txt"));

    function getView(SearchRequest $searchRequest, UserSearchRepository $userSearchRepository, HttpSession $session): View
    {
        if ($searchRequest->searchText() === '') {
            return new SearchView($session->userId(), [], Result::failure('Podaj nazwę użytkownika'));
        }
        $users = $userSearchRepository->searchUsers($searchRequest->searchText());
        if ($users === []) {
            return new SearchView($session->userId(), $users, Result::failure('Nie ma takiego użytkownika'));
        }
        return new SearchView($session->userId(), $users, Result::success());
    }

    $getView = getView(new SearchRequest($_POST), new UserSearchRepository($string->getPdo()), $session);
    $getView->render();
} else {
    $header = HttpHeader::homepage();
    $header->send();
}
