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
		if($query == null)
			header("Location: queryfallita.php");
		$data = mysqli_fetch_assoc($query);
		$name =$data['Nome'];
		$cognome =$data['Cognome'];
		$stampa ="<div id=\"datiUtente\"class=\"bloccoDati\">";
		$stampa .="<div class=\"userData\">Dati utente:</div>";
		$stampa .="<div class=\"TabUtente\">";
		$stampa .="<div  id=\"NomeUtente\" class=\"lineacapo\"><div class=\"EntryUtente\"> Nome: </div><div class=\"EntryTab\">&nbsp;" .$data['Nome']."&ensp;</div></div>";
		$stampa .="<div id=\"CognomeUtente\" class=\"lineacapo\"><div class=\"EntryUtente\"> Cognome: </div><div class=\"EntryTab\">&nbsp;" .$data['Cognome']."&ensp;</div></div>";
		$stampa .="<div id=\"MailUtente\" class=\"lineacapo\"><div class=\"EntryUtente\"> Email: </div><div class=\"EntryTab\">&nbsp;" .$data['Email']."&ensp;</div></div>";
		$stampa .="</div></div>";
		
		//Dati abbonamento
		$query2 = query("SELECT ScadenzaFitness, EntrateCorsi from abbonamento where CodiceUtente=$usercode");
		if($query2 == null)
			header("Location: queryfallita.php");
		$data = mysqli_fetch_assoc($query2);
		$stampa .="<div id=\"datiAbbonamento\" class=\"bloccoDati\">";
		$stampa .= "<div class=\"userData\">Dati abbonamento:</div>";
		$stampa .="<div class=\"TabUtente\">";
		$stampa .="<div class=\"lineacapo\"><div class=\"EntryUtente\"> Validit&agrave; abbonamento:</div>";
		if($data['ScadenzaFitness'] != null)
			$stampa .="<div id\"scadenzaAbbonamento\" class=\"EntryTab\">&nbsp;" .$data['ScadenzaFitness']."&ensp;</div></div>";
		else
			$stampa .=" <div class=\"EntryTab\">&nbsp;Scaduto!&ensp;</div></div>";
		$stampa .="<div id=\"puntiAccumulati\"class=\"lineacapo\"><div class=\"EntryUtente\"> Entrate corsi:</div><div class=\"EntryTab\">&nbsp;" .$data['EntrateCorsi']."&ensp;</div></div>";
		$stampa .="</div></div>";

		//Corsi a cui si è iscritti
		$query3 = query("SELECT NomeCorso from iscrizionecorso where CodiceUtente=$usercode");
		if($query3 == null)
			header("Location: queryfallita.php");
		$stampa .="<div id=\"datiCorso\" class=\"bloccoDati\">";
		$stampa .= "<div class=\"userData\">Corsi a cui si &egrave; iscritti:</div>";
		$stampa .="<div class=\"TabUtente\">";
		$countercorsi=1;
		while($data = mysqli_fetch_assoc($query3)){
			$stampa .="<div class=\"lineacapo\"><div id=\"numCorso\" class=\"EntryUtente\">$countercorsi.</div><div id=\"nomeCorso\" class=\"EntryTab\"> &nbsp;".$data['NomeCorso']."&ensp;</div></div>";
			$stampa .="</br>";
			$countercorsi++;
		}
		$stampa .="</div></div>";

		$stampa .="<div id=\"datiIscrizione\" class=\"bloccoDati\">";
		$stampa .= "<div id=\"voceformcorsi\" class=\"userData\">Iscriviti ad un nuovo corso:</div>";
		$stampa .="<a id=\"linkformcorsi\" href=\"formCorsi.php\" alt=\"Link al form predisposto per iscriversi ai corsi e aggiungere la voce al proprio profilo\">Iscriviti qui!</a>";
		$stampa .="</div>";

		//Button di download scheda
		$query4 = query("SELECT LinkScheda from scheda where CodiceUtente=$usercode");
		if($query4 == null)
			header("Location: queryfallita.php");
		$data = mysqli_fetch_assoc($query4);
		$stampa .="<div id=\"datiScheda\" class=\"bloccoDati2\">";
		$stampa .= "<div class=\"userData2\">Scarica la tua scheda:</div>";
		if($data['LinkScheda']!=null) {
			//mi cerca la scheda nella dir schede col nome corrispondente salvato sul db
			$stampa.="<a id=\"linkscheda\" href=\"../schede/".$data['LinkScheda']."\" download=\"Scheda ".$name." ".$cognome."\">";
			$stampa .= "<img id=\"schedadownimg\" src=\"../IMAGES/icone/downbutton.svg\" alt=\"Bottone di download scheda.\"></a>";
		}
		else
			$stampa.="<div class=\"TabUtente2\">Nessuna scheda associata.</div>";

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