<?php
namespace Mess\View\Views;

use Mess\Application\Profile;
use Mess\View\View;

class FriendsView extends View
{
    public function __construct(int $userId, array $friends, bool $areFriends)
    {
        parent::__construct('src/mess/view/pages/friends.php', [
            'profile'    => new Profile($userId),
            'friends'    => $friends,
            'areFriends' => $areFriends,
        ]);
    }
}