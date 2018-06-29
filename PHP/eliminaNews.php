<?php
	require_once('config.php');
	register('title');
	register('image');
	$file_to_delete = '../Uploads/upNews/'.$image;
	unlink($file_to_delete);
	query("DELETE FROM news WHERE Titolo='$title'");
	close_connection();
	header("Location:gestisciNews.php");
?>