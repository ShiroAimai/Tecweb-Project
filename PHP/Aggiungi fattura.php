<?php
	require_once('config.php');
	register('userCode');
	register('importo');
	register('mesi');
	register('entrate');
	$today = date("Y-m-d"); 


	if(isset($userCode) && !empty($userCode) 
		&& isset($today) && !empty($today)
		&& isset($importo) && !empty($importo)
		&& isset($mesi) && !empty($mesi)
		&& isset($entrate) && !empty($entrate)) {		
			//aggiorno fattura
			query("INSERT INTO fattura (CodiceUtente, DataEmissione, ImportoEuro, MesiFitness, EntrateCorsi)
			VALUES ('$userCode','$today','$importo','$mesi','$entrate')");			
			header("Location:fattura aggiunta.php");
	}
	else {
		header("Location: queryfallita.php");
	}
?>