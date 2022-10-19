<?php
namespace Mess\Http\Requests;

class UserIdRequest
{
    private array $getAttributes;

    public function __construct(array $getAttributes)
    {
        $this->getAttributes = $getAttributes;
    }

    public function getUserId(): int
    {
        return $this->getAttributes['id'];
    }
}
