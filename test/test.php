<?php
ob_start();
require 'index.php';
$renderedContent = ob_get_clean();

$dom = new DomDocument();

@$dom->loadHTML($renderedContent);
$xpath = new DOMXpath($dom);
$content = element($xpath, "/html/head/title");

$expected = 'MessBox';
if (trim($content) === $expected) {
    echo "Test passed" . PHP_EOL;
} else {
    echo "Test failed - expected '$expected', but '$content' given" . PHP_EOL;
}
$content = element($xpath, "//h1");

$expected = 'NAWIĄŻ KONTAKTY Z MILIONAMI LUDZI NA CAŁYM ŚWIECIE';
if (trim($content) === $expected) {
    echo "Test passed" . PHP_EOL;
} else {
    echo "Test failed - expected '$expected', but '$content' given" . PHP_EOL;
}

$content = elements($xpath, "/html/body/nav/div/ul/li/a");

$expected = ['Startowa', 'Logowanie', 'Rejestracja'];
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

function element(DOMXPath $xpath, string $selector): string
{
    $elements = elements($xpath, $selector);
    if (empty($elements)) {
        throw new Exception("Failed to find element matching '$selector'");
    }
    $count = count($elements);
    if ($count === 1) {
        return $elements[0];
    }
    throw new Exception("Failed to match selector '$selector' uniquely, $count elements matched");
}

function elements(DOMXPath $xpath, string $selector): array
{
    $elements = $xpath->query($selector);

    if ($elements === false) {
        throw new Exception("Malformed xPath selector: '$selector'");
    }
    $results = array();
    foreach ($elements as $element) {
        $nodes = $element->childNodes;
        foreach ($nodes as $node) {
            $results[] = $node->nodeValue;
        }
    }
    return $results;
}