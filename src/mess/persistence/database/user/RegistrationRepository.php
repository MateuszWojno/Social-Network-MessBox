<?php
namespace Mess\Persistence\Database\User;

use PDO;

class RegistrationRepository
{
    public function __construct(private PDO $pdo)
    {
    }

    public function loginExists(string $login): bool
    {
        $query = $this->pdo->prepare("Select * from user where login = :login");
        $query->bindParam(':login', $login, PDO::PARAM_STR);
        $query->execute();
        return $query->rowCount();
    }

    public function emailExists(string $email): bool
    {
        $query = $this->pdo->prepare("Select * from user where email = :email");
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->execute();
        return $query->rowCount();
    }

    public function phoneNumberExists(string $phoneNumber): bool
    {
        $query = $this->pdo->prepare("Select * from user where number_phone = :phoneNumber");
        $query->bindParam(':phoneNumber', $phoneNumber, PDO::PARAM_INT);
        $query->execute();
        return $query->rowCount();
    }
}
