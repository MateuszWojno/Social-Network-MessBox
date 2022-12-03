<?php
namespace Mess\Http;

class HttpHeader
{
    private function __construct(private string $url)
    {
    }

    public function send(): void
    {
        \header("Location: $this->url");
    }

    public static function homepage(): HttpHeader
    {
        return new self("index.php");
    }

    public static function profile(int $userId): HttpHeader
    {
        return new self("profile.php?id=" . $userId);
    }
}
