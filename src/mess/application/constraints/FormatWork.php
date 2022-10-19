<?php
namespace Mess\Application\Constraints;

use Mess\View\Views\ValidationErrors;

class FormatWork implements Constraint
{
    public function __construct(private string $work)
    {
    }

    public function fails(): bool
    {
        return !preg_match('/^[A-Z][a-ząćęłńóśźż]{2,12}$/', $this->work);
    }

    public function addError(ValidationErrors $errors): void
    {
        $errors->addError('work', 'Niepoprawny format');
    }
}