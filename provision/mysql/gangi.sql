-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 26 Lis 2019, 19:31
-- Wersja serwera: 10.3.16-MariaDB
-- Wersja PHP: 7.1.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `gangi`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `sklep`
--

CREATE TABLE `sklep` (
  `id` int(11) NOT NULL,
  `username` varchar(30) COLLATE utf8_polish_ci DEFAULT NULL,
  `czapkawpierdolka` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `sklep`
--

INSERT INTO `sklep` (`id`, `username`, `czapkawpierdolka`) VALUES
(1, NULL, 0),
(2, 'Adi', 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` text COLLATE utf8_polish_ci NOT NULL,
  `pass` text COLLATE utf8_polish_ci NOT NULL,
  `sila` int(11) NOT NULL,
  `obrona` int(11) NOT NULL,
  `bron` int(11) NOT NULL,
  `zdrowie` int(11) NOT NULL,
  `szybkosc` int(11) NOT NULL,
  `email` text COLLATE utf8_polish_ci NOT NULL,
  `premium` int(11) NOT NULL,
  `hajs` int(11) NOT NULL,
  `bank` int(11) NOT NULL,
  `progress` int(11) NOT NULL,
  `tsilka` datetime NOT NULL DEFAULT current_timestamp(),
  `tdilerka` datetime NOT NULL DEFAULT current_timestamp(),
  `tpraca` datetime NOT NULL DEFAULT current_timestamp(),
  `tpaczki` datetime NOT NULL DEFAULT current_timestamp(),
  `tprzestepstwa` datetime NOT NULL DEFAULT current_timestamp(),
  `tszpital` datetime NOT NULL DEFAULT current_timestamp(),
  `twiezienie` datetime NOT NULL DEFAULT current_timestamp(),
  `admin` bit(1) NOT NULL,
  `ranga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id`, `username`, `pass`, `sila`, `obrona`, `bron`, `zdrowie`, `szybkosc`, `email`, `premium`, `hajs`, `bank`, `progress`, `tsilka`, `tdilerka`, `tpraca`, `tpaczki`, `tprzestepstwa`, `tszpital`, `twiezienie`, `admin`, `ranga`) VALUES
(1, 'Adi', '$2y$10$UdSisMsv1ffcv4OxKjkhEufVsWn8Gh8Z1egXXAYNyYJdN95WjPFsS', 568, 271, 3, 100, 203, 'adi@wp.pl', 2147483647, 1647, 7143, 2645, '2019-11-23 18:33:42', '2019-11-20 08:05:47', '2017-11-15 14:09:23', '2017-11-16 13:49:28', '2019-11-22 21:38:46', '2019-11-22 18:34:12', '2019-11-22 21:24:56', b'1', 7),
(2, '1234', '$2y$10$VIeiZGbpQt0qeyd8J4a4Eu7NaeikqYC6IMsZDB82S8ib6qo00QsaK', 0, 0, 0, 100, 0, 'a@a.pl', 0, 0, 0, 0, '2017-11-16 13:28:51', '2017-11-16 13:28:51', '2017-11-16 13:28:51', '2017-11-16 13:28:51', '2017-11-16 13:28:51', '2017-11-16 13:28:51', '2017-11-16 13:28:51', b'0', 1),
(3, 'Bilbo', '$2y$10$9A0gqPLVeECyJyoe4K6bHu6pW8/1pYDE757bpS9Q7vNfEHA5wNgO.', 89, 33, 0, 11, 34, 'bilbo@baginns.pl', 0, 340, 0, 16, '2017-11-16 13:56:22', '2017-11-16 14:01:13', '2017-11-16 13:50:04', '2017-11-17 13:50:49', '2017-11-16 13:50:04', '2017-11-16 13:50:04', '2017-11-16 13:50:04', b'0', 1),
(4, 'testtest', '$2y$10$h6.wpCKmwEeK1GiT1nb2kOzBbGIpSOov1N8Trf0tgviaEJY5JwbMu', 2, 4, 0, 100, 2, 'test@test.test', 0, 105, 0, 9, '2019-11-21 18:45:29', '2019-11-19 22:21:31', '2019-11-20 22:32:07', '2019-11-19 20:38:46', '2019-11-20 22:14:31', '2019-11-21 20:05:17', '2019-11-19 20:38:46', b'0', 1);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `sklep`
--
ALTER TABLE `sklep`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `sklep`
--
ALTER TABLE `sklep`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
