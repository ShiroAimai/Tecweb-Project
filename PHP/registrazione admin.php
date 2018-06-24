<?php
	require_once('config.php');
	register('userName');
	register('userSurname');
	register('pass');
	register('userMail');
	$admin = "admin";

	if(isset($userName) && !empty($userName) && isset($userSurname) && !empty($userSurname) && isset($pass) && !empty($pass) && isset($userMail) && !empty($userMail)) {
		$userName = test_input($userName);
        $userSurname = test_input($userSurname);
		$pass = test_input($pass);
        $userMail = test_input($userMail);
		query("INSERT INTO utente (Nome, Cognome, Password, Email, Tipo) VALUES ('$userName','$userSurname','$pass','$userMail','$admin')");
		header("Location:admin aggiunto.php");
	}
	else {
		header("Location: queryfallita.php");
	}
?>