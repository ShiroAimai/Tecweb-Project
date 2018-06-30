<?php
	require_once('config.php');
	register('userCode');
	register('importo');
	register('mesi');
	register('entrate');
	$today = date("Y-m-d"); 
	$tipoUtente = select("SELECT Tipo from utente where CodiceUtente='$userCode'");
	if(isset($userCode) && !empty($userCode) && $tipoUtente[0]['Tipo'] !== "admin"
		&& isset($today) && !empty($today)
		&& isset($importo) && !empty($importo)
		&& ((isset($mesi) && !empty($mesi)) || (isset($entrate) && !empty($entrate)))) {		
			//aggiorno fattura
			query("INSERT INTO fattura (CodiceUtente, DataEmissione, ImportoEuro, MesiFitness, EntrateCorsi)
			VALUES ('$userCode','$today','$importo','$mesi','$entrate')");			
			header("Location:fatturaAggiunta.php");
	}
	else {
		header("Location: operazioneFallita.php");
		die();
	}
	close_connection();
?>