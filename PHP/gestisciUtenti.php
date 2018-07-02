<?php
	require_once('config.php');
    require_once('printHeader.php');
    $foot = file_get_contents("../Templates/footer.txt");
	$gestisciUser = file_get_contents("../Templates/gestisciUser.txt");
	$notAdmin = file_get_contents("../Templates/notAdmin.txt");
	$logout = "<a id=\"logoutButton\" title=\"Effettua il logout\" href=\"logout.php\"><span lang=\"en\">Logout</span></a>";
	$login = "<a id=\"panelButton\" title=\"Effettua il login\" href=\"areaPersonale.php\">Area Personale</a>";
	$adminPanel = "<a id=\"panelButton\" title=\"Vai al pannello amministratore\" href=\"adminPanel.php\"><span lang=\"en\">Admin Panel</span></a>";
	$userPanel = "<a id=\"panelButton\" title=\"Vai al pannello utente\" href=\"userPanel.php\"><span lang=\"en\">User Panel</span></a>";
	$closediv = "</div>";
	$closebody = "</body>";
	$closehtml = "</html>";
	$id = 1;
	
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
					<label class=\"invisibleLabel\" for=\"" . $id . "\">Elimina utente</label>
					<input id=\"".$id."\" type=\"submit\"  title=\"Elimina utente ".$u['CodiceUtente']." ".$u['Nome']." ".$u['Cognome']."\" value=\"Elimina utente\"/>
				</form>
				</td>";
			
			$id++;
				
			echo "<td class=\"notPrint\">
				<form method=\"post\" action=\"aggiungiScheda.php\" enctype=\"multipart/form-data\" >
					<input type=\"hidden\"  name=\"user\" value=\"" . $u['CodiceUtente'] . "\"/>
					<label class=\"invisibleLabel\" for=\"" . $id . "\">Aggiungi scheda</label>
					<input id=\"".$id."\" name=\"".$id."\" type=\"file\" accept=\"application/pdf\"  title=\"Aggiungi scheda all'utente ".$u['CodiceUtente']." ".$u['Nome']." ".$u['Cognome']."\" onchange=\"form.submit()\"/>
				</form>
				</td>";
				
			$id++;
				
			echo "<td class=\"notPrint\">
				<form method=\"post\" action=\"listaFatture.php?user=".$u['CodiceUtente']."\" >
					<input type=\"hidden\"  name=\"user\" value=\"" . $u['CodiceUtente'] . "\"/>
					<label class=\"invisibleLabel\" for=\"" . $id . "\">Vedi fatture</label>
					<input id=\"".$id."\" type=\"submit\"  title=\"Vedi le fatture dell'utente ".$u['CodiceUtente']." ".$u['Nome']." ".$u['Cognome']."\" value=\"Vedi fatture\"/>
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