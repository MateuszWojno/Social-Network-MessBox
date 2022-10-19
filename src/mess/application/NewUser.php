<?php
namespace Mess\Application;

class NewUser
{
    public string $login;
    public string $hash;
    public string $firstName;
    public string $lastName;
    public string $email;
    public string $avatar;
    public string $phoneNumber;
    public string $birthDate;
    public string $gender;
    public string $registrationDate;

    public function __construct(string $login,
                                string $hash,
                                string $firstName,
                                string $lastName,
                                string $email,
                                string $avatar,
                                string $phoneNumber,
                                string $birthDate,
                                string $gender,
                                string $registrationDate)
    {
        $this->login = $login;
        $this->hash = $hash;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->avatar = $avatar;
        $this->phoneNumber = $phoneNumber;
        $this->birthDate = $birthDate;
        $this->gender = $gender;
        $this->registrationDate = $registrationDate;
    }
}