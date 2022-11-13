<?php
namespace Mess\Http\Requests;

class ConversationRequest
{
    private array $postAttributes;
    private UserIdRequest $request;

    public function __construct(array $postAttributes, UserIdRequest $request)
    {
        $this->postAttributes = $postAttributes;
        $this->request = $request;
    }

    public function message(): string
    {
        return $this->postAttributes['message'];
    }

    public function wantsSubmit(): bool
    {
        return isset($this->postAttributes['submitMessage']);
    }

    public function userId(): int
    {
        return $this->request->userId();
    }
}