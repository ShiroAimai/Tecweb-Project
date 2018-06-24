<?php

//inizio sessione
session_start();

//parametri di connessione al database
$hostname = "localhost";
$username = "root";
$password = "";
$database = "fsacchet";

//registra una variabile da una form nella pagina che richiama questa funzione
function register($varname)
{
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
    }
}

//effettua una query sul database ritornando il risultato
function query($sql)
{
    global $connessione;
    if ($connessione == null) {
        connect();
    }
    $res = mysqli_query($connessione, $sql);
    if ($res == FALSE) {
       header("Location queryfallita.php");
    }
    return $res;
}

//salva una query in una tabella, così facendo è possibile ad esempio effettuare il count del risultato
function select($sql)
{
    $res = query($sql);
    if($res == FALSE)
        header("Location: queryfallita.php");
    $table = array();
    while ($row = mysqli_fetch_assoc($res)) {
        $table[] = $row;
    }
    return $table;
}

?>
