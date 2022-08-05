-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Авг 05 2022 г., 11:07
-- Версия сервера: 10.4.21-MariaDB
-- Версия PHP: 7.4.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `user_info`
--

-- --------------------------------------------------------

--
-- Структура таблицы `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `is_favourite` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `email`, `phone`, `is_favourite`, `created_at`, `updated_at`) VALUES
(2, 'test', 'test@mail.kz', '7771112278', 0, '2022-08-03 04:54:13', '2022-08-03 00:54:13'),
(3, 'Christelle Kerluke 2', 'user@gmail.com', '7771112278', 0, '2022-07-31 08:25:45', NULL),
(6, 'john', 'john@gmail.com', '7771115588', 0, '2022-08-02 01:39:34', NULL),
(12, 'Ben', 'ben@mail.ru', '7777777799', 0, '2022-08-02 01:43:23', NULL),
(13, 'user', 'user@gmail.com', '7771234567', 0, '2022-08-03 01:42:09', '0000-00-00 00:00:00'),
(14, 'Danial', 'danial@gmail.com', '7771112288', 0, '2022-08-03 01:44:16', '0000-00-00 00:00:00'),
(15, 'newUser', 'new@email.com', '7771234598', 0, '2022-08-03 01:44:52', '0000-00-00 00:00:00'),
(16, 'Abay', 'abay@email.com', '7771234545', 0, '2022-08-03 01:45:20', '0000-00-00 00:00:00'),
(17, 'Bolat', 'bolat@email.com', '7771237878', 0, '2022-08-03 01:45:44', '0000-00-00 00:00:00'),
(18, 'Serik', 'serik@mail.ru', '7022331616', 0, '2022-08-05 06:09:11', '0000-00-00 00:00:00'),
(19, 'Berik', 'berik@mail.ru', '7022331617', 0, '2022-08-03 14:41:34', '0000-00-00 00:00:00'),
(20, 'Bob', 'bob@mail.ru', '7024561233', 0, '2022-08-03 14:41:32', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Структура таблицы `favourites`
--

CREATE TABLE `favourites` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `contact_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `favourites`
--

INSERT INTO `favourites` (`id`, `user_id`, `contact_id`, `created_at`) VALUES
(1, 1, 1, '2022-08-02 06:02:01'),
(2, 1, 3, '2022-08-02 06:02:01'),
(5, 1, 12, '2022-08-02 08:32:01'),
(6, 1, 4, '2022-08-02 08:32:30'),
(10, 2, 11, '2022-08-02 10:38:04'),
(11, 2, 10, '2022-08-02 10:41:56'),
(12, 2, 9, '2022-08-02 10:43:45'),
(13, 2, 5, '2022-08-02 10:46:40'),
(14, 2, 8, '2022-08-02 12:46:19'),
(28, 2, 20, '2022-08-05 02:08:03'),
(29, 6, 18, '2022-08-05 02:09:11');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'test', 'test@mail.ru', 'e10adc3949ba59abbe56e057f20f883e', '2022-08-01 07:46:48', NULL),
(2, 'user', 'user@gmail.com', '1a1dc91c907325c69271ddf0c944bc72', '2022-08-01 07:51:40', NULL),
(6, 'user2', 'user2@mail.kz', '202cb962ac59075b964b07152d234b70', '2022-08-03 02:13:02', NULL);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `favourites`
--
ALTER TABLE `favourites`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT для таблицы `favourites`
--
ALTER TABLE `favourites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
