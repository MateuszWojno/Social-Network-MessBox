<?php
namespace Mess\Application\Constraints;

use Mess\View\Views\ValidationErrors;

class FormatFirstName implements Constraint
{
    public function __construct(private string $firstName)
    {
    }

    public function fails(): bool
    {
        return !preg_match('/^[A-Z][a-ząćęłńóśźż]{2,12}$/', $this->firstName);
    }

    public function addError(ValidationErrors $errors): void
    {
        $errors->addError('firstName', 'Niepoprawne nazwisko');
    }
}