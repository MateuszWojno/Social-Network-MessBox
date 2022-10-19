<?php
namespace Mess\Persistence\Database\User;

use Mess\Application\Friend;
use PDO;

class FriendRepository
{
    public function __construct(private PDO $pdo)
    {
    }

    public function getFriends(int $id, int $sessionId): array
    {
        $query = $this->pdo->prepare("
            SELECT user.user_id, avatar, first_name, last_name
            FROM user
            JOIN friend ON user.user_id = friend.request_from_id
            where request_to_id = :id AND friend.status='znajomy'
            UNION ALL 
                SELECT user.user_id, avatar, first_name, last_name
                FROM user
                JOIN friend ON user.user_id = friend.request_to_id
                where request_from_id = :id AND friend.status='znajomy'");
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        $query->bindParam(':session', $sessionId, PDO::PARAM_INT);
        $query->execute();

        $friends = [];
        while ($row = $query->fetch()) {
            $friends[] = new Friend(
                $row['user_id'],
                $row['avatar'],
                $row['first_name'],
                $row['last_name']);
        }
        return $friends;
    }
}
