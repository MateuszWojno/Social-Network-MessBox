<?php
namespace Mess\Persistence\Session;

interface Session
{
    public function userLoggedIn(): bool;

    public function userId(): int;

    public function userLogIn(int $userId): void;

    public function userLogOut(): void;
}