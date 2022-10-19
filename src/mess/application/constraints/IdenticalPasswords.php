<?php
namespace Mess\Application\Constraints;

use Mess\View\Views\ValidationErrors;

class IdenticalPasswords implements Constraint
{
    public function __construct(private string $password, private string $passwordRepeat)
    {
    }

    public function fails(): bool
    {
        return $this->password !== $this->passwordRepeat;
    }

    public function addError(ValidationErrors $errors): void
    {
        $errors->addError('passwordRepeat', 'Hasła nie są takie same');
    }
}
