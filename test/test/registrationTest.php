<?php
require __DIR__ . "/../fixture/page.php";
require __DIR__ . "/../fixture/assert.php";

$html = openPageParameters('registration.php', [
    'login'          => '',
    'password'       => '',
    'passwordRepeat' => '',
    'firstName'      => '',
    'lastName'       => '',
    'email'          => '',
    'phoneNumber'    => '',
    'birthDate'      => '',
    'gender'         => '',
    'avatar'         => '',
    'signUp'         => 0
]);

$content = $html->elements("/html/body/nav/div/ul/li/a");
assertArrayEquals(['Startowa', 'Logowanie', 'Rejestracja'], $content);

$html = openPageParameters('registration.php', [
    'login'          => '',
    'password'       => '',
    'passwordRepeat' => '',
    'firstName'      => '',
    'lastName'       => '',
    'email'          => '',
    'phoneNumber'    => '',
    'birthDate'      => '',
    'gender'         => '',
    'avatar'         => '',
    'signUp'         => 0
]);
$content = $html->element("/html/body/div/div/div/h1");
assertEquals('Rejestracja', $content);

$html = openPageParameters('registration.php', [
    'login'          => '',
    'password'       => '',
    'passwordRepeat' => '',
    'firstName'      => '',
    'lastName'       => '',
    'email'          => '',
    'phoneNumber'    => '',
    'birthDate'      => '',
    'gender'         => '',
    'avatar'         => '',
    'signUp'         => 0
]);

$content = $html->element("/html/body/div/form/div/button");
assertEquals("Zarejestruj", $content);

$html = openPageParameters('registration.php', [
    'login'          => '',
    'password'       => 'aaaaaa',
    'passwordRepeat' => 'aaaaaa',
    'firstName'      => 'Jan',
    'lastName'       => 'Mic',
    'email'          => 'm@m.com',
    'phoneNumber'    => '999999999',
    'birthDate'      => '22.10.2012',
    'gender'         => 'kobieta',
    'avatar'         => 'avatar.jpg',
    'signUp'         => 1
]);

$content = $html->elements("//span[@class='error']");
assertArrayEquals(['Podaj login'], $content);

$html = openPageParameters('registration.php', [
    'login'          => 'Jan',
    'password'       => 'aaaaaa',
    'passwordRepeat' => 'aaaaaa',
    'firstName'      => 'Jan',
    'lastName'       => 'Mic',
    'email'          => 'm@m.com',
    'phoneNumber'    => '999999999',
    'birthDate'      => '22.10.2012',
    'gender'         => 'kobieta',
    'avatar'         => 'avatar.jpg',
    'signUp'         => 1
]);

$content = $html->elements("//span[@class='error']");
assertArrayEquals(['Podany login już istnieje'], $content);

$html = openPageParameters('registration.php', [
    'login'          => 'Iga',
    'password'       => '',
    'passwordRepeat' => '',
    'firstName'      => 'Jan',
    'lastName'       => 'Mic',
    'email'          => 'm@m.com',
    'phoneNumber'    => '999999999',
    'birthDate'      => '22.10.2012',
    'gender'         => 'kobieta',
    'avatar'         => 'avatar.jpg',
    'signUp'         => 1
]);

$content = $html->elements("//span[@class='error']");
assertArrayEquals(['Podaj hasło', 'Nieprawidłowe hasło'], $content);

$html = openPageParameters('registration.php', [
    'login'          => 'Iga',
    'password'       => 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa',
    'passwordRepeat' => 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa',
    'firstName'      => 'Jan',
    'lastName'       => 'Mic',
    'email'          => 'm@m.com',
    'phoneNumber'    => '999999999',
    'birthDate'      => '22.10.2012',
    'gender'         => 'kobieta',
    'avatar'         => 'avatar.jpg',
    'signUp'         => 1
]);

$content = $html->elements("//span[@class='error']");
assertArrayEquals(['Nieprawidłowe hasło'], $content);

$html = openPageParameters('registration.php', [
    'login'          => 'Iga',
    'password'       => '1aaaaa',
    'passwordRepeat' => '1aaaaa',
    'firstName'      => 'Jan',
    'lastName'       => 'Mic',
    'email'          => 'm@m.com',
    'phoneNumber'    => '999999999',
    'birthDate'      => '22.10.2012',
    'gender'         => 'kobieta',
    'avatar'         => 'avatar.jpg',
    'signUp'         => 1
]);

$content = $html->elements("//span[@class='error']");
assertArrayEquals(['Nieprawidłowe hasło'], $content);

$html = openPageParameters('registration.php', [
    'login'          => 'Iga',
    'password'       => 'a',
    'passwordRepeat' => 'a',
    'firstName'      => 'Jan',
    'lastName'       => 'Mic',
    'email'          => 'm@m.com',
    'phoneNumber'    => '999999999',
    'birthDate'      => '22.10.2012',
    'gender'         => 'kobieta',
    'avatar'         => 'avatar.jpg',
    'signUp'         => 1
]);

$content = $html->elements("//span[@class='error']");
assertArrayEquals(['Nieprawidłowe hasło'], $content);

$html = openPageParameters('registration.php', [
    'login'          => 'Iga',
    'password'       => 'aa/aaa',
    'passwordRepeat' => 'aa/aaa',
    'firstName'      => 'Jan',
    'lastName'       => 'Mic',
    'email'          => 'm@m.com',
    'phoneNumber'    => '999999999',
    'birthDate'      => '22.10.2012',
    'gender'         => 'kobieta',
    'avatar'         => 'avatar.jpg',
    'signUp'         => 1
]);

$content = $html->elements("//span[@class='error']");
assertArrayEquals(['Nieprawidłowe hasło'], $content);

$html = openPageParameters('registration.php', [
    'login'          => 'Iga',
    'password'       => 'aaaaaa',
    'passwordRepeat' => 'aaaaaa1',
    'firstName'      => 'Jan',
    'lastName'       => 'Mic',
    'email'          => 'm@m.com',
    'phoneNumber'    => '999999999',
    'birthDate'      => '22.10.2012',
    'gender'         => 'kobieta',
    'avatar'         => 'avatar.jpg',
    'signUp'         => 1
]);

$content = $html->elements("//span[@class='error']");
assertArrayEquals(['Hasła nie są takie same'], $content);

$html = openPageParameters('registration.php', [
    'login'          => 'Iga',
    'password'       => 'aaaaaa',
    'passwordRepeat' => 'aaaaaa',
    'firstName'      => '',
    'lastName'       => 'Mic',
    'email'          => 'm@m.com',
    'phoneNumber'    => '999999999',
    'birthDate'      => '22.10.2012',
    'gender'         => 'kobieta',
    'avatar'         => 'avatar.jpg',
    'signUp'         => 1
]);

$content = $html->elements("//span[@class='error']");
assertArrayEquals(['Podaj imię'], $content);

$html = openPageParameters('registration.php', [
    'login'          => 'Iga',
    'password'       => 'aaaaaa',
    'passwordRepeat' => 'aaaaaa',
    'firstName'      => 'jan',
    'lastName'       => 'Mic',
    'email'          => 'm@m.com',
    'phoneNumber'    => '999999999',
    'birthDate'      => '22.10.2012',
    'gender'         => 'kobieta',
    'avatar'         => 'avatar.jpg',
    'signUp'         => 1
]);

$content = $html->elements("//span[@class='error']");
assertArrayEquals(['Niepoprawne imię'], $content);

$html = openPageParameters('registration.php', [
    'login'          => 'Iga',
    'password'       => 'aaaaaa',
    'passwordRepeat' => 'aaaaaa',
    'firstName'      => 'J/n',
    'lastName'       => 'Mic',
    'email'          => 'm@m.com',
    'phoneNumber'    => '999999999',
    'birthDate'      => '22.10.2012',
    'gender'         => 'kobieta',
    'avatar'         => 'avatar.jpg',
    'signUp'         => 1
]);

$content = $html->elements("//span[@class='error']");
assertArrayEquals(['Niepoprawne imię'], $content);

$html = openPageParameters('registration.php', [
    'login'          => 'Iga',
    'password'       => 'aaaaaa',
    'passwordRepeat' => 'aaaaaa',
    'firstName'      => 'Ja',
    'lastName'       => 'Mic',
    'email'          => 'm@m.com',
    'phoneNumber'    => '999999999',
    'birthDate'      => '22.10.2012',
    'gender'         => 'kobieta',
    'avatar'         => 'avatar.jpg',
    'signUp'         => 1
]);

$content = $html->elements("//span[@class='error']");
assertArrayEquals(['Niepoprawne imię'], $content);

$html = openPageParameters('registration.php', [
    'login'          => 'Iga',
    'password'       => 'aaaaaa',
    'passwordRepeat' => 'aaaaaa',
    'firstName'      => 'Jjjjjjjjjjjjjj',
    'lastName'       => 'Mic',
    'email'          => 'm@m.com',
    'phoneNumber'    => '999999999',
    'birthDate'      => '22.10.2012',
    'gender'         => 'kobieta',
    'avatar'         => 'avatar.jpg',
    'signUp'         => 1
]);

$content = $html->elements("//span[@class='error']");
assertArrayEquals(['Niepoprawne imię'], $content);

$html = openPageParameters('registration.php', [
    'login'          => 'Iga',
    'password'       => 'aaaaaa',
    'passwordRepeat' => 'aaaaaa',
    'firstName'      => 'Jan',
    'lastName'       => '',
    'email'          => 'm@m.com',
    'phoneNumber'    => '999999999',
    'birthDate'      => '22.10.2012',
    'gender'         => 'kobieta',
    'avatar'         => 'avatar.jpg',
    'signUp'         => 1
]);

$content = $html->elements("//span[@class='error']");
assertArrayEquals(['Podaj nazwisko'], $content);

$html = openPageParameters('registration.php', [
    'login'          => 'Iga',
    'password'       => 'aaaaaa',
    'passwordRepeat' => 'aaaaaa',
    'firstName'      => 'Jan',
    'lastName'       => 'mic',
    'email'          => 'm@m.com',
    'phoneNumber'    => '999999999',
    'birthDate'      => '22.10.2012',
    'gender'         => 'kobieta',
    'avatar'         => 'avatar.jpg',
    'signUp'         => 1
]);

$content = $html->elements("//span[@class='error']");
assertArrayEquals(['Niepoprawne nazwisko'], $content);

$html = openPageParameters('registration.php', [
    'login'          => 'Iga',
    'password'       => 'aaaaaa',
    'passwordRepeat' => 'aaaaaa',
    'firstName'      => 'Jan',
    'lastName'       => 'M/c',
    'email'          => 'm@m.com',
    'phoneNumber'    => '999999999',
    'birthDate'      => '22.10.2012',
    'gender'         => 'kobieta',
    'avatar'         => 'avatar.jpg',
    'signUp'         => 1
]);

$content = $html->elements("//span[@class='error']");
assertArrayEquals(['Niepoprawne nazwisko'], $content);

$html = openPageParameters('registration.php', [
    'login'          => 'Iga',
    'password'       => 'aaaaaa',
    'passwordRepeat' => 'aaaaaa',
    'firstName'      => 'Jan',
    'lastName'       => 'Mi',
    'email'          => 'm@m.com',
    'phoneNumber'    => '999999999',
    'birthDate'      => '22.10.2012',
    'gender'         => 'kobieta',
    'avatar'         => 'avatar.jpg',
    'signUp'         => 1
]);

$content = $html->elements("//span[@class='error']");
assertArrayEquals(['Niepoprawne nazwisko'], $content);

$html = openPageParameters('registration.php', [
    'login'          => 'Iga',
    'password'       => 'aaaaaa',
    'passwordRepeat' => 'aaaaaa',
    'firstName'      => 'Jan',
    'lastName'       => 'Mmmmmmmmmmmmmm',
    'email'          => 'm@m.com',
    'phoneNumber'    => '999999999',
    'birthDate'      => '22.10.2012',
    'gender'         => 'kobieta',
    'avatar'         => 'avatar.jpg',
    'signUp'         => 1
]);

$content = $html->elements("//span[@class='error']");
assertArrayEquals(['Niepoprawne nazwisko'], $content);

$html = openPageParameters('registration.php', [
    'login'          => 'Iga',
    'password'       => 'aaaaaa',
    'passwordRepeat' => 'aaaaaa',
    'firstName'      => 'Jan',
    'lastName'       => 'Mic',
    'email'          => '',
    'phoneNumber'    => '999999999',
    'birthDate'      => '22.10.2012',
    'gender'         => 'kobieta',
    'avatar'         => 'avatar.jpg',
    'signUp'         => 1
]);

$content = $html->elements("//span[@class='error']");
assertArrayEquals(['Podaj email'], $content);

$html = openPageParameters('registration.php', [
    'login'          => 'Iga',
    'password'       => 'aaaaaa',
    'passwordRepeat' => 'aaaaaa',
    'firstName'      => 'Jan',
    'lastName'       => 'Mic',
    'email'          => 'email@',
    'phoneNumber'    => '999999999',
    'birthDate'      => '22.10.2012',
    'gender'         => 'kobieta',
    'avatar'         => 'avatar.jpg',
    'signUp'         => 1
]);

$content = $html->elements("//span[@class='error']");
assertArrayEquals(['Niepoprawny email'], $content);

$html = openPageParameters('registration.php', [
    'login'          => 'Iga',
    'password'       => 'aaaaaa',
    'passwordRepeat' => 'aaaaaa',
    'firstName'      => 'Jan',
    'lastName'       => 'Mic',
    'email'          => 'mail@mail.com',
    'phoneNumber'    => '999999999',
    'birthDate'      => '22.10.2012',
    'gender'         => 'kobieta',
    'avatar'         => 'avatar.jpg',
    'signUp'         => 1
]);

$content = $html->elements("//span[@class='error']");
assertArrayEquals(['Podany email już istnieje'], $content);

$html = openPageParameters('registration.php', [
    'login'          => 'Iga',
    'password'       => 'aaaaaa',
    'passwordRepeat' => 'aaaaaa',
    'firstName'      => 'Jan',
    'lastName'       => 'Mic',
    'email'          => 'm@m.com',
    'phoneNumber'    => '',
    'birthDate'      => '22.10.2012',
    'gender'         => 'kobieta',
    'avatar'         => 'avatar.jpg',
    'signUp'         => 1
]);

$content = $html->elements("//span[@class='error']");
assertArrayEquals(['Podaj numer telefonu'], $content);

$html = openPageParameters('registration.php', [
    'login'          => 'Iga',
    'password'       => 'aaaaaa',
    'passwordRepeat' => 'aaaaaa',
    'firstName'      => 'Jan',
    'lastName'       => 'Mic',
    'email'          => 'm@m.com',
    'phoneNumber'    => 'a00000000',
    'birthDate'      => '22.10.2012',
    'gender'         => 'kobieta',
    'avatar'         => 'avatar.jpg',
    'signUp'         => 1
]);

$content = $html->elements("//span[@class='error']");
assertArrayEquals(['Niepoprawny numer'], $content);

$html = openPageParameters('registration.php', [
    'login'          => 'Iga',
    'password'       => 'aaaaaa',
    'passwordRepeat' => 'aaaaaa',
    'firstName'      => 'Jan',
    'lastName'       => 'Mic',
    'email'          => 'm@m.com',
    'phoneNumber'    => '0',
    'birthDate'      => '22.10.2012',
    'gender'         => 'kobieta',
    'avatar'         => 'avatar.jpg',
    'signUp'         => 1
]);

$content = $html->elements("//span[@class='error']");
assertArrayEquals(['Niepoprawny numer'], $content);

$html = openPageParameters('registration.php', [
    'login'          => 'Iga',
    'password'       => 'aaaaaa',
    'passwordRepeat' => 'aaaaaa',
    'firstName'      => 'Jan',
    'lastName'       => 'Mic',
    'email'          => 'm@m.com',
    'phoneNumber'    => '0000000000',
    'birthDate'      => '22.10.2012',
    'gender'         => 'kobieta',
    'avatar'         => 'avatar.jpg',
    'signUp'         => 1
]);

$content = $html->elements("//span[@class='error']");
assertArrayEquals(['Niepoprawny numer'], $content);

$html = openPageParameters('registration.php', [
    'login'          => 'Iga',
    'password'       => 'aaaaaa',
    'passwordRepeat' => 'aaaaaa',
    'firstName'      => 'Jan',
    'lastName'       => 'Mic',
    'email'          => 'm@m.com',
    'phoneNumber'    => '000000000',
    'birthDate'      => '22.10.2012',
    'gender'         => 'kobieta',
    'avatar'         => 'avatar.jpg',
    'signUp'         => 1
]);

$content = $html->elements("//span[@class='error']");
assertArrayEquals(['Podany numer już istnieje'], $content);

$html = openPageParameters('registration.php', [
    'login'          => 'Iga',
    'password'       => 'aaaaaa',
    'passwordRepeat' => 'aaaaaa',
    'firstName'      => 'Jan',
    'lastName'       => 'Mic',
    'email'          => 'm@m.com',
    'phoneNumber'    => '999999999',
    'birthDate'      => '',
    'gender'         => 'kobieta',
    'avatar'         => 'avatar.jpg',
    'signUp'         => 1
]);

$content = $html->elements("//span[@class='error']");
assertArrayEquals(['Wybierz datę urodzenia'], $content);

$html = openPageParameters('registration.php', [
    'login'          => 'Iga',
    'password'       => 'aaaaaa',
    'passwordRepeat' => 'aaaaaa',
    'firstName'      => 'Jan',
    'lastName'       => 'Mic',
    'email'          => 'm@m.com',
    'phoneNumber'    => '999999999',
    'birthDate'      => '22.10.2014',
    'gender'         => 'kobieta',
    'avatar'         => 'avatar.jpg',
    'signUp'         => 1
]);

$content = $html->elements("//span[@class='error']");
assertArrayEquals(['Nie masz ukończonych 10 lat'], $content);

$html = openPageParameters('registration.php', [
    'login'          => 'Iga',
    'password'       => 'aaaaaa',
    'passwordRepeat' => 'aaaaaa',
    'firstName'      => 'Jan',
    'lastName'       => 'Mic',
    'email'          => 'm@m.com',
    'phoneNumber'    => '999999999',
    'birthDate'      => '22.10.2012',
    'gender'         => '',
    'avatar'         => 'avatar.jpg',
    'signUp'         => 1
]);

$content = $html->elements("//span[@class='error']");
assertArrayEquals(['Wybierz płeć'], $content);

$html = openPageParameters('registration.php', [
    'login'          => 'Iga',
    'password'       => 'aaaaaa',
    'passwordRepeat' => 'aaaaaa',
    'firstName'      => 'Jan',
    'lastName'       => 'Mic',
    'email'          => 'm@m.com',
    'phoneNumber'    => '999999999',
    'birthDate'      => '22.10.2012',
    'gender'         => 'kobieta',
    'avatar'         => 'avatar.pdf',
    'signUp'         => 1
]);

$content = $html->elements("//span[@class='error']");
assertArrayEquals(['Nieprawidłowe rozszerzenie pliku'], $content);

$html = openPageParameters('registration.php', [
    'login'          => 'Tom',
    'password'       => 'aaaaaa',
    'passwordRepeat' => 'aaaaaa',
    'firstName'      => 'Jan',
    'lastName'       => 'Mic',
    'email'          => 'b@b.com',
    'phoneNumber'    => '888888888',
    'birthDate'      => '22.10.2012',
    'gender'         => 'kobieta',
    'avatar'         => 'avatar.jpg',
    'signUp'         => 1
]);

if ($html->exists("//div[@class='success']") === true) {
    $content = $html->element("//div[@class='success']");
    assertEquals('Pomyślna rejestracja', $content);
}