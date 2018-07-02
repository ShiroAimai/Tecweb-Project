<?php
	require_once('config.php');
    require_once('printHeader.php');
    $foot = file_get_contents("../Templates/footer.txt");
	$addFattura = file_get_contents("../Templates/addFattura.txt");
	$logout = "<a id=\"logoutButton\" title=\"Effettua il logout\" href=\"logout.php\"><span lang=\"en\">Logout</span></a>";
	$login = "<a id=\"panelButton\" title=\"Effettua il login\" href=\"areaPersonale.php\">Area Personale</a>";
	$adminPanel = "<a id=\"panelButton\" title=\"Vai al pannello amministratore\" href=\"adminPanel.php\"><span lang=\"en\">Admin Panel</span></a>";
	$notAdmin = file_get_contents("../Templates/notAdmin.txt");
	$closediv = "</div>";
	$closebody = "</body>";
	$closehtml = "</html>";
	
	printHead('Fattura aggiunta');
	if(isset($_SESSION['user_code']) && $_SESSION['user_type'] == 'admin') {
		echo $logout;
		echo $adminPanel;
	} else 
		echo $notAdmin;
	
	echo $closediv;
	echo $closediv;
	echo $addFattura;
	echo $foot;
	echo $closebody;
	echo $closehtml;
?>

