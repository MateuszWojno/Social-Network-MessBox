<?php
namespace Mess\Persistence\Database\PostReaction;

use Mess\Application\Posts;
use PDO;

class PostRepository
{
    public function __construct(private PDO $pdo)
    {
    }

    public function fetchPosts(int $id, int $sessionId): array
    {
        $query = $this->pdo->prepare("
            SELECT
                post.post_id,
                CONCAT(first_name, ' ', last_name) AS author, 
                date_to_add, 
                comment,
                (SELECT count(*) FROM post_reaction WHERE post_reaction.post_id = post.post_id AND reaction = 'like') AS likes,
                (SELECT count(*) FROM post_reaction WHERE post_reaction.post_id = post.post_id AND reaction = 'dislike') AS dislikes,
                (SELECT count(*) FROM post_reaction WHERE post_reaction.post_id = post.post_id AND post_reaction.user_id = :id AND reaction = 'like') AS like_color, 
                (SELECT count(*) FROM post_reaction WHERE post_reaction.post_id = post.post_id AND post_reaction.user_id = :id AND reaction = 'dislike') AS dislike_color 
            FROM user
            JOIN post 
                ON user.user_id = post.user_id
            WHERE post.user_id = :user_id
            ORDER BY post.post_id DESC
        ");
        $query->bindParam(':user_id', $id, PDO::PARAM_INT);
        $query->bindParam(':id', $sessionId, PDO::PARAM_INT);
        $query->execute();

        $posts = [];

        while ($row = $query->fetch()) {
            $posts[] = new Posts(
                $row['post_id'],
                $row['author'],
                $row['date_to_add'],
                $row['comment'],
                $row['likes'],
                $row['dislikes'],
                $row['like_color'],
                $row['dislike_color']);
        }

        return $posts;
    }
}
