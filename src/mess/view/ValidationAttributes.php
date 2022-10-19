<?php
namespace Mess\View\Views;

use Mess\View\Validation;
use Mess\View\ViewAttributeException;

class ValidationAttributes
{
    public function __construct(private Validation $validation, private array $attributes)
    {
    }

    public function failed(string $field): bool
    {
        if (!\in_array($field, $this->attributes)) {
            throw new ViewAttributeException("Validation attribute '$field' isn't defined");
        }
        return $this->validation->failed($field);
    }

    public function message(string $field): string
    {
        if (!\in_array($field, $this->attributes)) {
            throw new ViewAttributeException("Validation attribute '$field' isn't defined");
        }
        return $this->validation->message($field);
    }
}
