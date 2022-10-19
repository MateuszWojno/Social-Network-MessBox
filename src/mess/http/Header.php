<?php
namespace Mess\Http;

class Header
{
    private function __construct(private string $url)
    {
    }

    public function send(): void
    {
        \header("Location: $this->url");
    }

    public static function homepage(): Header
    {
        return new self("index.php");
    }

    public static function profile(int $userId): Header
    {
        return new self("profile.php?id=" . $userId);
    }
}
