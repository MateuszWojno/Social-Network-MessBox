<?php
namespace Mess\Application;

class PhotoExtension
{
    public function __construct(
        private $photo,
    )
    {
    }

    public function getExtension(): string
    {
        return pathinfo($this->photo, PATHINFO_EXTENSION);
    }
}