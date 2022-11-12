<?php
namespace Mess\Application\Constraints;

use Mess\View\Views\ValidationErrors;

class FormatPost implements Constraint
{
    public function __construct(private string $post)
    {
    }

    public function fails(): bool
    {
        return !preg_match('/^[a-zA-Z-0-9ąćęłńóśźż?,._\-\s]{1,400}$/', $this->post);
    }

    public function addError(ValidationErrors $errors): void
    {
        $errors->addError('post', 'Niedozwolone znaki, lub za długi tekst');
    }
}