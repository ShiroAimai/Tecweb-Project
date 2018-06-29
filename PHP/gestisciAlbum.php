<?php
	require_once('config.php');
    require_once('printHeader.php');
    $foot = file_get_contents("../Templates/footer.txt");
	$gestisciAlbum = file_get_contents("../Templates/gestisciAlbum.txt");
	$notAdmin = file_get_contents("../Templates/notAdmin.txt");
	$logout = "<button id=\"logoutButton\" onclick=\"window.location.href='logout.php'\"><span xml:lang=\"en\">Logout</span></button>";
	$login = "<button onclick=\"window.location.href='areaPersonale.php'\">Area Personale</button>";
	$adminPanel = "<button onclick=\"window.location.href='adminPanel.php'\"><span xml:lang=\"en\">Admin Panel</span></button>";
	$userPanel = "<button onclick=\"window.location.href='userPanel.php'\"><span xml:lang=\"en\">User Panel</span</button>";
	$closediv = "</div>";
	$closebody = "</body>";
	$closehtml = "</html>";
	
	printHead('Gestisci album');
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
		echo $gestisciAlbum;
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
			
			echo "<td class=\"notPrint\">
				<form method=\"post\" action=\"eliminaGalleria.php\" onsubmit=\"return confirm('Confermi di voler eliminare la galleria e le relative foto?');\" >
					<input type=\"hidden\"  name=\"title\" value=\"" . $a['Album'] . "\"/>
					<label class=\"invisibleLabel\" for=\"" . $a['Album'] . "\">Elimina galleria</label>
					<input id=\"".$a['Album']."\" type=\"submit\"  title=\"Elimina galleria\" value=\"Elimina galleria\"/>
				</form>
				</td>";
				
			echo "<td class=\"notPrint\">
				<form method=\"post\" action=\"rinominaGalleria.php\" >
					<input type=\"hidden\"  name=\"title\" value=\"" . $a['Album'] . "\"/>
					<label class=\"invisibleLabel\" for=\"rename\">Rinomina galleria</label>
					<input name=\"rename\" id=\"rename\" type=\"text\"  title=\"Rinomina galleria\" required />
					<input type=\"submit\"  title=\"Rinomina galleria\" value=\"Rinomina galleria\"/>
				</form>
				</td>";
				
			echo "<td class=\"notPrint\">
				<form method=\"post\" action=\"listaFoto.php?album=".$a['Album']."\" >
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
	close_connection();
	echo $foot;
	echo $closebody;
	echo $closehtml;
?>