<?php
	require_once('config.php');
    require_once('printHeader.php');
    $foot = file_get_contents("../Templates/footer.txt");
	$gestisciNews = file_get_contents("../Templates/gestisciNews.txt");
	$notAdmin = file_get_contents("../Templates/notAdmin.txt");
	$logout = "<a id=\"logoutButton\" title=\"Effettua il logout\" href=\"logout.php\"><span lang=\"en\">Logout</span></a>";
	$login = "<a id=\"panelButton\" title=\"Effettua il login\" href=\"areaPersonale.php\">Area Personale</a>";
	$adminPanel = "<a id=\"panelButton\" title=\"Vai al pannello amministratore\" href=\"adminPanel.php\"><span lang=\"en\">Admin Panel</span></a>";
	$userPanel = "<a id=\"panelButton\" title=\"Vai al pannello utente\" href=\"userPanel.php\"><span lang=\"en\">User Panel</span></a>";
	$closediv = "</div>";
	$closebody = "</body>";
	$closehtml = "</html>";
	$id = 1;
	
	printHead('Gestisci news');
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
	if(isset($_SESSION['user_code']) && $_SESSION['user_type'] == 'admin') {
		echo $gestisciNews;
		$sql = "SELECT * FROM news ORDER BY Data DESC";
		$news=select($sql);
		if ($news == null) {
			echo "<tr><td colspan=7 >Nessun risultato</td>";
		}
		foreach ($news as $n) {
			echo "<tr>";

			echo "<td>".$n['Titolo'];
			echo "</td>";

			echo "<td>".$n['Data'];
			echo "</td>";
						
			echo "<td>".$n['Immagine'];
			echo "</td>";
						
			echo "<td>".$n['Descrizione'];
			echo "</td>";
			
			echo "<td class=\"notPrint\">
				<form method=\"post\" action=\"eliminaNews.php\" onsubmit=\"return confirm('Confermi di voler eliminare la news?');\" >
					<input type=\"hidden\"  name=\"title\" value=\"" . $n['Titolo'] . "\"/>
					<input type=\"hidden\"  name=\"image\" value=\"" . $n['Immagine'] . "\"/>
					<label class=\"invisibleLabel\" for=\"" . $id . "\">Elimina news</label>
					<input id=\"".$id."\" type=\"submit\"  title=\"Elimina news ".$n['Titolo']."\" value=\"Elimina news\"/>
				</form>
				</td>";
			
			$id++;
		}
		echo "</tbody>";
		echo "</table>";
		echo $closediv;
		echo $closediv;
	}
	else {
		echo $notAdmin;
	}
	close_connection();
	echo $foot;
	echo $closebody;
	echo $closehtml;
?>