<?php
namespace Mess\View\Views;

use Mess\View\View;

class EmptyView extends View
{
    public function __construct()
    {
        parent::__construct('', []);
    }

    public function render(): void
    {
    }
}
