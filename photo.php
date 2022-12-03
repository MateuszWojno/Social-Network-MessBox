<?php

require_once 'src/autoload.php';

use Mess\Http\HttpHeader;
use Mess\Http\Requests\PhotoRequest;
use Mess\Http\Requests\UserIdRequest;
use Mess\Persistence\ConnectionString;
use Mess\Persistence\CredentialsFile;
use Mess\Persistence\Database\PhotoReaction\PhotoReactionRepository;
use Mess\Persistence\Database\PhotoReaction\PhotoRepository;
use Mess\Persistence\Session\HttpSession;
use Mess\View\View;
use Mess\View\Views\PhotoView;

$session = new HttpSession();

if ($session->userLoggedIn()) {
    $string = new ConnectionString(new CredentialsFile("connection.txt"));

    function getView(PDO $pdo, HttpSession $session, PhotoRequest $photoRequest, PhotoRepository $photoRepository, UserIdRequest $id): View
    {
        $reaction = new PhotoReactionRepository($pdo);

        if ($photoRequest->isSubmitLike()) {
            $reaction->addReactionIfMissing($photoRequest->like(), $session->userId(), "like");
        } else if ($photoRequest->isSubmitDislike()) {
            $reaction->addReactionIfMissing($photoRequest->dislike(), $session->userId(), 'dislike');
        }
        return new PhotoView($session->userId(), $photoRepository->getPhotos($id->userId(), $session->userId()));
    }

    $view = getView($string->getPdo(), $session, new PhotoRequest($_POST), new PhotoRepository($string->getPdo()), new UserIdRequest($_GET));
    $view->render();
} else {
    $header = HttpHeader::homepage();
    $header->send();
}
