<?php
	require_once('config.php');
	register('user');
	register('type');
	if($_SESSION['user_code'] == $user) {
		header("Location:Errore eliminazione utente.php");
	} 
	else if($type == 'admin') {
		query("DELETE FROM utente WHERE CodiceUtente=$user");
		close_connection();
		header("Location:Gestisci admin.php");
	}
	else {
		query("DELETE FROM utente WHERE CodiceUtente=$user");
		close_connection();
		header("Location:Gestisci utenti.php");
	}
?>