<?php
namespace Mess\Http\Requests;

class FriendRequest
{
    private array $postAttributes;

    public function __construct(array $postAttributes)
    {
        $this->postAttributes = $postAttributes;
    }

    public function friend(): int
    {
        return $this->postAttributes['friend'];
    }

    public function wantsDelete(): bool
    {
        return isset($this->postAttributes['deleteAccount']);
    }
}