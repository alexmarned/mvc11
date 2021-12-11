-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Дек 10 2021 г., 14:34
-- Версия сервера: 10.4.20-MariaDB
-- Версия PHP: 7.4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `blog_test2`
--

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `vendor_code` varchar(50) NOT NULL,
  `price` varchar(15) NOT NULL,
  `name` varchar(500) NOT NULL,
  `product_dimensions` varchar(255) NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `vendor_code`, `price`, `name`, `product_dimensions`, `user_id`) VALUES
(7, '57', '4523', 'модель 887', '20*125*785', 5),
(30, 'kode', '2500', '54ро', 'gfhgfh', 3),
(33, '4568', '6000', 'новый сайт', 'средний', 7),
(34, '555444', '200', 'hjg', 'средний', 6),
(39, '55', '6000', 'собрать', 'размер', 6),
(40, 'уа', '345', 'ыва', '345', 6),
(41, 'kode', '55555', 'fg', 'крупный 200', 3),
(42, 'ааааааа', '2500', 'ааа', '1.90', 3),
(44, 'dfgdfg', '6000', 'egfdgdf', 'dfgfdgfdg', 5),
(45, 'ets', '1500', 'проверка пагинации', 'средний', 5),
(46, 'ets', '6000', 'Александр', 'крупный 200', 5);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `user_id` int(11) UNSIGNED NOT NULL,
  `user_login` varchar(30) NOT NULL,
  `user_password` varchar(32) NOT NULL,
  `user_hash` varchar(32) NOT NULL DEFAULT '',
  `user_ip` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `role` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`user_id`, `user_login`, `user_password`, `user_hash`, `user_ip`, `role`) VALUES
(3, 'admin', '3049a1f0f1c808cdaa4fbed0e01649b1', 'bb489d6a06eaf3112b9392c99ae4e927', 0, 0),
(5, 'alex', '3049a1f0f1c808cdaa4fbed0e01649b1', 'b166a6a6c3ff69197aca9fc45d59447c', 0, 1),
(6, 'lena', '3049a1f0f1c808cdaa4fbed0e01649b1', 'cec8b93d7dbdb02f6bc3426cd8fc147c', 0, 0),
(7, 'sem', '3049a1f0f1c808cdaa4fbed0e01649b1', 'f4412e93c9072ac6b0481390399272ff', 0, 0);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
