<?php
	require_once('config.php');
    $head = file_get_contents("../Templates/headerUserPanel.txt");
    $foot = file_get_contents("../Templates/footer.txt");
	$UserPanel = file_get_contents("../Templates/UserPanel.txt");
	$notAdmin = file_get_contents("../Templates/NotAdmin.txt");
	$logout = "<button id=\"logoutButton\" onclick=\"window.location.href='logout.php'\">Logout</button>";
	$login = "<button onclick=\"window.location.href='AreaPersonale.php'\">Area Personale</button>";
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
		$query = query("SELECT CodiceUtente, Password, Nome, Cognome, Email FROM utente WHERE CodiceUtente=$usercode");
		$data = mysqli_fetch_assoc($query);
		$name =$data['Nome'];
		$cognome =$data['Cognome'];
		$stampa ="<div id=\"datiUtente\"class=\"bloccoDati\">";
		$stampa .="<div class=\"userData\">Dati utente:</div>";
		$stampa .="<div class=\"TabUtente\">";
		$stampa .="<div  id=\"NomeUtente\"><div class=\"EntryUtente\"> Nome: </div><div class=\"EntryTab\">&nbsp;" .$data['Nome']."&ensp;</div></div>";
		$stampa .="<div id=\"CognomeUtente\"><div class=\"EntryUtente\"> Cognome: </div><div class=\"EntryTab\">&nbsp;" .$data['Cognome']."&ensp;</div></div>";
		$stampa .="<div id=\"MailUtente\"><div class=\"EntryUtente\"> Email: </div><div class=\"EntryTab\">&nbsp;" .$data['Email']."&ensp;</div></div>";
		$stampa .="</div></div>";
		
		//Dati abbonamento
		$query2 = query("SELECT ScadenzaFitness, EntrateCorsi FROM abbonamento WHERE CodiceUtente=$usercode");
		$data = mysqli_fetch_assoc($query2);
		$stampa .="<div id=\"datiAbbonamento\" class=\"bloccoDati\">";
		$stampa .= "<div class=\"userData\">Dati abbonamento:</div>";
		$stampa .="<div class=\"TabUtente\">";
		$stampa .="<div class=\"EntryUtente\"> Validit&agrave; abbonamento:</div>";
		if($data['ScadenzaFitness'] >= date("Y-m-d"))
			$stampa .="<div id\"scadenzaAbbonamento\" class=\"EntryTab\">&nbsp;" .$data['ScadenzaFitness']."&ensp;</div>";
		else
			$stampa .=" <div class=\"EntryTab\">&nbsp;Scaduto!&ensp;</div>";
		$stampa .="<div class=\"EntryUtente\"> Entrate corsi:</div><div class=\"EntryTab\">&nbsp;" .$data['EntrateCorsi']."&ensp;</div></div>";
		$stampa .="</div>";

		//Corsi a cui si è iscritti
		$query3 = query("SELECT NomeCorso FROM iscrizionecorso WHERE CodiceUtente=$usercode");
		$stampa .="<div id=\"datiCorso\" class=\"bloccoDati\">";
		$stampa .= "<div class=\"userData\">I tuoi corsi:</div>";
		$stampa .="<div class=\"TabUtente\">";
		$countercorsi=1;
		$ok = FALSE;
		while($data = mysqli_fetch_assoc($query3)){
		    $ok = TRUE;
			$stampa .="<div id=\"contatoreCorsi\" class=\"EntryUtente\">$countercorsi.</div><div id=\"nomeCorso\" class=\"EntryTab\"> &nbsp;".$data['NomeCorso']."&ensp;</div>";
			$countercorsi++;
		}
		if($ok == FALSE)
			$stampa	.= "<div class=\"EntryTab\">Non sei iscritto a nessun corso di questa palestra!</div>";
		$stampa .="</div>";
		$stampa .="</div>";
		
		//Button iscrizione corsi
		$stampa .="<div id=\"iscrizioneCorsi\" class=\"bloccoDati\">";
		$stampa .= "<div class=\"userData\">Iscriviti a nuovi corsi:</div>";
		$stampa .="<a href=\"formCorsi.php?attr=0\"><button class=\"btn btn-10 btn-sep icon-addcorso\">Iscrizione corsi</button></a>";
		$stampa .="</div>";

		//Button disiscrizione corsi
        $stampa .="<div id=\"discrizioneCorsi\" class=\"bloccoDati\">";
        $stampa .= "<div class=\"userData\">Cancella la tua iscrizione ai corsi:</div>";
        $stampa .="<a href=\"formCorsi.php?attr=1\"><button class=\"btn btn-12 btn-sep icon-removecorso\">Disiscrizione corsi</button></a>";
        $stampa .="</div>";


		//Button di download scheda
		$query4 = query("SELECT LinkScheda FROM scheda WHERE CodiceUtente=$usercode");
		$data = mysqli_fetch_assoc($query4);
		$stampa .="<div id=\"datiScheda\" class=\"bloccoDati\">";
		$stampa .= "<div class=\"userData\">La tua scheda:</div>";
		if($data['LinkScheda']!=null) {
			//mi cerca la scheda nella dir schede col nome corrispondente salvato sul db
			$stampa .= "<a href=\"../schede/".$data['LinkScheda']."\" download=\"Scheda ".$name." ".$cognome."\">";
			$stampa .= "<button class=\"btn btn-11 btn-sep icon-schedadownimg\">Scarica scheda</button></a>";
		}
		else
			$stampa.="<div class=\"EntryUtente\">Nessuna scheda associata.</div>";

		$stampa .="</div>";



		echo $stampa;
	}
	else {
		echo $notAdmin;
	}
	close_connection();
	echo $foot;
	echo $closebody;
	echo $closehtml;
?>