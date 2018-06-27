<?php
	require_once('config.php');
	$head = file_get_contents("../Templates/headerConnessionefallita.txt");
	$foot = file_get_contents("../Templates/footer.txt");
	$notAdmin = file_get_contents("../Templates/NotAdmin.txt");
	$connfallita = file_get_contents("../Templates/connessionefallita.txt");
	$logout = "<button id=\"logoutButton\" onclick=\"window.location.href='logout.php'\">Logout</button>";
	$login = "<button onclick=\"window.location.href='AreaPersonale.php'\">Area Personale</button>";
	$adminPanel = "<button onclick=\"window.location.href='AdminPanel.php'\">Admin Panel</button>";
	$userPanel = "<button onclick=\"window.location.href='UserPanel.php'\">User Panel</button>";
	$pswvalidation = "<script src=\"../JS/PswValidation.js\"></script>";
	$closediv = "</div>";
	$closebody = "</body>";
	$closehtml = "</html>";

	echo $head;
	echo $closediv;
	echo $closediv;	
	echo $connfallita;
	echo $foot;
	echo $closebody;
	echo $closehtml;
?>