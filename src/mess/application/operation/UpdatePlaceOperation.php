<?php
namespace Mess\Application\Operation;

use Mess\Application\Constraints\FormatPlace;
use Mess\Persistence\Database\User\PlaceUpdateRepository;
use Mess\View\Views\ValidationErrors;

class UpdatePlaceOperation implements Operation
{
    public function __construct(private PlaceUpdateRepository $repository,
                                private int                   $userId,
                                private string                $place)
    {
    }

    public function apply(ValidationErrors $errors): void
    {
        $constraint = new FormatPlace($this->place);
        if ($constraint->fails()) {
            $constraint->addError($errors);
        } else {
            $this->repository->setPlace($this->userId, $this->place);
        }
    }
}