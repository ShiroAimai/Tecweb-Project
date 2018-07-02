<?php
	require_once('config.php');
    require_once('printHeader.php');
	$foot = file_get_contents("../Templates/footer.txt");
	$addGallery = file_get_contents("../Templates/addGallery.txt");
	$logout = "<a id=\"logoutButton\" title=\"Effettua il logout\" href=\"logout.php\"><span lang=\"en\">Logout</span></a>";
	$login = "<a id=\"panelButton\" title=\"Effettua il login\" href=\"areaPersonale.php\">Area Personale</a>";
	$adminPanel = "<a id=\"panelButton\" title=\"Vai al pannello amministratore\" href=\"adminPanel.php\"><span lang=\"en\">Admin Panel</span></a>";
	$userPanel = "<a id=\"panelButton\" title=\"Vai al pannello utente\" href=\"userPanel.php\"><span lang=\"en\">User Panel</span></a>";
	$closediv = "</div>";
	$closebody = "</body>";
	$closehtml = "</html>";
	register('galleryName');
	$galleryFile = $_FILES["galleryFile"]["name"];
	$gallerySize = $_FILES["galleryFile"]["size"];
	$counter=0;
	
	$galleryName = test_input($galleryName);
	if(isset($galleryName) && !empty($galleryName) && isset($galleryFile) && !empty($galleryFile)) {
		/*$max_file_number = 50; //massimo 50 file per volta
		$upload_max_size = 209715200; //massimo 200M ad upload
		if(count($galleryFile) > $max_file_number || $gallerySize > $upload_max_size) {
			header("Location: operazioneFallita.php");
			die();
		}*/
        while(isset($_FILES['galleryFile']['name'][$counter])) {   
			$immagine=$_FILES['galleryFile']['name'][$counter];
			query("INSERT INTO galleria (NomeImmagine, Album) VALUES ('$immagine', '$galleryName')");
			$counter++;
		}
    }
    else {
        header("Location: operazioneFallita.php");
		die();
	}
	
	printHead('Album aggiunto');
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

	if (!file_exists('../Uploads/upGalleria/'.$galleryName.'/')) {
		mkdir('../Uploads/upGalleria/'.$galleryName.'/', 0777, true);
	}
	$target_dir = '../Uploads/upGalleria/'.$galleryName.'/';
	$count=0;
	foreach ($galleryFile as $g) {
		$destination=$target_dir;
		$origin=$_FILES['galleryFile']['tmp_name'][$count];
		$count++;
		$destination=$destination.basename($g);
		if (!move_uploaded_file($origin, $destination)) {
			header("Location: operazioneFallita.php");		
			die();			
		}
	}

	echo $addGallery;
	close_connection();
	echo $foot;
	echo $closebody;
	echo $closehtml;
?>
