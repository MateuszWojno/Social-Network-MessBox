<?php
namespace Mess\View\Views;

use Mess\Application\ViewProfile;
use Mess\View\Result;
use Mess\View\View;

class ConversationView extends View
{
    public function __construct(int $userId, array $messages, Result $message)
    {
        parent::__construct('src/mess/view/pages/conversation.php', [
            'profile'  => new ViewProfile($userId),
            'messages' => $messages,
            'message'  => $message,
        ]);
    }
}
