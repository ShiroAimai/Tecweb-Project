<?php
	require_once('config.php');
	register('userCode');
	register('importo');
	register('mesi');
	register('entrate');
	$today = date("Y-m-d"); 


	if(isset($userCode) && isset($today) && isset($importo) && isset($mesi) && isset($entrate))
	{		
			//aggiorno fattura
			$sql = "INSERT INTO fattura (CodiceUtente, DataEmissione, ImportoEuro, MesiFitness, EntrateCorsi)
			VALUES ('$userCode','$today','$importo','$mesi','$entrate')";
			if(query($sql) == FALSE) //da ampliare con gestione errori
				header("Location:queryfallita.php");
			
			header("Location:fattura aggiunta.php");
	}
	else
		header("Location: queryfallita.php");

	

?>