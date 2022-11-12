<?php
namespace Mess\Application\Operation;

use Mess\Persistence\Database\PostReaction\PostReactionRepository;
use Mess\View\Views\ValidationErrors;

class InsertPostReaction implements Operation
{
    public function __construct(private PostReactionRepository $reactionRepo,
                                private int                    $postId,
                                private int                    $userId,
                                private string                 $reaction)
    {
    }

    public function apply(ValidationErrors $errors): void
    {
        $this->reactionRepo->addReactionIfMissing($this->postId, $this->userId, $this->reaction);
    }
}