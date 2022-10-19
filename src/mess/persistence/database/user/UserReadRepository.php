<?php
namespace Mess\Persistence\Database\User;

use Mess\Application\User;
use Mess\Persistence\Database\PersistenceException;
use PDO;

class UserReadRepository
{
    public function __construct(private PDO $pdo)
    {
    }

    public function fetchUser(int $userId): User
    {
        $query = $this->pdo->prepare("
            SELECT 
                user_id, first_name, last_name, avatar, 
                birth_date, gender, email, school, work, 
                place_living, martial_status, number_phone, status 
            FROM user 
            WHERE user_id = :id");
        $query->bindParam(':id', $userId, PDO::PARAM_INT);
        $query->execute();

        if ($query->rowCount()) {
            $row = $query->fetch();
            return new User(
                $row['user_id'],
                $row['first_name'],
                $row['last_name'],
                $row['avatar'],
                $row['birth_date'],
                $row['gender'],
                $row['email'],
                $row['school'],
                $row['work'],
                $row['place_living'],
                $row['martial_status'],
                $row['number_phone'],
                $row['status']);
        }
        throw new PersistenceException("There isn't someone with that user");
    }
}
