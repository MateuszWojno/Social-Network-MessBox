<?php
namespace Mess\Application;

class Invitation
{
    public function __construct(
        public int    $userId,
        public string $avatar,
        public string $firstName,
        public string $lastName,
    )
    {
    }

    public function avatarUrl(): string
    {
        return "assets/images/$this->avatar";
    }
}