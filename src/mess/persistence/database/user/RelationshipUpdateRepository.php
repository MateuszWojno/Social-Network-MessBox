<?php
namespace Mess\Persistence\Database\User;

use PDO;

class RelationshipUpdateRepository
{

    public function __construct(
        private PDO $pdo,
    )
    {
    }

    public function setRelationship(int $id, string $relationship): void
    {
        $statement = $this->pdo->prepare("UPDATE user set martial_status = :relationship where user_id = :id");
        $statement->bindParam(':relationship', $relationship, PDO::PARAM_STR);
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->execute();
    }
}