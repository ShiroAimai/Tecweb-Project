<?php
	require_once('config.php');
    require_once('printHeader.php');
	$foot = file_get_contents("../Templates/footer.txt");
	$addScheda = file_get_contents("../Templates/addScheda.txt");
	$logout = "<a id=\"logoutButton\" title=\"Effettua il logout\" href=\"logout.php\"><span lang=\"en\">Logout</span></a>";
	$login = "<a id=\"panelButton\" title=\"Effettua il login\" href=\"areaPersonale.php\">Area Personale</a>";
	$adminPanel = "<a id=\"panelButton\" title=\"Vai al pannello amministratore\" href=\"adminPanel.php\"><span lang=\"en\">Admin Panel</span></a>";
	$userPanel = "<a id=\"panelButton\" title=\"Vai al pannello utente\" href=\"userPanel.php\"><span lang=\"en\">User Panel</span></a>";
	$closediv = "</div>";
	$closebody = "</body>";
	$closehtml = "</html>";
	register('user');
	$pdf = $_FILES[$user]["name"];

	printHead('Scheda aggiunta');
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

	$scheda_trovata = select("SELECT * FROM scheda WHERE CodiceUtente='$user';");
	if(count($scheda_trovata) > 0){
		unlink('../Uploads/upSchede/'.$scheda_trovata[0]['LinkScheda']);
		query("UPDATE scheda SET LinkScheda='$pdf' WHERE CodiceUtente='$user'");

	}
	else {
		query("INSERT INTO scheda (CodiceUtente, LinkScheda) VALUES ('$user', '$pdf')");

	}
	echo $addScheda;

	$target_dir = "../Uploads/upSchede/";
	$target_file = $target_dir . basename($pdf);
	$uploadOk = 1;
	$pdfFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	if (!move_uploaded_file($_FILES["$user"]["tmp_name"], $target_file)) {
		header("Location: operazioneFallita.php");
		die();
	}

	close_connection();
	echo $foot;
	echo $closebody;
	echo $closehtml;
?>