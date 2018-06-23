<?php

	require_once('config.php');
	register('userCode');
	register('importo');
	register('mesi');
	register('punti');
	$today = date("Y-m-d"); 
	register('corsiselect1');
	register('corsiselect2');
	register('corsiselect3');
	register('corsiselect4');
	register('corsiselect5');

	$sql = "INSERT INTO fattura (CodiceUtente, DataEmissione, ImportoEuro, MesiFitness, EntrateCorsi)
	VALUES ('$userCode','$today','$importo','$mesi','$punti')";
	query($sql);
	if(isset($corsiselect1))
		query("INSERT INTO iscrizionecorso (CodiceUtente, CodiceCorso, NomeCorso) VALUES ('$usercode,'1','$corsiselect1')");
	if(isset($corsiselect2))
		query("INSERT INTO iscrizionecorso (CodiceUtente, CodiceCorso, NomeCorso) VALUES ('$usercode,'5','$corsiselect2')");
	if(isset($corsiselect3))
		query("INSERT INTO iscrizionecorso (CodiceUtente, CodiceCorso, NomeCorso) VALUES ('$usercode,'4','$corsiselect3')");
	if(isset($corsiselect4))
		query("INSERT INTO iscrizionecorso (CodiceUtente, CodiceCorso, NomeCorso) VALUES ('$usercode,'3','$corsiselect4')");
	if(isset($corsiselect5))
		query("INSERT INTO iscrizionecorso (CodiceUtente, CodiceCorso, NomeCorso) VALUES ('$usercode,'2','$corsiselect5')");
	

	header("Location:fattura aggiunta.php");

?>