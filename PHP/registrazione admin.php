<?php

	require_once('config.php');
	register('userCode');
	register('userName');
	register('userSurname');
	register('pass');
	register('userMail');

	$admin = "admin";

	$sql = "INSERT INTO utente (CodiceUtente, Nome, Cognome, Password, Email, Tipo)
	VALUES ('$userCode','$userName','$userSurname','$pass','$userMail','$admin')";
	query($sql);

	header("Location:admin aggiunto.php");

?>
