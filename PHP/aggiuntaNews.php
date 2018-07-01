<?php
	require_once('config.php');
	require_once('printHeader.php');
	$foot = file_get_contents("../Templates/footer.txt");
	$addNews = file_get_contents("../Templates/addNews.txt");
	$logout = "<button id=\"logoutButton\" title=\"Effettua il logout\" onclick=\"window.location.href='logout.php'\"><span lang=\"en\">Logout</span></button>";
	$login = "<button title=\"Effettua il login\" onclick=\"window.location.href='areaPersonale.php'\">Area Personale</button>";
	$adminPanel = "<button title=\"Vai al pannello amministratore\" onclick=\"window.location.href='adminPanel.php'\"><span lang=\"en\">Admin Panel</span></button>";
	$userPanel = "<button title=\"Vai al pannello utente\" onclick=\"window.location.href='userPanel.php'\"><span lang=\"en\">User Panel</span></button>";
	$closediv = "</div>";
	$closebody = "</body>";
	$closehtml = "</html>";
	register('newsTitle');
	register('newsDescription');
	$newsImage = $_FILES["newsImage"]["name"];
	
	$newsTitle = test_input($newsTitle);
    $newsDescription = test_input($newsDescription);
	if(isset($newsTitle) && !empty($newsTitle) && isset($newsImage) && !empty($newsImage) && isset($newsDescription) && !empty($newsDescription)) {	
        query("INSERT INTO news (Titolo, Immagine, Descrizione) VALUES ('$newsTitle', '$newsImage', '$newsDescription')");
    }
    else {
        header("Location: operazioneFallita.php");
		die();
	}

	printHead('News Aggiunta');
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
   
	$target_dir = "../Uploads/upNews/";
	$target_file = $target_dir . basename($newsImage);
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	// Check if image file is a actual image or fake image
	if (!move_uploaded_file($_FILES["newsImage"]["tmp_name"], $target_file)) {
		header("Location: operazioneFallita.php");
		die();
		}

	echo $addNews;
	close_connection();
	echo $foot;
	echo $closebody;
	echo $closehtml;
?>