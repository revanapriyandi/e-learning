-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 21 Jul 2020 pada 16.37
-- Versi server: 5.7.24
-- Versi PHP: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `datasiswa`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `absen`
--

CREATE TABLE `absen` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `semester_id` bigint(20) UNSIGNED NOT NULL,
  `time_in` time NOT NULL,
  `kelas_id` bigint(20) UNSIGNED DEFAULT NULL,
  `keterangan` enum('1','2','3','4') COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `absen_pending`
--

CREATE TABLE `absen_pending` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `semester_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `time_in` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kelas_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `konfirm` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `absen_pending`
--

INSERT INTO `absen_pending` (`id`, `user_id`, `semester_id`, `time_in`, `kelas_id`, `keterangan`, `note`, `konfirm`, `created_at`, `updated_at`) VALUES
(2, '4', '1', '08:35:54', '1', '1', NULL, 0, '2020-07-23 01:35:54', '2020-07-23 01:35:54');

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelas`
--

CREATE TABLE `kelas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_kelas` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `walikelas` bigint(20) UNSIGNED DEFAULT NULL,
  `ketuakelas` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kelas`
--

INSERT INTO `kelas` (`id`, `nama_kelas`, `walikelas`, `ketuakelas`, `created_at`, `updated_at`) VALUES
(1, 'XII RPL 1', 1, 4, '2020-07-15 18:38:10', '2020-07-15 18:38:10');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mapel`
--

CREATE TABLE `mapel` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pengajar` bigint(20) UNSIGNED DEFAULT NULL,
  `kelas_id` bigint(20) UNSIGNED DEFAULT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `mapel`
--

INSERT INTO `mapel` (`id`, `nama`, `pengajar`, `kelas_id`, `deskripsi`, `created_at`, `updated_at`) VALUES
(1, 'Bahasa Indonesia', 1, 1, 'Bahasa Indonesia kelas XII', NULL, NULL),
(2, 'Pemograman Web Dasar dan Perangkat Bergerak', 1, 1, 'Belajar Pemograman Web Dasar dengan PHP', '2020-07-15 23:08:04', '2020-07-15 23:24:31');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2020_07_12_181631_create_kelas_table', 1),
(5, '2020_07_12_181945_create_semesters_table', 1),
(6, '2020_07_12_182215_create_absens_table', 1),
(7, '2020_07_12_221001_add_kelas_id_on_users', 1),
(8, '2020_07_13_214808_add_kelas_id_to_absen_table', 1),
(9, '2020_07_15_054404_create_moduls_table', 1),
(10, '2020_07_16_002200_create_mapels_table', 1),
(12, '2020_07_17_001136_create_modul_dowloader_table', 2),
(14, '2020_07_17_031942_create_absen_pendings_table', 1),
(15, '2020_07_18_002340_create_quizzes_table', 3),
(16, '2020_07_18_003239_create_quiz_pilgandas_table', 3),
(17, '2020_07_18_003303_create_quiz_essays_table', 3),
(18, '2020_07_18_003930_add_table_siswa_sudah_mengerjakan', 3),
(19, '2020_07_18_005723_create_jawaban_table', 3),
(20, '2020_07_18_010031_create_nilais_table', 3),
(21, '2020_07_18_010240_create_nilai_essays_table', 3),
(22, '2020_07_18_071831_create_tugas_siswas_table', 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `modul`
--

CREATE TABLE `modul` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `kategori` enum('tugas','modul') COLLATE utf8mb4_unicode_ci NOT NULL,
  `kelas_id` bigint(20) UNSIGNED DEFAULT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `links` text COLLATE utf8mb4_unicode_ci,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `modul`
--

INSERT INTO `modul` (`id`, `judul`, `user_id`, `deskripsi`, `kategori`, `kelas_id`, `file`, `links`, `status`, `created_at`, `updated_at`) VALUES
(10, 'Database: Query Builder', 1, '<h2 id=\"introduction\" style=\"font-family: scandia-web, sans-serif; font-size: 1.75em; color: rgb(9, 9, 16);\"><a href=\"https://laravel.com/docs/7.x/queries#introduction\" style=\"background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; position: relative; transition-duration: 0.3s; transition-property: all; color: rgb(9, 9, 16);\">Introduction</a></h2><p style=\"font-size: 16px; line-height: 1.8em; color: rgba(9, 9, 16, 0.7); margin-bottom: 2em; font-family: scandia-web, sans-serif;\">Laravel\'s database query builder provides a convenient, fluent interface to creating and running database queries. It can be used to perform most database operations in your application and works on all supported database systems.</p><p style=\"font-size: 16px; line-height: 1.8em; color: rgba(9, 9, 16, 0.7); margin-bottom: 2em; font-family: scandia-web, sans-serif;\">The Laravel query builder uses PDO parameter binding to protect your application against SQL injection attacks. There is no need to clean strings being passed as bindings.</p><blockquote style=\"color: rgb(9, 9, 16); font-family: scandia-web, sans-serif; font-size: 16px;\"><div class=\"callout\" style=\"padding: 1.875em 1em; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; box-shadow: rgba(9, 9, 16, 0.2) 0px 20px 30px -16px; margin-bottom: 2.5em; margin-left: 0px; margin-right: 0px; max-width: 43.75em; display: flex; -webkit-box-align: center; align-items: center;\"><div class=\"icon red\" style=\"position: relative; width: 4.5em; height: 4.5em; margin: 0px 1.5em 0px 0px; background: rgb(255, 45, 32);\"><img src=\"https://laravel.com/img/callouts/exclamation.min.svg\" style=\"border: 0px; max-width: 100%; display: block; position: absolute; top: 36px; left: 36px; transform: translate(-50%, -50%); opacity: 0.7; user-select: none;\"></div><p class=\"content\" style=\"font-size: 1rem; line-height: 1.8em; color: rgba(9, 9, 16, 0.7); margin-bottom: 0px; quotes: &quot;“&quot; &quot;”&quot; &quot;‘&quot; &quot;’&quot;; -webkit-box-flex: 1; flex: 1 1 0%;\">PDO does not support binding column names. Therefore, you should never allow user input to dictate the column names referenced by your queries, including \"order by\" columns, etc. If you must allow the user to select certain columns to query against, always validate the column names against a white-list of allowed columns.</p></div></blockquote><p style=\"font-size: 16px; line-height: 1.8em; color: rgba(9, 9, 16, 0.7); margin-bottom: 2em; font-family: scandia-web, sans-serif;\"><a name=\"retrieving-results\" style=\"background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; position: relative; text-decoration-line: underline; transition-duration: 0.3s; transition-property: all; color: rgb(255, 45, 32); display: block; visibility: hidden; top: -45px;\"></a></p><h2 id=\"retrieving-results\" style=\"font-family: scandia-web, sans-serif; font-size: 1.75em; color: rgb(9, 9, 16);\"><a href=\"https://laravel.com/docs/7.x/queries#retrieving-results\" style=\"background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; position: relative; transition-duration: 0.3s; transition-property: all; color: rgb(9, 9, 16);\">Retrieving Results</a></h2><h4 style=\"font-family: scandia-web, sans-serif; font-size: 16px; color: rgb(9, 9, 16);\">Retrieving All Rows From A Table</h4><p style=\"font-size: 16px; line-height: 1.8em; color: rgba(9, 9, 16, 0.7); margin-bottom: 2em; font-family: scandia-web, sans-serif;\">You may use the&nbsp;<code class=\" language-php\" style=\"font-family: source-code-pro, monospace; font-size: 0.8rem; line-height: 1.9; color: rgb(202, 71, 63); background: rgb(251, 251, 253); padding: 0px 0.25em; white-space: pre; word-spacing: normal; word-break: normal; overflow-wrap: normal; tab-size: 4; hyphens: none; box-shadow: rgba(0, 0, 0, 0.075) 0px 1px 1px;\">table</code>&nbsp;method on the&nbsp;<code class=\" language-php\" style=\"font-family: source-code-pro, monospace; font-size: 0.8rem; line-height: 1.9; color: rgb(202, 71, 63); background: rgb(251, 251, 253); padding: 0px 0.25em; white-space: pre; word-spacing: normal; word-break: normal; overflow-wrap: normal; tab-size: 4; hyphens: none; box-shadow: rgba(0, 0, 0, 0.075) 0px 1px 1px;\"><span class=\"token constant\" style=\"color: rgb(152, 29, 21);\">DB</span></code>&nbsp;facade to begin a query. The&nbsp;<code class=\" language-php\" style=\"font-family: source-code-pro, monospace; font-size: 0.8rem; line-height: 1.9; color: rgb(202, 71, 63); background: rgb(251, 251, 253); padding: 0px 0.25em; white-space: pre; word-spacing: normal; word-break: normal; overflow-wrap: normal; tab-size: 4; hyphens: none; box-shadow: rgba(0, 0, 0, 0.075) 0px 1px 1px;\">table</code>&nbsp;method returns a fluent query builder instance for the given table, allowing you to chain more constraints onto the query and then finally get the results using the&nbsp;<code class=\" language-php\" style=\"font-family: source-code-pro, monospace; font-size: 0.8rem; line-height: 1.9; color: rgb(202, 71, 63); background: rgb(251, 251, 253); padding: 0px 0.25em; white-space: pre; word-spacing: normal; word-break: normal; overflow-wrap: normal; tab-size: 4; hyphens: none; box-shadow: rgba(0, 0, 0, 0.075) 0px 1px 1px;\">get</code>&nbsp;method:</p><pre class=\" language-php\" style=\"font-family: monospace, monospace; font-size: 16px; color: rgb(202, 71, 63); background: rgb(251, 251, 253); word-break: normal; overflow-wrap: normal; tab-size: 4; hyphens: none; padding: 1em; margin-top: 0.5em; margin-bottom: 2em; max-width: 100%; box-shadow: rgba(0, 0, 0, 0.075) 0px 1px 1px;\"><code class=\" language-php\" style=\"font-family: source-code-pro, monospace; font-size: 0.8rem; line-height: 1.9; color: rgb(9, 9, 16); background: none; word-spacing: normal; overflow-wrap: normal; tab-size: 4; hyphens: none;\"><span class=\"token php language-php\"><span class=\"token delimiter important\" style=\"color: rgb(7, 130, 177); font-weight: 700;\">&lt;?php</span>\r\n\r\n<span class=\"token keyword\" style=\"color: rgb(5, 84, 114);\">namespace</span> <span class=\"token package\">App<span class=\"token punctuation\">\\</span>Http<span class=\"token punctuation\">\\</span>Controllers</span><span class=\"token punctuation\">;</span>\r\n\r\n<span class=\"token keyword\" style=\"color: rgb(5, 84, 114);\">use</span> <span class=\"token package\">App<span class=\"token punctuation\">\\</span>Http<span class=\"token punctuation\">\\</span>Controllers<span class=\"token punctuation\">\\</span>Controller</span><span class=\"token punctuation\">;</span>\r\n<span class=\"token keyword\" style=\"color: rgb(5, 84, 114);\">use</span> <span class=\"token package\">Illuminate<span class=\"token punctuation\">\\</span>Support<span class=\"token punctuation\">\\</span>Facades<span class=\"token punctuation\">\\</span>DB</span><span class=\"token punctuation\">;</span>\r\n\r\n<span class=\"token keyword\" style=\"color: rgb(5, 84, 114);\">class</span> <span class=\"token class-name\" style=\"color: rgb(202, 71, 63);\">UserController</span> <span class=\"token keyword\" style=\"color: rgb(5, 84, 114);\">extends</span> <span class=\"token class-name\" style=\"color: rgb(202, 71, 63);\">Controller</span>\r\n<span class=\"token punctuation\">{</span>\r\n    <span class=\"token comment\" style=\"color: rgb(147, 147, 158);\">/**\r\n     * Show a list of all of the application\'s users.\r\n     *\r\n     * @return Response\r\n     */</span>\r\n    <span class=\"token keyword\" style=\"color: rgb(5, 84, 114);\">public</span> <span class=\"token keyword\" style=\"color: rgb(5, 84, 114);\">function</span> <span class=\"token function\" style=\"color: rgb(202, 71, 63);\">index</span><span class=\"token punctuation\">(</span><span class=\"token punctuation\">)</span>\r\n    <span class=\"token punctuation\">{</span>\r\n        <span class=\"token variable\" style=\"color: rgb(7, 130, 177);\">$users</span> <span class=\"token operator\">=</span> <span class=\"token constant\" style=\"color: rgb(152, 29, 21);\">DB</span><span class=\"token punctuation\">:</span><span class=\"token punctuation\">:</span><span class=\"token function\" style=\"color: rgb(202, 71, 63);\">table</span><span class=\"token punctuation\">(</span><span class=\"token single-quoted-string string\" style=\"color: rgb(102, 153, 0);\">\'users\'</span><span class=\"token punctuation\">)</span><span class=\"token operator\">-</span><span class=\"token operator\">&gt;</span><span class=\"token function\" style=\"color: rgb(202, 71, 63);\">get</span><span class=\"token punctuation\">(</span><span class=\"token punctuation\">)</span><span class=\"token punctuation\">;</span>\r\n\r\n        <span class=\"token keyword\" style=\"color: rgb(5, 84, 114);\">return</span> <span class=\"token function\" style=\"color: rgb(202, 71, 63);\">view</span><span class=\"token punctuation\">(</span><span class=\"token single-quoted-string string\" style=\"color: rgb(102, 153, 0);\">\'user.index\'</span><span class=\"token punctuation\">,</span> <span class=\"token punctuation\">[</span><span class=\"token single-quoted-string string\" style=\"color: rgb(102, 153, 0);\">\'users\'</span> <span class=\"token operator\">=</span><span class=\"token operator\">&gt;</span> <span class=\"token variable\" style=\"color: rgb(7, 130, 177);\">$users</span><span class=\"token punctuation\">]</span><span class=\"token punctuation\">)</span><span class=\"token punctuation\">;</span>\r\n    <span class=\"token punctuation\">}</span>\r\n<span class=\"token punctuation\">}</span></span></code></pre><p style=\"font-size: 16px; line-height: 1.8em; color: rgba(9, 9, 16, 0.7); margin-bottom: 2em; font-family: scandia-web, sans-serif;\">The&nbsp;<code class=\" language-php\" style=\"font-family: source-code-pro, monospace; font-size: 0.8rem; line-height: 1.9; color: rgb(202, 71, 63); background: rgb(251, 251, 253); padding: 0px 0.25em; white-space: pre; word-spacing: normal; word-break: normal; overflow-wrap: normal; tab-size: 4; hyphens: none; box-shadow: rgba(0, 0, 0, 0.075) 0px 1px 1px;\">get</code>&nbsp;method returns an&nbsp;<code class=\" language-php\" style=\"font-family: source-code-pro, monospace; font-size: 0.8rem; line-height: 1.9; color: rgb(202, 71, 63); background: rgb(251, 251, 253); padding: 0px 0.25em; white-space: pre; word-spacing: normal; word-break: normal; overflow-wrap: normal; tab-size: 4; hyphens: none; box-shadow: rgba(0, 0, 0, 0.075) 0px 1px 1px;\">Illuminate\\<span class=\"token package\">Support<span class=\"token punctuation\" style=\"color: rgb(9, 9, 16);\">\\</span>Collection</span></code>&nbsp;containing the results where each result is an instance of the PHP&nbsp;<code class=\" language-php\" style=\"font-family: source-code-pro, monospace; font-size: 0.8rem; line-height: 1.9; color: rgb(202, 71, 63); background: rgb(251, 251, 253); padding: 0px 0.25em; white-space: pre; word-spacing: normal; word-break: normal; overflow-wrap: normal; tab-size: 4; hyphens: none; box-shadow: rgba(0, 0, 0, 0.075) 0px 1px 1px;\">stdClass</code>&nbsp;object. You may access each column\'s value by accessing the column as a property of the object:</p><pre class=\" language-php\" style=\"font-family: monospace, monospace; font-size: 16px; color: rgb(202, 71, 63); background: rgb(251, 251, 253); word-break: normal; overflow-wrap: normal; tab-size: 4; hyphens: none; padding: 1em; margin-top: 0.5em; margin-bottom: 2em; max-width: 100%; box-shadow: rgba(0, 0, 0, 0.075) 0px 1px 1px;\"><code class=\" language-php\" style=\"font-family: source-code-pro, monospace; font-size: 0.8rem; line-height: 1.9; color: rgb(9, 9, 16); background: none; word-spacing: normal; overflow-wrap: normal; tab-size: 4; hyphens: none;\"><span class=\"token keyword\" style=\"color: rgb(5, 84, 114);\">foreach</span> <span class=\"token punctuation\">(</span><span class=\"token variable\" style=\"color: rgb(7, 130, 177);\">$users</span> <span class=\"token keyword\" style=\"color: rgb(5, 84, 114);\">as</span> <span class=\"token variable\" style=\"color: rgb(7, 130, 177);\">$user</span><span class=\"token punctuation\">)</span> <span class=\"token punctuation\">{</span>\r\n    <span class=\"token keyword\" style=\"color: rgb(5, 84, 114);\">echo</span> <span class=\"token variable\" style=\"color: rgb(7, 130, 177);\">$user</span><span class=\"token operator\">-</span><span class=\"token operator\">&gt;</span><span class=\"token property\" style=\"color: rgb(152, 29, 21);\">name</span><span class=\"token punctuation\">;</span>\r\n<span class=\"token punctuation\">}</span></code></pre><h4 style=\"font-family: scandia-web, sans-serif; font-size: 16px; color: rgb(9, 9, 16);\">Retrieving A Single Row / Column From A Table</h4><p style=\"font-size: 16px; line-height: 1.8em; color: rgba(9, 9, 16, 0.7); margin-bottom: 2em; font-family: scandia-web, sans-serif;\">If you just need to retrieve a single row from the database table, you may use the&nbsp;<code class=\" language-php\" style=\"font-family: source-code-pro, monospace; font-size: 0.8rem; line-height: 1.9; color: rgb(202, 71, 63); background: rgb(251, 251, 253); padding: 0px 0.25em; white-space: pre; word-spacing: normal; word-break: normal; overflow-wrap: normal; tab-size: 4; hyphens: none; box-shadow: rgba(0, 0, 0, 0.075) 0px 1px 1px;\">first</code>&nbsp;method. This method will return a single&nbsp;<code class=\" language-php\" style=\"font-family: source-code-pro, monospace; font-size: 0.8rem; line-height: 1.9; color: rgb(202, 71, 63); background: rgb(251, 251, 253); padding: 0px 0.25em; white-space: pre; word-spacing: normal; word-break: normal; overflow-wrap: normal; tab-size: 4; hyphens: none; box-shadow: rgba(0, 0, 0, 0.075) 0px 1px 1px;\">stdClass</code>&nbsp;object:</p><pre class=\" language-php\" style=\"font-family: monospace, monospace; font-size: 16px; color: rgb(202, 71, 63); background: rgb(251, 251, 253); word-break: normal; overflow-wrap: normal; tab-size: 4; hyphens: none; padding: 1em; margin-top: 0.5em; margin-bottom: 2em; max-width: 100%; box-shadow: rgba(0, 0, 0, 0.075) 0px 1px 1px;\"><code class=\" language-php\" style=\"font-family: source-code-pro, monospace; font-size: 0.8rem; line-height: 1.9; color: rgb(9, 9, 16); background: none; word-spacing: normal; overflow-wrap: normal; tab-size: 4; hyphens: none;\"><span class=\"token variable\" style=\"color: rgb(7, 130, 177);\">$user</span> <span class=\"token operator\">=</span> <span class=\"token constant\" style=\"color: rgb(152, 29, 21);\">DB</span><span class=\"token punctuation\">:</span><span class=\"token punctuation\">:</span><span class=\"token function\" style=\"color: rgb(202, 71, 63);\">table</span><span class=\"token punctuation\">(</span><span class=\"token single-quoted-string string\" style=\"color: rgb(102, 153, 0);\">\'users\'</span><span class=\"token punctuation\">)</span><span class=\"token operator\">-</span><span class=\"token operator\">&gt;</span><span class=\"token function\" style=\"color: rgb(202, 71, 63);\">where</span><span class=\"token punctuation\">(</span><span class=\"token single-quoted-string string\" style=\"color: rgb(102, 153, 0);\">\'name\'</span><span class=\"token punctuation\">,</span> <span class=\"token single-quoted-string string\" style=\"color: rgb(102, 153, 0);\">\'John\'</span><span class=\"token punctuation\">)</span><span class=\"token operator\">-</span><span class=\"token operator\">&gt;</span><span class=\"token function\" style=\"color: rgb(202, 71, 63);\">first</span><span class=\"token punctuation\">(</span><span class=\"token punctuation\">)</span><span class=\"token punctuation\">;</span>\r\n\r\n<span class=\"token keyword\" style=\"color: rgb(5, 84, 114);\">echo</span> <span class=\"token variable\" style=\"color: rgb(7, 130, 177);\">$user</span><span class=\"token operator\">-</span><span class=\"token operator\">&gt;</span><span class=\"token property\" style=\"color: rgb(152, 29, 21);\">name</span><span class=\"token punctuation\">;</span></code></pre><p style=\"font-size: 16px; line-height: 1.8em; color: rgba(9, 9, 16, 0.7); margin-bottom: 2em; font-family: scandia-web, sans-serif;\">If you don\'t even need an entire row, you may extract a single value from a record using the&nbsp;<code class=\" language-php\" style=\"font-family: source-code-pro, monospace; font-size: 0.8rem; line-height: 1.9; color: rgb(202, 71, 63); background: rgb(251, 251, 253); padding: 0px 0.25em; white-space: pre; word-spacing: normal; word-break: normal; overflow-wrap: normal; tab-size: 4; hyphens: none; box-shadow: rgba(0, 0, 0, 0.075) 0px 1px 1px;\">value</code>&nbsp;method. This method will return the value of the column directly:</p><pre class=\" language-php\" style=\"font-family: monospace, monospace; font-size: 16px; color: rgb(202, 71, 63); background: rgb(251, 251, 253); word-break: normal; overflow-wrap: normal; tab-size: 4; hyphens: none; padding: 1em; margin-top: 0.5em; margin-bottom: 2em; max-width: 100%; box-shadow: rgba(0, 0, 0, 0.075) 0px 1px 1px;\"><code class=\" language-php\" style=\"font-family: source-code-pro, monospace; font-size: 0.8rem; line-height: 1.9; color: rgb(9, 9, 16); background: none; word-spacing: normal; overflow-wrap: normal; tab-size: 4; hyphens: none;\"><span class=\"token variable\" style=\"color: rgb(7, 130, 177);\">$email</span> <span class=\"token operator\">=</span> <span class=\"token constant\" style=\"color: rgb(152, 29, 21);\">DB</span><span class=\"token punctuation\">:</span><span class=\"token punctuation\">:</span><span class=\"token function\" style=\"color: rgb(202, 71, 63);\">table</span><span class=\"token punctuation\">(</span><span class=\"token single-quoted-string string\" style=\"color: rgb(102, 153, 0);\">\'users\'</span><span class=\"token punctuation\">)</span><span class=\"token operator\">-</span><span class=\"token operator\">&gt;</span><span class=\"token function\" style=\"color: rgb(202, 71, 63);\">where</span><span class=\"token punctuation\">(</span><span class=\"token single-quoted-string string\" style=\"color: rgb(102, 153, 0);\">\'name\'</span><span class=\"token punctuation\">,</span> <span class=\"token single-quoted-string string\" style=\"color: rgb(102, 153, 0);\">\'John\'</span><span class=\"token punctuation\">)</span><span class=\"token operator\">-</span><span class=\"token operator\">&gt;</span><span class=\"token function\" style=\"color: rgb(202, 71, 63);\">value</span><span class=\"token punctuation\">(</span><span class=\"token single-quoted-string string\" style=\"color: rgb(102, 153, 0);\">\'email\'</span><span class=\"token punctuation\">)</span><span class=\"token punctuation\">;</span></code></pre><p style=\"font-size: 16px; line-height: 1.8em; color: rgba(9, 9, 16, 0.7); margin-bottom: 2em; font-family: scandia-web, sans-serif;\">To retrieve a single row by its&nbsp;<code class=\" language-php\" style=\"font-family: source-code-pro, monospace; font-size: 0.8rem; line-height: 1.9; color: rgb(202, 71, 63); background: rgb(251, 251, 253); padding: 0px 0.25em; white-space: pre; word-spacing: normal; word-break: normal; overflow-wrap: normal; tab-size: 4; hyphens: none; box-shadow: rgba(0, 0, 0, 0.075) 0px 1px 1px;\">id</code>&nbsp;column value, use the&nbsp;<code class=\" language-php\" style=\"font-family: source-code-pro, monospace; font-size: 0.8rem; line-height: 1.9; color: rgb(202, 71, 63); background: rgb(251, 251, 253); padding: 0px 0.25em; white-space: pre; word-spacing: normal; word-break: normal; overflow-wrap: normal; tab-size: 4; hyphens: none; box-shadow: rgba(0, 0, 0, 0.075) 0px 1px 1px;\">find</code>&nbsp;method:</p><pre class=\" language-php\" style=\"font-family: monospace, monospace; font-size: 16px; color: rgb(202, 71, 63); background: rgb(251, 251, 253); word-break: normal; overflow-wrap: normal; tab-size: 4; hyphens: none; padding: 1em; margin-top: 0.5em; margin-bottom: 2em; max-width: 100%; box-shadow: rgba(0, 0, 0, 0.075) 0px 1px 1px;\"><code class=\" language-php\" style=\"font-family: source-code-pro, monospace; font-size: 0.8rem; line-height: 1.9; color: rgb(9, 9, 16); background: none; word-spacing: normal; overflow-wrap: normal; tab-size: 4; hyphens: none;\"><span class=\"token variable\" style=\"color: rgb(7, 130, 177);\">$user</span> <span class=\"token operator\">=</span> <span class=\"token constant\" style=\"color: rgb(152, 29, 21);\">DB</span><span class=\"token punctuation\">:</span><span class=\"token punctuation\">:</span><span class=\"token function\" style=\"color: rgb(202, 71, 63);\">table</span><span class=\"token punctuation\">(</span><span class=\"token single-quoted-string string\" style=\"color: rgb(102, 153, 0);\">\'users\'</span><span class=\"token punctuation\">)</span><span class=\"token operator\">-</span><span class=\"token operator\">&gt;</span><span class=\"token function\" style=\"color: rgb(202, 71, 63);\">find</span><span class=\"token punctuation\">(</span><span class=\"token number\" style=\"color: rgb(152, 29, 21);\">3</span><span class=\"token punctuation\">)</span><span class=\"token punctuation\">;</span></code></pre>', 'modul', 1, '[\"membuat-web-portofolio_compressed.pdf\"]', NULL, 1, '2020-07-16 19:13:16', '2020-07-16 19:13:16'),
(11, 'Selami. Jalan ketika orang lain tidak', 1, '<p>asdasdas</p>', 'tugas', 1, '[\"Armada - Harusnya Aku (Unofficial Music Video).mp3\"]', '[\"https:\\/\\/www.youtube.com\\/watch?v=flCu9377Rlg&list=RDMMHxIUkj5X194&index=22\"]', 1, '2020-07-18 02:16:30', '2020-07-18 02:16:30'),
(12, 'Selami. Jalan ketika orang lain tidak', 1, '<p>asdasdsad</p>', 'modul', NULL, '[\"1.mp4\"]', NULL, 1, '2020-07-18 02:12:58', '2020-07-18 02:12:58');

-- --------------------------------------------------------

--
-- Struktur dari tabel `modul_has_download`
--

CREATE TABLE `modul_has_download` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `kelas_id` bigint(20) UNSIGNED NOT NULL,
  `modul_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `modul_has_download`
--

INSERT INTO `modul_has_download` (`user_id`, `kelas_id`, `modul_id`, `created_at`, `updated_at`) VALUES
(4, 1, 10, '2020-07-16 19:34:14', '2020-07-16 19:34:14');

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `semester`
--

CREATE TABLE `semester` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun_ajaran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `semester`
--

INSERT INTO `semester` (`id`, `kode`, `tahun_ajaran`, `status`, `created_at`, `updated_at`) VALUES
(1, '1', '2019/2020', 1, NULL, '2020-07-15 22:31:27'),
(2, '2', '2020/2021', 0, '2020-07-15 22:39:41', '2020-07-15 22:39:41');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tugas_siswa`
--

CREATE TABLE `tugas_siswa` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dari` bigint(20) UNSIGNED NOT NULL,
  `to` int(11) NOT NULL,
  `file` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `catatan` text COLLATE utf8mb4_unicode_ci,
  `status` enum('send','read') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tugas_siswa`
--

INSERT INTO `tugas_siswa` (`id`, `judul`, `dari`, `to`, `file`, `catatan`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Tugas B.indo', 4, 1, '[\"http:\\/\\/datasiswa.org\\/storage\\/files\\/4\\/WhatsApp Stickers.zip\"]', '<p>Cuman test doannk</p>', 'read', '2020-07-18 01:28:27', '2020-07-18 02:55:08'),
(2, 'Testing Send Image in Email', 4, 1, '[\"WhatsApp Stickers.zip\"]', '<p>Hanya test doank juga</p>', 'read', '2020-07-18 02:01:09', '2020-07-18 02:48:16');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nis` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telepon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jk` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tempat_lahir` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kelas_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `role` enum('guru','siswa') COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `nis`, `nip`, `nama`, `username`, `email`, `email_verified_at`, `password`, `telepon`, `jk`, `tempat_lahir`, `tgl_lahir`, `avatar`, `kelas_id`, `status`, `role`, `alamat`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, NULL, '17070079025042002', 'Administrator', 'admin', 'admin@gmail.com', '2020-07-15 17:49:39', '$2y$10$6lWetgK9d4JY1SfVilSgw.Gx/HVqN17ayUAPrbzLww0g.js8d13nS', '081261865875', 'L', 'Padang Japang', '2002-04-02', 'http://datasiswa.org/storage/photos/1/pp.jpg', NULL, 1, 'guru', 'Limbanang, Suliki, Kabupaten Lima Puluh Kota, Sumatera Barat\r\n', NULL, NULL, NULL),
(4, '170700790', NULL, 'M. Revan Apriyandi', 'revan', 'revanapriyandi88@gmail.com', '2020-07-15 19:53:03', '$2y$10$rBvYzOJ8z4FMJDsnt7nxUu65215Bl8S.DMrzL0KZ4INO2J/uanyQy', '0812 6186 5875', 'L', 'Padang Japang', '2002-04-25', 'http://datasiswa.org/storage/photos/1/pp.jpg', 1, 1, 'siswa', 'Limbanang, Suliki, Kabupaten Lima Puluh Kota, Sumatera Barat', NULL, '2020-07-15 18:58:17', '2020-07-15 20:54:32'),
(5, '127484', NULL, 'ashdasdsadsad', 'asdasd', 'asdasdas@gmail.com', NULL, '$2y$10$XeOgS0sbQU0Uoeul71uZ8OA6thdX6kxZ7wZL8AWp7OK5okcQ8D5Tq', '0812 6186 5875', 'L', 'asdasd', '1970-01-01', 'http://datasiswa.org/storage/photos/shares/default.jpg', 1, 1, 'siswa', 'asdasd', NULL, '2020-07-18 20:23:11', '2020-07-18 20:23:11'),
(6, '32235325', NULL, 'asdasdasd', 'asdasdasaaa', 'revanapriyandi881@gmail.com', NULL, '$2y$10$6a/GSOCVDCJAeRP/GpbgauSNvicUDyHcg4yfeRM1yew2myOzs.uOi', '322323232323', 'L', 'Padang Japang', '1970-01-01', 'http://datasiswa.org/storage/photos/shares/default.jpg', 1, 1, 'siswa', 'asdadasadasdad', NULL, '2020-07-18 20:24:40', '2020-07-18 20:24:40'),
(7, '1248740124', NULL, 'Rahma Dinda', 'dinda', 'dinda@gmail.com', NULL, '$2y$10$kJwQ1pSFLocdtWcHTLE40OJiq8Rbh4WW2/IiHCz27Xtm.xZQRfhUu', '0812 7505 0254', 'P', NULL, NULL, 'http://datasiswa.org/storage/photos/shares/default.jpg', 1, 0, 'siswa', NULL, NULL, '2020-07-21 16:17:07', '2020-07-21 16:17:07');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `absen`
--
ALTER TABLE `absen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `absen_user_id_foreign` (`user_id`),
  ADD KEY `absen_semester_id_foreign` (`semester_id`),
  ADD KEY `absen_kelas_id_foreign` (`kelas_id`);

--
-- Indeks untuk tabel `absen_pending`
--
ALTER TABLE `absen_pending`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kelas_walikelas_foreign` (`walikelas`),
  ADD KEY `kelas_ketuakelas_foreign` (`ketuakelas`);

--
-- Indeks untuk tabel `mapel`
--
ALTER TABLE `mapel`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mapel_pengajar_foreign` (`pengajar`),
  ADD KEY `mapel_kelas_id_foreign` (`kelas_id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `modul`
--
ALTER TABLE `modul`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modul_user_id_foreign` (`user_id`),
  ADD KEY `modul_kelas_id_foreign` (`kelas_id`);

--
-- Indeks untuk tabel `modul_has_download`
--
ALTER TABLE `modul_has_download`
  ADD KEY `modul_has_download_user_id_foreign` (`user_id`),
  ADD KEY `modul_has_download_kelas_id_foreign` (`kelas_id`),
  ADD KEY `modul_has_download_modul_id_foreign` (`modul_id`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indeks untuk tabel `semester`
--
ALTER TABLE `semester`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tugas_siswa`
--
ALTER TABLE `tugas_siswa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tugas_siswa_user_id_foreign` (`dari`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_kelas_id_foreign` (`kelas_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `absen`
--
ALTER TABLE `absen`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `absen_pending`
--
ALTER TABLE `absen_pending`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `mapel`
--
ALTER TABLE `mapel`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `modul`
--
ALTER TABLE `modul`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `semester`
--
ALTER TABLE `semester`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tugas_siswa`
--
ALTER TABLE `tugas_siswa`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `absen`
--
ALTER TABLE `absen`
  ADD CONSTRAINT `absen_kelas_id_foreign` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `absen_semester_id_foreign` FOREIGN KEY (`semester_id`) REFERENCES `semester` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `absen_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `kelas`
--
ALTER TABLE `kelas`
  ADD CONSTRAINT `kelas_ketuakelas_foreign` FOREIGN KEY (`ketuakelas`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `kelas_walikelas_foreign` FOREIGN KEY (`walikelas`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `mapel`
--
ALTER TABLE `mapel`
  ADD CONSTRAINT `mapel_kelas_id_foreign` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `mapel_pengajar_foreign` FOREIGN KEY (`pengajar`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `modul`
--
ALTER TABLE `modul`
  ADD CONSTRAINT `modul_kelas_id_foreign` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `modul_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `modul_has_download`
--
ALTER TABLE `modul_has_download`
  ADD CONSTRAINT `modul_has_download_kelas_id_foreign` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `modul_has_download_modul_id_foreign` FOREIGN KEY (`modul_id`) REFERENCES `modul` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `modul_has_download_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tugas_siswa`
--
ALTER TABLE `tugas_siswa`
  ADD CONSTRAINT `tugas_siswa_user_id_foreign` FOREIGN KEY (`dari`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_kelas_id_foreign` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
