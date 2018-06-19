<?php
	require_once('config.php');
    $head = file_get_contents("../Templates/headerGallery.txt");
    $foot = file_get_contents("../Templates/footer.txt");
	$logout = "<button id=\"logoutButton\" onclick=\"window.location.href='logout.php'\">Logout</button>";
	$login = "<button onclick=\"window.location.href='../HTML/AreaPersonale.html'\">Area Personale</button>";
	$adminPanel = "<button onclick=\"window.location.href='AdminPanel.php'\">Admin Panel</button>";
	$userPanel = "<button onclick=\"window.location.href='UserPanel.php'\">User Panel</button>";
	$closediv = "</div>";
	
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

	echo "<h2 id=\"gallerypictitle\">Album <span id=\"albumtitle\">".$_GET['album']."</span></h2>";
	$aux=$_GET['album'];
	$query=query("
		SELECT NomeImmagine, Album 
		FROM galleria 
		WHERE Album=\"$aux\";
	");
	$aux=null;
	while($row = mysqli_fetch_assoc($query)) {	
		if($aux==null) {
			$stampa = "<a href=\"immaginesingola.php?nome=".$row['NomeImmagine']."&album=".$row['Album']."\"><img class=\"gallerypicmini\" src=\"../galleria/".$row['NomeImmagine']."\" alt=\"Immagine dell'album ".$row['Album']."\"/></a>";
		}
		echo $stampa;
	}		
	
	$connessione->close();
	
	echo $foot;
?>