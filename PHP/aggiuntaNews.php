<?php
	require_once('config.php');
	require_once('printHeader.php');
	$foot = file_get_contents("../Templates/footer.txt");
	$addNews = file_get_contents("../Templates/addNews.txt");
	$logout = "<button id=\"logoutButton\" onclick=\"window.location.href='logout.php'\">Logout</button>";
	$login = "<button onclick=\"window.location.href='areaPersonale.php'\">Area Personale</button>";
	$adminPanel = "<button onclick=\"window.location.href='adminPanel.php'\">Admin Panel</button>";
	$userPanel = "<button onclick=\"window.location.href='userPanel.php'\">User Panel</button>";
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
   
	$target_dir = "../uploads/";
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