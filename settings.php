<?php

require_once 'src/autoload.php';

use Mess\Application\Settings;
use Mess\Http\Header;
use Mess\Http\Requests\SettingsRequest;
use Mess\Persistence\ConnectionString;
use Mess\Persistence\CredentialsFile;
use Mess\Persistence\Database\Photo\PhotoRepository;
use Mess\Persistence\Database\User\AvatarUpdateRepository;
use Mess\Persistence\Database\User\LastNameUpdateRepository;
use Mess\Persistence\Database\User\PhoneNumberRepository;
use Mess\Persistence\Database\User\PlaceUpdateRepository;
use Mess\Persistence\Database\User\RelationshipUpdateRepository;
use Mess\Persistence\Database\User\SchoolUpdateRepository;
use Mess\Persistence\Database\User\WorkUpdateRepository;
use Mess\Persistence\Session\Session;
use Mess\View\Validation;
use Mess\View\View;
use Mess\View\Views\SettingsView;
use Mess\View\Views\ValidationErrors;

$session = new Session();

$string = new ConnectionString(new CredentialsFile("connection.txt"));

if ($session->userLoggedIn()) {
    function getView(SettingsRequest              $request,
                     Session                      $session,
                     PhotoRepository              $photoRepository,
                     AvatarUpdateRepository       $avatarUpdate,
                     LastNameUpdateRepository     $lastNameUpdate,
                     WorkUpdateRepository         $workUpdate,
                     SchoolUpdateRepository       $schoolUpdate,
                     RelationshipUpdateRepository $relationshipUpdate,
                     PhoneNumberRepository        $phoneNumberRepository,
                     PlaceUpdateRepository        $placeUpdate): View
    {
        $photoUploadDate = date('Y-m-d');

        if (!$request->wantsSubmitSettings()) {
            return new SettingsView($session->userId(), Validation::success());
        }
        $settings = new Settings($photoRepository, $avatarUpdate, $lastNameUpdate, $workUpdate, $schoolUpdate, $relationshipUpdate, $phoneNumberRepository, $placeUpdate, $photoUploadDate);
        $operations = $settings->operations($request, $session);

        $errors = new ValidationErrors();
        foreach ($operations as $operation) {
            $operation->apply($errors);
        }
        return new SettingsView($session->userId(), $errors->validation());
    }

    $view = getView(new SettingsRequest($_POST),
        $session,
        new PhotoRepository($string->getPdo()),
        new AvatarUpdateRepository($string->getPdo()),
        new LastNameUpdateRepository($string->getPdo()),
        new WorkUpdateRepository($string->getPdo()),
        new SchoolUpdateRepository($string->getPdo()),
        new RelationshipUpdateRepository($string->getPdo()),
        new PhoneNumberRepository($string->getPdo()),
        new PlaceUpdateRepository($string->getPdo()));
    $view->render();
} else {
    $header = Header::homepage();
    $header->send();
}
