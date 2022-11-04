<?php

require_once 'src/autoload.php';

use Mess\Http\Header;
use Mess\Http\Requests\ProfileRequest;
use Mess\Http\Requests\UserIdRequest;
use Mess\Persistence\ConnectionString;
use Mess\Persistence\CredentialsFile;
use Mess\Persistence\Database\Friend\FriendRepository;
use Mess\Persistence\Database\PostReaction\PostReactionRepository;
use Mess\Persistence\Database\PostReaction\PostRepository;
use Mess\Persistence\Database\User\FriendStatusRepository;
use Mess\Persistence\Database\User\UserReadRepository;
use Mess\Persistence\Session\Session;
use Mess\View\Validation;
use Mess\View\View;
use Mess\View\Views\ProfileView;

$session = new Session();

if ($session->userLoggedIn()) {
    $string = new ConnectionString(new CredentialsFile("connection.txt"));

    function getView(ProfileRequest                                 $request,
                     UserReadRepository                             $userRead,
                     PostRepository                                 $postRepository,
                     FriendRepository                               $friendRepository,
                     Session                                        $session,
                     PostReactionRepository                         $reactionRepo,
                     FriendStatusRepository                         $statusRepo,
                     \Mess\Persistence\Database\Post\PostRepository $addingPost): View
    {
        $userId = $session->userId();
        $user = $userRead->fetchUser($request->userId());
        $posts = $postRepository->fetchPosts($request->userId(), $userId);
        $status = $statusRepo->friendStatus($request->userId(), $session->userId());

        if ($request->wantsAddFriend()) {
            $friendRepository->addPendingStatusIfMissing($userId, $request->userId());
            return new ProfileView($userId, $user, Validation::success(), $posts, $status);
        }
        if ($request->wantsSubmitPost()) {
            if ($request->post() === '') {
                return new ProfileView($userId, $user, Validation::failure('post', 'Puste pole'), $posts, $status);
            }
            if (!preg_match('/^[a-zA-Z-0-9ąćęłńóśźż?,._\-\s]{1,400}$/', $request->post())) {
                return new ProfileView($userId, $user, Validation::failure('post', 'Niedozwolone znaki, lub za długi tekst'), $posts, $status);
            }
            $addingPost->addPost($userId, $request->post(), date("Y-m-d-H:i:s"));
            return new ProfileView($userId, $user, Validation::success(), $posts, $status);
        }

        if ($request->wantsSubmitLike()) {
            $reactionRepo->addReactionIfMissing($request->postIdLike(), $userId, 'like');
            return new ProfileView($userId, $user, Validation::success(), $posts, $status);
        }
        if ($request->wantsSubmitDislike()) {
            $reactionRepo->addReactionIfMissing($request->postIdDislike(), $userId, 'dislike');
            return new ProfileView($userId, $user, Validation::success(), $posts, $status);
        }

        return new ProfileView($userId, $user, Validation::success(), $posts, $status);
    }

    $view = getView(new ProfileRequest($_POST, new UserIdRequest($_GET)),
        new UserReadRepository($string->getPdo()),
        new PostRepository($string->getPdo()),
        new FriendRepository($string->getPdo()), $session,
        new PostReactionRepository($string->getPdo()),
        new FriendStatusRepository($string->getPdo()),
        new \Mess\Persistence\Database\Post\PostRepository($string->getPdo()));
    $view->render();
} else {
    $header = Header::homepage();
    $header->send();
}
