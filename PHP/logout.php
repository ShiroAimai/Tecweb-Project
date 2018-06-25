<?php
	require_once('config.php');
	$head = file_get_contents("../Templates/headerLogout.txt");
    $foot = file_get_contents("../Templates/footer.txt");
	$Logout = file_get_contents("../Templates/Logout.txt");
	$logout = "<button id=\"logoutButton\" onclick=\"window.location.href='logout.php'\">Logout</button>";
	$login = "<button onclick=\"window.location.href='AreaPersonale.php'\">Area Personale</button>";
	$adminPanel = "<button disabled onclick=\"window.location.href='AdminPanel.php'\">Admin Panel</button>";
	$userPanel = "<button onclick=\"window.location.href='UserPanel.php'\">User Panel</button>";
	$closediv = "</div>";
	$closebody = "</body>";
	$closehtml = "</html>";
	
	echo $head;
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