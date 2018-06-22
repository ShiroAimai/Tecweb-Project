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
		
		$stampa .= "<h1 class=\"userData\">Dati utente:</h1>";
		$stampa .="<div class=\"TabUtente\">";
		$stampa .="<h2 class=\"EntryUtente\"> CodiceUtente:</h2><h2 class=\"EntryTab\">&nbsp;" .$data['CodiceUtente']."&ensp;</h2>";
		$stampa .="<h2 class=\"EntryUtente\"> Password: </h2><h2 class=\"EntryTab\">&nbsp;" .$data['Password']."&ensp;</h2>";
		$stampa .="<h2 class=\"EntryUtente\"> Nome: </h2><h2 class=\"EntryTab\">&nbsp;" .$data['Nome']."&ensp;</h2>";
		$stampa .="<h2 class=\"EntryUtente\"> Cognome: </h2><h2 class=\"EntryTab\">&nbsp;" .$data['Cognome']."&ensp;</h2>";
		$stampa .="<h2 class=\"EntryUtente\"> Email: </h2><h2 class=\"EntryTab\">&nbsp;" .$data['Email']."&ensp;</h2>";
		$stampa .="</div>";
		
		
		//Dati abbonamento
		$query2 = query("SELECT ScadenzaFitness, PuntiCorsi from abbonamento where CodiceUtente=$usercode");
		$data = mysqli_fetch_assoc($query2);
		
		$stampa .= "<h1 class=\"userData\">Dati abbonamento:</h1>";
		$stampa .="<div class=\"TabUtente2\">";
		$stampa .="<h2 class=\"EntryUtente\"> Validit&agrave; abbonamento:</h2>";
		if($data['ScadenzaFitness'] != null)
			$stampa .="<h2 class=\"EntryTab\">&nbsp;" .$data['ScadenzaFitness']."&ensp;</h2>";
		else
			$stampa .=" <h2 class=\"EntryTab\">&nbsp;Scaduto!&ensp;</h2>";
		$stampa .="<h2 class=\"EntryUtente\"> Punti accumulati:</h2><h2 class=\"EntryTab\">&nbsp;" .$data['PuntiCorsi']."&ensp;</h2>";
		$stampa .="</div>";

		//Corsi a cui si è iscritti
		$query3 = query("SELECT NomeCorso from iscrizionecorso where CodiceUtente=$usercode");
		$stampa .= "<h1 class=\"userData\">Corsi a cui si &egrave; iscritti:</h1>";
		$stampa .="<div class=\"TabUtente\">";
		while($data = mysqli_fetch_assoc($query3)){
			$stampa .="<h2 class=\"EntryUtente\">&nbsp;" .$data['NomeCorso']."&ensp;</h2>";
			$stampa .="</br>";
		}
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