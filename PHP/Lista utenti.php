<?php
	require_once('config.php');
    $head = file_get_contents("../Templates/headerUserList.txt");
    $foot = file_get_contents("../Templates/footer.txt");
	$userList = file_get_contents("../Templates/UserList.txt");
	$login = "<button onclick=\"window.location.href='logout.php'\">Logout</button>";
	$logout = "<button onclick=\"window.location.href='../HTML/AreaPersonale.html'\">Area Personale</button>";
	$closediv = "</div>";
	
	echo $head;
	if(isset($_SESSION['user_code'])) {
		echo $login;
	} else {
		echo $logout;
	}
	
	echo $closediv;
	echo $closediv;
	echo $userList;

    $sql = "SELECT * FROM utente ORDER BY CodiceUtente";
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
			
		echo "<td>".$u['Tipo'];
        echo "</td>";
		
		echo "<td>
			<form method=\"post\" action=\"elimina utente.php\" onsubmit=\"return confirm('Confermi di voler eliminare l\'utente?');\" >
				<input type=\"hidden\"  name=\"user\" value=\"" . $u['CodiceUtente'] . "\"/>
				<label class=\"invisibleLabel\" for=\"" . $u['CodiceUtente'] . "\">Elimina utente</label>
				<input id=\"".$u['CodiceUtente']."\" type=\"submit\"  title=\"Elimina utente\" value=\"Elimina utente\"/>
			</form>
			</td>";
    }
    echo "</tbody>";
    echo "</table>";
	echo $closediv;
	echo $foot;
?>