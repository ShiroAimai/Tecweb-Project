<?php

	require_once('config.php');
	register('userCode');
	register('importo');
	register('mesi');
	register('punti');
	$today = date("Y-m-d"); 

	$sql = "INSERT INTO fattura (CodiceUtente, DataEmissione, ImportoEuro, MesiFitness, PuntiCorsi)
	VALUES ('$userCode','$today','$importo','$mesi','$punti')";
	query($sql);

	header("Location:fattura aggiunta.php");

?>