-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Фев 23 2021 г., 12:22
-- Версия сервера: 8.0.19
-- Версия PHP: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `test`
--

-- --------------------------------------------------------

--
-- Структура таблицы `eventt`
--

CREATE TABLE `eventt` (
  `id` int NOT NULL,
  `start` datetime DEFAULT NULL,
  `end` datetime DEFAULT NULL,
  `title` mediumtext,
  `uid` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `eventt`
--

INSERT INTO `eventt` (`id`, `start`, `end`, `title`, `uid`) VALUES
(2, '2021-02-18 11:30:00', '2021-02-18 13:00:00', 'test', 'qoergk2acsoc065lr5j966e60lsumvut'),
(3, '2021-02-19 11:00:00', '2021-02-19 11:30:00', 'локал', 'qoergk2acsoc065lr5j966e60lsumvut'),
(5, '2021-02-15 16:00:00', '2021-02-15 16:30:00', 'тест ', 'qoergk2acsoc065lr5j966e60lsumvut'),
(7, '2021-02-18 11:00:00', '2021-02-18 12:30:00', 'Куна', 'qoergk2acsoc065lr5j966e60lsumvut'),
(8, '2021-02-19 09:00:00', '2021-02-19 09:30:00', 'Зал 1', 'qvljf1g2v359jsdb4ia2vg6l9dbv7ksr'),
(9, '2021-02-17 12:00:00', '2021-02-17 14:30:00', 'Куна ', 'qoergk2acsoc065lr5j966e60lsumvut'),
(10, '2021-02-24 11:00:00', '2021-02-24 11:30:00', 'ываыва', 'qoergk2acsoc065lr5j966e60lsumvut'),
(11, '2021-02-24 05:00:00', '2021-02-24 05:30:00', '', 'qoergk2acsoc065lr5j966e60lsumvut'),
(12, '2021-02-25 05:00:00', '2021-02-25 05:30:00', 'test', 'qoergk2acsoc065lr5j966e60lsumvut'),
(13, '2021-02-23 03:30:00', '2021-02-23 04:00:00', 'test', 'qoergk2acsoc065lr5j966e60lsumvut');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `eventt`
--
ALTER TABLE `eventt`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `eventt`
--
ALTER TABLE `eventt`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
