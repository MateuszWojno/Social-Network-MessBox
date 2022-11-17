<?php
namespace Mess\View\Views;

use Mess\View\Action;
use Mess\View\View;

class RegistrationView extends View
{
    public ValidationAttributes $validation;

    public function __construct(Action $registration)
    {
        parent::__construct('src/mess/view/pages/registration.phtml', [
            'registration' => $registration,
        ]);
        $this->validation = $registration->validationAttributes([
            'login',
            'password',
            'passwordRepeat',
            'firstName',
            'lastName',
            'email',
            'phoneNumber',
            'birthDate',
            'gender',
            'avatar',
        ]);
    }
}
