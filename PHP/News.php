<?php
	require_once('config.php');
    require_once('printHeader.php');
    $foot = file_get_contents("../Templates/footer.txt");
	$logout = "<button id=\"logoutButton\" title=\"Effettua il logout\" onclick=\"window.location.href='logout.php'\"><span lang=\"en\">Logout</span></button>";
	$login = "<button title=\"Effettua il login\" onclick=\"window.location.href='areaPersonale.php'\">Area Personale</button>";
	$adminPanel = "<button title=\"Vai al pannello amministratore\" onclick=\"window.location.href='adminPanel.php'\"><span lang=\"en\">Admin Panel</span></button>";
	$userPanel = "<button title=\"Vai al pannello utente\" onclick=\"window.location.href='userPanel.php'\"><span lang=\"en\">User Panel</span</button>";
	$closediv = "</div>";
	$closebody = "</body>";
	$closehtml = "</html>";
	
	printHead('News');
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
	$title = "<div id=\"Presentazione\">
				<h1 id=\"titoloPagina\"><span lang=\"en\">NEWS</span></h1>
				<p>Resta aggiornato sulle ultime novità della <span lang=\"en\">Body Evolution</span>!</p>
			</div>";
	echo $title;
	
	$query = query("
		SELECT Titolo, Data, Immagine, Descrizione 
		FROM news;
	");
	
	while($row = mysqli_fetch_assoc($query)) {
		$stampa = "<div class=\"newscont\">
						<h3 class=\"titlenews\"> ".$row['Titolo']." </h3> 
						<div class=\"corpopos\">
							<p class=\"pubblicazione\">Pubblicato il ".$row['Data']."</p>
							<img class=\"imgnews\" src=\"../Uploads/upNews/".$row['Immagine']."\" alt=\"Immagine della news\" /> 
							<p class=\"textnews\"> ".$row['Descrizione']." </p>
							<div class=\"separator\"></div>
						</div>
					</div>";
		echo $stampa;
	}

	close_connection();
	echo $foot;
	echo $closebody;
	echo $closehtml;
?>