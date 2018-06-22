<?php
require_once('config.php');
register('title');
query("DELETE FROM news WHERE Titolo='$title'");
header("Location:Lista news.php");
?>