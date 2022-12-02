<?php
namespace Mess\Application\Constraints;

use Mess\Application\CurrentDate;
use Mess\View\Views\ValidationErrors;

class DateLaterThanYears implements Constraint
{
    public function __construct(private CurrentDate $today, private string $date)
    {
    }

    public function fails(): bool
    {
        return !$this->today->isLaterThanYears($this->date, 10);
    }

    public function addError(ValidationErrors $errors): void
    {
        $errors->addError('birthDate', 'Nie masz ukończonych 10 lat');
    }
}
