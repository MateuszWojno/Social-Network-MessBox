<?php
namespace Mess\Application\Operation;

use Mess\Application\Constraints\AllowedImage;
use Mess\Persistence\Database\Photo\PhotoRepository;
use Mess\View\Views\ValidationErrors;

class UpdatePhotoOperation implements Operation
{
    public function __construct(private PhotoRepository $repository,
                                private int             $userId,
                                private string          $photo,
                                private string          $additionDate)
    {
    }

    public function apply(ValidationErrors $errors): void
    {
        $constraint = new AllowedImage($this->photo, 'photo');
        if ($constraint->fails()) {
            $constraint->addError($errors);
        } else {
            $this->repository->addPhoto($this->userId, $this->photo, $this->additionDate);
        }
    }
}
