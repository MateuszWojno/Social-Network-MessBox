<?php
namespace Mess\View\Views;

use Mess\View\Validation;
use Mess\View\View;

class LoginView extends View
{
    public ValidationAttributes $validation;

    public function __construct(Validation $validation)
    {
        parent::__construct('src/mess/view/pages/login.php', [

        ]);

        $this->validation = new ValidationAttributes($validation, [
            'login',
            'password',
        ]);
    }
}
