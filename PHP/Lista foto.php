<?php
	require_once('config.php');
    require_once('printHeader.php');
    $foot = file_get_contents("../Templates/footer.txt");
	$listaFoto = file_get_contents("../Templates/ListaFoto.txt");
	$notAdmin = file_get_contents("../Templates/NotAdmin.txt");
	$logout = "<button id=\"logoutButton\" onclick=\"window.location.href='logout.php'\">Logout</button>";
	$login = "<button onclick=\"window.location.href='AreaPersonale.php'\">Area Personale</button>";
	$adminPanel = "<button onclick=\"window.location.href='AdminPanel.php'\">Admin Panel</button>";
	$userPanel = "<button onclick=\"window.location.href='UserPanel.php'\">User Panel</button>";
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
			
			echo "<td>
				<form method=\"post\" action=\"Elimina foto.php?albumT=".$f['Album']."\" onsubmit=\"return confirm('Confermi di voler eliminare la foto?');\" >
					<input type=\"hidden\"  name=\"folder\" value=\"" . $f['Album'] . "\"/>
					<input type=\"hidden\"  name=\"image\" value=\"" . $f['NomeImmagine'] . "\"/>
					<label class=\"invisibleLabel\" for=\"" . $f['NomeImmagine'] . "\">Elimina foto</label>
					<input id=\"".$f['NomeImmagine']."\" type=\"submit\"  title=\"Elimina foto\" value=\"Elimina foto\"/>
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