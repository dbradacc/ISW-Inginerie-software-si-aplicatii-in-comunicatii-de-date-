-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Gazdă: localhost:3306
-- Timp de generare: apr. 26, 2026 la 04:56 AM
-- Versiune server: 10.6.24-MariaDB-cll-lve
-- Versiune PHP: 8.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Bază de date: `proiect`
--

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `Audit_Log`
--

CREATE TABLE `Audit_Log` (
  `ID_Audit` int(11) NOT NULL,
  `ID_User` int(11) NOT NULL,
  `IP` varchar(45) NOT NULL,
  `Actiune` varchar(20) NOT NULL,
  `Entitate` varchar(30) NOT NULL,
  `ID_Ent` int(11) DEFAULT NULL,
  `Info` text DEFAULT NULL,
  `Created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Eliminarea datelor din tabel `Audit_Log`
--

INSERT INTO `Audit_Log` (`ID_Audit`, `ID_User`, `IP`, `Actiune`, `Entitate`, `ID_Ent`, `Info`, `Created_at`) VALUES
(1, 1, '', 'create', 'Studenti', NULL, '{\"nume\":\"Petre\",\"prenume\":\"Cosmin\",\"email\":\"petre@cosmin.ro\",\"telefon\":\"0785635212\",\"an_studiu\":\"2\"}', '2025-05-05 18:57:19'),
(2, 1, '2a02:2f01:f602:8b00:61a1:917b:fc67:1b4e', 'delete', 'Studenti', 7, NULL, '2025-05-05 19:02:21'),
(3, 1, '2a02:2f01:f602:8b00:61a1:917b:fc67:1b4e', 'delete', 'Studenti', 3, NULL, '2025-05-05 19:04:15'),
(4, 1, '2a02:2f01:f602:8b00:61a1:917b:fc67:1b4e', 'create', 'Studenti', NULL, '{\"nume\":\"test\",\"prenume\":\"test\",\"email\":\"test@test.com\",\"telefon\":\"0728333222\",\"an_studiu\":\"2\"}', '2025-05-05 19:06:50'),
(5, 1, '2a02:2f01:f602:8b00:61a1:917b:fc67:1b4e', 'delete', 'Studenti', 8, NULL, '2025-05-05 19:12:32'),
(6, 1, '2a02:2f01:f602:8b00:61a1:917b:fc67:1b4e', 'create', 'Studenti', NULL, '{\"nume\":\"ADMINS\",\"prenume\":\"Test2\",\"email\":\"CAS@MDS.CPM\",\"telefon\":\"0788822222\",\"an_studiu\":\"2\"}', '2025-05-05 19:14:07'),
(7, 1, '2a02:2f01:f602:8b00:61a1:917b:fc67:1b4e', 'delete', 'Studenti', 10, '{\"ID_Student\":10,\"Nume\":\"ADMINS\",\"Prenume\":\"Test2\",\"Email\":\"CAS@MDS.CPM\",\"Telefon\":\"0788822222\",\"An_Studiu\":2}', '2025-05-05 19:16:21'),
(8, 1, '2a02:2f01:f602:8b00:61a1:917b:fc67:1b4e', 'create', 'Inscrieri', NULL, '{\"id_student\":\"4\",\"id_curs\":\"2\",\"nota\":\"10\"}', '2025-05-05 19:21:31'),
(9, 1, '2a02:2f01:f602:8b00:61a1:917b:fc67:1b4e', 'create', 'Inscrieri', NULL, '{\"id_student\":\"6\",\"id_curs\":\"2\",\"nota\":\"9\"}', '2025-05-05 19:24:50'),
(10, 1, '2a02:2f01:f602:8b00:61a1:917b:fc67:1b4e', 'update', 'Inscrieri', 4, '{\"id_student\":\"4\",\"id_curs\":\"2\",\"nota\":\"8\"}', '2025-05-05 19:30:01'),
(11, 1, '2a02:2f01:f602:8b00:61a1:917b:fc67:1b4e', 'create', 'Utilizatori', NULL, '{\"username\":\"andreea\",\"password\":\"********\",\"role\":\"admin\"}', '2025-05-05 19:30:24'),
(12, 1, '2a02:2f01:f602:8b00:61a1:917b:fc67:1b4e', 'update', 'Utilizatori', 1, '{\"username\":\"admin\",\"password\":\"********\",\"role\":\"admin\"}', '2025-05-05 19:30:44'),
(13, 1, '2a02:2f01:f602:8b00:61a1:917b:fc67:1b4e', 'update', 'Utilizatori', 2, '{\"username\":\"andreea\",\"password\":\"********\",\"role\":\"admin\"}', '2025-05-05 19:31:23'),
(14, 2, '2a02:2f01:f602:8b00:61a1:917b:fc67:1b4e', 'update', 'Utilizatori', 1, '{\"username\":\"dbradac\",\"password\":\"********\",\"role\":\"admin\"}', '2025-05-05 19:32:32'),
(15, 1, '2a02:2f01:f602:8b00:61a1:917b:fc67:1b4e', 'update', 'Utilizatori', 2, '{\"username\":\"anegru\",\"password\":\"********\",\"role\":\"admin\"}', '2025-05-05 19:32:59'),
(16, 1, '2a02:2f01:f602:8b00:61a1:917b:fc67:1b4e', 'create', 'Utilizatori', NULL, '{\"username\":\"gsimona\",\"password\":\"********\",\"role\":\"admin\"}', '2025-05-05 19:37:00'),
(17, 3, '2a02:2f0e:d001:db00:908b:8ee8:8997:27c9', 'update', 'Studenti', 6, '{\"nume\":\"Grama\",\"prenume\":\"Simona\",\"email\":\"gramasimona@gmail.com\",\"telefon\":\"0786888856\",\"an_studiu\":\"3\"}', '2025-05-05 19:40:31'),
(18, 3, '2a02:2f0e:d001:db00:908b:8ee8:8997:27c9', 'create', 'Studenti', NULL, '{\"nume\":\"Popescu\",\"prenume\":\"Andrei\",\"email\":\"andrei.popescu@yahoo.com\",\"telefon\":\"0732498348\",\"an_studiu\":\"1\"}', '2025-05-05 19:55:44'),
(19, 2, '2a02:2f01:f602:8b00:61a1:917b:fc67:1b4e', 'create', 'Studenti', NULL, '{\"nume\":\"Negru \",\"prenume\":\"Andreea\",\"email\":\"negruandreea@icloud.com\",\"telefon\":\"0799531472\",\"an_studiu\":\"3\"}', '2025-05-05 20:16:54'),
(20, 2, '2a02:2f01:f602:8b00:61a1:917b:fc67:1b4e', 'create', 'Inscrieri', NULL, '{\"id_student\":\"12\",\"id_curs\":\"5\",\"nota\":\"7.50\"}', '2025-05-05 20:18:41'),
(21, 2, '2a02:2f01:f602:8b00:61a1:917b:fc67:1b4e', 'update', 'Prezente', 5, '{\"data\":\"2025-05-05\",\"semester\":\"1\",\"id_student\":\"12\",\"id_curs\":\"2\",\"status\":\"prezent\"}', '2025-05-05 20:30:57'),
(22, 2, '2a02:2f01:f602:8b00:61a1:917b:fc67:1b4e', 'update', 'Studenti', 12, '{\"nume\":\"Negru \",\"prenume\":\"Andreea\",\"email\":\"negruandreea@icloud.co\",\"telefon\":\"0799531472\",\"an_studiu\":\"3\"}', '2025-05-05 20:31:14'),
(23, 2, '2a02:2f01:f602:8b00:61a1:917b:fc67:1b4e', 'update', 'Studenti', 12, '{\"nume\":\"Negru \",\"prenume\":\"Andreea\",\"email\":\"negruandreea@icloud.com\",\"telefon\":\"0799531472\",\"an_studiu\":\"3\"}', '2025-05-05 20:31:20'),
(24, 2, '2a02:2f01:f602:8b00:61a1:917b:fc67:1b4e', 'create', 'Studenti', NULL, '{\"nume\":\"test\",\"prenume\":\"test\",\"email\":\"test@test.com\",\"telefon\":\"1234567890\",\"an_studiu\":\"2\"}', '2025-05-05 20:31:47'),
(25, 2, '2a02:2f01:f602:8b00:61a1:917b:fc67:1b4e', 'delete', 'Studenti', 13, '{\"ID_Student\":13,\"Nume\":\"test\",\"Prenume\":\"test\",\"Email\":\"test@test.com\",\"Telefon\":\"1234567890\",\"An_Studiu\":2}', '2025-05-05 20:31:51'),
(26, 2, '2a02:2f01:f602:8b00:61a1:917b:fc67:1b4e', 'update', 'Cursuri', 15, '{\"denumire\":\"Bazele sistemelor de achizitii de dat\",\"profesor\":\"Cotfas Petru Adrian\",\"nr_credite\":\"3\",\"semester\":\"1\"}', '2025-05-05 20:32:03'),
(27, 2, '2a02:2f01:f602:8b00:61a1:917b:fc67:1b4e', 'update', 'Cursuri', 15, '{\"denumire\":\"Bazele sistemelor de achizitii de date\",\"profesor\":\"Cotfas Petru Adrian\",\"nr_credite\":\"3\",\"semester\":\"1\"}', '2025-05-05 20:32:08'),
(28, 2, '2a02:2f01:f602:8b00:61a1:917b:fc67:1b4e', 'create', 'Inscrieri', NULL, '{\"id_student\":\"11\",\"id_curs\":\"14\",\"nota\":\"2\"}', '2025-05-05 20:32:17'),
(29, 2, '2a02:2f01:f602:8b00:61a1:917b:fc67:1b4e', 'delete', 'Prezente', 5, '{\"ID_Prezenta\":5,\"Data\":\"2025-05-05\",\"ID_Student\":12,\"ID_Curs\":2,\"Status\":\"prezent\",\"Semester\":1}', '2025-05-05 20:32:39'),
(30, 2, '2a02:2f01:f602:8b00:61a1:917b:fc67:1b4e', 'create', 'Prezente', NULL, '{\"data\":\"2025-05-05\",\"semester\":\"2\",\"id_student\":\"12\",\"id_curs\":\"2\",\"status\":\"absent\"}', '2025-05-05 20:32:50'),
(31, 2, '2a02:2f01:f602:8b00:61a1:917b:fc67:1b4e', 'update', 'Cursuri', 3, '{\"denumire\":\"Teoria transmisiunii informatiei\",\"profesor\":\"Miron Miha\",\"nr_credite\":\"5\",\"semester\":\"2\"}', '2025-05-05 20:34:54'),
(32, 2, '2a02:2f01:f602:8b00:61a1:917b:fc67:1b4e', 'update', 'Cursuri', 3, '{\"denumire\":\"Teoria transmisiunii informatiei\",\"profesor\":\"Miron Mihai\",\"nr_credite\":\"5\",\"semester\":\"2\"}', '2025-05-05 20:35:00'),
(33, 2, '2a02:2f01:f602:8b00:61a1:917b:fc67:1b4e', 'logout', 'Auth', NULL, NULL, '2025-05-05 20:35:01'),
(34, 1, '2a02:2f01:f602:8b00:61a1:917b:fc67:1b4e', 'login', 'Auth', NULL, NULL, '2025-05-05 20:35:09'),
(35, 1, '2a02:2f01:f602:8b00:61a1:917b:fc67:1b4e', 'create', 'Prezente', NULL, '{\"data\":\"2025-02-05\",\"semester\":\"1\",\"id_student\":\"12\",\"id_curs\":\"9\",\"status\":\"absent\"}', '2025-05-05 20:36:26'),
(36, 1, '2a02:2f01:f602:8b00:61a1:917b:fc67:1b4e', 'logout', 'Auth', NULL, NULL, '2025-05-05 20:45:12'),
(37, 1, '2a02:2f01:f602:8b00:61a1:917b:fc67:1b4e', 'login', 'Auth', NULL, NULL, '2025-05-05 20:45:18'),
(38, 1, '2a02:2f01:f602:8b00:61a1:917b:fc67:1b4e', 'create', 'Inscrieri', NULL, '{\"id_student\":\"11\",\"id_curs\":\"13\",\"nota\":\"3\"}', '2025-05-05 20:45:56'),
(39, 1, '2a02:2f01:f602:8b00:61a1:917b:fc67:1b4e', 'create', 'Prezente', NULL, '{\"data\":\"2025-05-05\",\"semester\":\"2\",\"id_student\":\"4\",\"id_curs\":\"11\",\"status\":\"absent\"}', '2025-05-05 20:47:21'),
(40, 1, '2a02:2f01:f602:8b00:61a1:917b:fc67:1b4e', 'create', 'Prezente', NULL, '{\"data\":\"2025-05-05\",\"semester\":\"2\",\"id_student\":\"4\",\"id_curs\":\"11\",\"status\":\"absent\"}', '2025-05-05 20:47:43'),
(41, 1, '2a02:2f01:f602:8b00:61a1:917b:fc67:1b4e', 'logout', 'Auth', NULL, NULL, '2025-05-05 21:17:00'),
(42, 1, '2a02:2f01:f602:8b00:95f1:aefd:8cae:9aa7', 'login', 'Auth', NULL, NULL, '2025-05-06 06:56:36'),
(43, 1, '2a02:2f01:f602:8b00:61a1:917b:fc67:1b4e', 'login', 'Auth', NULL, NULL, '2025-05-06 07:08:19'),
(44, 1, '2a02:2f01:f602:8b00:61a1:917b:fc67:1b4e', 'delete', 'Inscrieri', 12, '{\"ID_Student\":12,\"ID_Curs\":5,\"Nota_Finala\":\"7.5\"}', '2025-05-06 07:20:41'),
(45, 3, '2a02:2f0e:d001:db00:908b:8ee8:8997:27c9', 'login', 'Auth', NULL, NULL, '2025-05-06 08:36:37'),
(46, 3, '2a02:2f0e:d001:db00:908b:8ee8:8997:27c9', 'create', 'Prezente', NULL, '{\"data\":\"2025-05-06\",\"semester\":\"1\",\"id_student\":\"6\",\"id_curs\":\"5\",\"status\":\"prezent\"}', '2025-05-06 08:37:20'),
(47, 1, '2a02:2f01:f602:8b00:61a1:917b:fc67:1b4e', 'login', 'Auth', NULL, NULL, '2025-05-06 08:57:07'),
(48, 1, '2a02:2f01:f602:8b00:61a1:917b:fc67:1b4e', 'logout', 'Auth', NULL, NULL, '2025-05-06 08:57:57'),
(49, 1, '34.103.242.69', 'login', 'Auth', NULL, NULL, '2025-05-06 09:46:25'),
(50, 1, '34.103.242.69', 'login', 'Auth', NULL, NULL, '2025-05-06 11:22:03'),
(51, 3, '2a02:2f0e:d001:db00:908b:8ee8:8997:27c9', 'login', 'Auth', NULL, NULL, '2025-05-06 12:00:51'),
(52, 3, '2a02:2f0e:d001:db00:908b:8ee8:8997:27c9', 'create', 'Studenti', NULL, '{\"nume\":\"Ghita\",\"prenume\":\"Miruna\",\"email\":\"mirunaghita10@gmail.com\",\"telefon\":\"0732614813\",\"an_studiu\":\"3\"}', '2025-05-06 12:01:50'),
(53, 3, '86.124.191.42', 'login', 'Auth', NULL, NULL, '2025-05-06 15:41:20'),
(54, 3, '86.124.191.42', 'create', 'Inscrieri', NULL, '{\"id_student\":\"6\",\"id_curs\":\"12\",\"nota\":\"4\"}', '2025-05-06 15:41:49'),
(55, 3, '86.124.191.42', 'create', 'Prezente', NULL, '{\"data\":\"2025-05-06\",\"semester\":\"2\",\"id_student\":\"16\",\"id_curs\":\"6\",\"status\":\"absent\"}', '2025-05-06 15:50:54'),
(56, 3, '86.124.191.42', 'create', 'Prezente', NULL, '{\"data\":\"2025-05-06\",\"semester\":\"2\",\"id_student\":\"11\",\"id_curs\":\"3\",\"status\":\"prezent\"}', '2025-05-06 15:51:14'),
(57, 1, '2a02:2f01:f602:8b00:4d6:1ce2:107d:ebb1', 'login', 'Auth', NULL, NULL, '2025-05-06 21:39:01'),
(58, 1, '193.254.231.207', 'login', 'Auth', NULL, NULL, '2025-05-07 09:08:17'),
(59, 1, '193.254.231.207', 'create', 'Prezente', NULL, '{\"data\":\"2025-05-07\",\"semester\":\"2\",\"id_student\":\"12\",\"id_curs\":\"2\",\"status\":\"prezent\"}', '2025-05-07 09:08:46'),
(60, 2, '193.254.231.207', 'login', 'Auth', NULL, NULL, '2025-05-07 09:10:27'),
(61, 1, '193.254.231.207', 'create', 'Studenti', NULL, '{\"nume\":\"Calu\",\"prenume\":\"Marian\",\"email\":\"marian@calu.ro\",\"telefon\":\"0789734221\",\"an_studiu\":\"2\"}', '2025-05-07 09:10:27'),
(62, 1, '193.254.231.207', 'create', 'Studenti', NULL, '{\"nume\":\"Iapa\",\"prenume\":\"Miruna\",\"email\":\"miruna@iapa.ro\",\"telefon\":\"0798723122\",\"an_studiu\":\"1\"}', '2025-05-07 09:10:53'),
(63, 1, '193.254.231.207', 'create', 'Inscrieri', NULL, '{\"id_student\":\"18\",\"id_curs\":\"15\",\"nota\":\"8\"}', '2025-05-07 09:11:04'),
(64, 1, '193.254.231.207', 'create', 'Inscrieri', NULL, '{\"id_student\":\"17\",\"id_curs\":\"14\",\"nota\":\"6\"}', '2025-05-07 09:11:14'),
(65, 1, '193.254.231.207', 'create', 'Inscrieri', NULL, '{\"id_student\":\"18\",\"id_curs\":\"2\",\"nota\":\"4\"}', '2025-05-07 09:11:23'),
(66, 2, '193.254.231.207', 'create', 'Studenti', NULL, '{\"nume\":\"Negru\",\"prenume\":\"Larisa\",\"email\":\"larisanegru04@gmail.com\",\"telefon\":\"0734927231\",\"an_studiu\":\"4\"}', '2025-05-07 09:11:30'),
(67, 1, '193.254.231.207', 'create', 'Prezente', NULL, '{\"data\":\"2025-05-07\",\"semester\":\"2\",\"id_student\":\"18\",\"id_curs\":\"12\",\"status\":\"prezent\"}', '2025-05-07 09:11:55'),
(68, 1, '193.254.231.207', 'create', 'Prezente', NULL, '{\"data\":\"2025-05-07\",\"semester\":\"1\",\"id_student\":\"18\",\"id_curs\":\"6\",\"status\":\"absent\"}', '2025-05-07 09:12:07'),
(69, 2, '193.254.231.207', 'create', 'Inscrieri', NULL, '{\"id_student\":\"19\",\"id_curs\":\"11\",\"nota\":\"6.50\"}', '2025-05-07 09:12:43'),
(70, 1, '34.103.242.69', 'logout', 'Auth', NULL, NULL, '2025-05-07 09:13:18'),
(71, 2, '193.254.231.207', 'create', 'Prezente', NULL, '{\"data\":\"2025-05-04\",\"semester\":\"1\",\"id_student\":\"19\",\"id_curs\":\"14\",\"status\":\"absent\"}', '2025-05-07 09:13:33'),
(72, 2, '193.254.231.207', 'create', 'Prezente', NULL, '{\"data\":\"2025-05-07\",\"semester\":\"2\",\"id_student\":\"19\",\"id_curs\":\"7\",\"status\":\"prezent\"}', '2025-05-07 09:14:06'),
(73, 2, '193.254.231.207', 'create', 'Studenti', NULL, '{\"nume\":\"Dimeny\",\"prenume\":\"Adrian\",\"email\":\"adriandimeny20@gmail.com\",\"telefon\":\"0724365221\",\"an_studiu\":\"3\"}', '2025-05-07 09:15:32'),
(74, 2, '193.254.231.207', 'create', 'Inscrieri', NULL, '{\"id_student\":\"12\",\"id_curs\":\"14\",\"nota\":\"5.5\"}', '2025-05-07 09:16:40'),
(75, 2, '193.254.231.207', 'create', 'Inscrieri', NULL, '{\"id_student\":\"20\",\"id_curs\":\"10\",\"nota\":\"7\"}', '2025-05-07 09:17:10'),
(76, 2, '193.254.231.207', 'create', 'Prezente', NULL, '{\"data\":\"2025-05-07\",\"semester\":\"2\",\"id_student\":\"20\",\"id_curs\":\"10\",\"status\":\"prezent\"}', '2025-05-07 09:17:42'),
(77, 2, '193.254.231.207', 'create', 'Studenti', NULL, '{\"nume\":\"Militaru\",\"prenume\":\"Rares\",\"email\":\"rareshmili2003@gmail.com\",\"telefon\":\"0722981754\",\"an_studiu\":\"4\"}', '2025-05-07 09:18:25'),
(78, 2, '193.254.231.207', 'create', 'Inscrieri', NULL, '{\"id_student\":\"21\",\"id_curs\":\"9\",\"nota\":\"6\"}', '2025-05-07 09:20:11'),
(79, 2, '193.254.231.207', 'create', 'Prezente', NULL, '{\"data\":\"2025-05-07\",\"semester\":\"1\",\"id_student\":\"21\",\"id_curs\":\"9\",\"status\":\"absent\"}', '2025-05-07 09:21:10'),
(80, 2, '193.254.231.207', 'update', 'Prezente', 19, '{\"data\":\"2025-05-07\",\"semester\":\"1\",\"id_student\":\"21\",\"id_curs\":\"9\",\"status\":\"prezent\"}', '2025-05-07 09:21:30'),
(81, 2, '193.254.231.207', 'create', 'Studenti', NULL, '{\"nume\":\"Deleanu\",\"prenume\":\"Andrei\",\"email\":\"deli2002@gmail.com\",\"telefon\":\"0783241985\",\"an_studiu\":\"4\"}', '2025-05-07 09:24:25'),
(82, 3, '2a02:2f0e:d001:db00:850e:dac8:cc43:89e6', 'login', 'Auth', NULL, NULL, '2025-05-07 09:45:12'),
(83, 3, '2a02:2f0e:d001:db00:850e:dac8:cc43:89e6', 'create', 'Studenti', NULL, '{\"nume\":\"Costache\",\"prenume\":\"Laurentiu\",\"email\":\"laurcostache11@gmail.com\",\"telefon\":\"0712543215\",\"an_studiu\":\"3\"}', '2025-05-07 09:47:37'),
(84, 3, '2a02:2f0e:d001:db00:850e:dac8:cc43:89e6', 'create', 'Studenti', NULL, '{\"nume\":\"Niculescu\",\"prenume\":\"Alina Elena\",\"email\":\"alinana2002@yahoo.com\",\"telefon\":\"0732561786\",\"an_studiu\":\"2\"}', '2025-05-07 09:49:01'),
(85, 3, '2a02:2f0e:d001:db00:850e:dac8:cc43:89e6', 'create', 'Inscrieri', NULL, '{\"id_student\":\"23\",\"id_curs\":\"10\",\"nota\":\"6\"}', '2025-05-07 09:49:59'),
(86, 3, '2a02:2f0e:d001:db00:850e:dac8:cc43:89e6', 'create', 'Inscrieri', NULL, '{\"id_student\":\"24\",\"id_curs\":\"3\",\"nota\":\"7\"}', '2025-05-07 09:50:21'),
(87, 3, '2a02:2f0e:d001:db00:850e:dac8:cc43:89e6', 'create', 'Inscrieri', NULL, '{\"id_student\":\"23\",\"id_curs\":\"9\",\"nota\":\"10\"}', '2025-05-07 09:50:38'),
(88, 3, '2a02:2f0e:d001:db00:850e:dac8:cc43:89e6', 'create', 'Inscrieri', NULL, '{\"id_student\":\"24\",\"id_curs\":\"15\",\"nota\":\"4.5\"}', '2025-05-07 09:51:01'),
(89, 2, '193.254.231.207', 'login', 'Auth', NULL, NULL, '2025-05-07 10:04:49'),
(90, 3, '2a02:2f0e:d001:db00:850e:dac8:cc43:89e6', 'login', 'Auth', NULL, NULL, '2025-05-07 21:36:18'),
(91, 1, '34.103.242.69', 'login', 'Auth', NULL, NULL, '2025-05-07 23:57:27'),
(92, 1, '34.103.242.69', 'create', 'Utilizatori', NULL, '{\"username\":\"profesor\",\"password\":\"********\",\"role\":\"profesor\"}', '2025-05-07 23:58:45'),
(93, 1, '34.103.242.69', 'logout', 'Auth', NULL, NULL, '2025-05-07 23:58:48'),
(94, 4, '34.103.242.69', 'login', 'Auth', NULL, NULL, '2025-05-07 23:58:50'),
(95, 4, '34.103.242.69', 'logout', 'Auth', NULL, NULL, '2025-05-07 23:59:04'),
(96, 1, '34.103.242.69', 'login', 'Auth', NULL, NULL, '2025-05-07 23:59:17'),
(97, 1, '34.103.242.69', 'create', 'Utilizatori', NULL, '{\"username\":\"secretar\",\"password\":\"********\",\"role\":\"secretar\"}', '2025-05-07 23:59:36'),
(98, 1, '34.103.242.69', 'logout', 'Auth', NULL, NULL, '2025-05-07 23:59:39'),
(99, 5, '34.103.242.69', 'login', 'Auth', NULL, NULL, '2025-05-07 23:59:41'),
(100, 5, '34.103.242.69', 'logout', 'Auth', NULL, NULL, '2025-05-08 00:00:18'),
(101, 1, '34.103.242.69', 'login', 'Auth', NULL, NULL, '2025-05-08 00:00:26'),
(102, 3, '193.254.231.207', 'login', 'Auth', NULL, NULL, '2025-05-08 11:23:45'),
(103, 3, '193.254.231.207', 'update', 'Cursuri', 8, '{\"denumire\":\"Practica de specialitate\",\"profesor\":\"Popescu Vlad\",\"nr_credite\":\"4\",\"semester\":\"2\"}', '2025-05-08 11:24:24'),
(104, 1, '34.103.242.69', 'login', 'Auth', NULL, NULL, '2025-05-08 20:41:37'),
(105, 1, '34.103.242.69', 'create', 'Inscrieri', NULL, '{\"id_student\":\"22\",\"id_curs\":\"11\",\"nota\":\"5\"}', '2025-05-08 20:42:31'),
(106, 1, '34.103.242.69', 'login', 'Auth', NULL, NULL, '2025-05-09 10:33:40'),
(107, 3, '2a02:2f0e:d001:db00:dd95:3401:899b:4bb7', 'login', 'Auth', NULL, NULL, '2025-05-11 13:07:16'),
(108, 1, '208.109.1.32', 'login', 'Auth', NULL, NULL, '2026-03-25 08:27:07'),
(109, 1, '208.109.1.32', 'update', 'Utilizatori', 2, '{\"username\":\"anegru\",\"password\":\"********\",\"role\":\"admin\"}', '2026-03-25 08:30:12'),
(110, 2, '208.109.1.32', 'login', 'Auth', NULL, NULL, '2026-03-25 08:30:24'),
(111, 1, '208.109.1.32', 'update', 'Utilizatori', 3, '{\"username\":\"gsimona\",\"password\":\"********\",\"role\":\"admin\"}', '2026-03-25 08:33:52'),
(112, 3, '208.109.1.32', 'login', 'Auth', NULL, NULL, '2026-03-25 08:34:31'),
(113, 2, '208.109.1.32', 'create', 'Prezente', NULL, '{\"data\":\"2026-03-24\",\"semester\":\"1\",\"id_student\":\"4\",\"id_curs\":\"4\",\"status\":\"absent\"}', '2026-03-25 08:39:27'),
(114, 1, '208.109.1.32', 'update', 'Utilizatori', 2, '{\"username\":\"anegru\",\"password\":\"********\",\"role\":\"admin\"}', '2026-03-25 08:43:31'),
(115, 2, '208.109.1.32', 'logout', 'Auth', NULL, NULL, '2026-03-25 08:46:00'),
(116, 2, '208.109.1.32', 'login', 'Auth', NULL, NULL, '2026-03-25 08:46:03'),
(117, 2, '208.109.1.32', 'logout', 'Auth', NULL, NULL, '2026-03-25 08:46:06'),
(118, 3, '208.109.1.32', 'create', 'Cursuri', NULL, '{\"denumire\":\"Economie generala\",\"profesor\":\"Constantin Duguleana\",\"nr_credite\":\"3\",\"semester\":\"2\"}', '2026-03-25 08:46:07'),
(119, 2, '208.109.1.32', 'login', 'Auth', NULL, NULL, '2026-03-25 08:46:14'),
(120, 2, '208.109.1.32', 'update', 'Utilizatori', 1, '{\"username\":\"dbradac\",\"password\":\"********\",\"role\":\"admin\"}', '2026-03-25 08:46:37'),
(121, 3, '208.109.1.32', 'create', 'Cursuri', NULL, '{\"denumire\":\"Comunicatii optice\",\"profesor\":\"Mihai Miron\",\"nr_credite\":\"3\",\"semester\":\"2\"}', '2026-03-25 08:47:13'),
(122, 3, '208.109.1.32', 'update', 'Cursuri', 16, '{\"denumire\":\"Economie generala\",\"profesor\":\"Constantin Duguleana\",\"nr_credite\":\"2\",\"semester\":\"2\"}', '2026-03-25 08:47:20'),
(123, 3, '208.109.1.32', 'create', 'Cursuri', NULL, '{\"denumire\":\"Comunicatii mobile\",\"profesor\":\"Marian Alexandru\",\"nr_credite\":\"5\",\"semester\":\"2\"}', '2026-03-25 08:47:46'),
(124, 1, '208.109.1.32', 'logout', 'Auth', NULL, NULL, '2026-03-25 08:50:07'),
(125, 1, '208.109.1.32', 'login', 'Auth', NULL, NULL, '2026-03-25 08:50:11'),
(126, 2, '208.109.1.32', 'login', 'Auth', NULL, NULL, '2026-03-25 08:57:15'),
(127, 2, '208.109.1.32', 'logout', 'Auth', NULL, NULL, '2026-03-25 09:01:43'),
(128, 2, '208.109.1.32', 'login', 'Auth', NULL, NULL, '2026-03-25 12:01:48'),
(129, 2, '208.109.1.32', 'login', 'Auth', NULL, NULL, '2026-04-15 07:30:06'),
(130, 3, '208.109.1.32', 'login', 'Auth', NULL, NULL, '2026-04-15 07:30:18'),
(131, 1, '208.109.1.32', 'login', 'Auth', NULL, NULL, '2026-04-15 07:30:24'),
(132, 1, '208.109.1.32', 'delete', 'Inscrieri', 18, '{\"ID_Student\":18,\"ID_Curs\":2,\"Nota_Finala\":\"4.0\"}', '2026-04-15 07:30:36'),
(133, 1, '208.109.1.32', 'delete', 'Inscrieri', 18, '{\"ID_Student\":18,\"ID_Curs\":15,\"Nota_Finala\":\"8.0\"}', '2026-04-15 07:30:44'),
(134, 1, '208.109.1.32', 'delete', 'Studenti', 18, '{\"ID_Student\":18,\"Nume\":\"Iapa\",\"Prenume\":\"Miruna\",\"Email\":\"miruna@iapa.ro\",\"Telefon\":\"0798723122\",\"An_Studiu\":1}', '2026-04-15 07:30:50'),
(135, 1, '208.109.1.32', 'delete', 'Studenti', 17, '{\"ID_Student\":17,\"Nume\":\"Calu\",\"Prenume\":\"Marian\",\"Email\":\"marian@calu.ro\",\"Telefon\":\"0789734221\",\"An_Studiu\":2}', '2026-04-15 07:31:02'),
(136, 1, '208.109.1.32', 'update', 'Utilizatori', 1, '{\"username\":\"dbradac\",\"password\":\"********\",\"role\":\"admin\"}', '2026-04-15 07:36:17'),
(137, 1, '208.109.1.32', 'update', 'Utilizatori', 1, '{\"username\":\"dbradac\",\"password\":\"********\",\"role\":\"admin\"}', '2026-04-15 07:36:29'),
(138, 1, '208.109.1.32', 'create', 'Prezente', NULL, '{\"data\":\"2026-04-15\",\"semester\":\"2\",\"id_student\":\"4\",\"id_curs\":\"7\",\"status\":\"prezent\"}', '2026-04-15 07:38:30'),
(139, 1, '208.109.1.32', 'logout', 'Auth', NULL, NULL, '2026-04-15 07:45:02'),
(140, 1, '208.109.1.32', 'login', 'Auth', NULL, NULL, '2026-04-15 07:45:05'),
(141, 2, '208.109.1.37', 'login', 'Auth', NULL, NULL, '2026-04-25 18:02:48'),
(142, 2, '208.109.1.37', 'login', 'Auth', NULL, NULL, '2026-04-25 20:52:03'),
(143, 2, '208.109.1.37', 'logout', 'Auth', NULL, NULL, '2026-04-25 20:52:39'),
(144, 2, '208.109.1.37', 'login', 'Auth', NULL, NULL, '2026-04-25 21:23:21'),
(145, 2, '208.109.1.37', 'logout', 'Auth', NULL, NULL, '2026-04-25 21:23:25'),
(146, 1, '208.109.1.37', 'login', 'Auth', NULL, NULL, '2026-04-25 21:32:47'),
(147, 2, '208.109.1.37', 'login', 'Auth', NULL, NULL, '2026-04-25 21:50:29'),
(148, 2, '208.109.1.37', 'logout', 'Auth', NULL, NULL, '2026-04-25 21:52:10'),
(149, 2, '208.109.1.37', 'login', 'Auth', NULL, NULL, '2026-04-25 21:52:12'),
(150, 2, '208.109.1.37', 'logout', 'Auth', NULL, NULL, '2026-04-25 21:52:14'),
(151, 2, '208.109.1.37', 'login', 'Auth', NULL, NULL, '2026-04-25 21:53:46'),
(152, 2, '208.109.1.37', 'logout', 'Auth', NULL, NULL, '2026-04-25 21:55:07'),
(153, 2, '208.109.1.37', 'login', 'Auth', NULL, NULL, '2026-04-25 22:13:56'),
(154, 2, '208.109.1.37', 'login', 'Auth', NULL, NULL, '2026-04-25 23:03:45'),
(155, 2, '208.109.1.37', 'login', 'Auth', NULL, NULL, '2026-04-25 23:10:26'),
(156, 2, '208.109.1.37', 'logout', 'Auth', NULL, NULL, '2026-04-25 23:29:52'),
(157, 2, '208.109.1.37', 'login', 'Auth', NULL, NULL, '2026-04-25 23:29:58'),
(158, 2, '208.109.1.37', 'login', 'Auth', NULL, NULL, '2026-04-26 10:49:08'),
(159, 1, '208.109.1.37', 'login', 'Auth', NULL, NULL, '2026-04-26 11:48:07');

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `Cursuri`
--

CREATE TABLE `Cursuri` (
  `ID_Curs` int(11) NOT NULL,
  `Denumire` varchar(100) NOT NULL,
  `Profesor_Titular` varchar(100) NOT NULL,
  `Nr_Credite` tinyint(4) NOT NULL CHECK (`Nr_Credite` > 0),
  `Semester` tinyint(1) NOT NULL COMMENT '1 = semestrul 1, 2 = semestrul 2'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Eliminarea datelor din tabel `Cursuri`
--

INSERT INTO `Cursuri` (`ID_Curs`, `Denumire`, `Profesor_Titular`, `Nr_Credite`, `Semester`) VALUES
(2, 'Baze de Date', 'Oprisescu Serban', 4, 2),
(3, 'Teoria transmisiunii informatiei', 'Miron Mihai', 5, 2),
(4, 'Telefonie si sisteme de comutatie a fluxurilor media', 'Curpen Dan Mihail', 4, 2),
(5, 'Modularea si demodularea semnalelor', 'Croitoru Otilia', 5, 2),
(6, 'Prelucrarea digitala a semnalelor', 'Miron Mihai', 4, 2),
(7, 'Sisteme de operare', 'Kertesz Csaba Zoltan', 4, 2),
(8, 'Practica de specialitate', 'Popescu Vlad', 4, 2),
(9, 'Software pentru telecomunicatii', 'Modran Horia Alexandru', 4, 1),
(10, 'Microcontrolere', 'Romanca Mihai', 5, 1),
(11, 'Arhitecturi de retea si internet', 'Robu Dan Nicolae ', 5, 1),
(12, 'Antene, linii si propagare', 'Miron Mihai', 5, 1),
(13, 'Comutatia circuitelor, a pachetelor si serviciilor', 'Alexandru Marian', 5, 1),
(14, 'Inginerie audio', 'Stanca Aurel Cornel si Ungureanu Daniel Constantin', 3, 1),
(15, 'Bazele sistemelor de achizitii de date', 'Cotfas Petru Adrian', 3, 1),
(16, 'Economie generala', 'Constantin Duguleana', 2, 2),
(17, 'Comunicatii optice', 'Mihai Miron', 3, 2),
(18, 'Comunicatii mobile', 'Marian Alexandru', 5, 2);

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `Inscrieri`
--

CREATE TABLE `Inscrieri` (
  `ID_Student` int(11) NOT NULL,
  `ID_Curs` int(11) NOT NULL,
  `Nota_Finala` decimal(3,1) NOT NULL CHECK (`Nota_Finala` between 1 and 10)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Eliminarea datelor din tabel `Inscrieri`
--

INSERT INTO `Inscrieri` (`ID_Student`, `ID_Curs`, `Nota_Finala`) VALUES
(4, 2, 8.0),
(6, 2, 9.0),
(6, 12, 4.0),
(11, 13, 3.0),
(11, 14, 2.0),
(12, 14, 5.5),
(19, 11, 6.5),
(20, 10, 7.0),
(21, 9, 6.0),
(22, 11, 5.0),
(23, 9, 10.0),
(23, 10, 6.0),
(24, 3, 7.0),
(24, 15, 4.5);

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `Prezente`
--

CREATE TABLE `Prezente` (
  `ID_Prezenta` int(11) NOT NULL,
  `Data` date NOT NULL,
  `ID_Student` int(11) NOT NULL,
  `ID_Curs` int(11) NOT NULL,
  `Status` enum('prezent','absent') NOT NULL,
  `Semester` tinyint(1) NOT NULL COMMENT '1 = semestrul 1, 2 = semestrul 2'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Eliminarea datelor din tabel `Prezente`
--

INSERT INTO `Prezente` (`ID_Prezenta`, `Data`, `ID_Student`, `ID_Curs`, `Status`, `Semester`) VALUES
(3, '2025-05-05', 6, 2, 'prezent', 2),
(4, '2025-05-05', 4, 2, 'prezent', 2),
(6, '2025-05-05', 12, 2, 'absent', 2),
(7, '2025-02-05', 12, 9, 'absent', 1),
(8, '2025-05-05', 4, 11, 'absent', 2),
(9, '2025-05-05', 4, 11, 'absent', 2),
(10, '2025-05-06', 6, 5, 'prezent', 1),
(11, '2025-05-06', 16, 6, 'absent', 2),
(12, '2025-05-06', 11, 3, 'prezent', 2),
(13, '2025-05-07', 12, 2, 'prezent', 2),
(16, '2025-05-04', 19, 14, 'absent', 1),
(17, '2025-05-07', 19, 7, 'prezent', 2),
(18, '2025-05-07', 20, 10, 'prezent', 2),
(19, '2025-05-07', 21, 9, 'prezent', 1),
(20, '2026-03-24', 4, 4, 'absent', 1),
(21, '2026-04-15', 4, 7, 'prezent', 2);

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `Studenti`
--

CREATE TABLE `Studenti` (
  `ID_Student` int(11) NOT NULL,
  `Nume` varchar(50) NOT NULL,
  `Prenume` varchar(50) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Telefon` varchar(20) NOT NULL COMMENT 'număr de telefon',
  `An_Studiu` tinyint(4) NOT NULL CHECK (`An_Studiu` between 1 and 6)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Eliminarea datelor din tabel `Studenti`
--

INSERT INTO `Studenti` (`ID_Student`, `Nume`, `Prenume`, `Email`, `Telefon`, `An_Studiu`) VALUES
(4, 'Bradac', 'Catalin Daniel', 'daniel@bradac.ro', '0759656923', 3),
(6, 'Grama', 'Simona', 'gramasimona@gmail.com', '0786888856', 3),
(11, 'Popescu', 'Andrei', 'andrei.popescu@yahoo.com', '0732498348', 1),
(12, 'Negru ', 'Andreea', 'negruandreea@icloud.com', '0799531472', 3),
(16, 'Ghita', 'Miruna', 'mirunaghita10@gmail.com', '0732614813', 3),
(19, 'Negru', 'Larisa', 'larisanegru04@gmail.com', '0734927231', 4),
(20, 'Dimeny', 'Adrian', 'adriandimeny20@gmail.com', '0724365221', 3),
(21, 'Militaru', 'Rares', 'rareshmili2003@gmail.com', '0722981754', 4),
(22, 'Deleanu', 'Andrei', 'deli2002@gmail.com', '0783241985', 4),
(23, 'Costache', 'Laurentiu', 'laurcostache11@gmail.com', '0712543215', 3),
(24, 'Niculescu', 'Alina Elena', 'alinana2002@yahoo.com', '0732561786', 2);

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `Utilizatori`
--

CREATE TABLE `Utilizatori` (
  `ID_User` int(10) UNSIGNED NOT NULL,
  `username` varchar(50) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `Role` enum('admin','secretar','profesor') NOT NULL DEFAULT 'profesor'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Eliminarea datelor din tabel `Utilizatori`
--

INSERT INTO `Utilizatori` (`ID_User`, `username`, `password_hash`, `Role`) VALUES
(1, 'dbradac', '$2y$10$YN/bNIk29JprRd06/NBPX.24Nbb4dB6z7jP8UYJEQXOlpPp6B4/r6', 'admin'),
(2, 'anegru', '$2y$12$gHfOgZyBqTYnI7quB6rr2eyr07oP6cMP3kRaSVAntKx3WUz4B64IS', 'admin'),
(3, 'gsimona', '$2y$12$/sAOeaZDfDdurFZ/L2sX9eaFY4/dHloiXeDAFqneUDG0j1QXvKPQO', 'admin'),
(4, 'profesor', '$2y$12$EK.ow1IwYzHxRSbdeZJgaOnia7MKnErF993ZLH43g.xn4LCJvcVru', 'profesor'),
(5, 'secretar', '$2y$12$FnqH9skiRvvn2zGcU9YRLuz.XZQNG5CSmcmHwhap64Ki56u.hYWuu', 'secretar');

--
-- Indexuri pentru tabele eliminate
--

--
-- Indexuri pentru tabele `Audit_Log`
--
ALTER TABLE `Audit_Log`
  ADD PRIMARY KEY (`ID_Audit`);

--
-- Indexuri pentru tabele `Cursuri`
--
ALTER TABLE `Cursuri`
  ADD PRIMARY KEY (`ID_Curs`);

--
-- Indexuri pentru tabele `Inscrieri`
--
ALTER TABLE `Inscrieri`
  ADD PRIMARY KEY (`ID_Student`,`ID_Curs`),
  ADD KEY `ID_Curs` (`ID_Curs`);

--
-- Indexuri pentru tabele `Prezente`
--
ALTER TABLE `Prezente`
  ADD PRIMARY KEY (`ID_Prezenta`),
  ADD KEY `fk_prez_student` (`ID_Student`),
  ADD KEY `fk_prez_curs` (`ID_Curs`);

--
-- Indexuri pentru tabele `Studenti`
--
ALTER TABLE `Studenti`
  ADD PRIMARY KEY (`ID_Student`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Indexuri pentru tabele `Utilizatori`
--
ALTER TABLE `Utilizatori`
  ADD PRIMARY KEY (`ID_User`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT pentru tabele eliminate
--

--
-- AUTO_INCREMENT pentru tabele `Audit_Log`
--
ALTER TABLE `Audit_Log`
  MODIFY `ID_Audit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=160;

--
-- AUTO_INCREMENT pentru tabele `Cursuri`
--
ALTER TABLE `Cursuri`
  MODIFY `ID_Curs` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT pentru tabele `Prezente`
--
ALTER TABLE `Prezente`
  MODIFY `ID_Prezenta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT pentru tabele `Studenti`
--
ALTER TABLE `Studenti`
  MODIFY `ID_Student` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT pentru tabele `Utilizatori`
--
ALTER TABLE `Utilizatori`
  MODIFY `ID_User` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constrângeri pentru tabele eliminate
--

--
-- Constrângeri pentru tabele `Inscrieri`
--
ALTER TABLE `Inscrieri`
  ADD CONSTRAINT `Inscrieri_ibfk_1` FOREIGN KEY (`ID_Student`) REFERENCES `Studenti` (`ID_Student`) ON DELETE CASCADE,
  ADD CONSTRAINT `Inscrieri_ibfk_2` FOREIGN KEY (`ID_Curs`) REFERENCES `Cursuri` (`ID_Curs`) ON DELETE CASCADE;

--
-- Constrângeri pentru tabele `Prezente`
--
ALTER TABLE `Prezente`
  ADD CONSTRAINT `fk_prez_curs` FOREIGN KEY (`ID_Curs`) REFERENCES `Cursuri` (`ID_Curs`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_prez_student` FOREIGN KEY (`ID_Student`) REFERENCES `Studenti` (`ID_Student`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
