<?php

require_once 'src/autoload.php';

use Mess\Application\ViewProfile;
use Mess\Application\Statistics;
use Mess\Http\Header;
use Mess\Persistence\ConnectionString;
use Mess\Persistence\CredentialsFile;
use Mess\Persistence\Database\User\UserStatisticsRepository;
use Mess\Persistence\Session\Session;
use Mess\View\View;

$session = new Session();

$string = new ConnectionString(new CredentialsFile("connection.txt"));

if ($session->userLoggedIn()) {
    $statisticsRepository = new UserStatisticsRepository($string->getPdo());
    $statistics = new Statistics($statisticsRepository);
    $userStatistics = $statistics->userStatistics($session->userId());

    $view = new View('src/mess/view/pages/statistics.phtml', [
        'profile'    => new ViewProfile($session->userId()),
        'statistics' => $userStatistics,
    ]);
    $view->render();
} else {
    $header = Header::homepage();
    $header->send();
}
