<?php

//inizio sessione
session_start();

//parametri di connessione al database
$hostname = "localhost";
$username = "root";
$password = "";
$database = "fsacchet";

//registra una variabile da una form nella pagina che richiama questa funzione
function register($varname) {
    global $$varname;
    if (isset($_REQUEST[$varname])) {
        $$varname = addslashes(stripslashes($_REQUEST[$varname])); // previene SQL injection
    } else {
        $$varname = null;
    }
}

//connessione al database
function connect()
{
    global $connessione, $hostname, $username, $password, $database;
    $connessione = new mysqli($hostname, $username, $password, $database);
    if ($connessione->connect_error) {
		header("Location: connessioneFallita.php");
		die();
    }
}

//chiusura connessione al database
function close_connection() {
	global $connessione;
	if(isset($connessione)){
		if(mysqli_ping($connessione)) {
			$connessione->close();
		}
	}
}

//effettua una query sul database ritornando il risultato
function query($sql) {
    global $connessione;
    if ($connessione == null) {
        connect();
    }
    $res = mysqli_query($connessione, $sql);
    if ($res == FALSE) {
		header("Location: operazioneFallita.php");
		die();
    }
    return $res;
}

//salva una query in una tabella, così facendo è possibile ad esempio effettuare il count del risultato
function select($sql) {
    $res = query($sql);
    $table = array();
    while ($row = mysqli_fetch_assoc($res)) {
        $table[] = $row;
    }
    return $table;
}

//controlla la validità dei valori inviati da una form
function test_input($data) {
	$data = trim($data); //restituisce il parametro $data privo degli spazi iniziali e finali
    $data = stripslashes($data); //rimuove i backslash da $data
    $data = htmlspecialchars($data); //converte i caratteri speciali in entità HTML
    return $data;
}

?>
