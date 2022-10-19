<?php
namespace Mess\Application;

class Posts
{
    public function __construct(
        public int    $postId,
        public string $author,
        public string $dateToAdd,
        public string $comment,
        public int    $likes,
        public int    $dislike,
        public int    $likeColor,
        public int    $dislikeColor,
    )
    {
    }
}
