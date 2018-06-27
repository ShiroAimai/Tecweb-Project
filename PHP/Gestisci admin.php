<?php
	require_once('config.php');
    $head = file_get_contents("../Templates/headerGestisciAdmin.txt");
    $foot = file_get_contents("../Templates/footer.txt");
	$gestisciAdmin = file_get_contents("../Templates/GestisciAdmin.txt");
	$notAdmin = file_get_contents("../Templates/NotAdmin.txt");
	$logout = "<button id=\"logoutButton\" onclick=\"window.location.href='logout.php'\">Logout</button>";
	$login = "<button onclick=\"window.location.href='AreaPersonale.php'\">Area Personale</button>";
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
		echo $gestisciAdmin;
		$sql = "SELECT * FROM utente WHERE Tipo='admin' ORDER BY CodiceUtente";
		$utenti=select($sql);
		if ($utenti == null) {
			echo "<tr><td colspan=7 >Nessun risultato</td>";
		}
		foreach ($utenti as $u) {
			echo "<tr>";

			echo "<td>".$u['CodiceUtente'];
			echo "</td>";

			echo "<td>".$u['Nome'];
			echo "</td>";
						
			echo "<td>".$u['Cognome'];
			echo "</td>";
						
			echo "<td>".$u['Password'];
			echo "</td>";
					
			echo "<td>".$u['Email'];
			echo "</td>";
			
			echo "<td>
				<form method=\"post\" action=\"Elimina utente.php\" onsubmit=\"return confirm('Confermi di voler eliminare l\'utente?');\" >
					<input type=\"hidden\"  name=\"type\" value=\"" . $u['Tipo'] . "\"/>
					<input type=\"hidden\"  name=\"user\" value=\"" . $u['CodiceUtente'] . "\"/>
					<label class=\"invisibleLabel\" for=\"" . $u['CodiceUtente'] . "\">Elimina utente</label>
					<input id=\"".$u['CodiceUtente']."\" type=\"submit\"  title=\"Elimina utente\" value=\"Elimina utente\"/>
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