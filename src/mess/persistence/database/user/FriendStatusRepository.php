<?php
namespace Mess\Persistence\Database\User;

use PDO;
use Mess\Application\FriendStatus;

class FriendStatusRepository
{
    public function __construct(private PDO $pdo)
    {
    }

    public function areFriends(int $userId, int $friendId): bool
    {
        return $this->friendStatus($userId, $friendId) === 'znajomy';
    }

    private function fetchFriendStatus(int $userId, int $friendId): string
    {
        $query = $this->pdo->prepare("
            SELECT friend.status AS status 
            FROM user 
            JOIN friend ON user.user_id = friend.request_from_id
            WHERE request_to_id = :userId 
              AND request_from_id = :friendId 
               OR request_to_id = :friendId 
              AND request_from_id = :userId
        ");
        $query->bindParam(':userId', $userId, PDO::PARAM_INT);
        $query->bindParam(':friendId', $friendId, PDO::PARAM_INT);
        $query->execute();

        $result = $query->fetch(PDO::FETCH_ASSOC);
        if ($query->rowCount()) {
            return $result['status'];
        }

        return 'Nieznajomy';
    }

    public function friendStatus(int $userId, int $friendId): FriendStatus
    {
        if ($userId === $friendId) {
            return FriendStatus::ownProfile();
        }
        if ($this->fetchFriendStatus($userId, $friendId) === 'znajomy') {
            return FriendStatus::friend();
        }
        if ($this->fetchFriendStatus($userId, $friendId) === 'oczekujacy') {
            return FriendStatus::awaiting();
        }
        return FriendStatus::unknown();
    }
}
