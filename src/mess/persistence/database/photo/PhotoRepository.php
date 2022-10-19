<?php
namespace Mess\Persistence\Database\Photo;

use PDO;

class PhotoRepository
{
    public function __construct(private PDO $pdo)
    {
    }

    public function addPhoto(int $userId, string $photo, string $date): void
    {
        $statement = $this->pdo->prepare('
            INSERT 
                INTO photo (`user_id`, `photo`, `date_to_add`) 
                VALUES (
                    (SELECT user_id from user where user_id = :userId),
                    :photo, 
                    :date
                )
            ');
        $statement->bindParam(':userId', $userId, PDO::PARAM_INT);
        $statement->bindParam(':photo', $photo);
        $statement->bindParam(':date', $date);
        $statement->execute();
    }
}
