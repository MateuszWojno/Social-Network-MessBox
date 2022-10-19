<?php
namespace Mess\Persistence\Database;

use PDO;

class CachedConnection
{
    private Connection $connection;
    private ?PDO $pdo;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
        $this->pdo = null;
    }

    public function getPdo(): PDO
    {
        if ($this->pdo === null) {
            $this->pdo = $this->connection->getPdo();
        }
        return $this->pdo;
    }
}
