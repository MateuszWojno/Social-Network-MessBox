<?php
namespace Mess\View\Views;

use Mess\Application\FriendStatus;
use Mess\Application\User;
use Mess\Application\Profile;
use Mess\View\Result;
use Mess\View\View;

class ProfileView extends View
{
    public function __construct(int $userId, User $user, Result $message, array $posts, FriendStatus $friendStatus)
    {
        parent::__construct('src/mess/view/pages/Profile.php', [
            'profile'      => new Profile($userId),
            'user'         => $user,
            'message'      => $message,
            'posts'        => $posts,
            'friendStatus' => $friendStatus,
        ]);
    }
}
