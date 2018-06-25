<?php
	require_once('config.php');
    $head = file_get_contents("../Templates/headerFormCorsi.txt");
    $foot = file_get_contents("../Templates/footer.txt");
	$formcorsi = file_get_contents("../Templates/formcorsi.txt");
	$notAdmin = file_get_contents("../Templates/NotAdmin.txt");
	$logout = "<button id=\"logoutButton\" onclick=\"window.location.href='logout.php'\">Logout</button>";
	$login = "<button onclick=\"window.location.href='AreaPersonale.php'\">Area Personale</button>";
	$adminPanel = "<button onclick=\"window.location.href='AdminPanel.php'\">Admin Panel</button>";
	$userPanel = "<button onclick=\"window.location.href='UserPanel.php'\">User Panel</button>";
	$pswvalidation = "<script src=\"../JS/PswValidation.js\"></script>";
	$closediv = "</div>";
	$closebody = "</body>";
	$closehtml = "</html>";
	
	echo $head;
	if(isset($_SESSION['user_code']) && $_SESSION['user_type'] == 'user') {
		echo $logout;
		echo $userPanel;
	} else {
		echo $login;
	}
	
	echo $closediv;
	echo $closediv;
	if(isset($_SESSION['user_code']) && $_SESSION['user_type'] == 'user') {
		echo $formcorsi;
	}
	else {
		echo $notAdmin;
	}
	
	echo $foot;
	echo $closebody;
	echo $closehtml;
?>