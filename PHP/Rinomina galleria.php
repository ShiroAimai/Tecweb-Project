<?php
require_once('config.php');
register('title');
register('rename');
$dir_to_rename = '../galleria/'.$title.'/';
$dir_new_name = '../galleria/'.$rename.'/';
if(query("UPDATE galleria SET Album='$rename' WHERE Album='$title'") == FALSE)
		header("Location: queryfallita.php");
rename($dir_to_rename, $dir_new_name);
header("Location:Lista album.php");
?>