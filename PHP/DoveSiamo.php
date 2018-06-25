<?php
	require_once('config.php');
    $head = file_get_contents("../Templates/headerDoveSiamo.txt");
    $foot = file_get_contents("../Templates/footer.txt");
	$dovesiamo = file_get_contents("../Templates/DoveSiamo.txt");
	$logout = "<button id=\"logoutButton\" onclick=\"window.location.href='logout.php'\">Logout</button>";
	$login = "<button onclick=\"window.location.href='AreaPersonale.php'\">Area Personale</button>";
	$adminPanel = "<button onclick=\"window.location.href='AdminPanel.php'\">Admin Panel</button>";
	$userPanel = "<button onclick=\"window.location.href='UserPanel.php'\">User Panel</button>";
	$maps = "<script src=\"../JS/Maps.js\"></script>
	<script src=\"https://maps.googleapis.com/maps/api/js?key=AIzaSyDy9ePX9YzCd4SvN7AJ8oNL6-2uue4rh6g&amp;callback=myMap\"></script>";
	$closediv = "</div>";
	$closebody = "</body>";
	$closehtml = "</html>";
	
	echo $head;
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