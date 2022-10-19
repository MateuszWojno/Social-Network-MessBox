<?php

namespace Mess\Application\Constraints;

use Mess\View\Views\ValidationErrors;

class FormatSchool implements Constraint
{
    public function __construct(private string $school)
    {
    }

    public function fails(): bool
    {
        return !preg_match('/^[A-Za-z_\-\s]+$/', $this->school);
    }

    public function addError(ValidationErrors $errors): void
    {
        $errors->addError('school', 'Niepoprawny format');
    }
}