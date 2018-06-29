<?php
	require_once('config.php');
	register('userName');
	register('userSurname');
	register('pass');
	register('userMail');
	$user = "user";

	$userName = test_input($userName);
    $userSurname = test_input($userSurname);
	$pass = test_input($pass);
    $userMail = test_input($userMail);
	if(isset($userName) && preg_match("/^[a-zA-Z ]*$/",$userName) && !empty($userName) && isset($userSurname) && !empty($userSurname) && preg_match("/^[a-zA-Z ]*$/",$userSurname) && isset($pass) && !empty($pass) && isset($userMail) && filter_var($userMail, FILTER_VALIDATE_EMAIL) && !empty($userMail)) {
		query("INSERT INTO utente (Nome, Cognome, Password, Email, Tipo) VALUES ('$userName','$userSurname','$pass','$userMail','$user')");
		close_connection();
		header("Location:utenteAggiunto.php");
	}
	else {
		header("Location: operazioneFallita.php");
	}
?>
