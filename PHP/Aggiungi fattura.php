<?php

	require_once('config.php');
	register('userCode');
	register('importo');
	register('mesi');
	register('entrate');
	$today = date("Y-m-d"); 
	register('corsiselect1');
	register('corsiselect2');
	register('corsiselect3');
	register('corsiselect4');
	register('corsiselect5');

	if(isset($userCode) && isset($today) && isset($importo) && isset($mesi) && isset($entrate))
	{		
		
		if(isset($corsiselect1) || isset($corsiselect2) || isset($corsiselect3) || isset($corsiselect4) || isset($corsiselect5))
		{
			//aggiorno fattura
			$sql = "INSERT INTO fattura (CodiceUtente, DataEmissione, ImportoEuro, MesiFitness, EntrateCorsi)
			VALUES ('$userCode','$today','$importo','$mesi','$entrate')";
			query($sql); //da ampliare con gestione errori

			//aggiorno la tabella iscrizionecorso
			//ampliare con gestione errori query
			if(isset($corsiselect1))
				query("INSERT INTO iscrizionecorso (CodiceUtente, CodiceCorso, NomeCorso) VALUES ('$userCode', 1, '$corsiselect1')");
			if(isset($corsiselect2))
				query("INSERT INTO iscrizionecorso (CodiceUtente, CodiceCorso, NomeCorso) VALUES ('$userCode', 5, '$corsiselect2')");
			if(isset($corsiselect3))
				query("INSERT INTO iscrizionecorso (CodiceUtente, CodiceCorso, NomeCorso) VALUES ('$userCode', 4, '$corsiselect3')");
			if(isset($corsiselect4))
				query("INSERT INTO iscrizionecorso (CodiceUtente, CodiceCorso, NomeCorso) VALUES ('$userCode', 3, '$corsiselect4')");
			if(isset($corsiselect5))
				query("INSERT INTO iscrizionecorso (CodiceUtente, CodiceCorso, NomeCorso) VALUES ('$userCode', 2, '$corsiselect5')");
			
			header("Location:fattura aggiunta.php");
		}
		else
			header("Location: queryfallita.php");
	}
	else
		header("Location: queryfallita.php");

	

?>