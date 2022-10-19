-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 05 Lip 2021, 20:40
-- Wersja serwera: 10.4.17-MariaDB
-- Wersja PHP: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `messbox`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `friend`
--

CREATE TABLE `friend` (
  `friend_id` int(11) NOT NULL,
  `request_from_id` int(11) NOT NULL,
  `request_to_id` int(11) NOT NULL,
  `status` varchar(50) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `friend`
--

INSERT INTO `friend` (`friend_id`, `request_from_id`, `request_to_id`, `status`) VALUES
(2, 2, 1, 'znajomy');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `message`
--

CREATE TABLE `message` (
  `message_id` int(11) NOT NULL,
  `request_from_id` int(11) NOT NULL,
  `request_to_id` int(11) NOT NULL,
  `message` varchar(400) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `message`
--

INSERT INTO `message` (`message_id`, `request_from_id`, `request_to_id`, `message`) VALUES
(1, 1, 2, 'Hej'),
(2, 1, 2, 'Cześć'),
(3, 2, 1, 'Co tam słychać ?');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `photo`
--

CREATE TABLE `photo` (
  `photo_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `photo` varchar(300) COLLATE utf8_polish_ci NOT NULL,
  `date_to_add` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `photo`
--

INSERT INTO `photo` (`photo_id`, `user_id`, `photo`, `date_to_add`) VALUES
(1, 1, 'pulpit13.png', '2021-07-05');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `photo_reaction`
--

CREATE TABLE `photo_reaction` (
  `photo_reaction_id` int(11) NOT NULL,
  `photo_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `reaction` varchar(20) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `photo_reaction`
--

INSERT INTO `photo_reaction` (`photo_reaction_id`, `photo_id`, `user_id`, `reaction`) VALUES
(1, 1, 1, 'dislike'),
(2, 1, 3, 'like');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `post`
--

CREATE TABLE `post` (
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment` varchar(300) COLLATE utf8_polish_ci NOT NULL,
  `date_to_add` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `post`
--

INSERT INTO `post` (`post_id`, `user_id`, `comment`, `date_to_add`) VALUES
(1, 1, 'Pierwszy post użytkownika Mateusz Wojno.', '2021-07-03 13:02:58'),
(2, 1, 'Drugi post użytkownika Mateusz Wojno.', '2021-07-03 13:03:12'),
(3, 1, 'Trzeci post użytkownika Mateusz Wojno.', '2021-07-03 13:03:20'),
(4, 3, 'Pierwszy post użytkownika Anna Nowak.', '2021-07-03 13:03:44'),
(5, 3, 'Drugi post użytkownika Anna Nowak.', '2021-07-03 13:03:51'),
(6, 3, 'Trzeci post użytkownika Anna Nowak.', '2021-07-03 13:04:00'),
(7, 2, 'Pierwszy post użytkownika Jan Nowak.', '2021-07-03 13:04:40'),
(8, 2, 'Drugi post użytkownika Anna Nowak.', '2021-07-03 13:04:49'),
(9, 2, 'Trzeci post użytkownika Anna Nowak.', '2021-07-03 13:04:55');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `post_reaction`
--

CREATE TABLE `post_reaction` (
  `post_reaction_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `reaction` varchar(20) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `post_reaction`
--

INSERT INTO `post_reaction` (`post_reaction_id`, `post_id`, `user_id`, `reaction`) VALUES
(1, 3, 1, 'like'),
(2, 2, 1, 'dislike'),
(3, 1, 1, 'like'),
(4, 5, 3, 'dislike'),
(5, 4, 3, 'dislike'),
(6, 6, 3, 'like'),
(7, 3, 3, 'dislike'),
(8, 2, 3, 'like'),
(9, 1, 3, 'like'),
(10, 7, 2, 'dislike'),
(11, 8, 2, 'like'),
(12, 9, 2, 'like'),
(13, 1, 2, 'like'),
(14, 2, 2, 'dislike'),
(15, 3, 2, 'like'),
(16, 8, 1, 'like');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `login` varchar(20) COLLATE utf8_polish_ci NOT NULL,
  `password` tinytext COLLATE utf8_polish_ci NOT NULL,
  `first_name` varchar(30) COLLATE utf8_polish_ci NOT NULL,
  `last_name` varchar(40) COLLATE utf8_polish_ci NOT NULL,
  `email` varchar(40) COLLATE utf8_polish_ci NOT NULL,
  `avatar` varchar(400) COLLATE utf8_polish_ci NOT NULL,
  `number_phone` varchar(9) COLLATE utf8_polish_ci NOT NULL,
  `birth_date` date NOT NULL,
  `access` varchar(5) COLLATE utf8_polish_ci NOT NULL DEFAULT 'user',
  `gender` varchar(1) COLLATE utf8_polish_ci NOT NULL,
  `date_registration` datetime NOT NULL,
  `status` text COLLATE utf8_polish_ci DEFAULT NULL,
  `count_logging` int(11) DEFAULT NULL,
  `place_living` varchar(50) COLLATE utf8_polish_ci DEFAULT 'brak informacji',
  `martial_status` varchar(20) COLLATE utf8_polish_ci DEFAULT 'brak informacji',
  `work` varchar(50) COLLATE utf8_polish_ci DEFAULT 'brak informacji',
  `school` varchar(50) COLLATE utf8_polish_ci DEFAULT 'brak informacji'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `user`
--

INSERT INTO `user` (`user_id`, `login`, `password`, `first_name`, `last_name`, `email`, `avatar`, `number_phone`, `birth_date`, `access`, `gender`, `date_registration`, `status`, `count_logging`, `place_living`, `martial_status`, `work`, `school`) VALUES
(1, 'mateusz20', '$2y$10$0Tr9yZvv7BQdVYAj7JsdP.3ILUMcuzfZFIwhHAKpC/QnEzr4J2yAu', 'Mateusz', 'Wojno', 'mateusz20@wp.pl', 'pulpit13.png', '111222333', '2009-06-12', 'admin', 'M', '2021-07-03 12:59:38', 'offline', NULL, 'brak informacji', 'brak informacji', 'brak informacji', 'brak informacji'),
(2, 'janek21', '$2y$10$nZ6xHMkc7by1lkjNKRbZ1.Ys0L9jg8Oa9roHgWw1egpn4bq94Wc1y', 'Jan', 'Nowak', 'janek21@wp.pl', 'avatar.jpg', '333444555', '1993-06-09', 'user', 'M', '2021-07-03 13:00:04', 'offline', NULL, 'brak informacji', 'brak informacji', 'brak informacji', 'brak informacji'),
(3, 'ania21', '$2y$10$CpUarBhhgKbBCRrScJBXtuFrTLbT3ac4pK4X.qAFlDOUgDtD3gw/u', 'Anna', 'Nowak', 'ania21@gmail.com', 'avatar.jpg', '222333444', '1990-06-27', 'user', 'K', '2021-07-03 13:01:23', 'offline', NULL, 'Lublin', 'Zaręczony', 'Brak informacji', 'Brak informacji');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `friend`
--
ALTER TABLE `friend`
  ADD PRIMARY KEY (`friend_id`),
  ADD KEY `idx_request_from_id` (`request_from_id`),
  ADD KEY `idx_request_to_id` (`request_to_id`);

--
-- Indeksy dla tabeli `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`message_id`),
  ADD KEY `idx_request_from_id` (`request_from_id`),
  ADD KEY `idx_request_to_id` (`request_to_id`);

--
-- Indeksy dla tabeli `photo`
--
ALTER TABLE `photo`
  ADD PRIMARY KEY (`photo_id`),
  ADD KEY `idx_user_id` (`user_id`);

--
-- Indeksy dla tabeli `photo_reaction`
--
ALTER TABLE `photo_reaction`
  ADD PRIMARY KEY (`photo_reaction_id`),
  ADD KEY `idx_photo_id` (`photo_id`),
  ADD KEY `idx_user_id` (`user_id`);

--
-- Indeksy dla tabeli `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `idx_user_id` (`user_id`);

--
-- Indeksy dla tabeli `post_reaction`
--
ALTER TABLE `post_reaction`
  ADD PRIMARY KEY (`post_reaction_id`),
  ADD KEY `idx_post_id` (`post_id`),
  ADD KEY `idx_user_id` (`user_id`);

--
-- Indeksy dla tabeli `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `friend`
--
ALTER TABLE `friend`
  MODIFY `friend_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT dla tabeli `message`
--
ALTER TABLE `message`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT dla tabeli `photo`
--
ALTER TABLE `photo`
  MODIFY `photo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT dla tabeli `photo_reaction`
--
ALTER TABLE `photo_reaction`
  MODIFY `photo_reaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT dla tabeli `post`
--
ALTER TABLE `post`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT dla tabeli `post_reaction`
--
ALTER TABLE `post_reaction`
  MODIFY `post_reaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT dla tabeli `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
