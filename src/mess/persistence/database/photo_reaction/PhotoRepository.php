<?php
namespace Mess\Persistence\Database\PhotoReaction;

use Mess\Application\Photo;
use PDO;

class PhotoRepository
{
    public function __construct(
        private PDO $pdo,
    )
    {
    }

    public function getPhotos(int $id, int $sessionId): array
    {
        $query = $this->pdo->prepare("SELECT photo.photo_id as id, (select count(*)  from photo_reaction WHERE photo_reaction.photo_id=photo.photo_id and reaction = 'like') as likes, (select count(*)  from photo_reaction WHERE photo_reaction.photo_id=photo.photo_id and reaction = 'dislike') as dislikes, (select count(*) from photo_reaction WHERE photo_reaction.photo_id=photo.photo_id and photo_reaction.user_id=:id and reaction = 'like') as like_color, (select count(*) from photo_reaction WHERE photo_reaction.photo_id=photo.photo_id and photo_reaction.user_id=:id and reaction = 'dislike') as dislike_color, photo FROM user join photo on photo.user_id=user.user_id where user.user_id = :user_id order by photo.photo_id DESC ");
        $query->bindParam(':user_id', $id, PDO::PARAM_INT);
        $query->bindParam(':id', $sessionId, PDO::PARAM_INT);
        $query->execute();

        $photo = [];
        while ($row = $query->fetch()) {
            $photo[] = new Photo(
                $row['id'],
                $row['likes'],
                $row['dislikes'],
                $row['like_color'],
                $row['dislike_color'],
                $row['photo']);
        }
        return $photo;
    }
}

