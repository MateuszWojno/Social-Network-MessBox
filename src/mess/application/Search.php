<?php
namespace Mess\Application;

class Search
{
    public function __construct(
        public int    $userId,
        public string $firstName,
        public string $lastName,
        public string $avatar,
    )
    {
    }

    public function avatarUrl(): string
    {
        return "assets/images/$this->avatar";
    }

    public function profileUrl(): string
    {
        return 'profile.php?id=' . urlEncode($this->userId);
    }
}