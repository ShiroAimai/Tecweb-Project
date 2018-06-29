<?php
	require_once('config.php');
    require_once('printHeader.php');
    $foot = file_get_contents("../Templates/footer.txt");
	$Logout = file_get_contents("../Templates/Logout.txt");
	$logout = "<button id=\"logoutButton\" onclick=\"window.location.href='logout.php'\">Logout</button>";
	$login = "<button onclick=\"window.location.href='areaPersonale.php'\">Area Personale</button>";
	$adminPanel = "<button disabled onclick=\"window.location.href='adminPanel.php'\">Admin Panel</button>";
	$userPanel = "<button onclick=\"window.location.href='userPanel.php'\">User Panel</button>";
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