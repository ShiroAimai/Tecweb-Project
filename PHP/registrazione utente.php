<?php

	require_once('config.php');
	register('userCode');
	register('userName');
	register('userSurname');
	register('pass');
	register('userMail');
	$user = "user";
	$sql = "INSERT INTO utente (CodiceUtente, Nome, Cognome, Password, Email, Tipo)
	VALUES ('$userCode','$userName','$userSurname','$pass','$userMail','$user')";
	query($sql);

	header("Location:utente aggiunto.php");

?>
