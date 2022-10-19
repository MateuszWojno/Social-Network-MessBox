<?php
namespace Mess\Application\Constraints;

use Mess\View\Views\ValidationErrors;

class FormatPassword implements Constraint
{
    public function __construct(private string $password)
    {
    }

    public function fails(): bool
    {
        return !preg_match('/^[A-Za-z][A-Za-z0-9]{5,31}$/', $this->password);
    }

    public function addError(ValidationErrors $errors): void
    {
        $errors->addError('password', 'Nieprawidłowe hasło');
    }
}