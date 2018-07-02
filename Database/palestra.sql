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
(2, '2018-05-28', 30),
(3, '2018-01-01', 100),
(4, '2018-04-10', 0),
(5, '2019-01-01', 50);

-- --------------------------------------------------------

--
-- Struttura della tabella `corso`
--

CREATE TABLE `corso` (
  `CodiceCorso` int(10) NOT NULL,
  `NomeCorso` char(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `corso`
--

INSERT INTO `corso` (`CodiceCorso`, `NomeCorso`) VALUES
(1, 'Spinning'),
(2, 'Fit boxe'),
(3, 'Power pump'),
(4, 'Jump fit'),
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

-- Dump dei dati per la tabella `fattura`
--

INSERT INTO `fattura` (`NumeroRicevuta`, `DataEmissione`, `ImportoEuro`, `CodiceUtente`, `MesiFitness`, `EntrateCorsi`) VALUES
(1, '2018-05-28', 70, 2, 1, 5),
(2, '2018-03-10', 140, 3, 2, 10),
(3, '2018-05-01', 70, 4, 1, 5),
(4, '2017-01-01', 70, 5, 1, 5);

--

-- --------------------------------------------------------

--
-- Struttura della tabella `galleria`
--

CREATE TABLE `galleria` (
  `NomeImmagine` varchar(50) NOT NULL,
  `Data` date NOT NULL,
  `Album` char(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `galleria`
--

INSERT INTO `galleria` (`NomeImmagine`, `Data`, `Album`) VALUES
('allenamento.jpg', '2018-04-01', 'Palestra'),
('corsi.jpg', '2018-04-01', 'Palestra'),
('fitboxe.jpg', '2018-04-01', 'Palestra'),
('fitness.jpg', '2018-04-01', 'Palestra'),
('jumpfit.jpg', '2018-04-01', 'Palestra'),
('trainer.jpg', '2018-04-01', 'Palestra'),
('party.jpg', '2018-01-01', 'Party'),
('partydue.jpg', '2018-01-01', 'Party'),
('pizzata.jpg', '2018-05-13', 'Pizzata'),
('pizzata2.jpg', '2018-05-13', 'Pizzata'),
('gara.jpg', '2018-05-13', 'Gara Deadlift'),
('gara2.jpg', '2018-05-13', 'Gara Deadlift');

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
  `NomeCorso` char(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `iscrizionecorso`
--

INSERT INTO `iscrizionecorso` (`CodiceUtente`, `CodiceCorso`, `NomeCorso`) VALUES
(2, 2, 'FitBoxe'),
(3, 2, 'FitBoxe');

-- --------------------------------------------------------

--
-- Struttura della tabella `news`
--

CREATE TABLE `news` (
  `Titolo` char(50) NOT NULL,
  `Data` date NOT NULL,
  `Immagine` varchar(50) NOT NULL,
  `Descrizione` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `news`
--

INSERT INTO `news` (`Titolo`, `Data`, `Immagine`, `Descrizione`) VALUES
('Gara Deadlift', '2018-07-02', 'gara.jpg', 'Venerdì 20 Luglio presso la palestra Body Evolution di Cavarzere si terrà una gara di Deadlift.
Alla gara può partecipare chiunque, indipendentemente dall\'età, dal sesso e dal massimale di stacco da terra.
Le categorie di peso verranno decise in base al numero di iscritti e verranno comunicate una settimana prima della gara.
Saranno premiati i primi 3 uomini e le prime 3 donne, in più diversi premi in palio.
Il costo della gara è di 10 euro, più 5 euro per l\'assicurazione (tranne per i partecipanti già iscritti alla Body Evolution, i quali sono già assicurati).
L\'iscrizione può essere effettuata fino a cinque giorni prima della gara entro il 15 Luglio.
Oltre questa data alla quota prevista si applicherà un supplemento di 5 euro.
Per maggiori indformazioni e per iscriversi alla gara rivolgersi presso la segreteria della palestra.'),
('Pizzata estiva', '2018-07-01', 'pizzata.jpg', 'Non mancare alla pizzata estiva con i membri della palestra Body Evolution.
L\'evento si terrà Mercoledì 11 Luglio alle ore 20:45.
Giro pizza con 10 tipi di pizza (8 salate + 2 dolci) a spicchi.
Costo 14 euro bevande comprese.
Prenotazione e pagamento entro il 10 Luglio presso la segreteria della palestra');


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

--
-- Dump dei dati per la tabella `scheda`
--

INSERT INTO `scheda` (`CodiceUtente`, `LinkScheda`) VALUES
(2, 'fsacchet.pdf');

-- --------------------------------------------------------

--
-- Struttura della tabella `utente`
--

CREATE TABLE `utente` (
  `CodiceUtente` int(10) NOT NULL,
  `Nome` char(150) NOT NULL,
  `Cognome` char(150) NOT NULL,
  `Password` char(50) NOT NULL,
  `Email` char(50) NOT NULL,
  `Tipo` char(50) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `utente`
--

INSERT INTO `utente` (`CodiceUtente`, `Nome`, `Cognome`, `Password`, `Email`, `Tipo`) VALUES
(1, 'Mario', 'Rossi', 'admin', 'mario.rossi@gmail.com', 'admin'),
(2, 'Francesco', 'Sacchetto', 'user', 'francesco.sacchetto@gmail.com', 'user'),
(3, 'Nicola', 'Cisternino', 'user', 'nicola.cisternino@gmail.com', 'user'),
(4, 'Marco', 'Masiero', 'user', 'marco.masiero@gmail.com', 'user'),
(5, 'Stefano', 'Nordio', 'user', 'stefano.nordio@gmail.com', 'user'),
(6, 'Roberto', 'Verdi', 'admin', 'roberto.verdi@hotmail.com', 'admin');

--

--
-- Trigger `utente`
--
DELIMITER $$
CREATE TRIGGER `updabb` AFTER INSERT ON `utente` FOR EACH ROW BEGIN
DECLARE codut INTEGER;
DECLARE scad DATE;
DECLARE tipo char(50);

SELECT new.Tipo INTO tipo;
IF (tipo = 'user')
THEN
SELECT new.CodiceUtente INTO codut;
SELECT DATE_ADD(CURRENT_DATE, INTERVAL 1 DAY) INTO scad;
INSERT INTO `abbonamento`(`CodiceUtente`, `ScadenzaFitness`) VALUES (codut, scad);
INSERT INTO `scheda`(`CodiceUtente`) VALUES (codut);

END IF;

END
$$
DELIMITER ;

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
