<?php
	require_once('config.php');
	register('userCode');
	register('pass');

	$utente_trovato = select("
		SELECT * FROM utente
		WHERE CodiceUtente='$userCode'
		AND Password='$pass';
	");

	if(count($utente_trovato) > 0){
		$_SESSION['user_code'] = $utente_trovato[0]['CodiceUtente'];
		$_SESSION['user_name'] = $utente_trovato[0]['Nome'];
		$_SESSION['user_surname'] = $utente_trovato[0]['Cognome'];
		$_SESSION['user_type'] = $utente_trovato[0]['Tipo'];
		if($_SESSION['user_type'] == 'admin')
			header("Location:AdminPanel.php");
		else
			header("Location:UserPanel.php");
	}
	else { 
	  header("Location:../HTML/ErroreLogin.html");
	}
?>
