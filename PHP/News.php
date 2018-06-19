<?php
	require_once('config.php');
    $head = file_get_contents("../Templates/headerNews.txt");
    $foot = file_get_contents("../Templates/footer.txt");
	$login = "<button onclick=\"window.location.href='logout.php'\">Logout</button>";
	$logout = "<button onclick=\"window.location.href='../HTML/AreaPersonale.html'\">Area Personale</button>";
	$closediv = "</div>";
	
	echo $head;
	if(isset($_SESSION['user_code'])) {
		echo $login;
	} else {
		echo $logout;
	}
	echo $closediv;
	echo $closediv;
	$title = "<div id=\"Presentazione\">
				<h1 id=\"titoloPagina\">NEWS</h1>
				<p>Resta aggiornato sulle ultime novità della <span lang=\"en\">Body Evolution</span>!</p>
			</div>";
	echo $title;
	
	$query = query("
		SELECT Titolo, Data, Immagine, Descrizione 
		FROM news;
	");
	
	while($row = mysqli_fetch_assoc($query)) {
		$stampa = "<div class=\"newscont\"> <h3 class=\"titlenews\"> ".$row['Titolo']." </h3> <div class=\"corpopos\"> <p class=\"pubblicazione\">Pubblicato il ".$row['Data']."</p><img class=\"imgnews\" src=\"../uploads/".$row['Immagine']."\" alt=\"Immagine della news\"/> <p class=\"textnews\"> ".$row['Descrizione']."  </p></div> </div>";
		echo $stampa;
	}

	echo $foot;
	$connessione->close();
?>