<?php
namespace Mess\Persistence\Database\User;

use PDO;

class SchoolUpdateRepository
{
    public function __construct(private PDO $pdo)
    {
    }

    public function setSchool(int $id, string $school): void
    {
        $statement = $this->pdo->prepare("UPDATE user set school = :school where user_id = :id");
        $statement->bindParam(':school', $school, PDO::PARAM_STR);
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->execute();
    }
}