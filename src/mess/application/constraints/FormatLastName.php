<?php
namespace Mess\Application\Constraints;

use Mess\View\Views\ValidationErrors;

class FormatLastName implements Constraint
{
    public function __construct(private string $lastName)
    {
    }

    public function fails(): bool
    {
        return !preg_match('/^[A-Z][a-ząćęłńóśźż]{2,12}$/', $this->lastName);
    }

    public function addError(ValidationErrors $errors): void
    {
        $errors->addError('lastName', 'Niepoprawne nazwisko');
    }
}