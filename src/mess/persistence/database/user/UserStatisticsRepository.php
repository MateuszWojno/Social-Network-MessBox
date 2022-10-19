<?php
namespace Mess\Persistence\Database\User;

use PDO;

class UserStatisticsRepository
{
    public function __construct(private PDO $pdo)
    {
    }

    public function countPost(int $sessionId): int
    {
        $query = $this->pdo->prepare("SELECT count(*) as count_post from post where user_id= :id");
        $query->bindParam(':id', $sessionId, PDO::PARAM_INT);
        $query->execute();

        $row = $query->fetch(PDO::FETCH_ASSOC);
        return $row['count_post'];
    }

    public function countPhoto(int $sessionId): int
    {
        $query = $this->pdo->prepare("SELECT count(*) as count_photo from photo where user_id= :id");
        $query->bindParam(':id', $sessionId, PDO::PARAM_INT);
        $query->execute();

        $row = $query->fetch(PDO::FETCH_ASSOC);
        return $row['count_photo'];
    }

    public function countPostLike(int $sessionId, string $like): int
    {
        $query = $this->pdo->prepare("SELECT count(*) as count_like FROM `post_reaction` WHERE user_id = :id and reaction = :like");
        $query->bindParam(':id', $sessionId, PDO::PARAM_INT);
        $query->bindParam(':like', $like, PDO::PARAM_STR);
        $query->execute();

        $row = $query->fetch(PDO::FETCH_ASSOC);
        return $row['count_like'];
    }

    public function countPostDislike(int $sessionId, string $dislike): int
    {
        $query = $this->pdo->prepare("SELECT count(*) as count_dislike FROM `post_reaction` WHERE user_id = :id and reaction = :dislike");
        $query->bindParam(':id', $sessionId, PDO::PARAM_INT);
        $query->bindParam(':dislike', $dislike, PDO::PARAM_STR);
        $query->execute();

        $row = $query->fetch(PDO::FETCH_ASSOC);
        return $row['count_dislike'];
    }

    public function countPhotoDislike(int $sessionId, string $dislike): int
    {
        $query = $this->pdo->prepare("SELECT count(*) as count_dislike_photo FROM `photo_reaction` WHERE user_id = :id and reaction = :dislike");
        $query->bindParam(':id', $sessionId, PDO::PARAM_INT);
        $query->bindParam(':dislike', $dislike, PDO::PARAM_STR);
        $query->execute();

        $row = $query->fetch(PDO::FETCH_ASSOC);
        return $row['count_dislike_photo'];
    }

    public function countPhotoLike(int $sessionId, string $like): int
    {
        $query = $this->pdo->prepare("SELECT count(*) as count_like_photo FROM `photo_reaction` WHERE user_id = :id and reaction = :like");
        $query->bindParam(':id', $sessionId, PDO::PARAM_INT);
        $query->bindParam(':like', $like, PDO::PARAM_STR);
        $query->execute();

        $row = $query->fetch(PDO::FETCH_ASSOC);
        return $row['count_like_photo'];
    }

    public function countFriend(int $sessionId): int
    {
        $query = $this->pdo->prepare("SELECT count(*) as count_friend FROM `friend` WHERE (request_from_id = :id OR request_to_id = :id) and status = 'znajomy';");
        $query->bindParam(':id', $sessionId, PDO::PARAM_INT);
        $query->execute();

        $row = $query->fetch(PDO::FETCH_ASSOC);
        return $row['count_friend'];
    }

}
