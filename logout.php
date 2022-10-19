<?php

require_once 'src/autoload.php';

use Mess\Http\Header;
use Mess\Persistence\ConnectionString;
use Mess\Persistence\CredentialsFile;
use Mess\Persistence\Database\User\StatusRepository;
use Mess\Persistence\Session\Session;

$string = new ConnectionString(new CredentialsFile("connection.txt"));
$session = new Session();
$status = new StatusRepository($string->getPdo());
$status->setStatus($session->userId());
$session->userLogOut();
$header = Header::homepage();
$header->send();
