<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
		
<?php require_once('config.php'); ?>

<html xmlns="http://www.w3.org/1999/xhtml"  xml:lang="it" lang="it">
<head>
	<title> Galleria Album | Body Evolution</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<link href="../CSS/Desktop.css" rel="stylesheet" type="text/css" media="handheld, screen"/>
	<link href="../CSS/Mobile.css" rel="stylesheet" type="text/css" media="handheld, screen and (max-width:480px), only screen and (max-device-width:480px)"/>
	<link href="../CSS/Print.css" rel="stylesheet" type="text/css" media="print"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>

<body>
	<div id="contenitore">
		<div id="Intestazione">
			<a class="sandwich" onclick="myFunction()">&#9776;</a>
			<a href="Home.php"><img id="logo" src="../IMAGES/logo.png" alt="Body Evolution logo"/></a>
			<a href="AreaPersonale.php"><img id="user" src="../IMAGES/user.png" alt="login utente"/></a>
			<div class="Menu" id="myMenu">
			<a href="Home.php">Home</a>
			<a href="Attivita.php">Attivit&agrave;</a>
			<a href="News.php"><span xml:lang="en">News</span></a>
			<a class="active">Galleria</a>
			<a href="Calendario.php">Calendario</a>
			<a href="ChiSiamo.php">Chi siamo</a>
			<a href="DoveSiamo.php">Dove siamo</a>
			<?php include '../PHP/login_logout_button.php' ?>
			</div>
		</div>
		<div id="Presentazione">
				<h1 id="titoloPagina">GALLERIA ALBUM</h1>
				<p>Guarda le foto scattate dai nostri Trainer qui alla <span lang="en">Body Evolution</span>!</p>
		</div>
		<div class="gallerymain">

			<?php
				$query=query("
					SELECT NomeImmagine, Album 
					FROM galleria 
					GROUP BY Album;
				");
				$aux=null; $stampa=null;
				while($row = mysqli_fetch_assoc($query))
						{	
							
							if($aux==null)//caso in cui siamo appena entrati a prelevare nel database
								{
								$stampa = "<a href=\"templategalleria.php?album=".$row['Album']."\"><div class=\"album\"> <h3 class=\"albumname\">".$row['Album']."</h3><img class=\"galleryimg\" src=\"../galleria/".$row['NomeImmagine']."\" alt=\"Immagine dell'album ".$row['Album']."\"></div></a>";// aggiungere il primo $row di ogni album
									$aux=$row['Album'];
								}
							else if($row['Album']!=$aux)
							{
								echo $stampa;
								$stampa="<a href=\"templategalleria.php?album=".$row['Album']."\"><div class=\"album\"> <h3 class=\"albumname\">".$row['Album']."</h3><img class=\"galleryimg\" src=\"../galleria/".$row['NomeImmagine']."\" alt=\"Immagine dell'album ".$row['Album']."\"/></div></a>";
								$aux=$row['Album'];
							}
						
							
						}
						
						echo $stampa;
						$connessione->close();
			?>
		</div>
		<div id="Footer">
				<div id="footersx">
					<a href="Home.php"><img id="logofooter" src="../IMAGES/logo.png" alt="Body Evolution logo"/></a>
					<p><span class="blocco">Via Cavour, 18</span>
					<span class="blocco">30014 Cavarzere (VE)</span>
					<span class="blocco">tel. 340 9473426</span>
					<span class="blocco">body_evolution@libero.it</span></p>
					<h3>ORARI PALESTRA</h3>
					<p><span class="blocco">Lun./Ven. dalle 9.00 alle 22.00</span>
					<span class="blocco">Sab. dalle 10.00 alle 12.00 e dalle 15.00 alle 18.00</span>
					<span class="blocco">Dom. dalle 10.00 alle 12.00</span></p>
					<a href="https://it-it.facebook.com/BodyEvolutionPalestra"><img id="logofacebook" src="../IMAGES/facebook.png" alt="Link pagina Facebook"/></a>
				</div>
				<div id="footercx">
					<h3>INFORMAZIONI</h3>
					<ul>
						<li>Prova GRATUITA per tutti i nuovi amici</li>
						<li>SCHEDE di allenamento personalizzate e gratuite</li>
						<li>Vasto parco macchine su 400 mq di sala fitness</li>
						<li>Istruttori qualificati sempre presenti</li>
						<li>Ampia scelta di corsi in pi&ugrave; fasce orarie</li>
						<li>Sala corsi attrezzata su 280 mq</li>
						<li>Ampio parcheggio</li>
					</ul>
				</div>
				<div id="footerdx">
					<img id="Coni" src="../IMAGES/Coni.png" alt="Affiliazione Coni"/>
					<img id="asi" src="../IMAGES/Asi.png" alt="Affiliazione asi"/>
					<p>La “BODY EVOLUTION A.S.D” &egrave; un'associazione senza scopo di lucro affiliata agli enti/federazioni di promozione
					sportiva riconosciuti dal CONI come: ASI – Associazioni Sportive Sociali Italiane – affiliazione n. EPS VEN-VE0093
					registro Coni n. 77776. L’attivit&agrave; di propaganda &egrave; in funzione agli scopi istituzionali e necessaria per lo sviluppo
					e la divulgazione dello Sport dilettantistico nazionale. Per coloro che fanno domanda per la pratica dell’attivit&agrave; 
					istituzionale la società provveder&agrave; al tesseramento di questi ad una delle federazioni o enti sportivi a cui &egrave; affiliata.</p>
				</div>
				<div id="footerbottom">
					<p><span xml:lang="en">Copyright</span>&copy; 2018 Palestra <span xml:lang="en">BODY EVOLUTION</span> A.S.D. - 
					<span xml:lang="en">All rights reserved</span></p>
				</div>
		</div>
	</div>	
	

</body>
</html>
