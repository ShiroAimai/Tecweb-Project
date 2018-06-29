<?php
	require_once('config.php');
    require_once('printHeader.php');
    $foot = file_get_contents("../Templates/footer.txt");
	$formFattura = file_get_contents("../Templates/formFattura.txt");
	$notAdmin = file_get_contents("../Templates/notAdmin.txt");
	$logout = "<button id=\"logoutButton\" onclick=\"window.location.href='logout.php'\">Logout</button>";
	$login = "<button onclick=\"window.location.href='areaPersonale.php'\">Area Personale</button>";
	$adminPanel = "<button onclick=\"window.location.href='adminPanel.php'\">Admin Panel</button>";
	$userPanel = "<button onclick=\"window.location.href='userPanel.php'\">User Panel</button>";
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