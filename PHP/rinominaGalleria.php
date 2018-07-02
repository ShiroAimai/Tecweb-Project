<?php
	require_once('config.php');
	register('title');
	register('rename');
	$dir_to_rename = '../Uploads/upGalleria/'.$title.'/';
	$dir_new_name = '../Uploads/upGalleria/'.$rename.'/';
	$rename = test_input($rename);
	if(isset($rename) && !empty($rename)) {
		query("UPDATE galleria SET Album='$rename' WHERE Album='$title'");
		close_connection();
	}
	else {
		header("Location: operazioneFallita.php");
		die();
	}
	rename($dir_to_rename, $dir_new_name);
	header("Location:gestisciAlbum.php");
?>