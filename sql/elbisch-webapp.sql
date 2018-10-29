-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 29. Okt 2018 um 22:32
-- Server-Version: 10.1.26-MariaDB
-- PHP-Version: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `elbisch-webapp_hp-data`
--
DROP DATABASE IF EXISTS `elbisch-webapp_hp-data`;
CREATE DATABASE IF NOT EXISTS `elbisch-webapp_hp-data` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `elbisch-webapp_hp-data`;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `orders`
--

CREATE TABLE `orders` (
  `id_order` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `languages` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fonts` text COLLATE utf8mb4_unicode_ci,
  `order_description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `translation` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `transcription` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `derivation` tinyint(1) NOT NULL,
  `offer` tinyint(1) NOT NULL,
  `gallery` tinyint(1) NOT NULL,
  `payment` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `currency` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comments` text COLLATE utf8mb4_unicode_ci,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_change` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `orders`
--

INSERT INTO `orders` (`id_order`, `date`, `name`, `email`, `order_type`, `languages`, `fonts`, `order_description`, `text`, `translation`, `transcription`, `derivation`, `offer`, `gallery`, `payment`, `currency`, `comments`, `status`, `last_change`) VALUES
(17038, '2018-10-24 07:26:35', 'Severin Zahler', 'severin.zahler@gmail.com', 'translation-transcription', 'sindarin,', 'tengwar-annatar-italic,', 'Bitte den folgenden Text übersetzen und transkribieren: \"Viele, die leben, verdienen den Tod. Und manche, die sterben, verdienen das Leben\"', 'Viele, die leben, verdienen den Tod. Und manche, die sterben, verdienen das Leben ', 'Laew in chuiar boe daved fired. Ar nodui i firir boe daved cuiad', 'jlEn 5% chM7E wlH 2r#2$ e7G2$ --  6E 52^hM `B e7G6G wlN 2r#2$ ahM2#', 1, 0, 0, 'paypal', 'chf', NULL, 'COMPLETED', '2018-10-28 13:49:21'),
(17042, '2018-10-28 13:51:23', 'Severin', 'severin.zahler@gmail.com', 'transcription', 'quenya,', 'tengwar-annatar-bold,tengwar-noldor,tengwar-noldor-caps,tengwar-quenya,tengwar-sindarin-caps,cirth-erebor,cirth-erebor-2,', 'Hoffnung', '', '', '', 1, 1, 1, 'e-banking', 'eur', 'Dringend', 'PENDING', '2018-10-28 13:51:23');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id_order`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `orders`
--
ALTER TABLE `orders`
  MODIFY `id_order` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17043;--
  
  
  
-- Datenbank: `elbisch-webapp_users`
--
DROP DATABASE IF EXISTS `elbisch-webapp_users`;
CREATE DATABASE IF NOT EXISTS `elbisch-webapp_users` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `elbisch-webapp_users`;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `email` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `users`
--

INSERT INTO `users` (`id_user`, `email`, `password_hash`) VALUES
(1, 'severin.zahler@gmail.com', '$2y$10$UGoOjo.uZj4vvVzwf/668OIJq0LM8Yhamo4A0btT3HvvmqD5czwzC'),
(2, 'nadine.seiler@edu.tbz.ch', '$2y$10$LsrTAgzIU7v5Eq6e1NmTruCYmaxKkUBr1sDRBGrhKeZEnK5xYYvlm'),
(3, 'dominik.waldvogel@tbz.ch', '$2y$10$wstm6d3CfqmWwsAqEU8/VeNr6XzfFvb70z.fTVL9tYWWXhuLbHSiS');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
