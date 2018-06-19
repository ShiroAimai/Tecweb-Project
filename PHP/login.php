<?php
require_once('config.php');
register('userCode');
register('pass');

$utente_trovato = select("
SELECT * FROM utente
WHERE CodiceUtente='$userCode'
AND Password='$pass';
");

if(count($utente_trovato) > 0){
  //qualcuno è stato trovato
  // imposto i parametri nella sessione
  $_SESSION['user_code'] = $utente_trovato[0]['CodiceUtente'];
  $_SESSION['user_name'] = $utente_trovato[0]['Nome'];
  $_SESSION['user_surname'] = $utente_trovato[0]['Cognome'];
  header("Location:Home.php");
}
else { // utente non trovato nel database
  header("Location:Errorelogin.php");
}
?>
