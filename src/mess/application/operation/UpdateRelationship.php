<?php
namespace Mess\Application\Operation;

use Mess\Persistence\Database\User\RelationshipUpdateRepository;
use Mess\View\Views\ValidationErrors;

class UpdateRelationship implements Operation
{
    public function __construct(private RelationshipUpdateRepository $relationshipUpdate,
                                private int                          $userId,
                                private string                       $relationship)
    {
    }

    public function apply(ValidationErrors $errors): void
    {
        $this->relationshipUpdate->setRelationship($this->userId, $this->relationship);
    }
}
