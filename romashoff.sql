-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Янв 28 2022 г., 06:49
-- Версия сервера: 5.7.33
-- Версия PHP: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `romashoff`
--

-- --------------------------------------------------------

--
-- Структура таблицы `goals`
--

CREATE TABLE `goals` (
  `gs_id` int(11) NOT NULL,
  `gs_match_id` int(11) NOT NULL,
  `gs_player_id` int(11) NOT NULL,
  `gs_time_from_match_start` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `goals`
--

INSERT INTO `goals` (`gs_id`, `gs_match_id`, `gs_player_id`, `gs_time_from_match_start`) VALUES
(14, 15, 1, 22),
(16, 9, 4, 22),
(17, 1, 9, 33),
(20, 22, 11, 54),
(21, 22, 10, 1),
(22, 15, 11, 54),
(23, 15, 7, 44);

-- --------------------------------------------------------

--
-- Структура таблицы `matches`
--

CREATE TABLE `matches` (
  `mch_id` int(11) NOT NULL,
  `mch_team1_id` int(11) NOT NULL,
  `mch_team2_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `matches`
--

INSERT INTO `matches` (`mch_id`, `mch_team1_id`, `mch_team2_id`) VALUES
(1, 22, 21),
(2, 23, 21),
(3, 24, 23),
(4, 26, 29),
(5, 27, 23),
(6, 22, 28),
(7, 25, 30),
(8, 23, 29),
(9, 21, 22),
(10, 23, 24),
(11, 25, 26),
(13, 28, 24),
(14, 28, 21),
(15, 30, 26),
(16, 21, 27),
(17, 21, 22),
(18, 28, 23),
(19, 23, 24),
(20, 22, 28),
(21, 30, 24),
(22, 30, 23);

-- --------------------------------------------------------

--
-- Структура таблицы `players`
--

CREATE TABLE `players` (
  `ps_id` int(11) NOT NULL,
  `ps_team_id` int(11) NOT NULL,
  `ps_full_name` varchar(30) NOT NULL,
  `ps_role` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `players`
--

INSERT INTO `players` (`ps_id`, `ps_team_id`, `ps_full_name`, `ps_role`) VALUES
(1, 30, 'Romashov', 'Napadenie'),
(2, 22, 'Golybev', 'zashita'),
(3, 22, 'Berkov', 'Napadenie'),
(4, 21, 'Semenov', 'Napadenie'),
(5, 21, 'Leshenko', 'Poly zashita'),
(6, 26, 'Zapevalov', 'Napadenie'),
(7, 26, 'Kyzin', 'Zashita'),
(8, 24, 'Polovinnki', 'napadenie'),
(9, 26, 'Denisenko', 'napadenie'),
(10, 23, 'Lykyanov', 'napadenie'),
(11, 30, 'Popov', 'poly_zashita'),
(12, 28, 'KOVACH', 'napadenie'),
(13, 26, 'Simple', 'AWP'),
(14, 23, 'ibragimov', 'zashita'),
(15, 22, 'Stoyakovich', 'zashita'),
(16, 27, 'Brasakovich', 'napodenie'),
(17, 25, 'Stolbakocish', 'Napadenie'),
(18, 25, 'Gorin', 'Poly_zashita'),
(19, 30, 'Valov', 'napadenie'),
(20, 21, 'popovich', 'napadenie');

-- --------------------------------------------------------

--
-- Структура таблицы `teams`
--

CREATE TABLE `teams` (
  `ts_id` int(11) NOT NULL,
  `ts_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `teams`
--

INSERT INTO `teams` (`ts_id`, `ts_name`) VALUES
(21, 'Bavariya'),
(22, 'Avai'),
(23, 'Verder'),
(24, 'Getta'),
(25, 'Desna'),
(26, 'Enisei'),
(27, 'Keln'),
(28, 'Nant'),
(29, 'Sakramenta'),
(30, 'Spartak');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `goals`
--
ALTER TABLE `goals`
  ADD PRIMARY KEY (`gs_id`),
  ADD KEY `gs_match_id` (`gs_match_id`),
  ADD KEY `gs_player_id` (`gs_player_id`);

--
-- Индексы таблицы `matches`
--
ALTER TABLE `matches`
  ADD PRIMARY KEY (`mch_id`),
  ADD KEY `mch_team1_id` (`mch_team1_id`),
  ADD KEY `mch_team2_id` (`mch_team2_id`),
  ADD KEY `mch_team2_id_2` (`mch_team2_id`);

--
-- Индексы таблицы `players`
--
ALTER TABLE `players`
  ADD PRIMARY KEY (`ps_id`),
  ADD KEY `ps_team_id` (`ps_team_id`);

--
-- Индексы таблицы `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`ts_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `goals`
--
ALTER TABLE `goals`
  MODIFY `gs_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT для таблицы `matches`
--
ALTER TABLE `matches`
  MODIFY `mch_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT для таблицы `players`
--
ALTER TABLE `players`
  MODIFY `ps_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT для таблицы `teams`
--
ALTER TABLE `teams`
  MODIFY `ts_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `goals`
--
ALTER TABLE `goals`
  ADD CONSTRAINT `goals_ibfk_1` FOREIGN KEY (`gs_match_id`) REFERENCES `matches` (`mch_id`),
  ADD CONSTRAINT `goals_ibfk_2` FOREIGN KEY (`gs_player_id`) REFERENCES `players` (`ps_id`);

--
-- Ограничения внешнего ключа таблицы `matches`
--
ALTER TABLE `matches`
  ADD CONSTRAINT `matches_ibfk_1` FOREIGN KEY (`mch_team1_id`) REFERENCES `teams` (`ts_id`),
  ADD CONSTRAINT `matches_ibfk_2` FOREIGN KEY (`mch_team2_id`) REFERENCES `teams` (`ts_id`);

--
-- Ограничения внешнего ключа таблицы `players`
--
ALTER TABLE `players`
  ADD CONSTRAINT `players_ibfk_1` FOREIGN KEY (`ps_team_id`) REFERENCES `teams` (`ts_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
