<?php
namespace Mess\Persistence\Database\User;

use PDO;

class PlaceUpdateRepository
{
    public function __construct(private PDO $pdo)
    {
    }

    public function setPlace(int $id, string $place): void
    {
        $statement = $this->pdo->prepare("UPDATE user set place_living = :place where user_id = :id");
        $statement->bindParam(':place', $place, PDO::PARAM_STR);
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->execute();
    }
}
