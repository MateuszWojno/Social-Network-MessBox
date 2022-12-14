<?php

require_once 'src/autoload.php';

use Mess\Http\HttpHeaders;
use Mess\Persistence\Session\HttpSession;

$loginView = require 'loginView.php';
$loginView(new HttpHeaders(), new HttpSession());