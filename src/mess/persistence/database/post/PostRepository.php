<?php
namespace Mess\Persistence\Database\Post;

use PDO;

class PostRepository
{
    public function __construct(private PDO $pdo)
    {
    }

    public function addPost(int $userId, string $content, string $date): void
    {
        $statement = $this->pdo->prepare("INSERT INTO post(`user_id`, `comment`, `date_to_add`) 
            VALUES(:userId, :content, :date)");
        $statement->bindParam(':userId', $userId, PDO::PARAM_INT);
        $statement->bindParam(':content', $content, PDO::PARAM_STR);
        $statement->bindParam(':date', $date, PDO::PARAM_STR);
        $statement->execute();
    }
}
