<?php
namespace Mess\Http\Requests;

class SearchRequest
{
    private array $postAttributes;

    public function __construct(array $postAttributes)
    {
        $this->postAttributes = $postAttributes;
    }

    public function searchText(): string
    {
        return $this->postAttributes['search'];
    }
}