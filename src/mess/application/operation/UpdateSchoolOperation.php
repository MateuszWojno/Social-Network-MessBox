<?php
namespace Mess\Application\Operation;

use Mess\Application\Constraints\FormatSchool;
use Mess\Persistence\Database\User\SchoolUpdateRepository;
use Mess\View\Views\ValidationErrors;

class UpdateSchoolOperation implements Operation
{
    public function __construct(private SchoolUpdateRepository $repository,
                                private int                    $userId,
                                private string                 $school)
    {
    }

    public function apply(ValidationErrors $errors): void
    {
        $constraint = new FormatSchool($this->school);
        if ($constraint->fails()) {
            $constraint->addError($errors);
        } else {
            $this->repository->setSchool($this->userId, $this->school);
        }
    }
}
