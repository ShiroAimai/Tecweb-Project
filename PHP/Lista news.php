<?php
	require_once('config.php');
    $head = file_get_contents("../Templates/headerNewsList.txt");
    $foot = file_get_contents("../Templates/footer.txt");
	$newsList = file_get_contents("../Templates/NewsList.txt");
	$notAdmin = file_get_contents("../Templates/NotAdmin.txt");
	$logout = "<button id=\"logoutButton\" onclick=\"window.location.href='logout.php'\">Logout</button>";
	$login = "<button onclick=\"window.location.href='../HTML/AreaPersonale.html'\">Area Personale</button>";
	$adminPanel = "<button onclick=\"window.location.href='AdminPanel.php'\">Admin Panel</button>";
	$userPanel = "<button onclick=\"window.location.href='UserPanel.php'\">User Panel</button>";
	$closediv = "</div>";
	$closebody = "</body>";
	$closehtml = "</html>";
	
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
	if(isset($_SESSION['user_code']) && $_SESSION['user_type'] == 'admin') {
		echo $newsList;
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
			
			echo "<td>
				<form method=\"post\" action=\"elimina news.php\" onsubmit=\"return confirm('Confermi di voler eliminare la news?');\" >
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
	echo $foot;
	echo $closebody;
	echo $closehtml;
?>