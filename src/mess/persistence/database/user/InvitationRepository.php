<?php
namespace Mess\Persistence\Database\User;

use Mess\Application\Invitation;
use PDO;

class InvitationRepository
{
    public function __construct(private PDO $pdo)
    {
    }

    public function getInvitations(int $friendUserId): array
    {
        $query = $this->pdo->prepare("
            SELECT user.user_id, avatar, first_name, last_name
            FROM user
            JOIN friend ON user.user_id = friend.request_from_id
            WHERE request_to_id = :id
              AND friend.status = 'oczekujacy'
        ");
        $query->bindParam(':id', $friendUserId, PDO::PARAM_INT);
        $query->execute();

        $invitations = [];
        while ($row = $query->fetch()) {
            $invitations[] = new Invitation(
                $row['user_id'],
                $row['avatar'],
                $row['first_name'],
                $row['last_name']);
        }
        return $invitations;
    }
}
