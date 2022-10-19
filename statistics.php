<?php

require_once 'src/autoload.php';

use Mess\Application\Profile;
use Mess\Http\Header;
use Mess\Persistence\ConnectionString;
use Mess\Persistence\CredentialsFile;
use Mess\Persistence\Database\User\UserStatisticsRepository;
use Mess\Persistence\Session\Session;
use Mess\View\View;

$session = new Session();

$string = new ConnectionString(new CredentialsFile("connection.txt"));

if ($session->userLoggedIn()) {
    $userStatistics = new UserStatisticsRepository($string->getPdo());

    $countFriend = $userStatistics->CountFriend($session->userId());
    $countPost = $userStatistics->CountPost($session->userId());
    $countPhoto = $userStatistics->CountPhoto($session->userId());
    $countPostLike = $userStatistics->CountPostLike($session->userId(), 'like');
    $countPostDislike = $userStatistics->CountPostDislike($session->userId(), 'dislike');
    $countPhotoDislike = $userStatistics->CountPhotoDislike($session->userId(), 'dislike');
    $countPhotoLike = $userStatistics->CountPhotoLike($session->userId(), 'like');

    $view = new View('src/mess/view/pages/statistics.php', [
        'profile'           => new Profile($session->userId()),
        'countFriend'       => $countFriend,
        'countPost'         => $countPost,
        'countPhoto'        => $countPhoto,
        'countPostLike'     => $countPostLike,
        'countPostDislike'  => $countPostDislike,
        'countPhotoDislike' => $countPhotoDislike,
        'countPhotoLike'    => $countPhotoLike,
    ]);
    $view->render();
} else {
    $header = Header::homepage();
    $header->send();
}
