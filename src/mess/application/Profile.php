<?php
namespace Mess\Application;

use Mess\Application\Operation\InsertPostOperation;
use Mess\Application\Operation\InsertPostReaction;
use Mess\Application\Operation\UpdateFriendStatus;
use Mess\Http\Requests\ProfileRequest;
use Mess\Persistence\Database\Friend\FriendRepository;
use Mess\Persistence\Database\Post\PostRepository;
use Mess\Persistence\Database\PostReaction\PostReactionRepository;
use Mess\Persistence\Database\User\FriendStatusRepository;
use Mess\Persistence\Database\User\UserReadRepository;
use Mess\Persistence\Session\Session;

class Profile
{
    public function __construct(private PostRepository                                         $addingPost,
                                private FriendRepository                                       $friendRepo,
                                private PostReactionRepository                                 $reactionRepo,
                                private string                                                 $date,
                                private ProfileRequest                                         $request,
                                private UserReadRepository                                     $readRepository,
                                private FriendStatusRepository                                 $statusRepo,
                                private \Mess\Persistence\Database\PostReaction\PostRepository $postRepository)
    {
    }

    public function operations(Session $session): array
    {
        $operations = [];
        if ($this->request->wantsAddFriend()) {
            $operations[] = new UpdateFriendStatus($this->friendRepo, $session->userId(), $this->request->userId());
        }
        if ($this->request->wantsSubmitPost()) {
            $operations[] = new InsertPostOperation($this->addingPost, $session->userId(), $this->request->post(), $this->date, $this->request);
        }
        if ($this->request->wantsSubmitLike()) {
            $operations[] = new InsertPostReaction($this->reactionRepo, $this->request->postIdLike(), $session->userId(), 'like');
        }
        if ($this->request->wantsSubmitDislike()) {
            $operations[] = new InsertPostReaction($this->reactionRepo, $this->request->postIdDislike(), $session->userId(), 'dislike');
        }
        return $operations;
    }

    public function user(int $userId): User
    {
        return $this->readRepository->fetchUser($userId);
    }

    public function userPosts(int $userId, int $sessionId): array
    {
        return $this->postRepository->fetchPosts($userId, $sessionId);
    }

    public function friendStatus(int $userId, $sessionId): FriendStatus
    {
        return $this->statusRepo->friendStatus($userId, $sessionId);
    }
}
