<?php
namespace Mess\Persistence\Database\User;

use PDO;

class WorkUpdateRepository
{
    public function __construct(private PDO $pdo)
    {
    }

    public function setWork(int $id, string $work): void
    {
        $statement = $this->pdo->prepare("UPDATE user set work = :work where user_id = :id");
        $statement->bindParam(':work', $work, PDO::PARAM_STR);
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->execute();
    }
}
