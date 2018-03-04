<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"  xml:lang="it" lang="it">
<head>
	<title> Galleria Foto | Body Evolution</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<link href="../CSS/Desktop.css" rel="stylesheet" type="text/css" media="handheld, screen"/>
	<link href="../CSS/Mobile.css" rel="stylesheet" type="text/css" media="handheld, screen and (max-width:480px), only screen and (max-device-width:480px)"/>
	<link href="../CSS/Print.css" rel="stylesheet" type="text/css" media="print"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>

<body>
	<div class="sfondonero">
		<?php
			$aux=$_GET['album'];
			$stampa="
			<div class=\"backbutton\">
			<a href=\"templategalleria.php?album=$aux\">
			<img id=\"backarrow\" src=\"../IMAGES/tornaindietro.png\" alt=\"TORNA ALLA GALLERIA FOTO DELL'ALBUM $aux\"/>
			</a></div>";
			$stampa.="<img class=\"imgsfondonero\" src=\"../galleria/".$_GET['nome']."\" alt=\"Immagine dell'album\"/>";
			echo $stampa;
		?>
	</div>
</body>
</html>
