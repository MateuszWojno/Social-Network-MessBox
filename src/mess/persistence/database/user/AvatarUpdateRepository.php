<?php
namespace Mess\Persistence\Database\User;

use PDO;

class AvatarUpdateRepository
{
    public function __construct(private PDO $pdo)
    {
    }

    public function setAvatar(int $id, string $photo): void
    {
        $statement = $this->pdo->prepare("UPDATE user set avatar = :avatar where user_id = :id");
        $statement->bindParam(':avatar', $photo, PDO::PARAM_STR);
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->execute();
    }
}
