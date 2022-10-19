<?php
namespace Mess\Persistence\Database\Friend;

use PDO;

class FriendRepository
{
    public function __construct(private PDO $pdo)
    {
    }

    private function hasFriend(int $userId, int $friendId): bool
    {
        $statement = $this->pdo->prepare("SELECT * FROM user JOIN friend ON user.user_id = friend.request_from_id WHERE request_to_id = :userId AND request_from_id = :friendId OR request_to_id = :friendId AND request_from_id = :userId");
        $statement->bindParam(':userId', $userId, PDO::PARAM_INT);
        $statement->bindParam(':friendId', $friendId, PDO::PARAM_INT);
        $statement->execute();

        return $statement->rowCount();
    }

    public function addPendingStatusIfMissing(int $userId, int $friendId): void
    {
        if (!$this->hasFriend($userId, $friendId)) {
            $statement = $this->pdo->prepare("INSERT INTO friend(`request_from_id`, `request_to_id`, `status`) VALUES (:userId, :friendId, 'oczekujacy')");
            $statement->bindParam(':userId', $userId, PDO::PARAM_INT);
            $statement->bindParam(':friendId', $friendId);
            $statement->execute();
        }
    }

}
