<?php
	require_once('config.php');
	require_once('printHeader.php');
	$foot = file_get_contents("../Templates/footer.txt");
	$notAdmin = file_get_contents("../Templates/notAdmin.txt");
	$connfallita = file_get_contents("../Templates/connessioneFallita.txt");
	$logout = "<button id=\"logoutButton\" onclick=\"window.location.href='logout.php'\">Logout</button>";
	$login = "<button onclick=\"window.location.href='areaPersonale.php'\">Area Personale</button>";
	$adminPanel = "<button onclick=\"window.location.href='adminPanel.php'\">Admin Panel</button>";
	$userPanel = "<button onclick=\"window.location.href='userPanel.php'\">User Panel</button>";
	$pswvalidation = "<script src=\"../JS/pswValidation.js\"></script>";
	$closediv = "</div>";
	$closebody = "</body>";
	$closehtml = "</html>";

	printHead('Connessione fallita');
	echo $closediv;
	echo $closediv;	
	echo $connfallita;
	echo $foot;
	echo $closebody;
	echo $closehtml;
?>