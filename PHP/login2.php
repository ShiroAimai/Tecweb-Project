<?php
	session_start();
	

	$page= file_get_contents("../HTML/AreaPersonale.html");

	// se hai loggato, sei uscito tramite URL o Indietro, e rientri, compila il form in auto: come fare?


	// se _SESSION non è settata sono appena entrato; se ==0 sono entrato una volta dopo la prima, _SESSION è già stata settata e riposta a zero.
	if( !isset($_SESSION['wrong_login']) or $_SESSION['wrong_login']==0)
		$page= str_replace("myPlaceholder","",$page);


	//se _SESSION ==1 sono tornato nella pagina aver sbagliato le credenziali: riporto a 0 il flag degli errori e segnalo l'errore.
	else if($_SESSION['wrong_login']==1){
		$_SESSION['wrong_login']=0; 
		$page= str_replace("myPlaceholder","Errore: nome utente o password errati",$page);
	}

	echo $page;
?>