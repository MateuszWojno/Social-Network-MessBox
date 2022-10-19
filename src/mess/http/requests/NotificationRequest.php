<?php
namespace Mess\Http\Requests;

class NotificationRequest
{
    private array $postAttributes;

    public function __construct(array $postAttributes)
    {
        $this->postAttributes = $postAttributes;
    }

    public function positive(): int
    {
        return $this->postAttributes['positive'];
    }

    public function negative(): int
    {
        return $this->postAttributes['negative'];
    }

    public function wantsPositive(): bool
    {
        return isset($this->postAttributes['submitPositive']);
    }

    public function wantsNegative(): bool
    {
        return isset($this->postAttributes['submitNegative']);
    }
}