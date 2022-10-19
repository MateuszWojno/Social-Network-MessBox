<?php
namespace Mess\View;

use Exception;
use Mess\View\Views\ValidationAttributes;

class Action
{
    private function __construct(private ?string $success, private Validation $validation)
    {
    }

    public function validationAttributes(array $attributes): ValidationAttributes
    {
        return new ValidationAttributes($this->validation, $attributes);
    }

    public static function clean(): Action
    {
        return new self(null, Validation::success());
    }

    public static function failures(array $failures): Action
    {
        return new self(null, Validation::failures($failures));
    }

    public static function success(string $successMessage): Action
    {
        return new self($successMessage, Validation::success());
    }

    public function successful(): bool
    {
        return $this->success !== null;
    }

    public function successMessage(): string
    {
        if ($this->success === null) {
            throw new Exception("Registration wasn't success");
        }
        return $this->success;
    }
}
