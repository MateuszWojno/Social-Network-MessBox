<?php
namespace Mess\Http\Requests;

class RegistrationRequest
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

    public function passwordRepeat(): string
    {
        return $this->postAttributes['passwordRepeat'];
    }

    public function firstName(): string
    {
        return $this->postAttributes['firstName'];
    }

    public function lastName(): string
    {
        return $this->postAttributes['lastName'];
    }

    public function email(): string
    {
        return $this->postAttributes['email'];
    }

    public function phoneNumber(): string
    {
        return $this->postAttributes['phoneNumber'];
    }

    public function date(): string
    {
        return $this->postAttributes['birthDate'];
    }

    public function gender(): string
    {
        return $this->postAttributes['gender'];
    }

    public function avatar(): string
    {
        return $this->postAttributes['avatar'];
    }

    public function wantsSignUp(): bool
    {
        return isset($this->postAttributes['signUp']);
    }
}