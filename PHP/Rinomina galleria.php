<?php
	require_once('config.php');
	register('title');
	register('rename');
	$dir_to_rename = '../galleria/'.$title.'/';
	$dir_new_name = '../galleria/'.$rename.'/';
	if(isset($rename) && !empty($rename)) {
		$rename = test_input($rename);
		query("UPDATE galleria SET Album='$rename' WHERE Album='$title'");
		close_connection();
	}
	else {
		header("Location: queryfallita.php");
		die();
	}
	rename($dir_to_rename, $dir_new_name);
	header("Location:Gestisci album.php");
?>