<?php
namespace Mess\Application\Operation;

use Mess\Persistence\Database\Friend\FriendRepository;
use Mess\View\Views\ValidationErrors;

class UpdateFriendStatus implements Operation
{
    public function __construct(private FriendRepository $friendRepo,
                                private int              $userId,
                                private int              $friendId)
    {
    }

    public function apply(ValidationErrors $errors): void
    {
        $this->friendRepo->addPendingStatusIfMissing($this->userId, $this->friendId);
    }
}