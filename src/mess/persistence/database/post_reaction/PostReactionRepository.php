<?php
namespace Mess\Persistence\Database\PostReaction;

use PDO;

class PostReactionRepository
{
    public function __construct(private PDO $pdo)
    {
    }

    private function hasPostReaction(int $postId, int $userId): bool
    {
        $query = $this->pdo->prepare("SELECT * FROM post_reaction  where post_id= :postId and user_id = :userId and (reaction= 'dislike' or reaction='like')");
        $query->bindParam(':postId', $postId, PDO::PARAM_INT);
        $query->bindParam(':userId', $userId, PDO::PARAM_INT);
        $query->execute();

        return $query->RowCount();
    }

    public function addReactionIfMissing(int $postId, int $userId, string $reaction): void
    {
        if ($this->hasPostReaction($postId, $userId) === false) {
            $statement = $this->pdo->prepare("INSERT INTO post_reaction (`post_id`, `user_id`, `reaction`) VALUES(:post_id, :user_id, :reaction)");
            $statement->bindParam(':post_id', $postId, PDO::PARAM_INT);
            $statement->bindParam(':user_id', $userId, PDO::PARAM_INT);
            $statement->bindParam(':reaction', $reaction, PDO::PARAM_STR);
            $statement->execute();
        }
    }
}
