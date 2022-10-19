<?php
namespace Mess\Persistence\Database\Message;

use Mess\Application\Message;
use PDO;

class MessageRepository
{
    public function __construct(private PDO $pdo)
    {
    }

    /**
     * @return Message[]
     */
    public function messages(int $userId, int $friendId): array
    {
        $query = $this->pdo->prepare("
            SELECT 
                request_from_id, 
                avatar, 
                CONCAT(first_name, ' ', last_name) AS name, 
                message
            FROM message 
            JOIN user 
                ON message.request_from_id = user.user_id 
            WHERE (request_from_id= :userId and request_to_id = :friendId) 
               OR (request_from_id = :friendId and request_to_id = :userId)
            ORDER BY message.message_id
        ");
        $query->bindParam(':userId', $userId, PDO::PARAM_INT);
        $query->bindParam(':friendId', $friendId, PDO::PARAM_INT);
        $query->execute();

        $messages = [];
        while ($row = $query->fetch()) {
            $messages[] = new Message(
                (int)$row['request_from_id'] === $userId,
                $row['avatar'],
                $row['name'],
                $row['message']);
        }

        return $messages;
    }
}
