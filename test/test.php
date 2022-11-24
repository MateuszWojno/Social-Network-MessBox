<?php

class HtmlContent
{
    private DOMXpath $xPath;

    public function __construct(string $html)
    {
        $this->xPath = new \DOMXpath($this->document($html));
    }

    private function document(string $html): DomDocument
    {
        $document = new \DomDocument();
        @$document->loadHTML($html);
        return $document;
    }

    public function element(string $xPath): string
    {
        $elements = $this->elements($xPath);
        if (empty($elements)) {
            throw new Exception("Failed to find element matching '$xPath'");
        }
        $count = count($elements);
        if ($count === 1) {
            return $elements[0];
        }
        throw new Exception("Failed to match selector '$xPath' uniquely, $count elements matched");
    }

    public function elements(string $xPath): array
    {
        $elements = $this->xPath->query($xPath);
        if ($elements === false) {
            throw new Exception("Malformed xPath selector: '$xPath'");
        }
        $results = [];
        foreach ($elements as $element) {
            foreach ($element->childNodes as $node) {
                $results[] = $node->nodeValue;
            }
        }
        return $results;
    }
}

function renderedPage(string $entryPoint): string
{
    \ob_start();
    require $entryPoint;
    return \ob_get_clean();
}

$html = new HtmlContent(renderedPage('index.php'));

$content = $html->element("/html/head/title");
assertEquals('MessBox', $content);

$content = $html->element("//h1");
assertEquals('NAWIĄŻ KONTAKTY Z MILIONAMI LUDZI NA CAŁYM ŚWIECIE', $content);

$content = $html->elements("/html/body/nav/div/ul/li/a");
assertArrayEquals(['Startowa', 'Logowanie', 'Rejestracja'], $content);

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