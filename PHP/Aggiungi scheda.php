<?php
	require_once('config.php');
	$head = file_get_contents("../Templates/headerAddGallery.txt");
	$foot = file_get_contents("../Templates/footer.txt");
	$addScheda = file_get_contents("../Templates/AddScheda.txt");
	$logout = "<button id=\"logoutButton\" onclick=\"window.location.href='logout.php'\">Logout</button>";
	$login = "<button onclick=\"window.location.href='AreaPersonale.php'\">Area Personale</button>";
	$adminPanel = "<button onclick=\"window.location.href='AdminPanel.php'\">Admin Panel</button>";
	$userPanel = "<button onclick=\"window.location.href='UserPanel.php'\">User Panel</button>";
	$closediv = "</div>";
	$closebody = "</body>";
	$closehtml = "</html>";
	register('user');
	$pdf = $_FILES[$user]["name"];

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

	$scheda_trovata = select("SELECT * FROM scheda WHERE CodiceUtente='$user';");
	if(count($scheda_trovata) > 0){
		unlink('../schede/'.$scheda_trovata[0]['LinkScheda']);
		query("UPDATE scheda SET LinkScheda='$pdf' WHERE CodiceUtente='$user'");
	}
	else {
		query("INSERT INTO scheda (CodiceUtente, LinkScheda) VALUES ('$user', '$pdf')");
	}
	echo $addScheda;

	$target_dir = "../schede/";
	$target_file = $target_dir . basename($pdf);
	$uploadOk = 1;
	$pdfFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	if (!move_uploaded_file($_FILES["$user"]["tmp_name"], $target_file)) {
		header("Location: queryfallita.php");
		die();
	}

	echo $foot;
	echo $closebody;
	echo $closehtml;
?>