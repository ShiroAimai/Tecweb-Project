<?php
	require_once('config.php');
    $head = file_get_contents("../Templates/headerAddCorso.txt");
    $foot = file_get_contents("../Templates/footer.txt");
	$addCorso = file_get_contents("../Templates/AddCorso.txt");
	$rimCorso =file_get_contents("../Templates/rimCorso.txt");
	$logout = "<button id=\"logoutButton\" onclick=\"window.location.href='logout.php'\">Logout</button>";
	$login = "<button onclick=\"window.location.href='AreaPersonale.php'\">Area Personale</button>";
	$adminPanel = "<button onclick=\"window.location.href='AdminPanel.php'\">Admin Panel</button>";
	$userPanel = "<button onclick=\"window.location.href='UserPanel.php'\">User Panel</button>";
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
	if($_GET['attr']== 0)
		echo $addCorso;
	else
		echo $rimCorso;
	echo $foot;
	echo $closebody;
	echo $closehtml;
?>