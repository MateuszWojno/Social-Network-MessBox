<?php
namespace Mess\Application\Constraints;

use Mess\View\Views\ValidationErrors;

interface Constraint
{
    public function fails(): bool;

    public function addError(ValidationErrors $errors): void;
}