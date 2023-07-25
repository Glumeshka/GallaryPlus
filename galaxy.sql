-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июл 25 2023 г., 23:57
-- Версия сервера: 8.0.30
-- Версия PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `galaxy`
--

-- --------------------------------------------------------

--
-- Структура таблицы `comments`
--

CREATE TABLE `comments` (
  `id` int NOT NULL,
  `image_id` int NOT NULL,
  `created` datetime NOT NULL,
  `text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `author` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `comments`
--

INSERT INTO `comments` (`id`, `image_id`, `created`, `text`, `author`) VALUES
(22, 315, '2023-07-22 19:57:36', 'jkonnjk', 302);

-- --------------------------------------------------------

--
-- Структура таблицы `images`
--

CREATE TABLE `images` (
  `id` int NOT NULL,
  `filename` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `owner` int DEFAULT NULL,
  `type` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `images`
--

INSERT INTO `images` (`id`, `filename`, `title`, `owner`, `type`) VALUES
(315, 'кот_001.jpg', 'Кошки являются одними из самых популярных домашних животных во всем мире.', 302, 'image/jpeg'),
(316, 'кот_002.jpg', 'Существует более 70 различных пород кошек, каждая со своими уникальными характеристиками и особенностями.', 302, 'image/jpeg'),
(317, 'кот_003.jpg', 'Кошки обладают превосходным ночным зрением и могут видеть в полной темноте.', 302, 'image/jpeg'),
(318, 'кот_004.jpg', 'Отдельные кошки могут спать до 16 часов в день, что делает их одними из самых сонных животных.', 302, 'image/jpeg'),
(319, 'кот_005.jpg', 'Кошки используют свое мяуканье для общения с людьми и другими кошками.', 302, 'image/jpeg'),
(320, 'кот_006.jpg', 'У кошек есть острые когти, которые они используют для охоты, защиты и заточки своих когтей.', 302, 'image/jpeg'),
(321, 'кот_007.jpg', 'Приласкав кошку, вы можете услышать ее мурлыканье, что является проявлением удовольствия и комфорта.', 302, 'image/jpeg'),
(322, 'кот_008.jpg', 'Кошки очень гибкие и могут повернуть свое тело на 180 градусов.', 302, 'image/jpeg'),
(323, 'кот_009.jpg', 'Многие кошки обожают играть с маленькими предметами, такими как мячи и пушистые игрушки.', 302, 'image/jpeg'),
(324, 'кот_010.jpg', 'Кошки имеют отличную координацию и баланс, что позволяет им совершать невероятные прыжки и лазить по узким поверхностям.', 302, 'image/jpeg'),
(325, 'кот_011.jpg', 'В древних культурах кошки считались священными животными и символами удачи.', 302, 'image/jpeg'),
(326, 'кот_012.jpg', 'Кошки - это популярные домашние животные, которые обладают независимым и самобытным характером.', 302, 'image/jpeg');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(32) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `token` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `role` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `date`, `token`, `role`) VALUES
(302, 'qwe', 'RZL1985@gmail.com', '$2y$10$F287mix1VIZpsJh7i3HZ7OBHhME554HUhPiXcOGltj.ce0Fpi.RJO', '2023-07-15 21:20:48', '$2y$10$K6U584UpbpKQweH6xsopMeZGvkj5WtAwiRJe4aTuGhrIKt6/2ssRy', 1);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_comments_images` (`image_id`),
  ADD KEY `FK_comments_users` (`author`);

--
-- Индексы таблицы `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `filename` (`filename`) USING BTREE,
  ADD KEY `FK_images_users` (`owner`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`) USING BTREE;

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT для таблицы `images`
--
ALTER TABLE `images`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=327;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=303;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `FK_comments_images` FOREIGN KEY (`image_id`) REFERENCES `images` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_comments_users` FOREIGN KEY (`author`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `FK_images_users` FOREIGN KEY (`owner`) REFERENCES `users` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
