<?php
	require_once('config.php');
	$head = file_get_contents("../Templates/headerImmagineSingola.txt");
	echo $head;

	$body = "<body>";
	$closebody ="</body>";
	$div = "<div class=\"sfondonero\">";
	$closediv = "</div>";
	$closehtml = "</html>";

	echo $body;
	echo $div;

	$aux=$_GET['album'];
	$stampa="<div id=\"sfondonerocont\" ><a id=\"imgsfondoneroa\" href=\"templategalleria.php?album=$aux\">Torna all'album ".$aux."</a>";
	$stampa.="<img class=\"imgsfondonero\" src=\"../galleria/".$aux.'/'.$_GET['nome']."\" alt=\"Immagine dell'album ".$aux."\"/></div>";
	echo $stampa;

	echo $closediv;
	echo $closebody;
	echo $closehtml;
?>