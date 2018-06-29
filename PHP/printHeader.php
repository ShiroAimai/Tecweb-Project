<?php
	function printHead($title){
		echo("
		<!DOCTYPE html>
		<html lang=\"it\">
		<head>
			<title>".$title." | Body Evolution</title>
			<meta charset=\"utf-8\">
			<meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\"/>
			<link href=\"../CSS/Desktop.css\" rel=\"stylesheet\" media=\"handheld, screen\"/>
			<link href=\"../CSS/Tablet.css\" rel=\"stylesheet\" media=\"screen and (min-width:768px) and (max-width:1024px), only screen and (min-device-width:768px) and (max-device-width:1024px)\"/>
			<link href=\"../CSS/Mobile.css\" rel=\"stylesheet\" media=\"handheld, screen and (max-width: 767px), only screen and (max-device-width:767px)\"/>
			<link href=\"../CSS/Print.css\" rel=\"stylesheet\" media=\"print\"/>
			<link href=\"https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css\" rel=\"stylesheet\"/>
		</head>

		<body>
			<div id=\"contenitore\">
				<div id=\"Intestazione\">
					<a class=\"sandwich\" onclick=\"myFunction()\">&#9776;</a>
		");
		if($title == 'Home') {
			echo("<a class=\"active\"><img id=\"logo\" src=\"../IMAGES/logo.png\" alt=\"Body Evolution logo\"/></a>
			<div class=\"printable\"> BODY EVOLUTION FITNESS</div>");
		}
		else {
			echo("<a href=\"Home.php\"><img id=\"logo\" src=\"../IMAGES/logo.png\" alt=\"Body Evolution logo\"/></a>
			<div class=\"printable\"> BODY EVOLUTION FITNESS</div>");
		}
		if($title == 'Area Personale') {
			echo("<a class=\"active\"><img id=\"user\" src=\"../IMAGES/user.png\" alt=\"login utente\"/></a>
			<div class=\"Menu\" id=\"myMenu\">");
		}
		else {
			echo("<a href=\"areaPersonale.php\"><img id=\"user\" src=\"../IMAGES/user.png\" alt=\"login utente\"/></a>
			<div class=\"Menu\" id=\"myMenu\">");
		}
		if($title == 'Home') {
			echo("<a class=\"active\">Home</a>");
		}
		else {
			echo("<a href=\"Home.php\">Home</a>");
		}
		if($title == 'Attivita') {
			echo("<a class=\"active\">Attivit&agrave;</a>");
		}
		else {
			echo("<a href=\"Attivita.php\">Attivit&agrave;</a>");
		}
		if($title == 'News') {
			echo("<a class=\"active\">News</a>");
		}
		else {
			echo("<a href=\"News.php\"><span xml:lang=\"en\">News</span></a>");
		}
		if($title == 'Galleria' || $title == 'Galleria Foto') {
			echo("<a class=\"active\">Galleria</a>>");
		}
		else {
			echo("<a href=\"Galleria.php\">Galleria</a>");
		}
		if($title == 'Calendario') {
			echo("<a class=\"active\">Calendario</a>");
		}
		else {
			echo("<a href=\"Calendario.php\">Calendario</a>");
		}
		if($title == 'Chi Siamo') {
			echo("<a class=\"active\">Chi siamo</a>");
		}
		else {
			echo("<a href=\"chiSiamo.php\">Chi siamo</a>");
		}
		if($title == 'Dove Siamo') {
			echo("<a class=\"active\">Dove siamo</a>");
		}
		else {
			echo("<a href=\"doveSiamo.php\">Dove siamo</a>");
		}
		if($title == 'Area Personale') {
			echo("<button disabled>Area Personale</button></div></div>");
		}
	}
?>
