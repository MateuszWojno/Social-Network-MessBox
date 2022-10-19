<?php
namespace Mess\Http\Requests;

class ConversationRequest
{
    private array $postAttributes;

    public function __construct(array $postAttributes)
    {
        $this->postAttributes = $postAttributes;
    }

    public function message(): string
    {
        return $this->postAttributes['message'];
    }

    public function wantsSubmit(): bool
    {
        return isset($this->postAttributes['submitMessage']);
    }
}