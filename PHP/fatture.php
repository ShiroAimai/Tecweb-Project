<?php
	require_once('config.php');
    $head = file_get_contents("../Templates/headerUserList.txt");
    $foot = file_get_contents("../Templates/footer.txt");
	$listaFatture = file_get_contents("../Templates/ListaFatture.txt");
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
	register('user');
	if(isset($_SESSION['user_code']) && $_SESSION['user_type'] == 'admin') {
		echo $listaFatture;
		$sql = "SELECT * FROM fattura WHERE CodiceUtente='$user' ORDER BY DataEmissione";
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