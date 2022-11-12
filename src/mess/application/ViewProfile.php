<?php

namespace Mess\Application;

class ViewProfile
{

    public function __construct(private $userId)
    {
    }

    public function profileUrl(): string
    {
        return 'profile.php?id=' . $this->userId;
    }

    public function photoUrl(): string
    {
        return 'photo.php?id=' . $this->userId;
    }

    public function notificationUrl(): string
    {
        return 'notification.php?id=' . $this->userId;
    }

}