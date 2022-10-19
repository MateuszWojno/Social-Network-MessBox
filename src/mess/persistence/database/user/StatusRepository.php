<?php
namespace Mess\Persistence\Database\User;

use PDO;

class StatusRepository
{
    public function __construct(private PDO $pdo)
    {
    }

    public function setStatus(int $sessionId): void
    {
        $statement = $this->pdo->prepare("UPDATE user set status = 'offline' where user_id = :id");
        $statement->bindParam(':id', $sessionId, PDO::PARAM_INT);
        $statement->execute();
    }
}
