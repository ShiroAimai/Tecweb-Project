<?php
require_once('config.php');
register('user');
if($_SESSION['user_code'] == $user) {
	header("Location:Errore eliminazione utente.php");
} else {
	query("DELETE FROM utente WHERE CodiceUtente=$user");
	if($_SESSION['user_type'] == 'admin') {
		header("Location:Lista admin.php");
	}
	else {
		header("Location:Lista utenti.php");
	}
}
?>