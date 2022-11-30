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
    'password'       => 'aaaaaa',
    'passwordRepeat' => 'aaaaaa',
    'firstName'      => 'Jan',
    'lastName'       => 'Mic',
    'email'          => 'email@email.com',
    'phoneNumber'    => '000000000',
    'birthDate'      => '22.10.2012',
    'gender'         => 'kobieta',
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

$content = $html->elements("//span[@class='error']");
assertArrayEquals(['Podaj login'], $content);

$content = $html->elements("//span[@class='error']");
assertArrayEquals(['Podany login już istnieje'], $content);

$content = $html->elements("//span[@class='error']");
assertArrayEquals(['Podaj hasło', 'Nieprawidłowe hasło'], $content);

$content = $html->elements("//span[@class='error']");
assertArrayEquals(['Niepoprawne hasło'], $content);

$content = $html->elements("//span[@class='error']");
assertArrayEquals(['Niepoprawne hasło'], $content);

$content = $html->elements("//span[@class='error']");
assertArrayEquals(['Niepoprawne hasło'], $content);

$content = $html->elements("//span[@class='error']");
assertArrayEquals(['Niepoprawne hasło'], $content);

$content = $html->elements("//span[@class='error']");
assertArrayEquals(['Hasła nie są takie same'], $content);

$content = $html->elements("//span[@class='error']");
assertArrayEquals(['Podaj imię'], $content);

$content = $html->elements("//span[@class='error']");
assertArrayEquals(['Niepoprawne imię'], $content);

$content = $html->elements("//span[@class='error']");
assertArrayEquals(['Niepoprawne imię'], $content);

$content = $html->elements("//span[@class='error']");
assertArrayEquals(['Niepoprawne imię'], $content);

$content = $html->elements("//span[@class='error']");
assertArrayEquals(['Niepoprawne imię'], $content);

$content = $html->elements("//span[@class='error']");
assertArrayEquals(['Podaj nazwisko'], $content);

$content = $html->elements("//span[@class='error']");
assertArrayEquals(['Niepoprawne nazwisko'], $content);

$content = $html->elements("//span[@class='error']");
assertArrayEquals(['Niepoprawne nazwisko'], $content);

$content = $html->elements("//span[@class='error']");
assertArrayEquals(['Niepoprawne nazwisko'], $content);

$content = $html->elements("//span[@class='error']");
assertArrayEquals(['Niepoprawne nazwisko'], $content);

$content = $html->elements("//span[@class='error']");
assertArrayEquals(['Podaj email'], $content);

$content = $html->elements("//span[@class='error']");
assertArrayEquals(['Niepoprawny email'], $content);

$content = $html->elements("//span[@class='error']");
assertArrayEquals(['Podany email już istnieje'], $content);

$content = $html->elements("//span[@class='error']");
assertArrayEquals(['Podaj numer telefonu'], $content);

$content = $html->elements("//span[@class='error']");
assertArrayEquals(['Niepoprawny numer'], $content);

$content = $html->elements("//span[@class='error']");
assertArrayEquals(['Niepoprawny format'], $content);

$content = $html->elements("//span[@class='error']");
assertArrayEquals(['Niepoprawny format'], $content);

$content = $html->elements("//span[@class='error']");
assertArrayEquals(['Podany numer już istnieje'], $content);

$content = $html->elements("//span[@class='error']");
assertArrayEquals(['Wybierz datę urodzenia'], $content);

$content = $html->elements("//span[@class='error']");
assertArrayEquals(['Nie masz ukończonych 10 lat'], $content);

$content = $html->elements("//span[@class='error']");
assertArrayEquals(['Wybierz płeć'], $content);

$content = $html->elements("//span[@class='error']");
assertArrayEquals(['Nieprawidłowe rozszerzenie pliku'], $content);

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