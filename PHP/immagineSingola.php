<?php
	require_once('config.php');
	echo("<!DOCTYPE html>
		<html lang=\"it\">
		<head>
			<title>Galleria Foto | <span lang=\"en\">Body Evolution</span></title>
			<meta charset=\"utf-8\">
			<link href=\"../CSS/Desktop.css\" rel=\"stylesheet\" media=\"handheld, screen\"/>
			<link href=\"../CSS/Tablet.css\" rel=\"stylesheet\" media=\"screen and (min-width:768px) and (max-width:1024px), only screen and (min-device-width:768px) and (max-device-width:1024px)\"/>
			<link href=\"../CSS/Mobile.css\" rel=\"stylesheet\" media=\"handheld, screen and (max-width: 767px), only screen and (max-device-width:767px)\"/>
			<link href=\"../CSS/Print.css\" rel=\"stylesheet\" media=\"print\"/>
			<meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\"/>
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
