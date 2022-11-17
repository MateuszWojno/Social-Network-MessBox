<?php
namespace Mess\View\Views;

use Mess\Application\ViewProfile;
use Mess\View\View;

class NotificationView extends View
{
    public function __construct(int $userId, array $invitations)
    {
        parent::__construct('src/mess/view/pages/notification.phtml', [
            'profile'     => new ViewProfile($userId),
            'invitations' => $invitations,
        ]);
    }
}