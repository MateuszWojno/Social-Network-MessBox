<?php

require_once 'src/autoload.php';

use Mess\Http\HttpHeader;
use Mess\Persistence\ConnectionString;
use Mess\Persistence\CredentialsFile;
use Mess\Persistence\Database\User\StatusRepository;
use Mess\Persistence\Session\HttpSession;

$string = new ConnectionString(new CredentialsFile("connection.txt"));
$session = new HttpSession();
$status = new StatusRepository($string->getPdo());
$status->setStatus($session->userId());
$session->userLogOut();
$header = HttpHeader::homepage();
$header->send();
