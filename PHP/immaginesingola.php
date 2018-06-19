<?php
	require_once('config.php');
	$head = file_get_contents("../Templates/headerImmagineSingola.txt");
	echo $head;

	$body1 = "<body>";
	$body2 = "</body>";
	$div1 = "<div class=\"sfondonero\">";
	$div2 = "</div>";

	echo $body1;
	echo $div1;

	$aux=$_GET['album'];
	$stampa="
	<div class=\"backbutton\">
	<a href=\"templategalleria.php?album=$aux\">
	<img id=\"backarrow\" src=\"../IMAGES/tornaindietro.png\" alt=\"TORNA ALLA GALLERIA FOTO DELL'ALBUM $aux\"/>
	</a></div>";
	$stampa.="<img class=\"imgsfondonero\" src=\"../galleria/".$_GET['nome']."\" alt=\"Immagine dell'album\"/>";
	echo $stampa;

	echo $div2;
	echo $body2;
	$closehtml = "</html>";
	echo $closehtml;
?>