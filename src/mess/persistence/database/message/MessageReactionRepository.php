<?php
namespace Mess\Persistence\Database\Message;

use PDO;

class MessageReactionRepository
{
    public function __construct(private PDO $pdo)
    {
    }

    public function addMessage(int $userId, int $friendId, string $message): void
    {
        $statement = $this->pdo->prepare("INSERT INTO message(`request_from_id`, `request_to_id`, `message`) VALUES (:session, :id, :message)");
        $statement->bindParam(':session', $userId, PDO::PARAM_INT);
        $statement->bindParam(':id', $friendId, PDO::PARAM_INT);
        $statement->bindParam(':message', $message);
        $statement->execute();
    }
}
