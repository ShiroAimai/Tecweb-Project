<?php
require_once('config.php');
register('user');
if($_SESSION['user_code'] == $user) {
	header("Location:Errore eliminazione utente.php");
} else {
	query("DELETE FROM utente WHERE CodiceUtente=$user");
	header("Location:Lista utenti.php");
}
?>