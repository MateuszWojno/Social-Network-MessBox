<?php
namespace Mess\Http;

class HttpHeaders implements Headers
{
    public function profile(int $userId): HttpHeader
    {
        return HttpHeader::profile($userId);
    }

    public function homepage(): HttpHeader
    {
        return HttpHeader::homepage();
    }
}