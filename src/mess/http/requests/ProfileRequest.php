<?php
namespace Mess\Http\Requests;

class ProfileRequest
{
    private array $postAttributes;
    private UserIdRequest $request;

    public function __construct(array $postAttributes, UserIdRequest $request)
    {
        $this->postAttributes = $postAttributes;
        $this->request = $request;
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

    public function userId(): int
    {
        return $this->request->getUserId();
    }

}