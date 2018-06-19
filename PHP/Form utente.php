<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
		
<?php require_once('config.php'); ?>

<html xmlns="http://www.w3.org/1999/xhtml"  xml:lang="it" lang="it">
<head>
	<title>Form Utente | Body Evolution</title>
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
			<a class="active"><img id="user" src="../IMAGES/user.png" alt="login utente"/></a>
			<div class="Menu" id="myMenu">
			<a href="Home.php">Home</a>
			<a href="Attivita.php">Attivit&agrave;</a>
			<a href="News.php"><span xml:lang="en">News</span></a>
			<a href="Galleria.php">Galleria</a>
			<a href="Calendario.php">Calendario</a>
			<a href="ChiSiamo.php">Chi siamo</a>
			<a href="DoveSiamo.php">Dove siamo</a>
			<?php include '../PHP/login_logout_button.php' ?>
			</div>
		</div>
		
		<div id="Presentazione">
				<h1 id="titoloPagina">AGGIUNGI UTENTE</h1>
			</div>
		<div class="FormContainer">
			<div class="containerChild">
				<div class="leftContent">
					<h1>Nuovo Utente</h1>
					<p>Inserisci le credenziali di accesso per registrare un nuovo utente</p>
				</div>
				<div class="signupOverlay"></div>
			</div>
			<div class="containerChild">
				<div class="loginWrap">
					<div class="login-html">
						<a href="AdminPanel.php"><span id="exit">&#215;</span></a>
						<div class="login-form">							
							<form id="userForm" action="registrazione utente.php" method="post" onsubmit="return validateUserForm()">
								<div class="group">
									<label for="userCode" class="label">Codice utente</label>
									<input name="userCode" id="userCode" type="text" class="input"/>
								</div>
								<div class="group">
									<label for="userName" class="label">Nome</label>
									<input name="userName" id="userName" type="text" class="input"/>
								</div>
								<div class="group">
									<label for="userSurname" class="label">Cognome</label>
									<input name="userSurname" id="userSurname" type="text" class="input"/>
								</div>
								<div class="group">
									<label for="pass" class="label">Password</label>
									<input name="pass" id="pass" type="password" class="input" title="La password deve essere lunga almeno 8 caratteri e contenere almeno un numero e una lettera"/>
								</div>
								<div class="group">
									<label for="confirmPass" class="label">Ripeti Password</label>
									<input name="confirmPass" id="confirmPass" type="password" class="input"/>
								</div>
								<div class="group">
									<label for="userMail" class="label">Email</label>
									<input name="userMail" id="userMail" type="text" class="input"/>
								</div>
								<div class="group">
									<input type="submit" class="button" value="Inserisci utente"/>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
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
	
	<script type="text/javascript" src="../JS/Sandwich.js"></script>
	<script type="text/javascript" src="../JS/FormValidation.js"></script>

</body>
</html>
