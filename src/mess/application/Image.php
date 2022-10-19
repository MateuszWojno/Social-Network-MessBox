<?php
namespace Mess\Application;

class Image
{
    private ImageExtension $extension;

    public function __construct(private string $image)
    {
        $this->extension = new ImageExtension($image);
    }

    public function allowed(): bool
    {
        if ($this->image === '') {
            return false;
        }
        return in_array($this->extension->getExtension(), ['jpg', 'png', 'jpeg']);
    }
}