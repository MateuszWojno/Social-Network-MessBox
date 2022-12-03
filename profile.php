<?php

require_once 'src/autoload.php';

use Mess\Application\Profile;
use Mess\Http\HttpHeader;
use Mess\Http\Requests\ProfileRequest;
use Mess\Http\Requests\UserIdRequest;
use Mess\Persistence\ConnectionString;
use Mess\Persistence\CredentialsFile;
use Mess\Persistence\Database\Friend\FriendRepository;
use Mess\Persistence\Database\PostReaction\PostReactionRepository;
use Mess\Persistence\Database\PostReaction\PostRepository;
use Mess\Persistence\Database\User\FriendStatusRepository;
use Mess\Persistence\Database\User\UserReadRepository;
use Mess\Persistence\Session\HttpSession;
use Mess\View\View;
use Mess\View\Views\ProfileView;
use Mess\View\Views\ValidationErrors;

$session = new HttpSession();

if ($session->userLoggedIn()) {
    $string = new ConnectionString(new CredentialsFile("connection.txt"));

    function getView(ProfileRequest $request,
                     HttpSession    $session,
                     Profile        $profile): View
    {
        $errors = new ValidationErrors();
        foreach ($profile->operations($session) as $operation) {
            $operation->apply($errors);
        }
        $userId = $session->userId();

        return new ProfileView($session->userId(),
            $profile->user($request->userId()),
            $errors->validation(),
            $profile->userPosts($request->userId(), $userId),
            $profile->friendStatus($request->userId(), $userId));
    }

    $profile = new Profile(new \Mess\Persistence\Database\Post\PostRepository($string->getPdo()),
        new FriendRepository($string->getPdo()),
        new PostReactionRepository($string->getPdo()),
        date("Y-m-d:H:i:s"),
        new ProfileRequest($_POST, new UserIdRequest($_GET)),
        new UserReadRepository($string->getPdo()),
        new FriendStatusRepository($string->getPdo()),
        new PostRepository($string->getPdo()));

    $view = getView(new ProfileRequest($_POST, new UserIdRequest($_GET)),
        $session,
        $profile);
    $view->render();

} else {
    $header = HttpHeader::homepage();
    $header->send();
}
