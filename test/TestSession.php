<?php

class TestSession
{
    private int $userId;

    public function userLoggedIn(): bool
    {
        return isset($this->userId);
    }

    public function userId(): int
    {
        if (!$this->userLoggedIn()) {
            throw new Exception("User not logged in");
        }
        return $this->userId;
    }

    public function userLogIn(int $userId): void
    {
        $this->userId = $userId;
    }

    public function userLogOut(): void
    {
        unset($this->userId);
    }

}