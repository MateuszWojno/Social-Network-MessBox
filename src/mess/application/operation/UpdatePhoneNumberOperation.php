<?php
namespace Mess\Application\Operation;

use Mess\Application\Constraints\FormatPhoneNumber;
use Mess\Persistence\Database\User\PhoneNumberRepository;
use Mess\View\Views\ValidationErrors;

class UpdatePhoneNumberOperation implements Operation
{
    public function __construct(private PhoneNumberRepository $repository,
                                private int                   $userId,
                                private string                $phoneNumber)
    {
    }

    public function apply(ValidationErrors $errors): void
    {
        $constraint = new FormatPhoneNumber($this->phoneNumber);
        if ($constraint->fails()) {
            $constraint->addError($errors);
        } else {
            $this->repository->setPhoneNumber($this->userId, $this->phoneNumber);
        }
    }
}