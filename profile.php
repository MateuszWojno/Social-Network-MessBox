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
use Mess\View\Result;
use Mess\View\View;
use Mess\View\Views\ProfileView;

$session = new Session();

if ($session->userLoggedIn()) {
    $string = new ConnectionString(new CredentialsFile("connection.txt"));

    function getView(ProfileRequest                                 $request,
                     UserReadRepository                             $userRead,
                     PostRepository                                 $postRepository,
                     UserIdRequest                                  $id,
                     FriendRepository                               $friendRepository,
                     Session                                        $session,
                     PostReactionRepository                         $reactionRepo,
                     FriendStatusRepository                         $statusRepo,
                     \Mess\Persistence\Database\Post\PostRepository $addingPost): View
    {
        $userId = $session->userId();
        $user = $userRead->fetchUser($id->getUserId());
        $posts = $postRepository->fetchPosts($id->getUserId(), $userId);
        $status = $statusRepo->friendStatus($id->getUserId(), $session->userId());

        if ($request->wantsAddFriend()) {
            $friendRepository->addPendingStatusIfMissing($userId, $id->getUserId());
        }

        if ($request->wantsSubmitPost()) {
            if ($request->post() === '') {
                return new ProfileView($userId, $user, Result::failure('Puste pole'), $posts, $status);
            }
            if (!preg_match('/^[a-zA-Z-0-9ąćęłńóśźż?,._\-\s]{1,400}$/', $request->post())) {
                return new ProfileView($userId, $user, Result::failure('Niedozwolone znaki, lub za długi tekst'), $posts, $status);
            }
            $addingPost->addPost($userId, $request->post(), date("Y-m-d-H:i:s"));
        }

        if ($request->wantsSubmitLike()) {
            $postId = $request->postIdLike();
            $reactionRepo->addReactionIfMissing($postId, $userId, 'like');
        } else if ($request->wantsSubmitDislike()) {
            $postId = $request->postIdDislike();
            $reactionRepo->addReactionIfMissing($postId, $userId, 'dislike');
        }

        return new ProfileView($userId, $user, Result::success(), $posts, $status);
    }

    $view = getView(new ProfileRequest($_POST),
        new UserReadRepository($string->getPdo()),
        new PostRepository($string->getPdo()),
        new UserIdRequest($_GET),
        new FriendRepository($string->getPdo()), $session,
        new PostReactionRepository($string->getPdo()),
        new FriendStatusRepository($string->getPdo()),
        new \Mess\Persistence\Database\Post\PostRepository($string->getPdo()));
    $view->render();
} else {
    $header = Header::homepage();
    $header->send();
}
