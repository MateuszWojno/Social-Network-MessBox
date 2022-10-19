<?php
namespace Mess\Application\Constraints;

use Mess\View\Views\ValidationErrors;

class NonEmpty implements Constraint
{
    public function __construct(private string $value, private string $fieldName, private string $message)
    {
    }

    public function fails(): bool
    {
        return $this->value === '';
    }

    public function addError(ValidationErrors $errors): void
    {
        $errors->addError($this->fieldName, $this->message);
    }
}
