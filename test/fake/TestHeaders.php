<?php

use Mess\Http\Headers;

class TestHeaders implements Headers
{
    public function profile(int $userId): TestHeader
    {
        return new TestHeader();
    }

    public function homepage(): TestHeader
    {
        return new TestHeader();
    }
}