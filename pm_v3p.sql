-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Дек 13 2024 г., 06:05
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
-- База данных: `pm_v3p`
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
  `description` text COLLATE utf8mb4_unicode_ci,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `started_at` date DEFAULT NULL,
  `finished_at` date DEFAULT NULL,
  `status` enum('Создан','В процессе','Завершен') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `squad` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `projects`
--

INSERT INTO `projects` (`id`, `title`, `description`, `user_id`, `started_at`, `finished_at`, `status`, `squad`, `created_at`, `updated_at`) VALUES
(31, 'New project #1', 'Description', 1, '2024-12-20', '2024-12-29', 'В процессе', '{\"squad\": [\"7\"]}', '2024-12-05 08:21:34', '2024-12-12 04:42:12'),
(32, 'tyty', 'desc', 1, '2024-12-18', '2024-12-25', 'В процессе', '{\"squad\": [\"7\", 10]}', NULL, '2024-12-12 04:36:00'),
(33, 'project 8 Dec', 'desc', 1, '2024-12-03', '2024-12-11', 'Создан', '{\"squad\": [\"10\", \"12\", \"7\"]}', '2024-12-08 14:55:22', '2024-12-08 14:55:22'),
(34, '123', '123', 3, '2024-12-06', '2024-12-08', 'Создан', '{\"squad\": [\"7\"]}', '2024-12-09 07:34:43', '2024-12-09 15:56:33'),
(35, '123 r', '123', 3, '2024-12-04', '2024-12-13', 'Создан', '{\"squad\": [\"7\"]}', '2024-12-09 07:39:13', '2024-12-09 15:49:53'),
(36, 'idk how named this project', 'desc', 13, '2024-12-02', '2024-12-12', 'В процессе', '{\"squad\": [\"10\", \"12\", \"7\"]}', NULL, NULL),
(37, 'idk how named this project #1', 'desc', 13, '2024-12-02', '2024-12-12', 'В процессе', '{\"squad\": [\"7\"]}', NULL, '2024-12-09 16:09:00'),
(38, 'idk how named this project #2', 'desc', 13, '2024-12-02', '2024-12-12', 'В процессе', '{\"squad\": [\"10\", \"12\", \"7\"]}', NULL, NULL),
(39, 'idk how named this project #3', 'desc', 13, '2024-12-02', '2024-12-12', 'В процессе', '{\"squad\": [\"7\"]}', NULL, '2024-12-09 16:06:45'),
(41, 'idk how named this project #5', 'desc', 13, '2024-12-02', '2024-12-12', 'В процессе', '{\"squad\": [\"12\", \"7\"]}', NULL, '2024-12-09 16:09:23'),
(42, 'idk how named this project #6', 'desc', 13, '2024-12-02', '2024-12-12', 'В процессе', '{\"squad\": [\"10\", \"12\", \"7\"]}', NULL, NULL),
(43, 'idk how named this project #7', 'desc', 13, '2024-12-02', '2024-12-12', 'В процессе', '{\"squad\": [\"7\"]}', NULL, '2024-12-09 16:07:53'),
(44, 'idk how named this project #8', 'desc', 13, '2024-12-02', '2024-12-12', 'В процессе', '{\"squad\": [\"10\", \"12\", \"7\"]}', NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `reports`
--

CREATE TABLE `reports` (
  `id` int(10) UNSIGNED NOT NULL,
  `aspect` enum('worker','project') COLLATE utf8mb4_unicode_ci NOT NULL,
  `aspect_id` int(11) NOT NULL,
  `date_report` date NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `statistics` json NOT NULL,
  `interval` enum('year','month','week') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `reports`
--

INSERT INTO `reports` (`id`, `aspect`, `aspect_id`, `date_report`, `user_id`, `statistics`, `interval`, `created_at`, `updated_at`) VALUES
(17, 'worker', 10, '2024-12-10', 2, '[[\"title\", \"Выполняется\", \"2024-12-03\", \"2024-12-08\"], [\"1234\", \"Завершена\", \"2024-12-04\", \"2024-12-08\"], [\"27\", \"Назначена\", \"2024-12-06\", \"2024-12-08\"], [\"for shampun`\", \"Назначена\", \"2024-12-05\", \"2024-12-12\"], [\"secon for shampoo\", \"Назначена\", \"2024-12-06\", \"2024-12-12\"], [\"shampoo\", \"Завершена\", \"2024-12-06\", \"2024-12-10\"], [\"cherry cherry lady\", \"Завершена\", \"2024-12-06\", \"2024-12-10\"]]', 'year', '2024-12-10 14:23:13', '2024-12-10 14:23:13'),
(18, 'worker', 10, '2024-12-10', 2, '{\"0\": [\"title\", \"Выполняется\", \"2024-12-03\", \"2024-12-08\"], \"1\": [\"1234\", \"Завершена\", \"2024-12-04\", \"2024-12-08\"], \"2\": [\"27\", \"Назначена\", \"2024-12-06\", \"2024-12-08\"], \"3\": [\"for shampun`\", \"Назначена\", \"2024-12-05\", \"2024-12-12\"], \"4\": [\"secon for shampoo\", \"Назначена\", \"2024-12-06\", \"2024-12-12\"], \"5\": [\"shampoo\", \"Завершена\", \"2024-12-06\", \"2024-12-10\"], \"6\": [\"cherry cherry lady\", \"Завершена\", \"2024-12-06\", \"2024-12-10\"]}', 'year', '2024-12-10 14:24:25', '2024-12-10 14:24:25'),
(19, 'worker', 10, '2024-12-10', 2, '{\"0\": [\"title\", \"Выполняется\", \"2024-12-03\", \"2024-12-08\"], \"1\": [\"1234\", \"Завершена\", \"2024-12-04\", \"2024-12-08\"], \"2\": [\"27\", \"Назначена\", \"2024-12-06\", \"2024-12-08\"], \"3\": [\"for shampun`\", \"Назначена\", \"2024-12-05\", \"2024-12-12\"], \"4\": [\"secon for shampoo\", \"Назначена\", \"2024-12-06\", \"2024-12-12\"], \"5\": [\"shampoo\", \"Завершена\", \"2024-12-06\", \"2024-12-10\"], \"6\": [\"cherry cherry lady\", \"Завершена\", \"2024-12-06\", \"2024-12-10\"]}', 'month', '2024-12-10 14:25:34', '2024-12-10 14:25:34'),
(20, 'worker', 7, '2024-12-10', 2, '{\"0\": [\"Task for Kiara\", \"Назначена\", \"2024-12-05\", \"2024-12-11\"]}', 'year', '2024-12-10 14:26:15', '2024-12-10 14:26:15'),
(21, 'project', 44, '2024-12-10', 2, '{\"0\": [\"shampoo\", \"Завершена\", \"2024-12-06\", \"2024-12-10\"], \"1\": [\"cherry cherry lady\", \"Завершена\", \"2024-12-06\", \"2024-12-10\"]}', 'month', '2024-12-10 14:45:31', '2024-12-10 14:45:31'),
(22, 'project', 44, '2024-12-10', 2, '{\"0\": [\"shampoo\", \"Завершена\", \"2024-12-06\", \"2024-12-10\"], \"1\": [\"cherry cherry lady\", \"Завершена\", \"2024-12-06\", \"2024-12-10\"]}', 'month', '2024-12-10 14:45:59', '2024-12-10 14:45:59'),
(23, 'worker', 10, '2024-12-11', 2, '{\"0\": [\"title\", \"Выполняется\", \"2024-12-03\", \"2024-12-08\"], \"1\": [\"1234\", \"Завершена\", \"2024-12-04\", \"2024-12-08\"], \"2\": [\"27\", \"Назначена\", \"2024-12-06\", \"2024-12-08\"], \"3\": [\"for shampun`\", \"Назначена\", \"2024-12-05\", \"2024-12-12\"], \"4\": [\"secon for shampoo\", \"Назначена\", \"2024-12-06\", \"2024-12-12\"], \"5\": [\"shampoo\", \"Завершена\", \"2024-12-06\", \"2024-12-10\"], \"6\": [\"cherry cherry lady\", \"Завершена\", \"2024-12-06\", \"2024-12-10\"]}', 'month', '2024-12-11 00:05:31', '2024-12-11 00:05:31'),
(24, 'project', 44, '2024-12-11', 2, '{\"0\": [\"shampoo\", \"Завершена\", \"2024-12-06\", \"2024-12-10\"], \"1\": [\"cherry cherry lady\", \"Завершена\", \"2024-12-06\", \"2024-12-10\"]}', 'month', '2024-12-11 00:43:38', '2024-12-11 00:43:38'),
(25, 'project', 44, '2024-12-11', 2, '{\"0\": [\"shampoo\", \"Завершена\", \"2024-12-06\", \"2024-12-10\"], \"1\": [\"cherry cherry lady\", \"Завершена\", \"2024-12-06\", \"2024-12-10\"]}', 'month', '2024-12-11 00:43:40', '2024-12-11 00:43:40'),
(26, 'project', 44, '2024-12-11', 2, '{\"0\": [\"shampoo\", \"Завершена\", \"2024-12-06\", \"2024-12-10\"], \"1\": [\"cherry cherry lady\", \"Завершена\", \"2024-12-06\", \"2024-12-10\"]}', 'month', '2024-12-11 00:43:42', '2024-12-11 00:43:42'),
(27, 'worker', 7, '2024-12-11', 2, '{\"0\": [\"Task for Kiara\", \"Назначена\", \"2024-12-05\", \"2024-12-11\"]}', 'year', '2024-12-11 00:44:26', '2024-12-11 00:44:26'),
(28, 'worker', 7, '2024-12-11', 2, '{\"0\": [\"Task for Kiara\", \"Назначена\", \"2024-12-05\", \"2024-12-11\"]}', 'year', '2024-12-11 00:44:31', '2024-12-11 00:44:31'),
(29, 'worker', 7, '2024-12-11', 2, '{\"0\": [\"Task for Kiara\", \"Назначена\", \"2024-12-05\", \"2024-12-11\"]}', 'year', '2024-12-11 00:44:33', '2024-12-11 00:44:33'),
(30, 'worker', 7, '2024-12-11', 2, '{\"0\": [\"Task for Kiara\", \"Назначена\", \"2024-12-05\", \"2024-12-11\"]}', 'year', '2024-12-11 00:44:34', '2024-12-11 00:44:34'),
(31, 'worker', 7, '2024-12-11', 2, '{\"0\": [\"Task for Kiara\", \"Назначена\", \"2024-12-05\", \"2024-12-11\"]}', 'year', '2024-12-11 00:44:34', '2024-12-11 00:44:34'),
(32, 'project', 44, '2024-12-11', 2, '{\"0\": [\"shampoo\", \"Завершена\", \"2024-12-06\", \"2024-12-10\"], \"1\": [\"cherry cherry lady\", \"Завершена\", \"2024-12-06\", \"2024-12-10\"]}', 'month', '2024-12-11 03:36:28', '2024-12-11 03:36:28'),
(33, 'project', 44, '2024-12-11', 2, '{\"0\": [\"shampoo\", \"Завершена\", \"2024-12-06\", \"2024-12-10\"], \"1\": [\"cherry cherry lady\", \"Завершена\", \"2024-12-06\", \"2024-12-10\"]}', 'month', '2024-12-11 03:36:32', '2024-12-11 03:36:32'),
(34, 'project', 31, '2024-12-11', 2, '{\"0\": [\"tutty-frutty\", \"Завершена\", \"2024-11-01\", \"2024-12-08\"]}', 'year', '2024-12-11 03:40:51', '2024-12-11 03:40:51'),
(35, 'project', 33, '2024-12-11', 1, '{\"0\": [\"title\", \"Выполняется\", \"2024-12-03\", \"2024-12-08\"], \"1\": [\"1234\", \"Завершена\", \"2024-12-04\", \"2024-12-08\"]}', 'month', '2024-12-11 03:53:17', '2024-12-11 03:53:17'),
(36, 'project', 33, '2024-12-11', 1, '{\"0\": [\"title\", \"Выполняется\", \"2024-12-03\", \"2024-12-08\"], \"1\": [\"1234\", \"Завершена\", \"2024-12-04\", \"2024-12-08\"]}', 'year', '2024-12-11 03:53:32', '2024-12-11 03:53:32'),
(37, 'project', 31, '2024-12-11', 1, '{\"0\": [\"tutty-frutty\", \"Завершена\", \"2024-11-01\", \"2024-12-08\"]}', 'year', '2024-12-11 03:54:20', '2024-12-11 03:54:20'),
(38, 'project', 31, '2024-12-11', 1, '{\"0\": [\"tutty-frutty\", \"Завершена\", \"2024-11-01\", \"2024-12-08\"]}', 'year', '2024-12-11 03:55:17', '2024-12-11 03:55:17'),
(39, 'project', 31, '2024-12-11', 1, '{\"0\": [\"tutty-frutty\", \"Завершена\", \"2024-11-01\", \"2024-12-08\"]}', 'year', '2024-12-11 03:56:35', '2024-12-11 03:56:35'),
(40, 'project', 33, '2024-12-11', 1, '{\"0\": [\"title\", \"Выполняется\", \"2024-12-03\", \"2024-12-08\"], \"1\": [\"1234\", \"Завершена\", \"2024-12-04\", \"2024-12-08\"]}', 'month', '2024-12-11 04:08:20', '2024-12-11 04:08:20'),
(41, 'worker', 10, '2024-12-11', 10, '{\"0\": [\"title\", \"Выполняется\", \"2024-12-03\", \"2024-12-08\"], \"1\": [\"1234\", \"Завершена\", \"2024-12-04\", \"2024-12-08\"], \"2\": [\"27\", \"Назначена\", \"2024-12-06\", \"2024-12-08\"], \"3\": [\"for shampun`\", \"Назначена\", \"2024-12-05\", \"2024-12-12\"], \"4\": [\"secon for shampoo\", \"Назначена\", \"2024-12-06\", \"2024-12-12\"], \"5\": [\"shampoo\", \"Завершена\", \"2024-12-06\", \"2024-12-10\"], \"6\": [\"cherry cherry lady\", \"Завершена\", \"2024-12-06\", \"2024-12-10\"]}', 'month', '2024-12-11 04:24:07', '2024-12-11 04:24:07'),
(42, 'worker', 10, '2024-12-11', 10, '{\"0\": [\"title\", \"Выполняется\", \"2024-12-03\", \"2024-12-08\"], \"1\": [\"1234\", \"Завершена\", \"2024-12-04\", \"2024-12-08\"], \"2\": [\"27\", \"Назначена\", \"2024-12-06\", \"2024-12-08\"], \"3\": [\"for shampun`\", \"Назначена\", \"2024-12-05\", \"2024-12-12\"], \"4\": [\"secon for shampoo\", \"Назначена\", \"2024-12-06\", \"2024-12-12\"], \"5\": [\"shampoo\", \"Завершена\", \"2024-12-06\", \"2024-12-10\"], \"6\": [\"cherry cherry lady\", \"Завершена\", \"2024-12-06\", \"2024-12-10\"]}', 'month', '2024-12-11 04:25:54', '2024-12-11 04:25:54'),
(43, 'project', 31, '2024-12-12', 2, '{\"0\": [\"tutty-frutty\", \"Завершена\", \"2024-11-01\", \"2024-12-08\"]}', 'year', '2024-12-12 04:37:17', '2024-12-12 04:37:17'),
(44, 'worker', 7, '2024-12-12', 2, '{\"0\": [\"Task for Kiara\", \"Назначена\", \"2024-12-05\", \"2024-12-11\"]}', 'year', '2024-12-12 04:38:13', '2024-12-12 04:38:13');

-- --------------------------------------------------------

--
-- Структура таблицы `tasks`
--

CREATE TABLE `tasks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `project_id` bigint(20) UNSIGNED NOT NULL,
  `manager_id` int(11) DEFAULT NULL,
  `started_at` date NOT NULL,
  `finished_at` date NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `priority` enum('Низкий','Высокий','Средний') COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('Назначена','Выполняется','Завершена') COLLATE utf8mb4_unicode_ci NOT NULL,
  `comments` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `tasks`
--

INSERT INTO `tasks` (`id`, `title`, `description`, `project_id`, `manager_id`, `started_at`, `finished_at`, `user_id`, `priority`, `status`, `comments`, `created_at`, `updated_at`) VALUES
(28, 't#1238', 'desc', 31, 1, '2024-12-21', '2024-12-22', 10, 'Низкий', 'Завершена', '{\"2024-12-07 22:36:00\": \"100%\", \"2024-12-08 15:13:28\": \"today is 08 Dec 2024\", \"2024-12-08 15:16:00\": \"try #14\", \"2024-12-08 15:16:24\": \"1\", \"2024-12-10 00:41:13\": \"new comm\"}', '2024-12-05 08:22:37', '2024-12-10 11:25:39'),
(29, 'title #123', 'description', 31, 1, '2024-12-26', '2024-12-21', 10, 'Высокий', 'Завершена', '{\"2024-12-07 22:20:26\": \"ret\", \"2024-12-07 22:21:04\": \"nkn\", \"2024-12-07 22:30:11\": \"ebat`\", \"2024-12-07 22:33:33\": \"im tired\", \"2024-12-07 22:34:44\": \"really?\", \"2024-12-07 22:35:46\": \"really..\"}', '2024-12-05 09:30:20', '2024-12-12 04:41:23'),
(30, 'parovoz', 'desc', 31, 1, '2024-12-21', '2024-12-08', 10, 'Высокий', 'Завершена', '{\"2024-12-07 21:42:16\": \"one_comm \\\"paravoz\\\"\", \"2024-12-07 22:10:38\": \"2\", \"2024-12-07 22:22:02\": \"3\", \"2024-12-07 22:22:27\": \"4\", \"2024-12-07 22:23:17\": \"5\"}', NULL, '2024-12-08 14:45:25'),
(31, 'tutty-frutty', 'desc', 31, 1, '2024-11-01', '2024-12-08', 10, 'Высокий', 'Завершена', '{\"2024-12-07 22:12:09\": \"first \\\"tutty-frutty\", \"2024-12-07 22:12:23\": \"first \\\"tutty-frutty\", \"2024-12-07 22:13:22\": \"first \\\"tutty-frutty3\\\"\"}', NULL, '2024-12-08 14:45:29'),
(32, 'title', '1234', 32, 1, '2024-12-20', '2024-12-08', 10, 'Высокий', 'Завершена', '{\"2024-12-07 22:24:59\": \"new\", \"2024-12-07 22:25:16\": \"new\"}', '2024-12-05 10:07:44', '2024-12-08 14:45:32'),
(33, 'new task #12', 'desc', 31, 1, '2024-12-20', '2024-12-22', 10, 'Средний', 'Завершена', '{\"2024-12-07 22:25:41\": \"new\"}', '2024-12-05 10:08:40', '2024-12-10 11:15:38'),
(34, 'Black Star Mafia <3', 'How much ?', 31, 1, '2024-12-20', '2024-12-28', 10, 'Низкий', 'Завершена', '{\"2024-12-07 22:26:36\": \"1\"}', '2024-12-05 10:12:39', '2024-12-12 04:40:13'),
(35, 'title #11', 'desc', 31, 1, '2024-12-21', '2024-12-24', 7, 'Низкий', 'Выполняется', NULL, '2024-12-05 10:26:53', '2024-12-05 10:50:22'),
(36, 'create #34', 'desc', 32, 1, '2024-12-20', '2024-12-25', 3, 'Низкий', 'Выполняется', NULL, '2024-12-05 10:50:50', '2024-12-05 10:50:50'),
(37, 'title #12345678909066', 'esc', 31, 1, '2024-12-27', '2024-12-12', 10, 'Низкий', 'Завершена', '{\"2024-12-07 22:28:13\": \"f\", \"2024-12-10 16:58:34\": \"f\", \"2024-12-10 16:58:36\": \"f\", \"2024-12-10 16:58:39\": \"f\"}', '2024-12-05 13:37:00', '2024-12-12 04:42:12'),
(38, 'roro', 'roro', 31, 1, '2024-12-20', '2024-12-29', 10, 'Низкий', 'Выполняется', '{\"2024-12-07 22:58:43\": \"first \\\"roro\\\"\", \"2024-12-12 12:42:51\": \"cbgb\"}', '2024-12-05 13:40:36', '2024-12-12 04:42:51'),
(39, 'toto', 'roro', 31, 1, '2024-12-21', '2024-12-27', 10, 'Высокий', 'Выполняется', '{\"2024-12-07 23:00:46\": \"at home\", \"2024-12-07 23:01:58\": \"qwertyuio;lkjhbgvcxvbnmk,loiuytgfvghbjklndfhbvnkl sfmbnkitrlmv msrjkelfmtrsnskjlgvmefnbkls;er/mnvlg;blsrm/nlk;m/bv ldrkfnlmv fjb mnrsikl;mjrieofkw\", \"2024-12-07 23:03:10\": \"Каждый из нас понимает очевидную вещь: глубокий уровень погружения напрямую зависит от инновационных методов управления процессами.\"}', '2024-12-05 13:41:22', '2024-12-08 13:42:34'),
(40, 'ete', 'ete', 32, 1, '2024-12-19', '2024-12-23', 3, 'Средний', 'Выполняется', NULL, '2024-12-05 13:42:18', '2024-12-05 13:42:18'),
(41, 'test test IDK', 'i dont know', 31, 1, '2024-12-27', '2024-12-29', 10, 'Низкий', 'Выполняется', '{\"2024-12-07 23:06:23\": \"try\", \"2024-12-10 16:56:43\": \"try comm with filter\", \"2024-12-10 16:57:36\": \"try #2 filter\", \"2024-12-10 16:57:51\": \"more\", \"2024-12-10 16:57:59\": \"or\", \"2024-12-10 16:58:03\": \"or\"}', '2024-12-05 13:44:13', '2024-12-10 08:58:03'),
(42, 'title', 'desc', 33, 1, '2024-12-03', '2024-12-08', 10, 'Высокий', 'Выполняется', NULL, '2024-12-08 14:55:48', '2024-12-08 14:56:47'),
(43, '1234', 'description', 33, 1, '2024-12-04', '2024-12-08', 10, 'Средний', 'Завершена', NULL, '2024-12-08 14:56:10', '2024-12-10 11:17:28'),
(44, '27', 'club', 33, 1, '2024-12-06', '2024-12-08', 10, 'Низкий', 'Назначена', NULL, '2024-12-08 14:56:32', '2024-12-08 14:59:42'),
(47, '123', '123', 31, 3, '2024-12-21', '2024-12-23', 7, 'Низкий', 'Назначена', NULL, '2024-12-09 07:36:04', '2024-12-09 07:36:04'),
(48, '456', '456', 31, 3, '2024-12-22', '2024-12-25', 7, 'Низкий', 'Назначена', NULL, '2024-12-09 07:37:56', '2024-12-09 07:37:56'),
(49, '789', '789', 31, 3, '2024-12-22', '2024-12-25', 7, 'Высокий', 'Назначена', NULL, '2024-12-09 07:38:39', '2024-12-09 07:38:39'),
(51, 'Task for Kiara', 'desc', 35, 1, '2024-12-05', '2024-12-11', 7, 'Высокий', 'Назначена', NULL, '2024-12-09 16:12:43', '2024-12-09 16:12:43'),
(52, 'nikogo ne budet v dome', 'krome sumerek', 32, 1, '2024-12-18', '2024-12-21', 10, 'Высокий', 'Завершена', NULL, '2024-12-09 16:37:40', '2024-12-12 04:40:44'),
(53, 'for shampun`', 'desc', 44, 1, '2024-12-05', '2024-12-12', 10, 'Высокий', 'Назначена', NULL, '2024-12-10 08:30:42', '2024-12-10 08:30:42'),
(54, 'secon for shampoo', 'desc', 44, 1, '2024-12-06', '2024-12-12', 10, 'Высокий', 'Назначена', NULL, '2024-12-10 08:31:11', '2024-12-10 08:31:11'),
(55, 'shampoo', 'desc', 44, 1, '2024-12-06', '2024-12-10', 10, 'Высокий', 'Завершена', NULL, '2024-12-10 08:31:46', '2024-12-10 08:46:31'),
(56, 'cherry cherry lady', 'emo', 44, 1, '2024-12-06', '2024-12-10', 10, 'Высокий', 'Завершена', NULL, '2024-12-10 08:32:35', '2024-12-10 08:52:29');

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
(2, 'rori', 'rori@mail.ru', NULL, 'admin', '$2y$10$kPrpnpHaJj7of/Jc1.gHEO5QzkLQT0/rozZoac6DEZ.Y0jFl67yA6', NULL, '2024-10-27 10:06:36', '2024-10-27 10:06:36', '0'),
(3, 'Ulyana', 'Ulyana@mail.ru', NULL, 'worker', '$2y$10$jowmdvufAzf8h/5iuOEo/O1sXIJxju96cIHdypn3igz5q68NSIIgW', NULL, '2024-10-27 10:32:33', '2024-10-27 10:32:33', '0'),
(7, 'kiara', 'kiara@mail.ru', NULL, 'worker', '$2y$10$Vvy6zjenCuS0.F8j5Ovu4O9RgF8xFt7wOLrbEFmkHBi0NzXlGhDtO', NULL, '2024-11-23 10:53:25', '2024-11-23 10:53:25', '0'),
(10, 'shastoon', 'shastoon@label.com', NULL, 'worker', '$2y$10$l2gx6TNjLbeYd6rkpOIcYO.tpickqOSDlgNEG3u5qjuO5aXnUYpsy', NULL, '2024-11-18 13:52:59', '2024-11-18 13:52:59', '0'),
(12, 'sergey', 'sergey@mail.ru', NULL, 'worker', '$2y$10$3Uaw.H0r3g99Lz8KtpGoVeNtPdRqVZXEaRQ3VmmNCqkr9/5iCq7qO', NULL, '2024-11-23 12:46:19', '2024-11-23 12:46:19', '0'),
(13, 'chulpan88', 'chulpan@mail.ru', NULL, 'worker', '$2y$10$TMEV/04ET7c37Ji/jMlVpuM0NUgtemqQIfXzNWt1QX0mIuhGbyECG', NULL, '2024-12-09 12:27:34', '2024-12-09 12:27:34', '0'),
(15, 'tretyakov', 'tretyakov@mail.ru', NULL, 'worker', '$2y$10$8ES631bfQ2.bfPkJpMegqOmzekfiRJWO2CQwSAi1wISD5QK5MxraW', NULL, '2024-12-09 12:32:39', '2024-12-09 12:32:39', '0'),
(16, 'tretyakova', 'tretyakova@mail.ru', NULL, 'worker', '$2y$10$YwaL18MC/1ZJtmJ7HCCqs.roboC/yCrx0DjATzNfxiJScsD5auqKq', NULL, '2024-12-09 12:36:18', '2024-12-09 12:36:18', '0'),
(17, 'popoi_42', 'popoi_42', NULL, 'worker', '$2y$10$ztu6ldzkCBGsoRNPJ2eP1.lDscqrIFaSHZGT4MIa8EsHYM.hxeDsK', NULL, '2024-12-09 12:37:02', '2024-12-09 12:37:02', '0'),
(18, 'bad_boy_loo', 'bad_boy_loo@mail.ru', NULL, 'worker', '$2y$10$StW9jWbppmGx/alxQMowM.nE.EdAkO5gG.DXi6IKkkw5LvgtVTyd6', NULL, '2024-12-09 12:44:23', '2024-12-09 12:44:23', '0'),
(19, 'jack_harlow', 'jack_harlow@mail.ru', NULL, 'worker', '$2y$10$vT2JoV6qzMzcHKOTS1CdyuMVU9Tv9zhJGNR/9Po4XVXE5HI1oQN8.', NULL, '2024-12-09 13:05:41', '2024-12-09 13:05:41', '0'),
(20, 'maroccoco', 'maroccoco', NULL, 'worker', '$2y$10$WxrRHBNIKJ/0qZMwYCT/c.Gji27aDxiL9ZwdjHTNvWhh1gL2vtqom', NULL, '2024-12-09 13:33:32', '2024-12-09 13:33:32', '0'),
(21, 'jimmyjim', 'jimmyjim@mail.ru', NULL, 'worker', '$2y$10$ZktquCExdjUYsuWNSjlkiegGI2a9VT5AAH6KZraRxdqZn16VlX7.e', NULL, '2024-12-09 13:35:41', '2024-12-09 13:35:41', '0'),
(22, 'qqq', 'qqq@qqq.q', NULL, 'worker', '$2y$10$Lm55D19T3YAUogaYQAG9ne9YrgLGsbyFBCYRWmC04Hn2AUhwwm3J.', NULL, '2024-12-12 04:33:57', '2024-12-12 04:33:57', '0');

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
  ADD KEY `user_id` (`user_id`);

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT для таблицы `reports`
--
ALTER TABLE `reports`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT для таблицы `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

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
  ADD CONSTRAINT `reports_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
