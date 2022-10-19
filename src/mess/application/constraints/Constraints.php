<?php
namespace Mess\Application\Constraints;

use Mess\View\Action;
use Mess\View\Views\ValidationErrors;

class Constraints
{
    private ValidationErrors $validationErrors;

    public function __construct(array $constraints)
    {
        $this->validationErrors = new ValidationErrors();
        foreach ($constraints as $constraint) {
            if ($constraint->fails()) {
                $constraint->addError($this->validationErrors);
            }
        }
    }

    public function failed(): bool
    {
        return !$this->validationErrors->success();
    }

    public function action(): Action
    {
        return $this->validationErrors->action();
    }
}