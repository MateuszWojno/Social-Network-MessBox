<?php
namespace Mess\Application\Constraints;

use Mess\Persistence\Database\User\RegistrationRepository;
use Mess\View\Views\ValidationErrors;

class NonDuplicatePhoneNumber implements Constraint
{
    public function __construct(private RegistrationRepository $registration, private string $phoneNumber)
    {
    }

    public function fails(): bool
    {
        return $this->registration->phoneNumberExists($this->phoneNumber);
    }

    public function addError(ValidationErrors $errors): void
    {
        $errors->addError('phoneNumber', 'Podany numer już istnieje');
    }
}