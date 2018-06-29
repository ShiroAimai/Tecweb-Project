<?php
	require_once('config.php');
    require_once('printHeader.php');
    $foot = file_get_contents("../Templates/footer.txt");
	$addFattura = file_get_contents("../Templates/AddFattura.txt");
	$logout = "<button id=\"logoutButton\" onclick=\"window.location.href='logout.php'\">Logout</button>";
	$login = "<button onclick=\"window.location.href='AreaPersonale.php'\">Area Personale</button>";
	$adminPanel = "<button onclick=\"window.location.href='AdminPanel.php'\">Admin Panel</button>";
	$notAdmin = file_get_contents("../Templates/NotAdmin.txt");
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