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
        $results = [];
        foreach ($this->query($xPath) as $element) {
            foreach ($element->childNodes as $node) {
                $results[] = $node->nodeValue;
            }
        }
        return $results;
    }

    private function query(string $xPath): mixed
    {
        $elements = $this->xPath->query($xPath);
        if ($elements === false) {
            throw new Exception("Malformed xPath selector: '$xPath'");
        }
        return $elements;
    }
}