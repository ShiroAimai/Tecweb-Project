<?php
	require_once('config.php');
	require_once('printHeader.php');
	$foot = file_get_contents("../Templates/footer.txt");
	$errLogin = file_get_contents("../Templates/erroreLogin.txt");
	$login = "<a id=\"panelButton\" title=\"Effettua il login\" href=\"areaPersonale.php\">Area Personale</a>";
	$closediv = "</div>";
	$closebody = "</body>";
	$closehtml = "</html>";

	printHead('Errore login');
	echo $login;
	echo $closediv;
	echo $closediv;
	echo $errLogin;
	echo $foot;
	echo $closebody;
	echo $closehtml;
?>