-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Сен 13 2019 г., 15:19
-- Версия сервера: 10.1.36-MariaDB
-- Версия PHP: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `crowdfunding`
--

-- --------------------------------------------------------

--
-- Структура таблицы `donate`
--

CREATE TABLE `donate` (
  `id_donate` int(11) NOT NULL,
  `date` date NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_project` int(11) NOT NULL,
  `sum` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `donate`
--

INSERT INTO `donate` (`id_donate`, `date`, `id_user`, `id_project`, `sum`) VALUES
(1, '2019-10-17', 4, 1, '1000');

-- --------------------------------------------------------

--
-- Структура таблицы `project`
--

CREATE TABLE `project` (
  `id_project` int(11) NOT NULL,
  `title` varchar(20) NOT NULL,
  `date` date NOT NULL,
  `description` varchar(100) NOT NULL,
  `period` int(8) NOT NULL,
  `daysFromStart` int(8) NOT NULL,
  `minPayment` decimal(10,0) NOT NULL,
  `requestFunds` decimal(10,0) NOT NULL,
  `currentFunds` decimal(10,0) NOT NULL,
  `id_user` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `project`
--

INSERT INTO `project` (`id_project`, `title`, `date`, `description`, `period`, `daysFromStart`, `minPayment`, `requestFunds`, `currentFunds`, `id_user`) VALUES
(1, 'на лечение', '2019-09-13', 'собираем на лечение', 60, 0, '100', '1000', '20000', 2);

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `login` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `adress` varchar(50) NOT NULL,
  `phone` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id_user`, `email`, `login`, `password`, `name`, `adress`, `phone`) VALUES
(1, 'kuku@mail.ru', 'kukuha', 'poletela', 'антонина', 'Волгоград', '88005553535'),
(2, 'morkovka@yandex.ru', 'cat', 'password', 'валентин', 'саратов', '88005672525'),
(3, 'figa@mail.ru', 'slovo', 'spb', 'чейни', 'питер', '89324638212'),
(4, 'shapka@yandex.ru', 'shapka', '12344321', 'клава', 'воронеж', '89297854637');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `donate`
--
ALTER TABLE `donate`
  ADD PRIMARY KEY (`id_donate`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_project` (`id_project`);

--
-- Индексы таблицы `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`id_project`),
  ADD KEY `id_user` (`id_user`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `donate`
--
ALTER TABLE `donate`
  MODIFY `id_donate` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `project`
--
ALTER TABLE `project`
  MODIFY `id_project` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `donate`
--
ALTER TABLE `donate`
  ADD CONSTRAINT `donate_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`),
  ADD CONSTRAINT `donate_ibfk_2` FOREIGN KEY (`id_project`) REFERENCES `project` (`id_project`);

--
-- Ограничения внешнего ключа таблицы `project`
--
ALTER TABLE `project`
  ADD CONSTRAINT `project_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
