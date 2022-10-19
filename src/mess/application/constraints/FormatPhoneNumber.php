<?php
namespace Mess\Application\Constraints;

use Mess\View\Views\ValidationErrors;

class FormatPhoneNumber implements Constraint
{
    public function __construct(private string $phoneNumber)
    {
    }

    public function fails(): bool
    {
        return !preg_match('/^[0-9]{9}+$/', $this->phoneNumber);
    }

    public function addError(ValidationErrors $errors): void
    {
        $errors->addError('phoneNumber', 'Niepoprawny numer');
    }
}