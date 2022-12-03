<?php
namespace Mess\Persistence\Session;

use Exception;

class HttpSession
{
    public function __construct()
    {
        session_start();
    }

    public function userLoggedIn(): bool
    {
        return isset($_SESSION['user_id']);
    }

    public function userId(): int
    {
        if (!$this->userLoggedIn()) {
            throw new Exception("User not logged in");
        }
        return $_SESSION['user_id'];
    }

    public function userLogIn(int $userId): void
    {
        $_SESSION['user_id'] = $userId;
    }

    public function userLogOut(): void
    {
        session_destroy();
        session_unset();
    }
}
