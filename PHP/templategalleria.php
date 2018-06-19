<?php
	require_once('config.php');
    $head = file_get_contents("../Templates/headerGallery.txt");
    $foot = file_get_contents("../Templates/footer.txt");
	$login = "<button onclick=\"window.location.href='logout.php'\">Logout</button>";
	$logout = "<button onclick=\"window.location.href='AreaPersonale.php'\">Area Personale</button>";
	$closediv = "</div>";
	
	echo $head;
	if(isset($_SESSION['user_code'])) {
		echo $login;
	} else {
		echo $logout;
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