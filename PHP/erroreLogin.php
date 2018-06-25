<?php
require_once('config.php');
$head = file_get_contents("../Templates/headerErroreLogin.txt");
$foot = file_get_contents("../Templates/footer.txt");
$errLogin = file_get_contents("../Templates/erroreLogin.txt");
$login = "<button onclick=\"window.location.href='AreaPersonale.php'\">Area Personale</button>";
$closediv = "</div>";
$closebody = "</body>";
$closehtml = "</html>";

echo $head;
	
	echo $login;
	
	echo $closediv;
	echo $closediv;
	echo $errLogin;
	echo $foot;
	echo $closebody;
	echo $closehtml;
?>