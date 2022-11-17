<?php
namespace Mess\View\Views;

use Mess\Application\ViewProfile;
use Mess\View\View;

class FriendsView extends View
{
    public function __construct(int $userId, array $friends, bool $areFriends)
    {
        parent::__construct('src/mess/view/pages/friends.phtml', [
            'profile'    => new ViewProfile($userId),
            'friends'    => $friends,
            'areFriends' => $areFriends,
        ]);
    }
}