<?php
namespace Mess\Persistence\Database\PhotoReaction;

use PDO;

class PhotoReactionRepository
{
    public function __construct(private PDO $pdo)
    {
    }

    private function hasPhotoReaction(int $photoId, int $userId): bool
    {
        $query = $this->pdo->prepare("SELECT * FROM photo_reaction  where photo_id= :photoId and user_id = :userId and (reaction= 'dislike' or reaction='like')");
        $query->bindParam(':photoId', $photoId, PDO::PARAM_INT);
        $query->bindParam(':userId', $userId, PDO::PARAM_INT);
        $query->execute();

        return $query->RowCount();
    }

    public function addReactionIfMissing(int $photoId, int $userId, string $reaction): void
    {
        if ($this->hasPhotoReaction($photoId, $userId) === false) {
            $statement = $this->pdo->prepare("INSERT INTO photo_reaction (`photo_id`, `user_id`, `reaction`) VALUES(:photo_id, :user_id, :reaction)");
            $statement->bindParam(':photo_id', $photoId, PDO::PARAM_INT);
            $statement->bindParam(':user_id', $userId, PDO::PARAM_INT);
            $statement->bindParam(':reaction', $reaction, PDO::PARAM_STR);
            $statement->execute();
        }
    }
}
