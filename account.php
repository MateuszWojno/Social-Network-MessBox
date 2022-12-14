<?php

require_once 'src/autoload.php';

use Mess\Http\HttpHeaders;
use Mess\Persistence\Session\HttpSession;

$accountView = require 'accountView.php';
$accountView(new HttpHeaders(), new HttpSession());