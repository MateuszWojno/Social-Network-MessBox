<?php
namespace Mess\Http\Requests;

class ProfileRequest
{
    private array $postAttributes;

    public function __construct(array $postAttributes)
    {
        $this->postAttributes = $postAttributes;
    }

    public function post(): string
    {
        return $this->postAttributes['post'];
    }

    public function postIdLike(): int
    {
        return $this->postAttributes['like'];
    }

    public function postIdDislike(): int
    {
        return $this->postAttributes['dislike'];
    }

    public function wantsSubmitPost(): bool
    {
        return isset($this->postAttributes['addPost']);
    }

    public function wantsSubmitLike(): bool
    {
        return isset($this->postAttributes['submitLike']);
    }

    public function wantsSubmitDislike(): bool
    {
        return isset($this->postAttributes['submitDislike']);
    }

    public function wantsAddFriend(): bool
    {
        return isset($this->postAttributes['addFriend']);
    }

}