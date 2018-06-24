-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Giu 20, 2018 alle 15:26
-- Versione del server: 10.1.30-MariaDB
-- Versione PHP: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fsacchet`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `abbonamento`
--

CREATE TABLE `abbonamento` (
  `CodiceUtente` int(10) NOT NULL,
  `ScadenzaFitness` date DEFAULT NULL,
  `EntrateCorsi` int(10) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `abbonamento`
--

INSERT INTO `abbonamento` (`CodiceUtente`, `ScadenzaFitness`, `EntrateCorsi`) VALUES
(1, '2018-03-28', 0),
(2, '2018-03-28', 20),
(3, '2018-03-28', 30);

-- --------------------------------------------------------

--
-- Struttura della tabella `corso`
--

CREATE TABLE `corso` (
  `CodiceCorso` int(10) NOT NULL,
  `NomeCorso` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `corso`
--

INSERT INTO `corso` (`CodiceCorso`, `NomeCorso`) VALUES
(1, 'Spinning'),
(2, 'FitBoxe'),
(3, 'PowerPump'),
(4, 'JumpFit'),
(5, 'Step');

-- --------------------------------------------------------

--
-- Struttura della tabella `fattura`
--

CREATE TABLE `fattura` (
  `NumeroRicevuta` int(10) NOT NULL,
  `DataEmissione` date NOT NULL,
  `ImportoEuro` int(10) NOT NULL,
  `CodiceUtente` int(10) NOT NULL,
  `MesiFitness` int(10) DEFAULT 0,
  `EntrateCorsi` int(10) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `fattura`
--

INSERT INTO `fattura` (`NumeroRicevuta`, `DataEmissione`, `ImportoEuro`, `CodiceUtente`, `MesiFitness`, `EntrateCorsi`) VALUES
(1, '2017-03-28', 300, 1, 12, 0),
(2, '2017-03-28', 120, 2, 0, 20),
(3, '2017-09-28', 420, 3, 6, 30);

--
-- Trigger `fattura`
--
DELIMITER $$
CREATE TRIGGER `fat1` AFTER INSERT ON `fattura` FOR EACH ROW BEGIN
DECLARE entry INTEGER;
DECLARE scad DATE;
DECLARE newdata DATE;
 
SELECT abbonamento.ScadenzaFitness INTO scad FROM abbonamento WHERE new.CodiceUtente = abbonamento.CodiceUtente;
 
IF (scad < CURRENT_DATE() )
THEN
SELECT DATE_ADD(CURRENT_DATE, INTERVAL new.MesiFitness MONTH) INTO newdata;
UPDATE abbonamento
SET abbonamento.ScadenzaFitness = newdata
WHERE
new.CodiceUtente = abbonamento.CodiceUtente;
END IF;
 
IF (scad IS NULL )
THEN
SELECT DATE_ADD(CURRENT_DATE, INTERVAL new.MesiFitness MONTH) INTO newdata;
UPDATE abbonamento
SET abbonamento.ScadenzaFitness = newdata
WHERE
new.CodiceUtente = abbonamento.CodiceUtente;
END IF;
 
IF (scad >= CURRENT_DATE() )
THEN
SELECT DATE_ADD(scad, INTERVAL new.MesiFitness MONTH) INTO newdata;
UPDATE abbonamento
SET abbonamento.ScadenzaFitness = newdata
WHERE
new.CodiceUtente = abbonamento.CodiceUtente;
END IF;
 
SELECT abbonamento.EntrateCorsi INTO entry FROM abbonamento WHERE new.CodiceUtente = abbonamento.CodiceUtente;
 
IF (new.EntrateCorsi > 0)
THEN
UPDATE abbonamento
SET abbonamento.EntrateCorsi = entry + new.EntrateCorsi
WHERE
new.CodiceUtente = abbonamento.CodiceUtente;
END IF;
 
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struttura della tabella `galleria`
--

CREATE TABLE `galleria` (
  `NomeImmagine` varchar(50) NOT NULL,
  `Data` date NOT NULL,
  `Album` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `galleria`
--

INSERT INTO `galleria` (`NomeImmagine`, `Data`, `Album`) VALUES
('Allenamento.jpg', '2018-01-01', 'Palestra'),
('fitBoxe.jpg', '2018-01-01', 'Palestra'),
('fitness.jpg', '2018-01-01', 'Palestra'),
('jumpfit.jpg', '2018-01-01', 'Palestra'),
('pizzata.jpg', '2018-01-01', 'Pizzata'),
('Trainer.jpg', '2018-01-01', 'Palestra');

--
-- Trigger `galleria`
--
DELIMITER $$
CREATE TRIGGER `Datag` BEFORE INSERT ON `galleria` FOR EACH ROW SET new.Data = CURRENT_DATE()
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struttura della tabella `iscrizionecorso`
--

CREATE TABLE `iscrizionecorso` (
  `CodiceUtente` int(10) NOT NULL,
  `CodiceCorso` int(10) NOT NULL,
  `NomeCorso` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `iscrizionecorso`
--

INSERT INTO `iscrizionecorso` (`CodiceUtente`, `CodiceCorso`, `NomeCorso`) VALUES
(2, 1, 'Spinning'),
(2, 2, 'FitBoxe'),
(3, 2, 'FitBoxe');

-- --------------------------------------------------------

--
-- Struttura della tabella `news`
--

CREATE TABLE `news` (
  `Titolo` varchar(50) NOT NULL,
  `Data` date NOT NULL,
  `Immagine` varchar(50) NOT NULL,
  `Descrizione` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `news`
--

INSERT INTO `news` (`Titolo`, `Data`, `Immagine`, `Descrizione`) VALUES
('Titolo news', '2018-03-01', 'Freddy.jpg', 'Descrizione news'),
('Titolo seconda news', '2018-02-28', 'Freddy.jpg', 'Descrizione seconda news');

--
-- Trigger `news`
--
DELIMITER $$
CREATE TRIGGER `Data` BEFORE INSERT ON `news` FOR EACH ROW SET new.Data = CURRENT_DATE()
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struttura della tabella `scheda`
--

CREATE TABLE `scheda` (
  `CodiceUtente` int(10) NOT NULL,
  `LinkScheda` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struttura della tabella `utente`
--

CREATE TABLE `utente` (
  `CodiceUtente` int(10) NOT NULL,
  `Nome` varchar(150) NOT NULL,
  `Cognome` varchar(150) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Tipo` varchar(50) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `utente`
--

INSERT INTO `utente` (`CodiceUtente`, `Nome`, `Cognome`, `Password`, `Email`, `Tipo`) VALUES
(1, 'Francesco', 'Sacchetto', 'fsacchet1', 'francesco.sacchetto@gmail.com', 'user'),
(2, 'Nicola', 'Cisternino', 'nicocister2', 'nicola.cisternino@gmail.com', 'user'),
(3, 'Marco', 'Masiero', 'marmasier3', 'marco.masiero@gmail.com', 'user'),
(4, 'Stefano', 'Nordio', 'snordio4', 'stefano.nordio@gmail.com', 'user'),
(5, 'Admin-Name', 'Admin-Surname', 'admin', 'admin.admin@gmail.com', 'admin');

--
-- Trigger `utente`
--
DELIMITER $$
CREATE TRIGGER `updabb` AFTER INSERT ON `utente` FOR EACH ROW BEGIN
DECLARE codut INTEGER;
DECLARE scad DATE;
DECLARE tipo VARCHAR(50);

SELECT new.Tipo INTO tipo;
IF (tipo = 'user')
THEN
SELECT new.CodiceUtente INTO codut;
SELECT DATE_ADD(CURRENT_DATE, INTERVAL 1 DAY) INTO scad;
INSERT INTO `abbonamento`(`CodiceUtente`, `ScadenzaFitness`) VALUES (codut, scad);

END IF;

END
$$
DELIMITER ;

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `abbonamento`
--
ALTER TABLE `abbonamento`
  ADD PRIMARY KEY (`CodiceUtente`);

--
-- Indici per le tabelle `corso`
--
ALTER TABLE `corso`
  ADD PRIMARY KEY (`CodiceCorso`);

--
-- Indici per le tabelle `fattura`
--
ALTER TABLE `fattura`
  ADD PRIMARY KEY (`NumeroRicevuta`),
  ADD KEY `fatt1` (`CodiceUtente`);

--
-- Indici per le tabelle `galleria`
--
ALTER TABLE `galleria`
  ADD PRIMARY KEY (`NomeImmagine`,`Album`);

--
-- Indici per le tabelle `iscrizionecorso`
--
ALTER TABLE `iscrizionecorso`
  ADD PRIMARY KEY (`CodiceUtente`,`CodiceCorso`,`NomeCorso`),
  ADD KEY `iscr2` (`CodiceCorso`);

--
-- Indici per le tabelle `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`Titolo`);

--
-- Indici per le tabelle `scheda`
--
ALTER TABLE `scheda`
  ADD PRIMARY KEY (`CodiceUtente`);

--
-- Indici per le tabelle `utente`
--
ALTER TABLE `utente`
  ADD PRIMARY KEY (`CodiceUtente`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `corso`
--
ALTER TABLE `corso`
  MODIFY `CodiceCorso` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT per la tabella `fattura`
--
ALTER TABLE `fattura`
  MODIFY `NumeroRicevuta` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT per la tabella `utente`
--
ALTER TABLE `utente`
  MODIFY `CodiceUtente` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `abbonamento`
--
ALTER TABLE `abbonamento`
  ADD CONSTRAINT `abb1` FOREIGN KEY (`CodiceUtente`) REFERENCES `utente` (`CodiceUtente`) ON DELETE CASCADE;

--
-- Limiti per la tabella `fattura`
--
ALTER TABLE `fattura`
  ADD CONSTRAINT `fatt1` FOREIGN KEY (`CodiceUtente`) REFERENCES `utente` (`CodiceUtente`) ON DELETE CASCADE;

--
-- Limiti per la tabella `iscrizionecorso`
--
ALTER TABLE `iscrizionecorso`
  ADD CONSTRAINT `iscr1` FOREIGN KEY (`CodiceUtente`) REFERENCES `utente` (`CodiceUtente`) ON DELETE CASCADE,
  ADD CONSTRAINT `iscr2` FOREIGN KEY (`CodiceCorso`) REFERENCES `corso` (`CodiceCorso`);

--
-- Limiti per la tabella `scheda`
--
ALTER TABLE `scheda`
  ADD CONSTRAINT `scheda` FOREIGN KEY (`CodiceUtente`) REFERENCES `utente` (`CodiceUtente`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
