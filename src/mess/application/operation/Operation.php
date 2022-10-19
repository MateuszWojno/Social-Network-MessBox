<?php
namespace Mess\Application\Operation;

use Mess\View\Views\ValidationErrors;

interface Operation
{
    public function apply(ValidationErrors $errors): void;
}
