<?php
namespace Mess\Http\Requests;

class LoginRequest
{
    private array $postAttributes;

    public function __construct(array $postAttributes)
    {
        $this->postAttributes = $postAttributes;
    }

    public function login(): string
    {
        return $this->postAttributes['login'];
    }

    public function password(): string
    {
        return $this->postAttributes['password'];
    }

    public function isSignIn(): bool
    {
        return isset($this->postAttributes['signIn']);
    }
}
