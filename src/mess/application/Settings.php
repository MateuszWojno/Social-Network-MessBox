<?php

namespace Mess\Application;

use Mess\Application\Operation\UpdateAvatarOperation;
use Mess\Application\Operation\UpdateLastNameOperation;
use Mess\Application\Operation\UpdatePhoneNumberOperation;
use Mess\Application\Operation\UpdatePhotoOperation;
use Mess\Application\Operation\UpdatePlaceOperation;
use Mess\Application\Operation\UpdateRelationship;
use Mess\Application\Operation\UpdateSchoolOperation;
use Mess\Application\Operation\UpdateWorkOperation;
use Mess\Http\Requests\SettingsRequest;
use Mess\Persistence\Database\Photo\PhotoRepository;
use Mess\Persistence\Database\User\AvatarUpdateRepository;
use Mess\Persistence\Database\User\LastNameUpdateRepository;
use Mess\Persistence\Database\User\PhoneNumberRepository;
use Mess\Persistence\Database\User\PlaceUpdateRepository;
use Mess\Persistence\Database\User\RelationshipUpdateRepository;
use Mess\Persistence\Database\User\SchoolUpdateRepository;
use Mess\Persistence\Database\User\WorkUpdateRepository;
use Mess\Persistence\Session\Session;

class Settings
{

    public function __construct(private PhotoRepository              $photo,
                                private AvatarUpdateRepository       $avatar,
                                private LastNameUpdateRepository     $lastName,
                                private WorkUpdateRepository         $work,
                                private SchoolUpdateRepository       $school,
                                private RelationshipUpdateRepository $relationship,
                                private PhoneNumberRepository        $phoneNumber,
                                private PlaceUpdateRepository        $place,
                                private string                       $photoUploadDate)
    {
    }

    public function operations(SettingsRequest $request, Session $session): array
    {
        return $this->userOperations($request, $session->userId());
    }

    private function userOperations(SettingsRequest $request, int $userId): array
    {
        $operations = [];
        if ($request->wantsSubmitPhoto()) {
            $operations[] = new UpdatePhotoOperation($this->photo, $userId, $request->photo(), $this->photoUploadDate);
        }
        if ($request->wantsSubmitAvatar()) {
            $operations[] = new UpdateAvatarOperation($this->avatar, $userId, $request->avatar());
        }
        if ($request->wantsSubmitLastName()) {
            $operations[] = new UpdateLastNameOperation($this->lastName, $userId, $request->lastName());
        }
        if ($request->wantsSubmitWork()) {
            $operations[] = new UpdateWorkOperation($this->work, $userId, $request->work());
        }
        if ($request->wantsSubmitSchool()) {
            $operations[] = new UpdateSchoolOperation($this->school, $userId, $request->school());
        }
        if ($request->wantsSubmitRelationship()) {
            $operations[] = new UpdateRelationship($this->relationship, $userId, $request->relationship());
        }
        if ($request->wantsSubmitPhoneNumber()) {
            $operations[] = new UpdatePhoneNumberOperation($this->phoneNumber, $userId, $request->phoneNumber());
        }
        if ($request->wantsSubmitPlace()) {
            $operations[] = new UpdatePlaceOperation($this->place, $userId, $request->place());
        }

        return $operations;
    }
}