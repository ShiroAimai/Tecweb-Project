<?php
	//crea o attiva la sessione
	session_start();
	$_SESSION['logged']= 0; //non sono più loggato
    unset($_SESSION['logged']);
	
	header("Location: ../HTML/Home.html");
?>