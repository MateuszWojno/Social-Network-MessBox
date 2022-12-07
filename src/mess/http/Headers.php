<?php
namespace Mess\Http;

interface Headers
{
    public function profile(int $userId): Header;

    public function homepage(): Header;

}