<?php
require_once('config.php');
register('folder');
register('image');
$file_to_delete = '../galleria/'.$folder.'/'.$image;
unlink($file_to_delete);
query("DELETE FROM galleria WHERE NomeImmagine='$image' AND Album='$folder'");
header("Location:Lista foto.php");
?>