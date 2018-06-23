<?php
require_once('config.php');
register('title');
register('rename');
$dir_to_rename = '../galleria/'.$title.'/';
$dir_new_name = '../galleria/'.$rename.'/';
query("UPDATE galleria SET Album='$rename' WHERE Album='$title'");
rename($dir_to_rename, $dir_new_name);
header("Location:Lista album.php");
?>