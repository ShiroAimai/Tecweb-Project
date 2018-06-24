<?php

	require_once('config.php');
	register('userName');
	register('userSurname');
	register('pass');
	register('userMail');

	$admin = "admin";

	$sql = "INSERT INTO utente (Nome, Cognome, Password, Email, Tipo)
	VALUES ('$userName','$userSurname','$pass','$userMail','$admin')";
	query($sql);

	header("Location:admin aggiunto.php");

?>
