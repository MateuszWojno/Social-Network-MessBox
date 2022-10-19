<?php
namespace Mess\Application\Operation;

use Mess\Application\Constraints\AllowedImage;
use Mess\Persistence\Database\User\AvatarUpdateRepository;
use Mess\View\Views\ValidationErrors;

class UpdateAvatarOperation implements Operation
{
    public function __construct(private AvatarUpdateRepository $repository,
                                private int                    $userId,
                                private string                 $avatar)
    {
    }

    public function apply(ValidationErrors $errors): void
    {
        $constraint = new AllowedImage($this->avatar, 'avatar');
        if ($constraint->fails()) {
            $constraint->addError($errors);
        } else {
            $this->repository->setAvatar($this->userId, $this->avatar);
        }
    }
}
