<?php
namespace Mess\Application;

class Message
{
    public function __construct(public bool $own,
                                public string $avatar,
                                public string $name,
                                public string $message)
    {
    }

    public function avatarUrl(): string
    {
        return "assets/images/$this->avatar";
    }
}
