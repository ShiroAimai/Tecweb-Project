<?php
require_once('config.php');
register('user');
query("DELETE FROM utente WHERE CodiceUtente=$user");
header("Location:Lista utenti.php");
?>