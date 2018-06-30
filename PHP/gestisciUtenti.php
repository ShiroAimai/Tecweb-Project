<?php
	require_once('config.php');
    require_once('printHeader.php');
    $foot = file_get_contents("../Templates/footer.txt");
	$gestisciUser = file_get_contents("../Templates/gestisciUser.txt");
	$notAdmin = file_get_contents("../Templates/notAdmin.txt");
	$logout = "<button id=\"logoutButton\" onclick=\"window.location.href='logout.php'\"><span lang=\"en\">Logout</span></button>";
	$login = "<button onclick=\"window.location.href='areaPersonale.php'\">Area Personale</button>";
	$adminPanel = "<button onclick=\"window.location.href='adminPanel.php'\"><span lang=\"en\">Admin Panel</span></button>";
	$userPanel = "<button onclick=\"window.location.href='userPanel.php'\"><span lang=\"en\">User Panel</span</button>";
	$closediv = "</div>";
	$closebody = "</body>";
	$closehtml = "</html>";
	
	printHead('Gestisci utenti');
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
		echo $gestisciUser;
		$sql = "SELECT * FROM utente WHERE Tipo='user' ORDER BY CodiceUtente";
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
			
			echo "<td class=\"notPrint\">
				<form method=\"post\" action=\"eliminaUtente.php\" onsubmit=\"return confirm('Confermi di voler eliminare l\'utente?');\" >
					<input type=\"hidden\"  name=\"type\" value=\"" . $u['Tipo'] . "\"/>
					<input type=\"hidden\"  name=\"user\" value=\"" . $u['CodiceUtente'] . "\"/>
					<label class=\"invisibleLabel\" for=\"" . $u['CodiceUtente'] . "\">Elimina utente</label>
					<input id=\"".$u['CodiceUtente']."\" type=\"submit\"  title=\"Elimina utente\" value=\"Elimina utente\"/>
				</form>
				</td>";
				
			echo "<td class=\"notPrint\">
				<form method=\"post\" action=\"aggiungiScheda.php\" enctype=\"multipart/form-data\" >
					<input type=\"hidden\"  name=\"user\" value=\"" . $u['CodiceUtente'] . "\"/>
					<label class=\"invisibleLabel\" for=\"" . $u['CodiceUtente'] . "\">Aggiungi scheda</label>
					<input id=\"".$u['CodiceUtente']."\" name=\"".$u['CodiceUtente']."\" type=\"file\" accept=\"application/pdf\"  title=\"Aggiungi scheda\" value=\"Aggiungi scheda\" onchange=\"form.submit()\"/>
				</form>
				</td>";
				
			echo "<td class=\"notPrint\">
				<form method=\"post\" action=\"listaFatture.php?user=".$u['CodiceUtente']."\" >
					<input type=\"hidden\"  name=\"user\" value=\"" . $u['CodiceUtente'] . "\"/>
					<label class=\"invisibleLabel\" for=\"" . $u['CodiceUtente'] . "\">Vedi fatture</label>
					<input id=\"".$u['CodiceUtente']."\" type=\"submit\"  title=\"Vedi fatture\" value=\"Vedi fatture\"/>
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