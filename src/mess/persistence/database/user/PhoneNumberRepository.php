<?php
namespace Mess\Persistence\Database\User;

use PDO;

class PhoneNumberRepository
{
    public function __construct(private PDO $pdo)
    {
    }

    public function setPhoneNumber(int $userId, string $phoneNumber): void
    {
        $statement = $this->pdo->prepare("UPDATE user set number_phone = :phoneNumber where user_id = :userId");
        $statement->bindParam(':userId', $userId, PDO::PARAM_INT);
        $statement->bindParam(':phoneNumber', $phoneNumber, PDO::PARAM_STR);
        $statement->execute();
    }
}
