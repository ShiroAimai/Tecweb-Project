<?php
	require_once('config.php');
    require_once('printHeader.php');
    $foot = file_get_contents("../Templates/footer.txt");
	$gestisciNews = file_get_contents("../Templates/GestisciNews.txt");
	$notAdmin = file_get_contents("../Templates/NotAdmin.txt");
	$logout = "<button id=\"logoutButton\" onclick=\"window.location.href='logout.php'\">Logout</button>";
	$login = "<button onclick=\"window.location.href='AreaPersonale.php'\">Area Personale</button>";
	$adminPanel = "<button onclick=\"window.location.href='AdminPanel.php'\">Admin Panel</button>";
	$userPanel = "<button onclick=\"window.location.href='UserPanel.php'\">User Panel</button>";
	$closediv = "</div>";
	$closebody = "</body>";
	$closehtml = "</html>";
	
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
				<form method=\"post\" action=\"Elimina news.php\" onsubmit=\"return confirm('Confermi di voler eliminare la news?');\" >
					<input type=\"hidden\"  name=\"title\" value=\"" . $n['Titolo'] . "\"/>
					<input type=\"hidden\"  name=\"image\" value=\"" . $n['Immagine'] . "\"/>
					<label class=\"invisibleLabel\" for=\"" . $n['Titolo'] . "\">Elimina news</label>
					<input id=\"".$n['Titolo']."\" type=\"submit\"  title=\"Elimina news\" value=\"Elimina news\"/>
				</form>
				</td>";
		}
		echo "</tbody>";
		echo "</table>";
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