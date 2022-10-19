<?php
namespace Mess\View\Views;

use Mess\Application\Profile;
use Mess\View\View;

class NotificationView extends View
{
    public function __construct(int $userId, array $invitations)
    {
        parent::__construct('src/mess/view/pages/notification.php', [
            'profile'     => new Profile($userId),
            'invitations' => $invitations,
        ]);
    }
}