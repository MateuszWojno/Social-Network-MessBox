<?php
namespace Mess\Application\Constraints;

use Mess\Persistence\Database\User\RegistrationRepository;
use Mess\View\Views\ValidationErrors;

class NonDuplicateEmail implements Constraint
{
    public function __construct(private RegistrationRepository $registration, private string $email)
    {
    }

    public function fails(): bool
    {
        return $this->registration->emailExists($this->email);
    }

    public function addError(ValidationErrors $errors): void
    {
        $errors->addError('email', 'Podany email już istneije');
    }
}