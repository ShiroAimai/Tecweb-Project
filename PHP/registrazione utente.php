<?php

	require_once('config.php');
	register('userName');
	register('userSurname');
	register('pass');
	register('userMail');
	$user = "user";
	$sql = "INSERT INTO utente (Nome, Cognome, Password, Email, Tipo)
	VALUES ('$userName','$userSurname','$pass','$userMail','$user')";
	if(query($sql) == FALSE)
		header("Location: queryfallita.php");

	header("Location:utente aggiunto.php");

?>
