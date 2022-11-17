<?php

require_once 'src/autoload.php';

$view = new \Mess\View\View('src/mess/view/pages/index.phtml', []);
$view->render();
