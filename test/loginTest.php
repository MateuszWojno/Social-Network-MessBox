<?php
require "HtmlContent.php";

function renderedPage(string $entryPoint): string
{
    \ob_start();
    require $entryPoint;
    return \ob_get_clean();
}

$html = new HtmlContent(renderedPage('login.php'));

$content = $html->elements("/html/body/nav/div/ul/li/a");
assertArrayEquals(['Startowa', 'Logowanie', 'Rejestracja'], $content);

$content = $html->element("/html/body/div/div/div/h1");
assertEquals('Logowanie', $content);

$content = $html->element("/html/body/div/form/div/button");
assertEquals("Logowanie", $content);

function assertEquals(string $expected, string $content): void
{
    if (trim($content) === $expected) {
        echo "Test passed" . PHP_EOL;
    } else {
        echo "Test failed - expected '$expected', but '$content' given" . PHP_EOL;
    }
}

function assertArrayEquals(array $expected, array $content): void
{
    $trimmedContent = [];
    foreach ($content as $item) {
        $trimmedContent[] = trim($item);
    }
    if ($trimmedContent === $expected) {
        echo "Test passed" . PHP_EOL;
    } else {
        $contentFormat = var_export($content, true);
        $expectedFormat = var_export($expected, true);

        echo "Test failed - expected $expectedFormat, but given $contentFormat" . PHP_EOL;
    }
}