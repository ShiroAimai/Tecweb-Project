<?php
	require_once('config.php');
    require_once('printHeader.php');
    $foot = file_get_contents("../Templates/footer.txt");
	$listaFoto = file_get_contents("../Templates/listaFoto.txt");
	$notAdmin = file_get_contents("../Templates/notAdmin.txt");
	$logout = "<a id=\"logoutButton\" title=\"Effettua il logout\" href=\"logout.php\"><span lang=\"en\">Logout</span></a>";
	$login = "<a id=\"panelButton\" title=\"Effettua il login\" href=\"areaPersonale.php\">Area Personale</a>";
	$adminPanel = "<a id=\"panelButton\" title=\"Vai al pannello amministratore\" href=\"adminPanel.php\"><span lang=\"en\">Admin Panel</span></a>";
	$userPanel = "<a id=\"panelButton\" title=\"Vai al pannello utente\" href=\"userPanel.php\"><span lang=\"en\">User Panel</span></a>";
	$closediv = "</div>";
	$closebody = "</body>";
	$closehtml = "</html>";
	
	printHead('Lista foto');
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
		echo $listaFoto;
		$aux=$_GET['album'];
		$sql = "SELECT * FROM galleria WHERE Album='$aux'";
		$foto=select($sql);
		if ($foto == null) {
			echo "<tr><td colspan=7 >Nessun risultato</td>";
		}
		foreach ($foto as $f) {
			echo "<tr>";

			echo "<td>".$f['Album'];
			echo "</td>";

			echo "<td>".$f['NomeImmagine'];
			echo "</td>";
			
			echo "<td class=\"notPrint\">
				<form method=\"post\" action=\"eliminaFoto.php?albumT=".$f['Album']."\" onsubmit=\"return confirm('Confermi di voler eliminare la foto?');\" >
					<input type=\"hidden\"  name=\"folder\" value=\"" . $f['Album'] . "\"/>
					<input type=\"hidden\"  name=\"image\" value=\"" . $f['NomeImmagine'] . "\"/>
					<label class=\"invisibleLabel\" for=\"" . $f['NomeImmagine'] . "\">Elimina foto</label>
					<input id=\"".$f['NomeImmagine']."\" type=\"submit\"  title=\"Elimina foto ".$f['NomeImmagine']."\" value=\"Elimina foto\"/>
				</form>
				</td>";
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