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
	$stampa="
	<div class=\"backbutton\">
	<a href=\"templategalleria.php?album=$aux\">
	<img id=\"backarrow\" src=\"../IMAGES/tornaindietro.png\" alt=\"TORNA ALLA GALLERIA FOTO DELL'ALBUM $aux\"/>
	</a></div>";
	$stampa.="<img class=\"imgsfondonero\" src=\"../galleria/".$_GET['nome']."\" alt=\"Immagine dell'album\"/>";
	echo $stampa;

	echo $closediv;
	echo $closebody;
	echo $closehtml;
?>