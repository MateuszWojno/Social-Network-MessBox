<?php
namespace Mess\Persistence;

use Mess\Persistence\Database\CachedConnection;
use Mess\Persistence\Database\Connection;
use PDO;

class ConnectionString
{
    private CachedConnection $connection;

    public function __construct(CredentialsFile $file)
    {
        $connection = new Connection($file->hostname(), $file->username(), $file->password(), $file->database());
        $this->connection = new CachedConnection($connection);
    }

    public function getPdo(): PDO
    {
        return $this->connection->getPdo();
    }
}

