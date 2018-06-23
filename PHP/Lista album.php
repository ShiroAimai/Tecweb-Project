<?php
	require_once('config.php');
    $head = file_get_contents("../Templates/headerAlbumList.txt");
    $foot = file_get_contents("../Templates/footer.txt");
	$albumList = file_get_contents("../Templates/AlbumList.txt");
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
		echo $albumList;
		$sql = "SELECT Album,Data, count(*) as foto FROM galleria GROUP BY Album,Data ORDER BY Data DESC";
		$album=select($sql);
		if ($album == null) {
			echo "<tr><td colspan=7 >Nessun risultato</td>";
		}
		foreach ($album as $a) {
			echo "<tr>";

			echo "<td>".$a['Album'];
			echo "</td>";
			
			echo "<td>".$a['foto'];
			echo "</td>";

			echo "<td>".$a['Data'];
			echo "</td>";
			
			echo "<td>
				<form method=\"post\" action=\"Elimina galleria.php\" onsubmit=\"return confirm('Confermi di voler eliminare la galleria e le relative foto?');\" >
					<input type=\"hidden\"  name=\"title\" value=\"" . $a['Album'] . "\"/>
					<label class=\"invisibleLabel\" for=\"" . $a['Album'] . "\">Elimina galleria</label>
					<input id=\"".$a['Album']."\" type=\"submit\"  title=\"Elimina galleria\" value=\"Elimina galleria\"/>
				</form>
				</td>";
				
			echo "<td>
				<form method=\"post\" action=\"Lista foto.php\" >
					<input type=\"hidden\"  name=\"title\" value=\"" . $a['Album'] . "\"/>
					<label class=\"invisibleLabel\" for=\"" . $a['Album'] . "\">Vedi foto</label>
					<input id=\"".$a['Album']."\" type=\"submit\"  title=\"Vedi foto\" value=\"Vedi foto\"/>
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