<?php
namespace Mess\Persistence\Database\User;

use Mess\Persistence\Database\PersistenceException;
use PDO;

class SignInRepository
{
    public function __construct(private PDO $pdo)
    {
    }

    public function loginExists(string $login): bool
    {
        $query = $this->pdo->prepare("SELECT * FROM user where login = :login");
        $query->bindParam(':login', $login, PDO::PARAM_STR);
        $query->execute();
        return $query->rowCount();
    }

    public function passwordHash(string $login): string
    {
        $query = $this->pdo->prepare("SELECT * FROM user where login = :login");
        $query->bindParam(':login', $login, PDO::PARAM_STR);
        $query->execute();
        if ($query->rowCount()) {
            $row = $query->fetch();
            return $row['password'];
        }
        throw new PersistenceException("There isn't someone with that login");
    }

    public function userId(string $login): int
    {
        $query = $this->pdo->prepare("SELECT * FROM user where login = :login");
        $query->bindParam(':login', $login, PDO::PARAM_STR);
        $query->execute();

        if ($query->rowCount()) {
            $row = $query->fetch();
            return (int)$row['user_id'];
        }
        throw new PersistenceException("There isn't someone with that login");
    }
}
