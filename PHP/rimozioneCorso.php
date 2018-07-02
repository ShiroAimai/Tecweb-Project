<?php
	require_once('config.php');
	$userCode = $_SESSION['user_code'];
    $counter=1;
	$check=0;
	while($counter <= 5){
		if(isset($_POST["select".$counter.""])) {
			query("DELETE FROM iscrizionecorso WHERE CodiceUtente='$userCode' AND NomeCorso='".$_POST["select".$counter.""]."'");
			$counter++;
			$check++;
		}
		else {
			$counter++;
		}
	}
	if($check == 0) {
		header("Location: operazioneFallita.php");
		die();
	}
	close_connection();
    header("Location: operazioneCorsoAvvenuta.php?attr=1");
?>