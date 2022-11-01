<?php

namespace Mess\Application;

class UserStatistics
{
    public function __construct(
        public int $amountFriends,
        public int $amountPosts,
        public int $amountPhotos,
        public int $amountPostsLike,
        public int $amountPostsDislike,
        public int $amountPhotosLike,
        public int $amountPhotosDislike,
    )
    {
    }
}