<?php
namespace Mess\Application;

class ImageExtension
{
    public function __construct(private $photo)
    {
    }

    public function getExtension(): string
    {
        return pathInfo($this->photo, PATHINFO_EXTENSION);
    }
}
