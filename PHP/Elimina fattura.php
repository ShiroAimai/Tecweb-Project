<?php
require_once('config.php');
register('fattura');
if($_SESSION['user_code'] == $_SESSION['user']) {
	header("Location: queryfallita.php");
} else {
	query("DELETE FROM fattura WHERE NumeroRicevuta=$fattura");
	if($_SESSION['user_type'] == 'admin') {
		header("Location:Lista admin.php");
	}
	else {
		header("Location:Lista utenti.php");
	}
}
?>