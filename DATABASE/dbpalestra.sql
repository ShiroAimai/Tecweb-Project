-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Creato il: Feb 28, 2018 alle 12:59
-- Versione del server: 10.1.30-MariaDB
-- Versione PHP: 7.2.1

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
  `EntrateCorsi` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `abbonamento`
--

INSERT INTO `abbonamento` (`CodiceUtente`, `ScadenzaFitness`, `EntrateCorsi`) VALUES
(1, '2018-03-28', NULL),
(2, NULL, 20),
(3, '2018-05-28', 32);

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
(3, '2017-09-28', 420, 3, 6, 30),
(5, '2018-02-28', 6, 3, NULL, 1),
(10, '2018-02-28', 6, 3, NULL, 1),
(14, '2018-02-28', 30, 3, 1, NULL),
(16, '2018-02-28', 60, 3, 2, NULL);

--
-- Trigger `fattura`
--
DELIMITER $$
CREATE TRIGGER `updateAbbonamento` AFTER INSERT ON `fattura` FOR EACH ROW BEGIN
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
SELECT DATE_ADD(abbonamento.ScadenzaFitness, INTERVAL new.MesiFitness MONTH) INTO newdata FROM abbonamento WHERE new.CodiceUtente = abbonamento.CodiceUtente;
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
-- Indici per le tabelle `iscrizionecorso`
--
ALTER TABLE `iscrizionecorso`
  ADD PRIMARY KEY (`CodiceUtente`,`CodiceCorso`,`NomeCorso`),
  ADD KEY `iscr2` (`CodiceCorso`);

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
  MODIFY `NumeroRicevuta` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
