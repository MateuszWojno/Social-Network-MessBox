<?php
namespace Mess\Http\Requests;

class SettingsRequest
{
    private array $postAttributes;

    public function __construct(array $postAttributes)
    {
        $this->postAttributes = $postAttributes;
    }

    public function photo(): string
    {
        return $this->postAttributes['photo'];
    }

    public function avatar(): string
    {
        return $this->postAttributes['avatar'];
    }

    public function school(): string
    {
        return $this->postAttributes['school'];
    }

    public function lastName(): string
    {
        return $this->postAttributes['lastName'];
    }

    public function work(): string
    {
        return $this->postAttributes['work'];
    }

    public function relationship(): string
    {
        return $this->postAttributes['relationship'];
    }

    public function phoneNumber(): string
    {
        return $this->postAttributes['phoneNumber'];
    }

    public function place(): string
    {
        return $this->postAttributes['place'];
    }

    public function wantsSubmitPhoto(): bool
    {
        return \array_key_exists('photo', $this->postAttributes) && trim($this->postAttributes['photo']) !== '';
    }

    public function wantsSubmitAvatar(): bool
    {
        return \array_key_exists('avatar', $this->postAttributes) && trim($this->postAttributes['avatar']) !== '';
    }

    public function wantsSubmitSchool(): bool
    {
        return \array_key_exists('school', $this->postAttributes) && trim($this->postAttributes['school']) !== '';
    }

    public function wantsSubmitLastName(): bool
    {
        return \array_key_exists('lastName', $this->postAttributes) && trim($this->postAttributes['lastName']) !== '';
    }

    public function wantsSubmitWork(): bool
    {
        return \array_key_exists('work', $this->postAttributes) && trim($this->postAttributes['work']) !== '';
    }

    public function wantsSubmitRelationship(): bool
    {
        return \array_key_exists('relationship', $this->postAttributes) && trim($this->postAttributes['relationship']) !== '';
    }

    public function wantsSubmitPhoneNumber(): bool
    {
        return \array_key_exists('phoneNumber', $this->postAttributes) && trim($this->postAttributes['phoneNumber']) !== '';
    }

    public function wantsSubmitPlace(): bool
    {
        return \array_key_exists('place', $this->postAttributes) && trim($this->postAttributes['place']) !== '';
    }

    public function wantsSubmitSettings(): bool
    {
        return \array_key_exists('submitSettings', $this->postAttributes);
    }

}