<?php
namespace Mess\Application;

class Photo
{
    public function __construct(
        public int    $id,
        public int    $likes,
        public int    $dislikes,
        public int    $likeColor,
        public int    $dislikeColor,
        public string $photo,
    )
    {
    }

    public function photoUrl(): string
    {
        return "assets/images/$this->photo";
    }
}