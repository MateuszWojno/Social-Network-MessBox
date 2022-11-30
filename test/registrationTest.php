<?php
require "HtmlContent.php";

function renderedPage(string $entryPoint): string
{
    \ob_start();
    require $entryPoint;
    return \ob_get_clean();
}

function openPage(string $entryPoint): HtmlContent
{
    return new HtmlContent(renderedPage($entryPoint));
}

$registrationRequest = [
    'login'          => 'Jan',
    'password'       => 'aa',
    'passwordRepeat' => 'aaaaa',
    'firstName'      => 'Jan',
    'lastName'       => 'Mic',
    'email'          => 'mail@mail',
    'phoneNumber'    => '000000000',
    'birthDate'      => '01.01.2011',
    'gender'         => 'mężczyzna',
    'avatar'         => 'avatar.jpg',
    'signUp'         => 1
];

$_POST = $registrationRequest;

$html = openPage('registration.php');

$content = $html->elements("/html/body/nav/div/ul/li/a");
assertArrayEquals(['Startowa', 'Logowanie', 'Rejestracja'], $content);

$content = $html->element("/html/body/div/div/div/h1");
assertEquals('Rejestracja', $content);

$content = $html->element("/html/body/div/form/div/button");
assertEquals("Zarejestruj", $content);

$content = $html->elements("//span[@class='error']");
assertArrayEquals(['', '', '', '', '', '', '', '', '', ''], $content);

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