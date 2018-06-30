<?php
	require_once('config.php');
    require_once('printHeader.php');
    $foot = file_get_contents("../Templates/footer.txt");
	$Logout = file_get_contents("../Templates/Logout.txt");
	$logout = "<button id=\"logoutButton\" title=\"Effettua il logout\" onclick=\"window.location.href='logout.php'\"><span lang=\"en\">Logout</span></button>";
	$login = "<button title=\"Effettua il login\" onclick=\"window.location.href='areaPersonale.php'\">Area Personale</button>";
	$adminPanel = "<button title=\"Vai al pannello amministratore\" onclick=\"window.location.href='adminPanel.php'\"><span lang=\"en\">Admin Panel</span></button>";
	$userPanel = "<button title=\"Vai al pannello utente\" onclick=\"window.location.href='userPanel.php'\"><span lang=\"en\">User Panel</span</button>";
	$closediv = "</div>";
	$closebody = "</body>";
	$closehtml = "</html>";
	
	printHead('Logout');
	echo $login;
	echo $closediv;
	echo $closediv;
	echo $Logout;
	echo $foot;
	echo $closebody;
	echo $closehtml;
	
	unset($_SESSION['user_code']);
	unset($_SESSION['user_name']);
	unset($_SESSION['user_surname']);
?>