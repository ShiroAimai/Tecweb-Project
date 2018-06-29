<?php
	require_once('config.php');
	register('userName');
	register('userSurname');
	register('pass');
	register('userMail');
	$admin = "admin";

	$userName = test_input($userName);
    $userSurname = test_input($userSurname);
	$pass = test_input($pass);
    $userMail = test_input($userMail);
	if(isset($userName) && !empty($userName) && preg_match("/^[a-zA-Z ]*$/",$userName) && isset($userSurname) && !empty($userSurname) && preg_match("/^[a-zA-Z ]*$/",$userSurname) && isset($pass) && !empty($pass) && isset($userMail) && !empty($userMail) && filter_var($userMail, FILTER_VALIDATE_EMAIL)) {
		query("INSERT INTO utente (Nome, Cognome, Password, Email, Tipo) VALUES ('$userName','$userSurname','$pass','$userMail','$admin')");
		close_connection();
		header("Location:adminAggiunto.php");
	}
	else {
		header("Location: operazioneFallita.php");
	}
?>