<?php

	require_once('config.php');
	$head = file_get_contents("../Templates/headerAddGallery.txt");
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
	$counter=0;
	
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

	if(isset($galleryName) && !empty($galleryName) && isset($galleryFile) && !empty($galleryFile)) {	
        $galleryName = test_input($galleryName);
        while(isset($_FILES['galleryFile']['name'][$counter])) {   
			$immagine=$_FILES['galleryFile']['name'][$counter];
			query("INSERT INTO galleria (NomeImmagine, Album) VALUES ('$immagine', '$galleryName')");
			$counter++;
		}
    }
    else {
        header("Location: queryfallita.php");
	}

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
		}
	}

	echo $addGallery;
	echo $foot;
	echo $closebody;
	echo $closehtml;
?>
