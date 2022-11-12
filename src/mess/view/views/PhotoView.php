<?php
namespace Mess\View\Views;

use Mess\Application\ViewProfile;
use Mess\View\View;

class PhotoView extends View
{
    public function __construct(int $userId, array $photo)
    {
        parent::__construct('src/mess/view/pages/photo.php', [
            'profile' => new ViewProfile($userId),
            'photo'   => $photo,
        ]);
    }
}
