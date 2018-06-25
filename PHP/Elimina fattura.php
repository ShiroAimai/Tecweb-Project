<?php
	require_once('config.php');
	register('fattura');
	query("DELETE FROM fattura WHERE NumeroRicevuta=$fattura");
	$aux=$_GET['user'];
	header("Location:Lista fatture.php?user=$aux");
?>