<?php
	require_once('config.php');
	register('userName');
	register('userSurname');
	register('pass');
	register('userMail');
	$user = "user";

	if(isset($userName) && preg_match("/^[a-zA-Z ]*$/",$userName) && !empty($userName) && isset($userSurname) && !empty($userSurname) && preg_match("/^[a-zA-Z ]*$/",$userSurname) && isset($pass) && !empty($pass) && isset($userMail) && filter_var($userMail, FILTER_VALIDATE_EMAIL) && !empty($userMail)) {
		$userName = test_input($userName);
        $userSurname = test_input($userSurname);
		$pass = test_input($pass);
        $userMail = test_input($userMail);
		query("INSERT INTO utente (Nome, Cognome, Password, Email, Tipo) VALUES ('$userName','$userSurname','$pass','$userMail','$user')");
		close_connection();
		header("Location:utente aggiunto.php");
	}
	else {
		header("Location: queryfallita.php");
	}
?>
