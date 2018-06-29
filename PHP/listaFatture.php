<?php
	require_once('config.php');
    require_once('printHeader.php');
    $foot = file_get_contents("../Templates/footer.txt");
	$listaFatture = file_get_contents("../Templates/ListaFatture.txt");
	$notAdmin = file_get_contents("../Templates/NotAdmin.txt");
	$logout = "<button id=\"logoutButton\" onclick=\"window.location.href='logout.php'\">Logout</button>";
	$login = "<button onclick=\"window.location.href='AreaPersonale.php'\">Area Personale</button>";
	$adminPanel = "<button onclick=\"window.location.href='AdminPanel.php'\">Admin Panel</button>";
	$userPanel = "<button onclick=\"window.location.href='UserPanel.php'\">User Panel</button>";
	$closediv = "</div>";
	$closebody = "</body>";
	$closehtml = "</html>";
	
	printHead('Lista fatture');
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
		echo $listaFatture;
		$aux=$_GET['user'];
		$sql = "SELECT * FROM fattura WHERE CodiceUtente='$aux' ORDER BY DataEmissione DESC";
		$fatture=select($sql);
		if ($fatture == null) {
			echo "<tr><td colspan=7 >Nessun risultato</td>";
		}
		foreach ($fatture as $f) {
			echo "<tr>";

			echo "<td>".$f['NumeroRicevuta'];
			echo "</td>";

			echo "<td>".$f['DataEmissione'];
			echo "</td>";
						
			echo "<td>".$f['ImportoEuro'];
			echo "</td>";
					
			echo "<td>".$f['MesiFitness'];
			echo "</td>";
			
			echo "<td>".$f['EntrateCorsi'];
			echo "</td>";

			echo "<td class=\"notPrint\">
				<form method=\"post\" action=\"Elimina fattura.php?user=".$f['CodiceUtente']."\" onsubmit=\"return confirm('Confermi di voler eliminare questa fattura?');\" >
					<input type=\"hidden\"  name=\"fattura\" value=\"" . $f['NumeroRicevuta'] . "\"/>
					<label class=\"invisibleLabel\" for=\"" . $f['NumeroRicevuta'] . "\">Elimina fattura</label>
					<input id=\"".$f['NumeroRicevuta']."\" type=\"submit\"  title=\"Elimina fattura\" value=\"Elimina fattura\"/>
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