<?php
namespace Mess\Application;

class HashPassword
{
    public function __construct(private $password)
    {
    }

    public function hash(): string
    {
        return password_hash($this->password, PASSWORD_DEFAULT);
    }
}