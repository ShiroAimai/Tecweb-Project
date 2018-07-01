<?php
	require_once('config.php');
    require_once('printHeader.php');
    $foot = file_get_contents("../Templates/footer.txt");
	$logout = "<button id=\"logoutButton\" title=\"Effettua il logout\" onclick=\"window.location.href='logout.php'\"><span lang=\"en\">Logout</span></button>";
	$login = "<button title=\"Effettua il login\" onclick=\"window.location.href='areaPersonale.php'\">Area Personale</button>";
	$adminPanel = "<button title=\"Vai al pannello amministratore\" onclick=\"window.location.href='adminPanel.php'\"><span lang=\"en\">Admin Panel</span></button>";
	$userPanel = "<button title=\"Vai al pannello utente\" onclick=\"window.location.href='userPanel.php'\"><span lang=\"en\">User Panel</span></button>";
	$closediv = "</div>";
	$closebody = "</body>";
	$closehtml = "</html>";
	$goback = "<div id=\"back\"><a href=\"Galleria.php\">Torna agli album</a></div>";
	
	printHead('Galleria Foto');
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

	echo "<div id=\"corpo\">";
	echo "<div id=\"gallerypictitle\">";
	echo "<h2>Album <span id=\"albumtitle\">".$_GET['album']."</span></h2>";
	echo $goback;
	echo $closediv;

	echo "<div id=\"gallerypicblock\">";
	$aux=$_GET['album'];
	$query=query("
		SELECT NomeImmagine, Album 
		FROM galleria 
		WHERE Album=\"$aux\";
	");
	$tmp=null;
	while($row = mysqli_fetch_assoc($query)) {	
		if($tmp==null) {
			$stampa = "<a href=\"immagineSingola.php?nome=".$row['NomeImmagine']."&album=".$row['Album']."\"><img class=\"gallerypicmini\" src=\"../Uploads/upGalleria/".$aux.'/'.$row['NomeImmagine']."\" alt=\"Immagine dell'album ".$row['Album']."\"/></a>";
		}
		echo $stampa;
	}
	echo $closediv;
	echo $closediv;	
	
	close_connection();	
	echo $foot;
	echo $closebody;
	echo $closehtml;
?>