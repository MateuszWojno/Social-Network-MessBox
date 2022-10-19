<?php

namespace Mess\Application\Constraints;

use Mess\View\Views\ValidationErrors;

class FormatPlace implements Constraint
{
    public function __construct(private string $place)
    {
    }

    public function fails(): bool
    {
        return !preg_match('/^[A-Za-z_\-\s]+$/', $this->place);
    }

    public function addError(ValidationErrors $errors): void
    {
        $errors->addError('place', 'Niepoprawny format');
    }
}