<?php
namespace Mess\View\Views;

use Mess\Application\ViewProfile;
use Mess\View\Validation;
use Mess\View\View;

class SettingsView extends View
{
    public ValidationAttributes $validation;

    public function __construct(int $userId, Validation $validation)
    {
        parent::__construct('src/mess/view/pages/settings.php', [
            'profile' => new ViewProfile($userId),
        ]);
        $this->validation = new ValidationAttributes($validation, [
            'photo',
            'avatar',
            'lastName',
            'work',
            'school',
            'relationship',
            'phoneNumber',
            'place'
        ]);
    }
}
