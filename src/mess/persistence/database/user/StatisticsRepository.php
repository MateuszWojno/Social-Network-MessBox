<?php
namespace Mess\Persistence\Database\User;

use PDO;

class StatisticsRepository
{
    public function __construct(private PDO $pdo)
    {
    }

    public function setStatus(string $login): void
    {
        $statement = $this->pdo->prepare("UPDATE user set status= 'online' where login = :login");
        $statement->bindParam(':login', $login, PDO::PARAM_STR);
        $statement->execute();
    }

    public function setCountLogging(string $login): void
    {
        $statement = $this->pdo->prepare("UPDATE user set count_logging = count_logging+1 where login = :login");
        $statement->bindParam(':login', $login, PDO::PARAM_STR);
        $statement->execute();
    }
}
