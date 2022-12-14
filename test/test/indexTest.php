<?php
require __DIR__ . "/../fixture/page.php";
require __DIR__ . "/../fixture/assert.php";

$html = openPage('index.php');

$content = $html->element("/html/head/title");
assertEquals('MessBox', $content);

$content = $html->element("//h1");
assertEquals('NAWIĄŻ KONTAKTY Z MILIONAMI LUDZI NA CAŁYM ŚWIECIE', $content);

$content = $html->elements("/html/body/nav/div/ul/li/a");
assertArrayEquals(['Startowa', 'Logowanie', 'Rejestracja'], $content);