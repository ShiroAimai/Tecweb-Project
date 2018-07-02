<?php
	require_once('config.php');
    require_once('printHeader.php');
    $foot = file_get_contents("../Templates/footer.txt");
	$formFattura = file_get_contents("../Templates/formFattura.txt");
	$notAdmin = file_get_contents("../Templates/notAdmin.txt");
	$logout = "<a id=\"logoutButton\" title=\"Effettua il logout\" href=\"logout.php\"><span lang=\"en\">Logout</span></a>";
	$login = "<a id=\"panelButton\" title=\"Effettua il login\" href=\"areaPersonale.php\">Area Personale</a>";
	$adminPanel = "<a id=\"panelButton\" title=\"Vai al pannello amministratore\" href=\"adminPanel.php\"><span lang=\"en\">Admin Panel</span></a>";
	$userPanel = "<a id=\"panelButton\" title=\"Vai al pannello utente\" href=\"userPanel.php\"><span lang=\"en\">User Panel</span></a>";
	$formFattura .="<script src=\"../JS/calcoloImportoFatture.js\"></script>";
	$pswvalidation = "<script src=\"../JS/pswValidation.js\"></script>";
	$closediv = "</div>";
	$closebody = "</body>";
	$closehtml = "</html>";
	
	printHead('Aggiungi fattura');
	if(isset($_SESSION['user_code']) && $_SESSION['user_type'] == 'admin') {
		echo $logout;
		echo $adminPanel;
	} 
	
	echo $closediv;
	echo $closediv;
	if(isset($_SESSION['user_code']) && $_SESSION['user_type'] == 'admin') {
		echo $formFattura;
	}
	else {
		echo $notAdmin;
	}
	echo $foot;
	echo $closebody;
	echo $closehtml;
?>