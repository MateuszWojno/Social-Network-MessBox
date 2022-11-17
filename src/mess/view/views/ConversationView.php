<?php
namespace Mess\View\Views;

use Mess\Application\ViewProfile;
use Mess\View\Validation;
use Mess\View\View;

class ConversationView extends View
{
    public function __construct(int $userId, array $messages, Validation $validation)
    {
        parent::__construct('src/mess/view/pages/conversation.phtml', [
            'profile'    => new ViewProfile($userId),
            'messages'   => $messages,
            'validation' => $validation,
        ]);
    }
}
