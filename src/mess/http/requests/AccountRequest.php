<?php
namespace Mess\Http\Requests;

class AccountRequest
{
    private array $postAttributes;

    public function __construct(array $postAttributes)
    {
        $this->postAttributes = $postAttributes;
    }

    public function isDelete(): bool
    {
        return isset($this->postAttributes['deleteAccount']);
    }
}
