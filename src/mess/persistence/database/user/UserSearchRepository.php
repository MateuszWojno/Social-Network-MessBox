<?php
namespace Mess\Persistence\Database\User;

use Mess\Application\Search;
use PDO;

class UserSearchRepository
{
    public function __construct(private PDO $pdo)
    {
    }

    public function searchUsers(string $firstNameOrLastName): array
    {
        $query = $this->pdo->prepare("SELECT user_id, first_name, last_name, avatar FROM user WHERE first_name LIKE :firstName OR last_name LIKE :lastName");
        $search = "%$firstNameOrLastName%";
        $query->bindParam(':firstName', $search);
        $query->bindParam(':lastName', $search);
        $query->execute();

        $searchedUsers = [];
        while ($row = $query->fetch()) {
            $searchedUsers[] = new Search(
                $row['user_id'],
                $row['first_name'],
                $row['last_name'],
                $row['avatar']);
        }
        return $searchedUsers;
    }
}
