<?php
	require_once('config.php');
    $head = file_get_contents("../Templates/headerGallery.txt");
    $foot = file_get_contents("../Templates/footer.txt");
	$logout = "<button id=\"logoutButton\" onclick=\"window.location.href='logout.php'\">Logout</button>";
	$login = "<button onclick=\"window.location.href='../HTML/AreaPersonale.html'\">Area Personale</button>";
	$adminPanel = "<button onclick=\"window.location.href='AdminPanel.php'\">Admin Panel</button>";
	$userPanel = "<button onclick=\"window.location.href='UserPanel.php'\">User Panel</button>";
	$closediv = "</div>";
	$closebody = "</body>";
	$closehtml = "</html>";

    $query=query("
		SELECT NomeImmagine, Album 
		FROM galleria 
		GROUP BY Album, NomeImmagine;
	");

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
	$title = "<div id=\"Presentazione\">
				<h1 id=\"titoloPagina\">GALLERIA ALBUM</h1>
				<p>Guarda le foto scattate dai nostri Trainer qui alla <span lang=\"en\">Body Evolution</span>!</p>
			</div>";
	echo $title;	

    $opendiv = "<div class=\"gallerymain\">";
    echo $opendiv;

    $aux=null; $stampa=null;
    while($row = mysqli_fetch_assoc($query))
            {   
                
                if($aux==null)//caso in cui siamo appena entrati a prelevare nel database
                    {
                    $stampa = "<a href=\"templategalleria.php?album=".$row['Album']."\"><div class=\"album\"> <h3 class=\"albumname\">".$row['Album']."</h3><img class=\"galleryimg\" src=\"../galleria/".$row['Album'].'/'.$row['NomeImmagine']."\" alt=\"Immagine dell'album ".$row['Album']."\"></div></a>";// aggiungere il primo $row di ogni album
                        $aux=$row['Album'];
                    }
                else if($row['Album']!=$aux)
                {
                    echo $stampa;
                    $stampa="<a href=\"templategalleria.php?album=".$row['Album']."\"><div class=\"album\"> <h3 class=\"albumname\">".$row['Album']."</h3><img class=\"galleryimg\" src=\"../galleria/".$row['Album'].'/'.$row['NomeImmagine']."\" alt=\"Immagine dell'album ".$row['Album']."\"/></div></a>";
                    $aux=$row['Album'];
                }
            
                
            }
            
    echo $stampa;
    echo $closediv;
    echo $foot;
	echo $closebody;
	echo $closehtml;
    
    $connessione->close();
?>