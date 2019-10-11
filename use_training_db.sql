-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Сен 15 2019 г., 22:32
-- Версия сервера: 10.1.40-MariaDB
-- Версия PHP: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `use_training_db`
--

-- --------------------------------------------------------

--
-- Структура таблицы `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `login` varchar(64) NOT NULL,
  `password` varchar(128) NOT NULL,
  `name` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `admin`
--

INSERT INTO `admin` (`id`, `login`, `password`, `name`) VALUES
(2, 'admin', 'ca05ab5a595ca0b36ea5c403bfc6779e33a8f6be8f8376294d7d71436a987d5b', 'admin');

-- --------------------------------------------------------

--
-- Структура таблицы `exercises`
--

CREATE TABLE `exercises` (
  `id` int(11) NOT NULL,
  `topicId` int(11) NOT NULL,
  `description` text NOT NULL,
  `img` text NOT NULL,
  `rightAnswer` int(11) NOT NULL,
  `version` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `exercises`
--

INSERT INTO `exercises` (`id`, `topicId`, `description`, `img`, `rightAnswer`, `version`, `status`) VALUES
(1, 1, 'На графике изображена зависимость крутящего момента двигателя от числа его оборотов в минуту. На оси абсцисс откладывается число оборотов в минуту, на оси ординат — крутящий момент в Н  м. Скорость автомобиля (в км/ч) приближенно выражается формулой v = 0,036n, где n — число оборотов двигателя в минуту. С какой наименьшей скоростью должен двигаться автомобиль, чтобы крутящий момент был не меньше 120 Н  м? Ответ дайте в километрах в час.', 'https://mathb-ege.sdamgia.ru/get_file?id=51', 72, 0, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `subjects`
--

CREATE TABLE `subjects` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `img` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `subjects`
--

INSERT INTO `subjects` (`id`, `name`, `img`) VALUES
(1, 'Математика (профильная)', ''),
(2, '123', '');

-- --------------------------------------------------------

--
-- Структура таблицы `topics`
--

CREATE TABLE `topics` (
  `id` int(11) NOT NULL,
  `number` int(11) NOT NULL,
  `title` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `topics`
--

INSERT INTO `topics` (`id`, `number`, `title`) VALUES
(1, 11, 'Текстовые задачи');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `exercises`
--
ALTER TABLE `exercises`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `topics`
--
ALTER TABLE `topics`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `exercises`
--
ALTER TABLE `exercises`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `topics`
--
ALTER TABLE `topics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
