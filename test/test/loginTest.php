<?php
require_once __DIR__ . '/../../src/autoload.php';
require __DIR__ . "/../fixture/page.php";
require __DIR__ . "/../fixture/assert.php";

$html = openPage('login.php');

$content = $html->elements("/html/body/nav/div/ul/li/a");
assertArrayEquals(['Startowa', 'Logowanie', 'Rejestracja'], $content);

$content = $html->element("/html/body/div/div/div/h1");
assertEquals('Logowanie', $content);

$content = $html->element("/html/body/div/form/div/button");
assertEquals("Logowanie", $content);