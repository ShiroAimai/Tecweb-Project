<?php
	require_once('config.php');
    require_once('printHeader.php');
    $foot = file_get_contents("../Templates/footer.txt");
	$logout = "<button id=\"logoutButton\" onclick=\"window.location.href='logout.php'\">Logout</button>";
	$login = "<button onclick=\"window.location.href='areaPersonale.php'\">Area Personale</button>";
	$adminPanel = "<button onclick=\"window.location.href='adminPanel.php'\">Admin Panel</button>";
	$userPanel = "<button onclick=\"window.location.href='userPanel.php'\">User Panel</button>";
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
			$stampa = "<a href=\"immagineSingola.php?nome=".$row['NomeImmagine']."&album=".$row['Album']."\"><img class=\"gallerypicmini\" src=\"../galleria/".$aux.'/'.$row['NomeImmagine']."\" alt=\"Immagine dell'album ".$row['Album']."\"/></a>";
		}
		echo $stampa;
	}
	echo $closediv;		
	
	close_connection();	
	echo $foot;
	echo $closebody;
	echo $closehtml;
?>