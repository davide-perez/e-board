-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Dic 15, 2018 alle 20:21
-- Versione del server: 10.1.36-MariaDB
-- Versione PHP: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eboard`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `ad`
--

CREATE TABLE `ad` (
  `ad_id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `category` varchar(30) NOT NULL,
  `ad_text` varchar(5000) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `date_published` date DEFAULT NULL,
  `date_until` date DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `ad`
--

INSERT INTO `ad` (`ad_id`, `title`, `category`, `ad_text`, `status`, `date_published`, `date_until`, `user_id`) VALUES
(9, 'Offering math lectures', 'lectures', 'Bachelor computer science student offers private math lectures on the following topics: calculus, linear algebra, discrete mathematics.', 1, '2018-01-01', '2018-12-01', 3),
(10, 'Private wrestling training', 'lectures', 'Wrestling champion offers private training.', 1, '2018-12-01', '2018-12-13', 1),
(11, 'Looking for Nintendo Switch', 'itemsale', 'Looking for a used nintendo switch in a good state. I am quite poor so good price please.', 1, '2018-12-13', '2018-12-20', 2);

-- --------------------------------------------------------

--
-- Struttura della tabella `email`
--

CREATE TABLE `email` (
  `email` varchar(40) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `email`
--

INSERT INTO `email` (`email`, `user_id`) VALUES
('pathosposta@gmail.com', 1),
('perezposta@gmail.com', 2),
('cremoposta@gmail.com', 3);

-- --------------------------------------------------------

--
-- Struttura della tabella `image`
--

CREATE TABLE `image` (
  `link` varchar(100) NOT NULL,
  `image_only` int(11) NOT NULL,
  `ad_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `image`
--

INSERT INTO `image` (`link`, `image_only`, `ad_id`) VALUES
('/eboard/eboard/server/resources/ads/images/img1.jpg', 0, 9),
('/eboard/eboard/server/resources/ads/images/img2.jpg', 0, 10),
('/eboard/eboard/server/resources/ads/images/img3.jpg', 0, 11);

-- --------------------------------------------------------

--
-- Struttura della tabella `moderator`
--

CREATE TABLE `moderator` (
  `moderator_id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `moderator`
--

INSERT INTO `moderator` (`moderator_id`, `username`, `password`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Struttura della tabella `phone`
--

CREATE TABLE `phone` (
  `phone_number` varchar(25) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `phone`
--

INSERT INTO `phone` (`phone_number`, `user_id`) VALUES
('3332211000', 1),
('3333333333', 1),
('0471123456', 2),
('3456789012', 3);

-- --------------------------------------------------------

--
-- Struttura della tabella `standard_user`
--

CREATE TABLE `standard_user` (
  `user_id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `surname` varchar(20) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `standard_user`
--

INSERT INTO `standard_user` (`user_id`, `name`, `surname`, `username`, `password`) VALUES
(1, 'Pathossa', 'De Pathossis', 'nhc1mazza', 'bagno'),
(2, 'Davide', 'Perez', 'dperez', 'superpassword'),
(3, 'Davide', 'Cremonini', 't-rex', 'password');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `ad`
--
ALTER TABLE `ad`
  ADD PRIMARY KEY (`ad_id`),
  ADD KEY `fk_user` (`user_id`);

--
-- Indici per le tabelle `email`
--
ALTER TABLE `email`
  ADD PRIMARY KEY (`email`),
  ADD KEY `user_id` (`user_id`);

--
-- Indici per le tabelle `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`link`),
  ADD KEY `ad_id` (`ad_id`);

--
-- Indici per le tabelle `moderator`
--
ALTER TABLE `moderator`
  ADD PRIMARY KEY (`moderator_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indici per le tabelle `phone`
--
ALTER TABLE `phone`
  ADD PRIMARY KEY (`phone_number`),
  ADD KEY `user_id` (`user_id`);

--
-- Indici per le tabelle `standard_user`
--
ALTER TABLE `standard_user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `ad`
--
ALTER TABLE `ad`
  MODIFY `ad_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT per la tabella `moderator`
--
ALTER TABLE `moderator`
  MODIFY `moderator_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT per la tabella `standard_user`
--
ALTER TABLE `standard_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `ad`
--
ALTER TABLE `ad`
  ADD CONSTRAINT `fk_user` FOREIGN KEY (`user_id`) REFERENCES `standard_user` (`user_id`);

--
-- Limiti per la tabella `email`
--
ALTER TABLE `email`
  ADD CONSTRAINT `email_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `standard_user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `image`
--
ALTER TABLE `image`
  ADD CONSTRAINT `image_ibfk_1` FOREIGN KEY (`ad_id`) REFERENCES `ad` (`ad_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `phone`
--
ALTER TABLE `phone`
  ADD CONSTRAINT `phone_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `standard_user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
