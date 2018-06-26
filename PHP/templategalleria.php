<?php
	require_once('config.php');
    $head = file_get_contents("../Templates/headerGallery.txt");
    $foot = file_get_contents("../Templates/footer.txt");
	$logout = "<button id=\"logoutButton\" onclick=\"window.location.href='logout.php'\">Logout</button>";
	$login = "<button onclick=\"window.location.href='AreaPersonale.php'\">Area Personale</button>";
	$adminPanel = "<button onclick=\"window.location.href='AdminPanel.php'\">Admin Panel</button>";
	$userPanel = "<button onclick=\"window.location.href='UserPanel.php'\">User Panel</button>";
	$closediv = "</div>";
	$closebody = "</body>";
	$closehtml = "</html>";
	$goback = "<div id=\"back\"><a href=\"Galleria.php\">Torna agli album</a></div>";
	
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
			$stampa = "<a href=\"immaginesingola.php?nome=".$row['NomeImmagine']."&album=".$row['Album']."\"><img class=\"gallerypicmini\" src=\"../galleria/".$aux.'/'.$row['NomeImmagine']."\" alt=\"Immagine dell'album ".$row['Album']."\"/></a>";
		}
		echo $stampa;
	}
	echo $closediv;		
	
	$connessione->close();
	
	echo $foot;
	echo $closebody;
	echo $closehtml;
?>