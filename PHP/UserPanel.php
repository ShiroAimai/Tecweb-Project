<?php
	require_once('config.php');
    $head = file_get_contents("../Templates/headerUserPanel.txt");
    $foot = file_get_contents("../Templates/footer.txt");
	$UserPanel = file_get_contents("../Templates/UserPanel.txt");
	$notAdmin = file_get_contents("../Templates/NotAdmin.txt");
	$logout = "<button id=\"logoutButton\" onclick=\"window.location.href='logout.php'\">Logout</button>";
	$login = "<button onclick=\"window.location.href='../HTML/AreaPersonale.html'\">Area Personale</button>";
	$adminPanel = "<button disabled onclick=\"window.location.href='AdminPanel.php'\">Admin Panel</button>";
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
	if(isset($_SESSION['user_code']) && $_SESSION['user_type'] == 'user') {
		echo $UserPanel;

		//Dati utente
		$usercode =$_SESSION['user_code'];
		$query = query("SELECT CodiceUtente, Password, Nome, Cognome, Email from utente where CodiceUtente=$usercode");
		$data = mysqli_fetch_assoc($query);
		$name =$data['Nome'];
		$cognome =$data['Cognome'];
		$stampa ="<div class=\"bloccoDati\">";
		$stampa .="<h1 class=\"userData\">Dati utente:</h1>";
		$stampa .="<div class=\"TabUtente\">";
		$stampa .="<div class=\"lineacapo\"><h2 class=\"EntryUtente\"> Nome: </h2><h2 class=\"EntryTab\">&nbsp;" .$data['Nome']."&ensp;</h2></div>";
		$stampa .="<div class=\"lineacapo\"><h2 class=\"EntryUtente\"> Cognome: </h2><h2 class=\"EntryTab\">&nbsp;" .$data['Cognome']."&ensp;</h2></div>";
		$stampa .="<div class=\"lineacapo\"><h2 class=\"EntryUtente\"> Email: </h2><h2 class=\"EntryTab\">&nbsp;" .$data['Email']."&ensp;</h2></div>";
		$stampa .="</div></div>";
		
		//Dati abbonamento
		$query2 = query("SELECT ScadenzaFitness, PuntiCorsi from abbonamento where CodiceUtente=$usercode");
		$data = mysqli_fetch_assoc($query2);
		$stampa .="<div class=\"bloccoDati\">";
		$stampa .= "<h1 class=\"userData\">Dati abbonamento:</h1>";
		$stampa .="<div class=\"TabUtente\">";
		$stampa .="<div class=\"lineacapo\"><h2 class=\"EntryUtente\"> Validit&agrave; abbonamento:</h2>";
		if($data['ScadenzaFitness'] != null)
			$stampa .="<h2 class=\"EntryTab\">&nbsp;" .$data['ScadenzaFitness']."&ensp;</h2></div>";
		else
			$stampa .=" <h2 class=\"EntryTab\">&nbsp;Scaduto!&ensp;</h2></div>";
		$stampa .="<div class=\"lineacapo\"><h2 class=\"EntryUtente\"> Punti accumulati:</h2><h2 class=\"EntryTab\">&nbsp;" .$data['PuntiCorsi']."&ensp;</h2></div>";
		$stampa .="</div></div>";

		//Corsi a cui si è iscritti
		$query3 = query("SELECT NomeCorso from iscrizionecorso where CodiceUtente=$usercode");
		$stampa .="<div class=\"bloccoDati\">";
		$stampa .= "<h1 class=\"userData\">Corsi a cui si &egrave; iscritti:</h1>";
		$stampa .="<div class=\"TabUtente\">";
		$countercorsi=1;
		while($data = mysqli_fetch_assoc($query3)){
			$stampa .="<h2 class=\"EntryUtente\">$countercorsi.</h2><h2 class=\"EntryTab\"> &nbsp;".$data['NomeCorso']."&ensp;</h2>";
			$stampa .="</br>";
			$countercorsi++;
		}
		$stampa .="</div></div>";

		//Button di download scheda
		$query4 = query("SELECT LinkScheda from scheda where CodiceUtente=$usercode");
		$data = mysqli_fetch_assoc($query4);
		$stampa .="<div class=\"bloccoDati2\">";
		$stampa .= "<h1 class=\"userData2\">Scarica la tua scheda:</h1>";
		if($data['LinkScheda']!=null) {
			//mi cerca la scheda nella dir schede col nome corrispondente salvato sul db
			$stampa.="<a id=\"linkscheda\" href=\"../schede/".$data['LinkScheda']."\" download=\"Scheda ".$name." ".$cognome."\">";
			$stampa .= "<img id=\"schedadownimg\" src=\"../IMAGES/icone/downbutton.svg\" alt=\"Bottone di download scheda.\"></a>";
		}
		else
			$stampa.="<h2 class=\"TabUtente2\">Nessuna scheda associata.</h2>";

		$stampa .="</div>";
		echo $stampa;
	}
	else {
		echo $notAdmin;
	}
	echo $foot;
	echo $closebody;
	echo $closehtml;
?>