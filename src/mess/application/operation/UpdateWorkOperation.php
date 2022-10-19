<?php
namespace Mess\Application\Operation;

use Mess\Application\Constraints\FormatWork;
use Mess\Persistence\Database\User\WorkUpdateRepository;
use Mess\View\Views\ValidationErrors;

class UpdateWorkOperation implements Operation
{
    public function __construct(private WorkUpdateRepository $repository,
                                private int                  $userId,
                                private string               $work)
    {
    }

    public function apply(ValidationErrors $errors): void
    {
        $constraint = new FormatWork($this->work);
        if ($constraint->fails()) {
            $constraint->addError($errors);
        } else {
            $this->repository->setWork($this->userId, $this->work);
        }
    }
}
