-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Ноя 26 2024 г., 08:05
-- Версия сервера: 5.7.39
-- Версия PHP: 8.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `pm.v3p`
--

-- --------------------------------------------------------

--
-- Структура таблицы `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_10_27_082052_create_projects_table', 1),
(6, '2024_10_27_082110_create_tasks_table', 1),
(7, '2024_10_27_082202_create_reports_table', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `projects`
--

CREATE TABLE `projects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `started_at` date NOT NULL,
  `finished_at` date NOT NULL,
  `status` enum('Создан','В процессе','Завершен') COLLATE utf8mb4_unicode_ci NOT NULL,
  `squad` json NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `projects`
--

INSERT INTO `projects` (`id`, `title`, `description`, `user_id`, `started_at`, `finished_at`, `status`, `squad`, `created_at`, `updated_at`) VALUES
(1, 'First project Title', 'First project Desc', 3, '2024-10-27', '2024-11-30', 'Создан', '{\"squad\": [10, 7, 3, 12]}', NULL, NULL),
(2, 'second project', 'description second project', 3, '2024-11-12', '2024-11-27', 'Создан', '{\"squad\": [3, 7, 10, 12]}', NULL, NULL),
(3, 'second project', 'description second project', 3, '2024-11-12', '2024-11-27', 'Создан', '{\"squad\": [3, 7, 10, 12]}', NULL, NULL),
(4, 'second project', 'description second project', 3, '2024-11-12', '2024-11-27', 'Создан', '{\"squad\": [7, 10, 3, 3, 12, 12]}', NULL, NULL),
(5, 'second project', 'description second project', 3, '2024-11-12', '2024-11-27', 'Создан', '{\"squad\": [3, 7, 10, 10, 12]}', NULL, NULL),
(6, 'second project', 'description second project', 3, '2024-11-12', '2024-11-27', 'Создан', '{\"squad\": [3, 7, 10, 12, 12]}', NULL, NULL),
(7, 'second project', 'description second project', 3, '2024-11-12', '2024-11-27', 'Создан', '{\"squad\": [3, 10, 7, 12, 12]}', NULL, NULL),
(8, 'second project', 'description second project', 3, '2024-11-12', '2024-11-27', 'Создан', '{\"squad\": [3, 7, 10, 12]}', NULL, NULL),
(9, 'second project', 'description second project', 3, '2024-11-12', '2024-11-27', 'Создан', '{\"squad\": []}', NULL, NULL),
(10, 'second project', 'description second project', 3, '2024-11-12', '2024-11-27', 'Создан', '{\"squad\": [3, 10]}', NULL, NULL),
(11, 'second project', 'description second project', 3, '2024-11-12', '2024-11-27', 'Создан', '{\"squad\": [3]}', NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `reports`
--

CREATE TABLE `reports` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `project_id` bigint(20) UNSIGNED NOT NULL,
  `date_report` date NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `statistics` json NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `tasks`
--

CREATE TABLE `tasks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `project_id` bigint(20) UNSIGNED NOT NULL,
  `started_at` date NOT NULL,
  `finished_at` date NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `priority` enum('Низкий','Высокий','Средний') COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('Назначена','Выполняется','Завершена') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `tasks`
--

INSERT INTO `tasks` (`id`, `title`, `description`, `project_id`, `started_at`, `finished_at`, `user_id`, `priority`, `status`, `created_at`, `updated_at`) VALUES
(1, 'First task Title', 'First task Desc', 1, '2024-10-27', '2024-10-29', 2, 'Высокий', 'Выполняется', NULL, NULL),
(2, 'Second task Title', 'Second task Desc', 1, '2024-10-27', '2024-10-29', 2, 'Высокий', 'Выполняется', NULL, NULL),
(3, 'Сходить за кофе', 'Адрес Кофейни: Республика Башкортостан, город Уфа, Советский район, улица Кирова, дом 91\r\nЗаказ: Матча Латте с карамельным сиропом, Тыквенный Латте.', 1, '2024-11-09', '2024-11-09', 2, 'Высокий', 'Выполняется', NULL, NULL),
(4, 'Сходить за кофе', 'Адрес Кофейни: Республика Башкортостан, город Уфа, Советский район, улица Кирова, дом 91\r\nЗаказ: Матча Латте с карамельным сиропом, Тыквенный Латте.', 1, '2024-11-09', '2024-11-09', 2, 'Высокий', 'Выполняется', NULL, NULL),
(5, 'Сходить за кофе', 'Адрес Кофейни: Республика Башкортостан, город Уфа, Советский район, улица Кирова, дом 91\r\nЗаказ: Матча Латте с карамельным сиропом, Тыквенный Латте.', 1, '2024-11-09', '2024-11-09', 2, 'Высокий', 'Выполняется', NULL, NULL),
(6, 'Сходить за кофе', 'Адрес Кофейни: Республика Башкортостан, город Уфа, Советский район, улица Кирова, дом 91\r\nЗаказ: Матча Латте с карамельным сиропом, Тыквенный Латте.', 1, '2024-11-09', '2024-11-09', 2, 'Высокий', 'Выполняется', NULL, NULL),
(7, 'Сходить за кофе', 'Адрес Кофейни: Республика Башкортостан, город Уфа, Советский район, улица Кирова, дом 91\r\nЗаказ: Матча Латте с карамельным сиропом, Тыквенный Латте.', 1, '2024-11-09', '2024-11-09', 2, 'Высокий', 'Выполняется', NULL, NULL),
(8, 'Сходить за кофе', 'Адрес Кофейни: Республика Башкортостан, город Уфа, Советский район, улица Кирова, дом 91\r\nЗаказ: Матча Латте с карамельным сиропом, Тыквенный Латте.', 1, '2024-11-09', '2024-11-09', 2, 'Высокий', 'Выполняется', NULL, NULL),
(9, 'Сходить за кофе', 'Адрес Кофейни: Республика Башкортостан, город Уфа, Советский район, улица Кирова, дом 91\r\nЗаказ: Матча Латте с карамельным сиропом, Тыквенный Латте.', 1, '2024-11-09', '2024-11-09', 2, 'Высокий', 'Выполняется', NULL, NULL),
(10, 'Сходить за кофе', 'Адрес Кофейни: Республика Башкортостан, город Уфа, Советский район, улица Кирова, дом 91\r\nЗаказ: Матча Латте с карамельным сиропом, Тыквенный Латте.', 1, '2024-11-09', '2024-11-09', 2, 'Высокий', 'Выполняется', NULL, NULL),
(11, 'Уложится в сроки', 'Прошу своих сотрудников поторопиться', 1, '2024-11-10', '2024-11-14', 2, 'Высокий', 'Выполняется', NULL, NULL),
(12, 'Уложится в сроки', 'Прошу своих сотрудников поторопиться', 1, '2024-11-10', '2024-11-14', 2, 'Высокий', 'Выполняется', NULL, NULL),
(13, 'Уложится в сроки', 'Прошу своих сотрудников поторопиться', 1, '2024-11-10', '2024-11-14', 2, 'Высокий', 'Выполняется', NULL, NULL),
(14, 'Уложится в сроки', 'Прошу своих сотрудников поторопиться', 1, '2024-11-10', '2024-11-14', 2, 'Высокий', 'Выполняется', NULL, NULL),
(15, 'Уложится в сроки', 'Прошу своих сотрудников поторопиться', 1, '2024-11-10', '2024-11-14', 2, 'Высокий', 'Выполняется', NULL, NULL),
(16, 'Уложится в сроки', 'Прошу своих сотрудников поторопиться', 1, '2024-11-10', '2024-11-14', 2, 'Высокий', 'Выполняется', NULL, NULL),
(17, 'Уложится в сроки', 'Прошу своих сотрудников поторопиться', 1, '2024-11-10', '2024-11-14', 2, 'Высокий', 'Выполняется', NULL, NULL),
(18, 'Уложится в сроки', 'Прошу своих сотрудников поторопиться', 1, '2024-11-10', '2024-11-14', 2, 'Высокий', 'Выполняется', NULL, NULL),
(19, 'Уложится в сроки', 'Прошу своих сотрудников поторопиться', 1, '2024-11-10', '2024-11-14', 2, 'Высокий', 'Выполняется', NULL, NULL),
(22, 'Выполнить задание 7', 'Сейчас важно выполнить задание под номером 7', 1, '2024-11-10', '2024-11-12', 2, 'Высокий', 'Выполняется', NULL, NULL),
(23, 'Выполнить задание 7', 'Сейчас важно выполнить задание под номером 7', 1, '2024-11-10', '2024-11-12', 2, 'Высокий', 'Выполняется', NULL, NULL),
(24, 'q', 'q', 1, '2024-11-27', '2024-11-30', 3, 'Низкий', 'Назначена', '2024-11-25 14:04:59', '2024-11-25 14:04:59'),
(25, 'qwerty', 'qwerty', 1, '2024-11-28', '2024-11-30', 7, 'Низкий', 'Назначена', '2024-11-25 14:07:16', '2024-11-25 14:07:16'),
(26, 'task #234', 'desc #234', 4, '2024-11-26', '2024-11-27', 10, 'Высокий', 'Назначена', '2024-11-25 14:07:46', '2024-11-25 14:07:46');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `role` enum('admin','manager','worker') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'worker',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `blocked` set('0','1') COLLATE utf8mb4_unicode_ci DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `role`, `password`, `remember_token`, `created_at`, `updated_at`, `blocked`) VALUES
(1, 'Kate', 'kate@mail.ru', NULL, 'manager', '$2y$10$5xKOIYI67xLlsm1/xNNMXOLKAejfh0jMgo3R9v/2gI1C9iHzq9zwS', NULL, '2024-10-27 08:37:13', '2024-10-27 08:37:13', '0'),
(2, 'rori', 'rori@mail.com', NULL, 'admin', '$2y$10$kPrpnpHaJj7of/Jc1.gHEO5QzkLQT0/rozZoac6DEZ.Y0jFl67yA6', NULL, '2024-10-27 10:06:36', '2024-10-27 10:06:36', '0'),
(3, 'Ulyana', 'Ulyana@mail.com', NULL, 'worker', '$2y$10$jowmdvufAzf8h/5iuOEo/O1sXIJxju96cIHdypn3igz5q68NSIIgW', NULL, '2024-10-27 10:32:33', '2024-10-27 10:32:33', '0'),
(7, 'kiara', 'kiara@mail.ru', NULL, 'worker', '$2y$10$Vvy6zjenCuS0.F8j5Ovu4O9RgF8xFt7wOLrbEFmkHBi0NzXlGhDtO', NULL, '2024-11-23 10:53:25', '2024-11-23 10:53:25', '0'),
(10, 'shastoon', 'sastoon@label.com', NULL, 'worker', '$2y$10$l2gx6TNjLbeYd6rkpOIcYO.tpickqOSDlgNEG3u5qjuO5aXnUYpsy', NULL, '2024-11-18 13:52:59', '2024-11-18 13:52:59', '0'),
(12, 'sergey', 'sergey@mail.ru', NULL, 'worker', '$2y$10$3Uaw.H0r3g99Lz8KtpGoVeNtPdRqVZXEaRQ3VmmNCqkr9/5iCq7qO', NULL, '2024-11-23 12:46:19', '2024-11-23 12:46:19', '0');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Индексы таблицы `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Индексы таблицы `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Индексы таблицы `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `projects_user_id_foreign` (`user_id`);

--
-- Индексы таблицы `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reports_project_id_foreign` (`project_id`),
  ADD KEY `reports_user_id_foreign` (`user_id`);

--
-- Индексы таблицы `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tasks_project_id_foreign` (`project_id`),
  ADD KEY `tasks_user_id_foreign` (`user_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `projects`
--
ALTER TABLE `projects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT для таблицы `reports`
--
ALTER TABLE `reports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `projects`
--
ALTER TABLE `projects`
  ADD CONSTRAINT `projects_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ограничения внешнего ключа таблицы `reports`
--
ALTER TABLE `reports`
  ADD CONSTRAINT `reports_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reports_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tasks_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
