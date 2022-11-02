<?php

namespace Mess\Application;

class User
{
    public function __construct(
        public int    $userId,
        public string $firstName,
        public string $lastName,
        public string $avatar,
        public string $birthDate,
        public string $gender,
        public string $email,
        public string $school,
        public string $work,
        public string $placeLiving,
        public string $martialStatus,
        public string $numberPhone,
        public string $status,
    )
    {
    }

    public function avatarUrl(): string
    {
        return "assets/images/$this->avatar";
    }

    public function friendsUrl(): string
    {
        return 'friends.php?id=' . urlEncode($this->userId);
    }

    public function photoUrl(): string
    {
        return 'photo.php?id=' . urlEncode($this->userId);
    }

    public function conversationUrl(): string
    {
        return 'conversation.php?id=' . urlEncode($this->userId);
    }
}
