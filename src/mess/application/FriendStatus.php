<?php
namespace Mess\Application;

class FriendStatus
{

    public function __construct(
        private string $cssColor,
        private string $friendStatus,
        private bool   $isFriend
    )
    {
    }

    public function cssColor(): string
    {
        return $this->cssColor;
    }

    public function friendStatus(): string
    {
        return $this->friendStatus;
    }

    public function isFriend(): bool
    {
        return $this->isFriend;
    }

    public static function ownProfile(): FriendStatus
    {
        return new self('black', '', false);
    }

    public static function friend(): FriendStatus
    {
        return new self('green', 'znajomy', 'true');
    }

    public static function awaiting(): FriendStatus
    {
        return new self('orange', 'Oczekujący', 'true');
    }

    public static function unknown(): FriendStatus
    {
        return new self('red', 'Dodaj', 'true');
    }
}
