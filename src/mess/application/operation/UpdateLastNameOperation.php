<?php
namespace Mess\Application\Operation;

use Mess\Application\Constraints\FormatLastName;
use Mess\Persistence\Database\User\LastNameUpdateRepository;
use Mess\View\Views\ValidationErrors;

class UpdateLastNameOperation implements Operation
{
    public function __construct(private LastNameUpdateRepository $repository,
                                private int                      $userId,
                                private string                   $lastName)
    {
    }

    public function apply(ValidationErrors $errors): void
    {
        $constraint = new FormatLastName($this->lastName);
        if ($constraint->fails()) {
            $constraint->addError($errors);
        } else {
            $this->repository->setLastName($this->userId, $this->lastName);
        }
    }
}
