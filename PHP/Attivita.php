<?php
	require_once('config.php');
    $head = file_get_contents("../Templates/headerAttivita.txt");
    $foot = file_get_contents("../Templates/footer.txt");
	$attivita = file_get_contents("../Templates/Attivita.txt");
	$login = "<button onclick=\"window.location.href='logout.php'\">Logout</button>";
	$logout = "<button onclick=\"window.location.href='../HTML/AreaPersonale.html'\">Area Personale</button>";
	$closediv = "</div>";
	
	echo $head;
	if(isset($_SESSION['user_code'])) {
		echo $login;
	} else {
		echo $logout;
	}
	
	echo $closediv;
	echo $closediv;
	echo $attivita;
	echo $foot;
?>