<?php
namespace Mess\Http\Requests;

class PhotoRequest
{
    private array $postAttributes;

    public function __construct(array $postAttributes)
    {
        $this->postAttributes = $postAttributes;
    }

    public function like(): int
    {
        return $this->postAttributes['like'];
    }

    public function dislike(): int
    {
        return $this->postAttributes['dislike'];
    }

    public function isSubmitLike(): bool
    {
        return isset($this->postAttributes['submitLike']);
    }

    public function isSubmitDislike(): bool
    {
        return isset($this->postAttributes['submitDislike']);
    }
}