<?php
namespace Mess\Application\Constraints;

use Mess\Application\Image;
use Mess\View\Views\ValidationErrors;

class AllowedImage implements Constraint
{
    private Image $image;
    private string $fieldName;

    public function __construct(string $image, string $fieldName)
    {
        $this->image = new Image($image);
        $this->fieldName = $fieldName;
    }

    public function fails(): bool
    {
        return !$this->image->allowed();
    }

    public function addError(ValidationErrors $errors): void
    {
        $errors->addError($this->fieldName, 'Nieprawidłowe rozszerzenie pliku');
    }
}