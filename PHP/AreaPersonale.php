<?php
	require_once('config.php');
    $head = file_get_contents("../Templates/headerAreaPersonale.txt");
    $foot = file_get_contents("../Templates/footer.txt");
	$areaPersonale = file_get_contents("../Templates/AreaPersonale.txt");
	$closebody = "</body>";
	$closehtml = "</html>";
	
	if(isset($_SESSION['user_code']) && $_SESSION['user_type'] == 'admin') {
		header("Location: AdminPanel.php");
	} 
	else if(isset($_SESSION['user_code']) && $_SESSION['user_type'] == 'user') {
		header("Location: UserPanel.php");
	}
	else {
		echo $head;
		echo $areaPersonale;
		echo $foot;
		echo $closebody;
		echo $closehtml;
	}
?>