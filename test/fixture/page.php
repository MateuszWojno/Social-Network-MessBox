<?php
require 'HtmlContent.php';

function renderedPage(string $entryPoint): string
{
    \ob_start();
    require $entryPoint;
    return \ob_get_clean();
}

function openPageParameters(string $entryPoint, array $post): HtmlContent
{
    $_POST = $post;
    return new HtmlContent(renderedPage($entryPoint));
}

function openPage(string $entryPoint): HtmlContent
{
    return new HtmlContent(renderedPage($entryPoint));
}