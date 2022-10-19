<?php
namespace Mess\View\Views;

use Mess\View\Action;
use Mess\View\Validation;

class ValidationErrors
{
    private array $errorMessages = [];

    public function addError(string $fieldName, string $message): void
    {
        $this->errorMessages += [$fieldName => $message];
    }

    public function success(): bool
    {
        return empty($this->errorMessages);
    }

    public function action(): Action
    {
        return Action::failures($this->errorMessages);
    }

    public function validation(): Validation
    {
        return Validation::failures($this->errorMessages);
    }

}