<?php
	function printHead($title){
		echo("
		<!DOCTYPE html>
		<html lang=\"it\">
		<head>
			<title>".$title." | Body Evolution</title>
			<meta charset=\"UTF-8\">
			<meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\"/>
			<link href=\"../CSS/Desktop.css\" rel=\"stylesheet\" media=\"screen\"/>
			<link href=\"../CSS/Tablet.css\" rel=\"stylesheet\" media=\"screen and (min-width:768px) and (max-width:1024px)\"/>
			<link href=\"../CSS/Mobile.css\" rel=\"stylesheet\" media=\"screen and (max-width: 767px)\"/>
			<link href=\"../CSS/Print.css\" rel=\"stylesheet\" media=\"print\"/>
			<link href=\"https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css\" rel=\"stylesheet\"/>
		</head>

		<body>
			<div id=\"contenitore\">
				<div id=\"Intestazione\">
					<a href=\"#corpo\" id=\"saltaMenu\">Vai al corpo della pagina</a>
					<a class=\"sandwich\" title=\"Mostra barra di navigazione\" onclick=\"menuResponsive()\">&#9776;</a>
		");
		if($title == 'Home') {
			echo("<a class=\"active\"><img id=\"logo\" src=\"../IMAGES/logo.png\" alt=\"Logo Body Evolution\" title=\"Logo Body Evolution\"/></a>
			<div class=\"printable\"> BODY EVOLUTION FITNESS</div>");
		}
		else {
			echo("<a href=\"Home.php\"><img id=\"logo\" src=\"../IMAGES/logo.png\" alt=\"Logo Body Evolution\" title=\"Vai alla home\"/></a>
			<div class=\"printable\"> BODY EVOLUTION FITNESS</div>");
		}
		if($title == 'Area Personale') {
			echo("<a class=\"active\"><img id=\"user\" src=\"../IMAGES/user.png\" alt=\"Immagine login\"/></a>
			<div class=\"Menu\" id=\"myMenu\">");
		}
		else {
			echo("<a href=\"areaPersonale.php\"><img id=\"user\" src=\"../IMAGES/user.png\" title=\"Vai all'area personale\" alt=\"Immagine login\"/></a>
			<div class=\"Menu\" id=\"myMenu\">");
		}
		if($title == 'Home') {
			echo("<a class=\"active\"><span lang=\"en\">Home</span></a>");
		}
		else {
			echo("<a href=\"Home.php\" title=\"Vai alla home\"><span lang=\"en\">Home</span></a>");
		}
		if($title == 'Attivita') {
			echo("<a class=\"active\">Attivit&agrave;</a>");
		}
		else {
			echo("<a href=\"Attivita.php\" title=\"Vai alle attività\">Attivit&agrave;</a>");
		}
		if($title == 'News') {
			echo("<a class=\"active\"><span lang=\"en\">News</span></a>");
		}
		else {
			echo("<a href=\"News.php\" title=\"Vai alle news\"><span lang=\"en\">News</span></a>");
		}
		if($title == 'Galleria' || $title == 'Galleria Foto') {
			echo("<a class=\"active\">Galleria</a>");
		}
		else {
			echo("<a href=\"Galleria.php\" title=\"Vai alla galleria\">Galleria</a>");
		}
		if($title == 'Calendario') {
			echo("<a class=\"active\">Calendario</a>");
		}
		else {
			echo("<a href=\"Calendario.php\" title=\"Vai al calendario\">Calendario</a>");
		}
		if($title == 'Chi Siamo') {
			echo("<a class=\"active\">Chi siamo</a>");
		}
		else {
			echo("<a href=\"chiSiamo.php\" title=\"Vai a chi siamo\">Chi siamo</a>");
		}
		if($title == 'Dove Siamo') {
			echo("<a class=\"active\">Dove siamo</a>");
		}
		else {
			echo("<a href=\"doveSiamo.php\" title=\"Vai a dove siamo\">Dove siamo</a>");
		}
		if($title == 'Area Personale') {
			echo("<a id=\"panelButton\" class=\"active\">Area Personale</a></div></div>");
		}
	}
?>
