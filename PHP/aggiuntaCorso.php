<?php
	require_once('config.php');
	$userCode = $_SESSION['user_code'];
    $counter=1;

	while(isset($_POST["select".$counter.""])) {
		$codiceCorso = select("SELECT * FROM corso WHERE NomeCorso='".$_POST["select".$counter.""]."'");
		query("INSERT INTO iscrizionecorso (CodiceUtente, CodiceCorso, NomeCorso) VALUES ('$userCode', '".$codiceCorso[0]['CodiceCorso']."', '".$_POST["select".$counter.""]."')");
		$counter++;
    }
	close_connection();
    header("Location: operazioneCorsoAvvenuta.php?attr=0");
?>