<?php
require_once('config.php');
register('title');
register('image');
$file_to_delete = '../uploads/'.$image;
unlink($file_to_delete);
query("DELETE FROM news WHERE Titolo='$title'");
header("Location:Gestisci news.php");
?>