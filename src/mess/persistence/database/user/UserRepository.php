<?php
namespace Mess\Persistence\Database\User;

use Mess\Application\NewUser;
use PDO;

class UserRepository
{
    public function __construct(private PDO $pdo)
    {
    }

    public function insertUser(NewUser $newUser): void
    {
        $statement = $this->pdo->prepare("
            INSERT INTO user (`login`, `password`, `first_name`, `last_name`, `email`, `avatar`, `number_phone`, `birth_date`, `gender`, `date_registration`) 
                VALUES (:login, :password, :firstName, :lastName, :email, :avatar, :numberPhone, :birthDate, :gender, :dateRegistration)
        ");
        $statement->bindParam(':login', $newUser->login);
        $statement->bindParam(':password', $newUser->hash);
        $statement->bindParam(':firstName', $newUser->firstName);
        $statement->bindParam(':lastName', $newUser->lastName);
        $statement->bindParam(':email', $newUser->email);
        $statement->bindParam(':avatar', $newUser->avatar);
        $statement->bindParam(':numberPhone', $newUser->phoneNumber);
        $statement->bindParam(':birthDate', $newUser->birthDate);
        $statement->bindParam(':gender', $newUser->gender);
        $statement->bindParam(':dateRegistration', $newUser->registrationDate);
        $statement->execute();
    }
}
