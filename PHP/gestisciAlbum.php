<?php
	require_once('config.php');
    require_once('printHeader.php');
    $foot = file_get_contents("../Templates/footer.txt");
	$gestisciAlbum = file_get_contents("../Templates/gestisciAlbum.txt");
	$notAdmin = file_get_contents("../Templates/notAdmin.txt");
	$logout = "<a id=\"logoutButton\" title=\"Effettua il logout\" href=\"logout.php\"><span lang=\"en\">Logout</span></a>";
	$login = "<a id=\"panelButton\" title=\"Effettua il login\" href=\"areaPersonale.php\">Area Personale</a>";
	$adminPanel = "<a id=\"panelButton\" title=\"Vai al pannello amministratore\" href=\"adminPanel.php\"><span lang=\"en\">Admin Panel</span></a>";
	$userPanel = "<a id=\"panelButton\" title=\"Vai al pannello utente\" href=\"userPanel.php\"><span lang=\"en\">User Panel</span></a>";
	$closediv = "</div>";
	$closebody = "</body>";
	$closehtml = "</html>";
	$id = 1;
	
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
					<label class=\"invisibleLabel\" for=\"" . $id . "\">Elimina galleria</label>
					<input id=\"".$id."\" name=\"".$id."\" type=\"submit\"  title=\"Elimina galleria ".$a['Album']."\" value=\"Elimina galleria\"/>
				</form>
				</td>";
				
			$id++;
				
			echo "<td class=\"notPrint\">
				<form method=\"post\" action=\"rinominaGalleria.php\" >
					<input type=\"hidden\"  name=\"title\" value=\"" . $a['Album'] . "\"/>
					<label class=\"invisibleLabel\" for=\"rename".$a['Album']."\">Rinomina galleria</label>
					<input id=\"rename".$a['Album']."\" name=\"rename\" type=\"text\"  title=\"Inserisci il nuovo nome dell'album\" required />
					<input type=\"submit\" title=\"Rinomina galleria ".$a['Album']."\" value=\"Rinomina galleria\"/>
				</form>
				</td>";
				
			echo "<td class=\"notPrint\">
				<form method=\"post\" action=\"listaFoto.php?album=".$a['Album']."\" >
					<input type=\"hidden\"  name=\"title\" value=\"" . $a['Album'] . "\"/>
					<label class=\"invisibleLabel\" for=\"" . $id . "\">Vedi foto</label>
					<input id=\"".$id."\" name=\"".$id."\" type=\"submit\"  title=\"Gestisci foto album\" value=\"Gestisi foto\"/>
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