<?php
namespace Mess\Http\Requests;

class UserIdRequest
{
    private array $getAttributes;

    public function __construct(array $getAttributes)
    {
        $this->getAttributes = $getAttributes;
    }

    public function userId(): int
    {
        return $this->getAttributes['id'];
    }
}
