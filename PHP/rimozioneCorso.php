<?php
	require_once('config.php');
	$userCode = $_SESSION['user_code'];

    $counter=1;


   while(isset($_POST["select".$counter.""]))
    {
  
       query("DELETE FROM iscrizionecorso WHERE CodiceUtente='$userCode' AND NomeCorso='".$_POST["select".$counter.""]."'");


       $counter++;
    }

    header("Location: operazioneCorsoAvvenuta.php?attr=1");


?>