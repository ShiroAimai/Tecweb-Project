<?php
	require_once('config.php');
	register('fattura');
	query("DELETE FROM fattura WHERE NumeroRicevuta=$fattura");
	$aux=$_GET['user'];
	close_connection();
	header("Location:listaFatture.php?user=$aux");
?>