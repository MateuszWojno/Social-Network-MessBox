<?php
namespace Mess\Application\Constraints;

use Mess\Persistence\Database\User\RegistrationRepository;
use Mess\View\Views\ValidationErrors;

class NonDuplicateLogin implements Constraint
{
    public function __construct(private RegistrationRepository $registration, private string $login)
    {
    }

    public function fails(): bool
    {
        return $this->registration->loginExists($this->login);
    }

    public function addError(ValidationErrors $errors): void
    {
        $errors->addError('login', 'Podany login już istnieje');
    }
}