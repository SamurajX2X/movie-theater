-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 16, 2025 at 01:18 PM
-- Wersja serwera: 10.4.32-MariaDB
-- Wersja PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cinema`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `movies`
--

CREATE TABLE `movies` (
  `movie_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`movie_id`, `title`, `description`) VALUES
(1, 'Avengers: Koniec Gry', ''),
(2, 'Barbie i Rajska Przygoda', ''),
(3, 'Inception', 'Film o snach w snach'),
(4, 'The Matrix', 'Rzeczywistość nie jest tym, czym się wydaje'),
(5, 'Interstellar', 'Podróż międzygwiezdna'),
(6, 'Pulp Fiction', 'Klasyk Tarantino'),
(7, 'Inception', 'Film o snach w snach'),
(8, 'Avatar 3', 'Kontynuacja sagi o Pandorze'),
(9, 'Dune: Part Two', 'Epicka kontynuacja historii Atrakedów');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `reservations`
--

CREATE TABLE `reservations` (
  `reservation_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `screening_id` int(11) NOT NULL,
  `reservation_time` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`reservation_id`, `user_id`, `screening_id`, `reservation_time`) VALUES
(1, 1, 1, '2025-03-15 21:39:58'),
(2, 1, 9, '2025-03-16 13:09:19'),
(3, 1, 9, '2025-03-16 13:16:06'),
(4, 6, 9, '2025-03-16 13:16:53');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `reserved_seats`
--

CREATE TABLE `reserved_seats` (
  `reservation_id` int(11) NOT NULL,
  `seat_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reserved_seats`
--

INSERT INTO `reserved_seats` (`reservation_id`, `seat_id`) VALUES
(2, 77),
(2, 92),
(3, 95),
(3, 186),
(4, 132),
(4, 252);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `screenings`
--

CREATE TABLE `screenings` (
  `screening_id` int(11) NOT NULL,
  `movie_id` int(11) NOT NULL,
  `screening_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `screenings`
--

INSERT INTO `screenings` (`screening_id`, `movie_id`, `screening_date`) VALUES
(1, 1, '2024-01-15 18:00:00'),
(2, 1, '2024-01-15 21:30:00'),
(3, 2, '2024-01-16 17:45:00'),
(4, 2, '2024-01-17 20:00:00'),
(5, 1, '2024-03-20 18:00:00'),
(6, 2, '2024-03-21 20:30:00'),
(7, 3, '2024-03-23 19:00:00'),
(8, 4, '2024-04-10 21:30:00'),
(9, 1, '2025-03-17 18:30:00'),
(10, 2, '2025-03-17 20:45:00'),
(11, 3, '2025-03-18 19:00:00'),
(12, 1, '2025-04-01 17:30:00'),
(13, 2, '2025-04-01 20:00:00'),
(14, 3, '2025-04-02 18:45:00'),
(15, 1, '2025-05-15 19:15:00'),
(16, 2, '2025-05-15 21:30:00'),
(17, 3, '2025-05-16 18:00:00');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `seats`
--

CREATE TABLE `seats` (
  `seat_id` int(11) NOT NULL,
  `row_num` int(11) NOT NULL,
  `seat_num` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `seats`
--

INSERT INTO `seats` (`seat_id`, `row_num`, `seat_num`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 4),
(5, 1, 5),
(6, 1, 6),
(7, 1, 7),
(8, 1, 8),
(9, 1, 9),
(10, 1, 10),
(11, 1, 11),
(12, 1, 12),
(13, 1, 13),
(14, 1, 14),
(15, 1, 15),
(16, 1, 16),
(17, 1, 17),
(18, 1, 18),
(19, 1, 19),
(20, 1, 20),
(21, 2, 1),
(22, 2, 2),
(23, 2, 3),
(24, 2, 4),
(25, 2, 5),
(26, 2, 6),
(27, 2, 7),
(28, 2, 8),
(29, 2, 9),
(30, 2, 10),
(31, 2, 11),
(32, 2, 12),
(33, 2, 13),
(34, 2, 14),
(35, 2, 15),
(36, 2, 16),
(37, 2, 17),
(38, 2, 18),
(39, 2, 19),
(40, 2, 20),
(41, 3, 1),
(42, 3, 2),
(43, 3, 3),
(44, 3, 4),
(45, 3, 5),
(46, 3, 6),
(47, 3, 7),
(48, 3, 8),
(49, 3, 9),
(50, 3, 10),
(51, 3, 11),
(52, 3, 12),
(53, 3, 13),
(54, 3, 14),
(55, 3, 15),
(56, 3, 16),
(57, 3, 17),
(58, 3, 18),
(59, 3, 19),
(60, 3, 20),
(61, 4, 1),
(62, 4, 2),
(63, 4, 3),
(64, 4, 4),
(65, 4, 5),
(66, 4, 6),
(67, 4, 7),
(68, 4, 8),
(69, 4, 9),
(70, 4, 10),
(71, 4, 11),
(72, 4, 12),
(73, 4, 13),
(74, 4, 14),
(75, 4, 15),
(76, 4, 16),
(77, 4, 17),
(78, 4, 18),
(79, 4, 19),
(80, 4, 20),
(81, 5, 1),
(82, 5, 2),
(83, 5, 3),
(84, 5, 4),
(85, 5, 5),
(86, 5, 6),
(87, 5, 7),
(88, 5, 8),
(89, 5, 9),
(90, 5, 10),
(91, 5, 11),
(92, 5, 12),
(93, 5, 13),
(94, 5, 14),
(95, 5, 15),
(96, 5, 16),
(97, 5, 17),
(98, 5, 18),
(99, 5, 19),
(100, 5, 20),
(101, 6, 1),
(102, 6, 2),
(103, 6, 3),
(104, 6, 4),
(105, 6, 5),
(106, 6, 6),
(107, 6, 7),
(108, 6, 8),
(109, 6, 9),
(110, 6, 10),
(111, 6, 11),
(112, 6, 12),
(113, 6, 13),
(114, 6, 14),
(115, 6, 15),
(116, 6, 16),
(117, 6, 17),
(118, 6, 18),
(119, 6, 19),
(120, 6, 20),
(121, 7, 1),
(122, 7, 2),
(123, 7, 3),
(124, 7, 4),
(125, 7, 5),
(126, 7, 6),
(127, 7, 7),
(128, 7, 8),
(129, 7, 9),
(130, 7, 10),
(131, 7, 11),
(132, 7, 12),
(133, 7, 13),
(134, 7, 14),
(135, 7, 15),
(136, 7, 16),
(137, 7, 17),
(138, 7, 18),
(139, 7, 19),
(140, 7, 20),
(141, 8, 1),
(142, 8, 2),
(143, 8, 3),
(144, 8, 4),
(145, 8, 5),
(146, 8, 6),
(147, 8, 7),
(148, 8, 8),
(149, 8, 9),
(150, 8, 10),
(151, 8, 11),
(152, 8, 12),
(153, 8, 13),
(154, 8, 14),
(155, 8, 15),
(156, 8, 16),
(157, 8, 17),
(158, 8, 18),
(159, 8, 19),
(160, 8, 20),
(161, 9, 1),
(162, 9, 2),
(163, 9, 3),
(164, 9, 4),
(165, 9, 5),
(166, 9, 6),
(167, 9, 7),
(168, 9, 8),
(169, 9, 9),
(170, 9, 10),
(171, 9, 11),
(172, 9, 12),
(173, 9, 13),
(174, 9, 14),
(175, 9, 15),
(176, 9, 16),
(177, 9, 17),
(178, 9, 18),
(179, 9, 19),
(180, 9, 20),
(181, 10, 1),
(182, 10, 2),
(183, 10, 3),
(184, 10, 4),
(185, 10, 5),
(186, 10, 6),
(187, 10, 7),
(188, 10, 8),
(189, 10, 9),
(190, 10, 10),
(191, 10, 11),
(192, 10, 12),
(193, 10, 13),
(194, 10, 14),
(195, 10, 15),
(196, 10, 16),
(197, 10, 17),
(198, 10, 18),
(199, 10, 19),
(200, 10, 20),
(201, 11, 1),
(202, 11, 2),
(203, 11, 3),
(204, 11, 4),
(205, 11, 5),
(206, 11, 6),
(207, 11, 7),
(208, 11, 8),
(209, 11, 9),
(210, 11, 10),
(211, 11, 11),
(212, 11, 12),
(213, 11, 13),
(214, 11, 14),
(215, 11, 15),
(216, 11, 16),
(217, 11, 17),
(218, 11, 18),
(219, 11, 19),
(220, 11, 20),
(221, 12, 1),
(222, 12, 2),
(223, 12, 3),
(224, 12, 4),
(225, 12, 5),
(226, 12, 6),
(227, 12, 7),
(228, 12, 8),
(229, 12, 9),
(230, 12, 10),
(231, 12, 11),
(232, 12, 12),
(233, 12, 13),
(234, 12, 14),
(235, 12, 15),
(236, 12, 16),
(237, 12, 17),
(238, 12, 18),
(239, 12, 19),
(240, 12, 20),
(241, 13, 1),
(242, 13, 2),
(243, 13, 3),
(244, 13, 4),
(245, 13, 5),
(246, 13, 6),
(247, 13, 7),
(248, 13, 8),
(249, 13, 9),
(250, 13, 10),
(251, 13, 11),
(252, 13, 12),
(253, 13, 13),
(254, 13, 14),
(255, 13, 15),
(256, 13, 16),
(257, 13, 17),
(258, 13, 18),
(259, 13, 19),
(260, 13, 20),
(261, 14, 1),
(262, 14, 2),
(263, 14, 3),
(264, 14, 4),
(265, 14, 5),
(266, 14, 6),
(267, 14, 7),
(268, 14, 8),
(269, 14, 9),
(270, 14, 10),
(271, 14, 11),
(272, 14, 12),
(273, 14, 13),
(274, 14, 14),
(275, 14, 15),
(276, 14, 16),
(277, 14, 17),
(278, 14, 18),
(279, 14, 19),
(280, 14, 20),
(281, 15, 1),
(282, 15, 2),
(283, 15, 3),
(284, 15, 4),
(285, 15, 5),
(286, 15, 6),
(287, 15, 7),
(288, 15, 8),
(289, 15, 9),
(290, 15, 10),
(291, 15, 11),
(292, 15, 12),
(293, 15, 13),
(294, 15, 14),
(295, 15, 15),
(296, 15, 16),
(297, 15, 17),
(298, 15, 18),
(299, 15, 19),
(300, 15, 20);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `phone`) VALUES
(1, 'sigma', '$2y$10$8/WEDjLopE8TLaAZC8XtGO3n0FFTr5wrGM7MJzkkZ/Qza.d7bAU4C', '123456789'),
(3, 'niga', '$2y$10$.0gA4m060EQ4s5D/Z8fHku8eaI.fy9WKpV86YziSVH8aeY5/3LrXa', '123456789'),
(4, 'bomboclat', '$2y$10$8B1NB7t2ZrX0GNn1aOleg.a.iGSrNtMD7c0OsTTNuE7cxybrqQhka', '69696969'),
(6, 'kowalski', '$2y$10$Dvwp92xq6/B7tuP3zIkkqeUxfnt/BMI326tPJsf1g3rwn5JuSMvBO', '6969696921');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`movie_id`);

--
-- Indeksy dla tabeli `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`reservation_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `screening_id` (`screening_id`);

--
-- Indeksy dla tabeli `reserved_seats`
--
ALTER TABLE `reserved_seats`
  ADD PRIMARY KEY (`reservation_id`,`seat_id`),
  ADD KEY `seat_id` (`seat_id`);

--
-- Indeksy dla tabeli `screenings`
--
ALTER TABLE `screenings`
  ADD PRIMARY KEY (`screening_id`),
  ADD KEY `movie_id` (`movie_id`);

--
-- Indeksy dla tabeli `seats`
--
ALTER TABLE `seats`
  ADD PRIMARY KEY (`seat_id`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `movies`
--
ALTER TABLE `movies`
  MODIFY `movie_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `reservation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `screenings`
--
ALTER TABLE `screenings`
  MODIFY `screening_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `reservations_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `reservations_ibfk_2` FOREIGN KEY (`screening_id`) REFERENCES `screenings` (`screening_id`);

--
-- Constraints for table `reserved_seats`
--
ALTER TABLE `reserved_seats`
  ADD CONSTRAINT `reserved_seats_ibfk_1` FOREIGN KEY (`reservation_id`) REFERENCES `reservations` (`reservation_id`),
  ADD CONSTRAINT `reserved_seats_ibfk_2` FOREIGN KEY (`seat_id`) REFERENCES `seats` (`seat_id`);

--
-- Constraints for table `screenings`
--
ALTER TABLE `screenings`
  ADD CONSTRAINT `screenings_ibfk_1` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`movie_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
