<?php
namespace Mess\Application\Constraints;

use Mess\View\Views\ValidationErrors;

class FormatEmail implements Constraint
{
    public function __construct(private string $email)
    {
    }

    public function fails(): bool
    {
        return !filter_var($this->email, FILTER_VALIDATE_EMAIL);
    }

    public function addError(ValidationErrors $errors): void
    {
        $errors->addError('email', 'Niepoprawny email');
    }
}