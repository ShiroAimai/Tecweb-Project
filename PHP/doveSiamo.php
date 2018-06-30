<?php
	require_once('config.php');
    require_once('printHeader.php');
    $foot = file_get_contents("../Templates/footer.txt");
	$dovesiamo = file_get_contents("../Templates/doveSiamo.txt");
	$logout = "<button id=\"logoutButton\" title=\"Effettua il logout\" onclick=\"window.location.href='logout.php'\"><span lang=\"en\">Logout</span></button>";
	$login = "<button title=\"Effettua il login\" onclick=\"window.location.href='areaPersonale.php'\">Area Personale</button>";
	$adminPanel = "<button title=\"Vai al pannello amministratore\" onclick=\"window.location.href='adminPanel.php'\"><span lang=\"en\">Admin Panel</span></button>";
	$userPanel = "<button title=\"Vai al pannello utente\" onclick=\"window.location.href='userPanel.php'\"><span lang=\"en\">User Panel</span</button>";
	$maps = "<script src=\"../JS/Maps.js\"></script>
	<script src=\"https://maps.googleapis.com/maps/api/js?key=AIzaSyDy9ePX9YzCd4SvN7AJ8oNL6-2uue4rh6g&amp;callback=myMap\"></script>";
	$closediv = "</div>";
	$closebody = "</body>";
	$closehtml = "</html>";
	
	printHead('Dove Siamo');
	if(isset($_SESSION['user_code']) && $_SESSION['user_type'] == 'admin') {
		echo $logout;
		echo $adminPanel;
	} else if(isset($_SESSION['user_code']) && $_SESSION['user_type'] == 'user') {
		echo $logout;
		echo $userPanel;
	} else {
		echo $login;
	}
	
	echo $closediv;
	echo $closediv;
	echo $dovesiamo;
	echo $foot;
	
	echo $maps;
	echo $closebody;
	echo $closehtml;
?>