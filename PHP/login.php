<?php
	session_start();
	if($_POST['codice']=='admin' && $_POST['pass']=='admin')
	{
		$_SESSION['wrong_login']=0;
		$_SESSION['logged']= 1;
		header("Location:../HTML/Calendario.html");
	}
	else if($_POST['codice']=='utente' && $_POST['pass']=='utente')
		{
			$_SESSION['wrong_login']=0;
			$_SESSION['logged']= 1;
			header("Location:../HTML/Attivita.html");
		}
		else
		{
			$_SESSION['wrong_login']= 1; // flag degli errori: sbaglio le credenziali, ricarico la pagina adminLogin.php con il mess di errore.
			header("Location:../HTML/Errorelogin.html");
		}
?>
