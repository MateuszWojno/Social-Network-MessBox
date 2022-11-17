<?php
namespace Mess\View\Views;

use Mess\Application\ViewProfile;
use Mess\View\Result;
use Mess\View\View;

class SearchView extends View
{
    public function __construct(int $userId, array $search, Result $message)
    {
        parent::__construct('src/mess/view/pages/search.phtml', [
            'profile' => new ViewProfile($userId),
            'search'  => $search,
            'message' => $message,
        ]);
    }
}
