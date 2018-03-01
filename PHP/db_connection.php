<?php 
    $hostname = "localhost";
    $username = "root";
    $password = "";
    $database = "fsacchet";

//creazione connessione
    $connessione = new mysqli($hostname, $username, $password, $database);
    
//controllo connessione

    if ($connessione->connect_error)
        die("Connessione fallita: Servizio momentaneamente non disponibile. Riprovare pi&ugrave; tardi");
?>
