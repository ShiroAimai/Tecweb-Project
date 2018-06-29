<?php
	require_once('config.php');
	register('title');
	$dir_to_delete = '../Uploads/upGalleria/'.$title.'/';
	$files = glob($dir_to_delete . '*', GLOB_MARK);
		foreach ($files as $file) {
			if (is_dir($file)) {
				self::deleteDir($file);
			} else {
				unlink($file);
			}
		}
		rmdir($dir_to_delete);
	query("DELETE FROM galleria WHERE Album='$title'");
	close_connection();
	header("Location:gestisciAlbum.php");
?>