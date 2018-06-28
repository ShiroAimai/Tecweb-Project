<?php
	require_once('config.php');
    require_once('printHeader.php');
	$foot = file_get_contents("../Templates/footer.txt");
	$addGallery = file_get_contents("../Templates/AddGallery.txt");
	$logout = "<button id=\"logoutButton\" onclick=\"window.location.href='logout.php'\">Logout</button>";
	$login = "<button onclick=\"window.location.href='AreaPersonale.php'\">Area Personale</button>";
	$adminPanel = "<button onclick=\"window.location.href='AdminPanel.php'\">Admin Panel</button>";
	$userPanel = "<button onclick=\"window.location.href='UserPanel.php'\">User Panel</button>";
	$closediv = "</div>";
	$closebody = "</body>";
	$closehtml = "</html>";
	register('galleryName');
	$galleryFile = $_FILES["galleryFile"]["name"];
	$gallerySize = $_FILES["galleryFile"]["size"];
	$counter=0;
	
	$galleryName = test_input($galleryName);
	if(isset($galleryName) && !empty($galleryName) && isset($galleryFile) && !empty($galleryFile)) {
		$max_file_number = 50; //massimo 50 file per volta
		$upload_max_size = 209715200; //massimo 200M ad upload
		if(count($galleryFile) > $max_file_number || $gallerySize > $upload_max_size) {
			header("Location: queryfallita.php");
			die();
		}
        while(isset($_FILES['galleryFile']['name'][$counter])) {   
			$immagine=$_FILES['galleryFile']['name'][$counter];
			query("INSERT INTO galleria (NomeImmagine, Album) VALUES ('$immagine', '$galleryName')");
			$counter++;
		}
    }
    else {
        header("Location: queryfallita.php");
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

	if (!file_exists('../galleria/'.$galleryName.'/')) {
		mkdir('../galleria/'.$galleryName.'/', 0777, true);
	}
	$target_dir = '../galleria/'.$galleryName.'/';
	$count=0;
	foreach ($galleryFile as $g) {
		$destination=$target_dir;
		$origin=$_FILES['galleryFile']['tmp_name'][$count];
		$count++;
		$destination=$destination.basename($g);
		if (!move_uploaded_file($origin, $destination)) {
			header("Location: queryfallita.php");		
			die();			
		}
	}

	echo $addGallery;
	close_connection();
	echo $foot;
	echo $closebody;
	echo $closehtml;
?>
