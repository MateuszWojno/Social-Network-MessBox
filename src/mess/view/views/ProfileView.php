<?php

namespace Mess\View\Views;

use Mess\Application\FriendStatus;
use Mess\Application\ViewProfile;
use Mess\Application\User;
use Mess\View\Validation;
use Mess\View\View;

class ProfileView extends View
{
    public function __construct(int $userId, User $user, Validation $validation, array $posts, FriendStatus $friendStatus)
    {
        parent::__construct('src/mess/view/pages/profile.phtml', [
            'profile'      => new ViewProfile($userId),
            'user'         => $user,
            'validation'   => $validation,
            'posts'        => $posts,
            'friendStatus' => $friendStatus,
        ]);
    }
}
