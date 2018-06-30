<?php
	require_once('config.php');
	echo("<!DOCTYPE html>
		<html lang=\"it\">
		<head>
			<title>Galleria Foto | <span lang=\"en\">Body Evolution</span></title>
			<meta charset=\"utf-8\">
			<meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\"/>
			<link href=\"../CSS/Desktop.css\" rel=\"stylesheet\"/>
			<link href=\"../CSS/Tablet.css\" rel=\"stylesheet\" media=\"(min-width:768px) and (max-width:1024px)\"/>
			<link href=\"../CSS/Mobile.css\" rel=\"stylesheet\" media=\"(max-width: 767px)\"/>
			<link href=\"../CSS/Print.css\" rel=\"stylesheet\" media=\"print\"/>
		</head>");

	$body = "<body>";
	$closebody ="</body>";
	$div = "<div class=\"sfondonero\">";
	$closediv = "</div>";
	$closehtml = "</html>";

	echo $body;
	echo $div;

	$aux=$_GET['album'];
	$stampa="<div id=\"sfondonerocont\" ><a id=\"imgsfondoneroa\" href=\"albumGalleria.php?album=$aux\">Torna all'album ".$aux."</a>";
	$stampa.="<img class=\"imgsfondonero\" src=\"../Uploads/upGalleria/".$aux.'/'.$_GET['nome']."\" alt=\"Immagine dell'album ".$aux."\"/></div>";
	echo $stampa;

	echo $closediv;
	echo $closebody;
	echo $closehtml;
?>
