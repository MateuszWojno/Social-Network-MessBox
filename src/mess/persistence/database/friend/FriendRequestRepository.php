<?php
namespace Mess\Persistence\Database\Friend;

use PDO;

class FriendRequestRepository
{
    public function __construct(private PDO $pdo)
    {
    }

    public function responsePositive(int $userId, int $friendId): void
    {
        $statement = $this->pdo->prepare("
            UPDATE friend 
                SET status = 'znajomy'
            WHERE request_to_id = :userId 
              AND request_from_id = :friendId 
               OR request_to_id = :friendId 
              AND request_from_id = :userId
        ");
        $statement->bindParam(':userId', $userId, PDO::PARAM_INT);
        $statement->bindParam(':friendId', $friendId, PDO::PARAM_INT);
        $statement->execute();
    }

    public function responseNegative(int $userId, int $friendId): void
    {
        $statement = $this->pdo->prepare("
            DELETE FROM friend
            WHERE request_to_id = :userId 
              AND request_from_id = :friendId 
               OR request_from_id = :userId
              AND request_to_id = :friendId
        ");
        $statement->bindParam(':userId', $userId, PDO::PARAM_INT);
        $statement->bindParam(':friendId', $friendId, PDO::PARAM_INT);
        $statement->execute();
    }
}
