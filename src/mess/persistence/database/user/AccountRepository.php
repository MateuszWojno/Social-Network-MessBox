<?php
namespace Mess\Persistence\Database\User;

use PDO;

class AccountRepository
{
    public function __construct(private PDO $pdo)
    {
    }

    public function delete(int $userId): void
    {
        $statement = $this->pdo->prepare("DELETE from user where user_id = :id");
        $statement->bindParam(':id', $userId, PDO::PARAM_INT);
        $statement->execute();
    }
}