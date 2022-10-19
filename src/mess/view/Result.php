<?php
namespace Mess\View;

use Exception;

class Result
{
    private function __construct(private ?string $error)
    {
    }

    public static function failure(string $message): Result
    {
        return new self($message);
    }

    public static function success(): Result
    {
        return new self(null);
    }

    public function failed(): bool
    {
        return $this->error !== null;
    }

    public function errorMessage(): string
    {
        if ($this->error === null) {
            throw new Exception("Field validation wasn't failed ");
        }
        return $this->error;
    }
}
