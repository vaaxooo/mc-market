-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Мар 18 2021 г., 01:10
-- Версия сервера: 5.7.23-log
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
-- База данных: `cms`
--

-- --------------------------------------------------------

--
-- Структура таблицы `historysells`
--

CREATE TABLE `historysells` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `account` varchar(255) NOT NULL,
  `date` varchar(50) NOT NULL,
  `price` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `itemId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `invoices`
--

CREATE TABLE `invoices` (
  `id` int(11) NOT NULL,
  `transaction` varchar(255) NOT NULL,
  `amount` int(11) NOT NULL,
  `date` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'unpaid',
  `account` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `small_description` varchar(55) NOT NULL,
  `description` varchar(5500) NOT NULL,
  `account` varchar(50) NOT NULL,
  `date` varchar(50) NOT NULL,
  `price` int(11) NOT NULL,
  `verified` varchar(20) NOT NULL DEFAULT 'false',
  `image1` varchar(255) NOT NULL,
  `image2` varchar(255) NOT NULL,
  `image3` varchar(255) DEFAULT NULL,
  `image4` varchar(255) DEFAULT NULL,
  `image5` varchar(255) DEFAULT NULL,
  `download_link` varchar(255) NOT NULL,
  `version` varchar(50) NOT NULL,
  `tags` varchar(255) NOT NULL,
  `game` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `message` varchar(255) NOT NULL,
  `date` varchar(50) NOT NULL,
  `account` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `notifications`
--

INSERT INTO `notifications` (`id`, `title`, `message`, `date`, `account`) VALUES
(83, 'Новый пользователь', 'Поздравляем вас с регистрацией! =)', '2021-03-18 00:07:06', 'donjkee47@gmail.com');

-- --------------------------------------------------------

--
-- Структура таблицы `payout`
--

CREATE TABLE `payout` (
  `id` int(11) NOT NULL,
  `payout_type` varchar(255) NOT NULL,
  `wallet` varchar(255) NOT NULL,
  `sum` int(11) NOT NULL,
  `date` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'unpaid',
  `account` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `payout`
--

INSERT INTO `payout` (`id`, `payout_type`, `wallet`, `sum`, `date`, `status`, `account`) VALUES
(1, 'Qiwi', '+380733285041', 110, '2019-08-02 06:49:40', 'paid', 'admin@trademc.xyz'),
(2, 'Qiwi', '+380733285041', 100, '2019-08-02 07:02:30', 'unpaid', 'admin@trademc.xyz'),
(3, 'Qiwi', '+380733285041', 100, '2019-08-02 07:02:56', 'unpaid', 'admin@trademc.xyz'),
(4, 'Yandex Money', '73314156862351', 750, '2019-08-03 15:36:18', 'unpaid', 'admin@trademc.xyz');

-- --------------------------------------------------------

--
-- Структура таблицы `promocodes`
--

CREATE TABLE `promocodes` (
  `id` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `percent` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `rating`
--

CREATE TABLE `rating` (
  `id` int(11) NOT NULL,
  `account` varchar(50) NOT NULL,
  `ip` varchar(50) NOT NULL,
  `date` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `rating`
--

INSERT INTO `rating` (`id`, `account`, `ip`, `date`) VALUES
(1, 'admin@trademc.xyz', '127.0.0.1', '2019-08-02 19:15:14'),
(2, 'admin@trademc.xyz', '162.158.234.133', '2019-10-31 01:40:43');

-- --------------------------------------------------------

--
-- Структура таблицы `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `top_ad` varchar(5000) DEFAULT NULL,
  `bottom_ad` varchar(5000) DEFAULT NULL,
  `pro_price` int(11) NOT NULL DEFAULT '50',
  `recaptcha` varchar(20) NOT NULL DEFAULT 'false',
  `recaptcha_publickey` varchar(255) DEFAULT NULL,
  `recaptcha_privatekey` varchar(255) DEFAULT NULL,
  `google_key` varchar(255) DEFAULT NULL,
  `description` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `settings`
--

INSERT INTO `settings` (`id`, `top_ad`, `bottom_ad`, `pro_price`, `recaptcha`, `recaptcha_publickey`, `recaptcha_privatekey`, `google_key`, `description`) VALUES
(1, '', NULL, 30, 'false', NULL, NULL, '', '');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `recovery_code` varchar(255) DEFAULT NULL,
  `admin` varchar(10) NOT NULL DEFAULT 'false',
  `type` varchar(20) NOT NULL DEFAULT 'unbanned',
  `date` varchar(20) NOT NULL,
  `pro` varchar(20) NOT NULL DEFAULT 'false',
  `balance` decimal(10,2) NOT NULL DEFAULT '0.00',
  `ip` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `password`, `recovery_code`, `admin`, `type`, `date`, `pro`, `balance`, `ip`) VALUES
(1, 'Никита', 'Печёнкин', 'admin@trademc.xyz', '$2y$13$IR8YLCM62sfqcSCD5aOIw.wCDTcW0qJuL3p7XfSXoPRt7DWVwOwb6', NULL, 'true', 'unbanned', '2019-08-02 01:44:29', 'true', '0.00', '127.0.0.1'),
(4, 'Рома', 'Туманов', 'roma_tumanov@mail.ua', '$2y$13$6CFTMtacaf2Ezgm8XOK7v..9VMGtqxckHnF4FOA/nbZZPBu3kEGAe', NULL, 'true', 'unbanned', '2019-08-05 09:31:46', 'true', '0.00', '172.68.239.174'),
(5, 'Secs', 'Saxs', '3467884v@gmail.com', '$2y$13$voeKCzilccCfYmsQcWZn/ulmPeBrnG2M7yyl1c1a35mL.vbuQaQQm', NULL, 'false', 'unbanned', '2019-08-05 16:35:39', 'false', '0.00', '162.158.89.170'),
(6, 'Макс', 'Никольский', 'muhammad.inkhelo@gmail.com', '$2y$13$MFb7N7nqmfjrhj9EucyboOhmQ0gG0YUuXZwXip3Fsbc.976KCILaK', NULL, 'false', 'unbanned', '2019-08-09 17:36:50', 'false', '0.00', '162.158.182.131'),
(7, 'Egor', 'Ronjen', 'graytiphelp@gmail.com', '$2y$13$v8K7o2zwLMWBq/1ixjiKQei4tSGhdbcJxq1xJ/jwhbRT6nB1J3s2m', NULL, 'false', 'unbanned', '2019-08-11 13:43:56', 'false', '0.00', '162.158.91.54'),
(8, 'Сергей', 'Милованов', 'sergmil2006@gmail.com', '$2y$13$OVijtoT23z2mlP8kvfoh4u.rznsrluK5MXOFVu.jY/H0M8HWHP/me', NULL, 'false', 'unbanned', '2019-08-11 13:55:03', 'false', '0.00', '162.158.210.71'),
(9, 'Andrey', 'Just', 'hestilov12@gmail.com', '$2y$13$YYFl8ozpvh0aQKMxgkKoy.pv47ecjWlh4SWITh2n5EPaU.QKYm996', NULL, 'false', 'unbanned', '2019-08-15 11:53:12', 'false', '0.00', '162.158.90.139'),
(10, 'Кирилл', 'Потехин', 'kpotehin55@gmail.com', '$2y$13$1cvNt50BqcwgfW/OfvuS/uAjoJx0Tq2I5jBWVE71W6O7H/aQexQ5C', NULL, 'false', 'unbanned', '2019-08-15 13:59:48', 'false', '0.00', '172.68.11.12'),
(11, 'Иван', 'Петров', 'xjsjsjsjsjs@mail.com', '$2y$13$wAeOOC6jZ6CX6VmOU6Q.SuUZOs0fC.EHlT/ukEC9g5W5ONpdrRQr.', NULL, 'false', 'unbanned', '2019-08-16 19:34:56', 'false', '0.00', '172.68.182.221'),
(12, 'Овер', 'Волков', 'skilltopyt.net@gmail.com', '$2y$13$anKlSn9SByyvvPghrEcEAeaErIT176kLDnQYGGDmI5bgIZWVaRGUK', NULL, 'false', 'unbanned', '2019-08-17 18:07:57', 'false', '0.00', '172.68.244.217'),
(13, 'Техническая', 'Поддержка', 'support@mcmarket.space', '$2y$13$usi2jbpMFqVrQl3QB.tMDu5FadAla4YVXWF8a9MGlMtgCdA5KBSdC', NULL, 'false', 'unbanned', '2019-08-17 19:24:24', 'true', '0.00', '172.68.65.103'),
(14, 'Илья', 'Мирный', 'zonalman73@gmail.com', '$2y$13$Abx9NDeKj1yQtu78bsTzleW3c9RKjaykO07RyvydVDc2WnYdWs8NS', NULL, 'false', 'unbanned', '2019-08-18 02:09:19', 'false', '0.00', '162.158.88.135'),
(15, 'Виктор', 'Призов', 'Likoilfree@gmail.Com', '$2y$13$NQZTc/YSba4AbHbgnXjso.iy.e2XSiHQSrmNyAXAC4uCzljISf1b.', NULL, 'false', 'unbanned', '2019-08-19 05:56:46', 'false', '0.00', '162.158.182.131'),
(16, 'Елисей', 'Веревкин', 'elisey.rayman@mail.ru', '$2y$13$cs5qXLPa22a2PVOo8Z8F2.ls/SN8h1jG1N1OuNlG4VD3WSvRGp2RG', NULL, 'false', 'unbanned', '2019-08-19 11:48:40', 'false', '0.00', '172.68.245.32'),
(17, 'Олег', 'Краев', 'hteppl.dev@gmail.com', '$2y$13$t.f5vGvA/fUl72ayORJb0ONbgLar2sfgKKU0Omx9ckdD/rBhY3XFm', NULL, 'false', 'unbanned', '2019-08-19 22:48:20', 'false', '0.00', '172.68.244.109'),
(18, 'Александр', 'Павлюченко', 'khismatov@khismatov.ru', '$2y$13$StgGafE95NiTVy11hVh6bOMou0OIXK3dy1lGjOO5zuGNRz0OIjPve', NULL, 'false', 'unbanned', '2019-08-20 09:33:19', 'false', '0.00', '172.68.244.217'),
(19, 'Даниил', 'Лапин', 'danilalapin163@gmail.com', '$2y$13$ga3Fk2CdN4AMXynjyjs4VuRnbg.9COgnC1kGFZYA0nOa9ySBeexL6', NULL, 'false', 'unbanned', '2019-08-20 10:23:34', 'false', '0.00', '172.68.11.132'),
(20, 'Ден', 'Фом', 'denisfomin598@gmail.com', '$2y$13$FSy9M14a2gR41KtxX3hDbOZGh3B0T4UiWrrp7j51Z5jkOU5R5vK.6', NULL, 'false', 'unbanned', '2019-08-21 13:37:31', 'false', '0.00', '172.68.246.213'),
(21, 'Vitality', 'Mentsau', 'witalik200511@gmail.com', '$2y$13$vZuNV4Hfq7nkfyMYqLZBWe4u1bK9M8Idq7dLZqqjchCmlq44XqM5K', NULL, 'false', 'unbanned', '2019-08-22 00:07:33', 'false', '0.00', '172.69.10.113'),
(22, 'LDPOGO', 'MCPE', 'ldpogo@list.ru', '$2y$13$MbIzKMml96K3dWT58MUmJOdiEK8Kga8gxU19lMLt0TTVvkpRJalgK', NULL, 'false', 'unbanned', '2019-08-22 13:36:48', 'false', '0.00', '172.68.182.227'),
(23, 'Vladislav', 'Rimashevskii', 'rimashevskydev@gmail.com', '$2y$13$YYD103JCaWnJPKwwv8nGeuRjmRFOtRHua.9koOtHgfmILdiv4.l3.', NULL, 'false', 'unbanned', '2019-08-22 14:33:48', 'false', '0.00', '108.162.229.123'),
(24, 'Рома', 'Лукин', 'lykin231003@gmail.com', '$2y$13$m7D6isHk0DWi1C38ujDCWe6Kw8whgGUpYZkcDy.RT4zyfLC.Rq.Ha', NULL, 'false', 'unbanned', '2019-08-22 15:45:20', 'false', '0.00', '172.68.182.155'),
(25, 'Timur', 'Kanapin', 'dreamworldpcmc@gmail.com', '$2y$13$9tZiIBb8YAzf7rjiSseqnuYDQKKDVa/b6P9a0I7w/ggfyuoZKH1PC', NULL, 'false', 'unbanned', '2019-08-22 16:00:43', 'false', '0.00', '162.158.93.148'),
(26, 'Ricado', 'Milos', 'RicardoMilos@star.com', '$2y$13$eQdj3JBvimvwgzVTRpKax.ZCwdkPkRLnKItdCeJ.h.Cbrl9PEOK8m', NULL, 'false', 'unbanned', '2019-08-22 16:20:11', 'false', '0.00', '172.68.182.221'),
(27, 'Smoggy', 'Deer', 'smoggydeer34424@gmail.com', '$2y$13$TUgEZyHgdPDv/i2ZcGSlTOXaq6zFyeFJyrVqW2IapaYHM41ohd7RO', NULL, 'false', 'unbanned', '2019-08-22 19:46:45', 'false', '0.00', '162.158.91.198'),
(28, 'AVEE', 'BLDS', 'projectavee@gmail.com', '$2y$13$uzq6g3GOIO03M/kIbp4SVOIjE5owaok821IJmOwCg3IsljvG1uOGi', NULL, 'false', 'unbanned', '2019-08-22 22:38:15', 'false', '0.00', '162.158.92.53'),
(29, 'Поц', 'Ноунейм', 'artur.kovalev.2008@gmail.com', '$2y$13$wJVioXfpfoq/KPfigdMiWu6WXlhENXBncn74QVnUTCDIxpaSeL5Gq', NULL, 'false', 'unbanned', '2019-08-23 00:08:32', 'false', '0.00', '172.68.246.81'),
(30, 'Andrey', 'Blih', 'sofarity@gmail.com', '$2y$13$IXSPIaZKlNIgys0Y4a0VJueb3MIU9VT7719L6kiQMGjwbhMHsnGrS', NULL, 'false', 'unbanned', '2019-08-23 09:16:42', 'false', '0.00', '172.68.239.30'),
(31, 'Yarka', 'Ilin', 'yarka720@gmail.com', '$2y$13$Nedf8r2ekr.KSaQsyQUtOOfn/XhUvvnRxs2/fA79v3AXaoQMjR7vW', NULL, 'false', 'unbanned', '2019-08-23 10:09:52', 'false', '0.00', '172.68.246.213'),
(32, 'Алекс', 'Алекс', 'alexwolf120904@gmail.com', '$2y$13$9DWw2TtRuoSbm8Rgi/SDFOKwmvFNkDZwiSJVzEjvtUUTxuWG0VRQm', NULL, 'false', 'unbanned', '2019-08-25 12:42:54', 'false', '0.00', '162.158.150.121'),
(33, 'Павел', 'Руппель', 'maksus2017@gmail.com', '$2y$13$ocoVVcSAgi42bV8iXnAaD.QSUufoM/ICEixEoyx4dzLS5j22mg4GO', NULL, 'false', 'unbanned', '2019-09-03 07:10:37', 'false', '0.00', '162.158.91.184'),
(34, 'Jonibek', 'Mussoev', 'jonibekmussoev@gmail.com', '$2y$13$.Ez/ry8cIqTpxqeB6NYySuoi76Yt7Png3RpSXFgJAzgEkOJCowAIa', NULL, 'false', 'unbanned', '2019-09-04 04:06:04', 'false', '0.00', '172.68.246.39'),
(35, 'Сергей', 'Авдеев', 'fox223223@gmail.com', '$2y$13$lNnTFNcr1zeUkOmLlXDyvuWpkiiXEGjN5dGzGBeH1d3MgUM81az6a', NULL, 'false', 'unbanned', '2019-09-20 00:52:38', 'false', '0.00', '172.68.10.125'),
(36, 'Вавиор', 'Вавиоров', 'vaviorthekaifgames@gmail.com', '$2y$13$C0Dnphe0qr8Dx0oOV0AFa.Dphb2peqIrfTVNC3vjVHotLiXdbHcLC', NULL, 'false', 'unbanned', '2019-10-06 18:31:29', 'false', '0.00', '172.69.55.149'),
(37, 'Никита', 'Зарубин', 'zarnik00999@gmail.com', '$2y$13$qPr0EMS.CzUwL./oFsKBj.U/fLNZQ/pR8WVguxTjP4/WfeiWj86C6', NULL, 'false', 'unbanned', '2019-10-15 01:50:02', 'false', '0.00', '172.68.246.171'),
(38, 'Технический', 'Профиль', 'support1@mcmarket.space', '$2y$13$RGiTJJjl6UchriaIgt7S/.Pz9IK3m71UujJr1Qn5l6aJi5Uxkxz.m', NULL, 'false', 'banned', '2019-10-26 17:16:59', 'false', '0.00', '162.158.234.133'),
(39, 'Кирилл', 'Силютин', 'slyutinki@yandex.ru', '$2y$13$ih4mT9GjKmG9MQlWtcaxceOGdPDlUWc7Tt/fz3Uiiwlt/Cku4S0Oy', NULL, 'false', 'unbanned', '2019-10-26 17:17:29', 'false', '0.00', '162.158.158.222'),
(40, 'Михаил', 'Святковский', 'mixruil@icloud.com', '$2y$13$mPsf9pLtM9Yckq5jtBlZRO7lR9K2gXQBRRsm73WVH7CEiPM.Xx1.O', NULL, 'false', 'unbanned', '2019-10-31 09:19:41', 'false', '0.00', '172.69.10.119'),
(41, 'Дмитрий', 'Буклынов', 'buklynovd@gmail.com', '$2y$13$1HBLOAxfY612y5ijyQEEpOllLxXaZ.l3ojF1A1P6.Ejb9yFXbWtBG', NULL, 'false', 'unbanned', '2019-11-29 11:22:30', 'false', '0.00', '172.69.55.173'),
(42, 'Александр', 'Смирнов', 'donjkee47@gmail.com', '$2y$13$mljoQMROu1OCedgqKQm6rebOSHCRY0FDdfYA9TOo759C8yBINqZiu', NULL, 'true', 'unbanned', '2021-03-18 00:07:06', 'false', '0.00', '127.0.0.1');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `historysells`
--
ALTER TABLE `historysells`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `payout`
--
ALTER TABLE `payout`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `promocodes`
--
ALTER TABLE `promocodes`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `settings`
--
ALTER TABLE `settings`
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
-- AUTO_INCREMENT для таблицы `historysells`
--
ALTER TABLE `historysells`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT для таблицы `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT для таблицы `payout`
--
ALTER TABLE `payout`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `promocodes`
--
ALTER TABLE `promocodes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `rating`
--
ALTER TABLE `rating`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
