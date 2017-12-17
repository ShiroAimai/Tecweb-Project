-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Dic 16, 2017 alle 14:28
-- Versione del server: 10.1.28-MariaDB
-- Versione PHP: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `palestra_tw`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `abbonamento`
--

CREATE TABLE `abbonamento` (
  `CodiceUtente` int(10) NOT NULL,
  `ScadenzaFitness` date DEFAULT NULL,
  `PuntiCorsi` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `abbonamento`
--

INSERT INTO `abbonamento` (`CodiceUtente`, `ScadenzaFitness`, `PuntiCorsi`) VALUES
(1, '2018-03-28', NULL),
(2, NULL, 20),
(3, '2018-03-28', 30);

-- --------------------------------------------------------

--
-- Struttura della tabella `corso`
--

CREATE TABLE `corso` (
  `CodiceCorso` int(10) NOT NULL,
  `NomeCorso` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `MesiFitness` int(10) DEFAULT NULL,
  `EntrateCorsi` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `fattura`
--

INSERT INTO `fattura` (`NumeroRicevuta`, `DataEmissione`, `ImportoEuro`, `CodiceUtente`, `MesiFitness`, `EntrateCorsi`) VALUES
(1, '2017-03-28', 300, 1, 12, NULL),
(2, '2017-03-28', 120, 2, NULL, 20),
(3, '2017-09-28', 420, 3, 6, 30);

-- --------------------------------------------------------

--
-- Struttura della tabella `galleria`
--

CREATE TABLE `galleria` (
  `NomeImmagine` varchar(50) NOT NULL,
  `Link` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `Immagine` varchar(50) DEFAULT NULL,
  `Testo` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `DataNascita` date NOT NULL,
  `CodiceFiscale` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `utente`
--

INSERT INTO `utente` (`CodiceUtente`, `Nome`, `Cognome`, `DataNascita`, `CodiceFiscale`) VALUES
(1, 'Francesco', 'Sacchetto', '1994-12-19', 'SCCFNC94T19G224O'),
(2, 'Nicola', 'Cisternino', '1994-01-12', 'CSTNCL95A12I452W'),
(3, 'Marco', 'Masiero', '1992-10-06', 'MSRMRC92R06B563K');

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
  ADD PRIMARY KEY (`NomeImmagine`,`Link`);

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
  MODIFY `CodiceUtente` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `abbonamento`
--
ALTER TABLE `abbonamento`
  ADD CONSTRAINT `abb1` FOREIGN KEY (`CodiceUtente`) REFERENCES `utente` (`CodiceUtente`);

--
-- Limiti per la tabella `fattura`
--
ALTER TABLE `fattura`
  ADD CONSTRAINT `fatt1` FOREIGN KEY (`CodiceUtente`) REFERENCES `utente` (`CodiceUtente`);

--
-- Limiti per la tabella `iscrizionecorso`
--
ALTER TABLE `iscrizionecorso`
  ADD CONSTRAINT `iscr1` FOREIGN KEY (`CodiceUtente`) REFERENCES `utente` (`CodiceUtente`),
  ADD CONSTRAINT `iscr2` FOREIGN KEY (`CodiceCorso`) REFERENCES `corso` (`CodiceCorso`);

--
-- Limiti per la tabella `scheda`
--
ALTER TABLE `scheda`
  ADD CONSTRAINT `scheda` FOREIGN KEY (`CodiceUtente`) REFERENCES `utente` (`CodiceUtente`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;