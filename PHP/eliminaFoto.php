<?php
	require_once('config.php');
	register('folder');
	register('image');
	$file_to_delete = '../Uploads/upGalleria/'.$folder.'/'.$image;
	unlink($file_to_delete);
	query("DELETE FROM galleria WHERE NomeImmagine='$image' AND Album='$folder'");
	$aux=$_GET['albumT'];
	if (count(glob('../Uploads/upGalleria/'.$folder.'/*')) === 0) {
		rmdir('../Uploads/upGalleria/'.$folder.'/');
	}
	close_connection();
	header("Location:listaFoto.php?album=$aux");
?>