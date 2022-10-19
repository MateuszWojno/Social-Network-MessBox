<?php
namespace Mess\Persistence\Database\User;

use PDO;

class LastNameUpdateRepository
{
    public function __construct(private PDO $pdo)
    {
    }

    public function setLastName(int $id, string $lastName): void
    {
        $statement = $this->pdo->prepare("UPDATE user set last_name = :last_name where user_id = :id");
        $statement->bindParam(':last_name', $lastName, PDO::PARAM_STR);
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->execute();
    }
}
