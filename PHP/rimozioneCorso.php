<?php
	require_once('config.php');
	$userCode = $_SESSION['user_code'];
    $counter=1;

	if (isset($_POST['submit'])) {
		while(isset($_POST["select".$counter.""])) {
			query("DELETE FROM iscrizionecorso WHERE CodiceUtente='$userCode' AND NomeCorso='".$_POST["select".$counter.""]."'");
			$counter++;
		}
	}
	else {
		header("Location: operazioneFallita.php");
		die();
	}
	close_connection();
    header("Location: operazioneCorsoAvvenuta.php?attr=1");
?>