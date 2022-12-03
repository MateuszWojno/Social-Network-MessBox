<?php

require_once 'src/autoload.php';

use Mess\Http\HttpHeader;
use Mess\Http\Requests\FriendRequest;
use Mess\Http\Requests\UserIdRequest;
use Mess\Persistence\ConnectionString;
use Mess\Persistence\CredentialsFile;
use Mess\Persistence\Database\Friend\FriendRequestRepository;
use Mess\Persistence\Database\User\FriendRepository;
use Mess\Persistence\Database\User\FriendStatusRepository;
use Mess\Persistence\Session\HttpSession;
use Mess\View\View;
use Mess\View\Views\FriendsView;

$session = new HttpSession();

if ($session->userLoggedIn()) {
    $string = new ConnectionString(new CredentialsFile("connection.txt"));

    function getView(FriendRequest $request, UserIdRequest $id, FriendRepository $friendRepository, FriendStatusRepository $friendStatus, FriendRequestRepository $friendRequestRepository, HttpSession $session): View
    {
        if ($request->wantsDelete()) {
            $friendRequestRepository->responseNegative($session->userId(), $request->friend());
        }

        return new FriendsView(
            $session->userId(),
            $friendRepository->getFriends($id->userId(), $session->userId()),
            $friendStatus->areFriends($session->userId(), $id->userId())
        );
    }

    $view = getView(new FriendRequest($_POST), new UserIdRequest($_GET), new FriendRepository($string->getPdo()), new FriendStatusRepository($string->getPdo()), new FriendRequestRepository($string->getPdo()), $session);
    $view->render();
} else {
    $header = HttpHeader::homepage();
    $header->send();
}
