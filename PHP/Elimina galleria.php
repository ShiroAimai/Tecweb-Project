<?php
require_once('config.php');
register('title');
query("DELETE FROM galleria WHERE Album='$title'");
header("Location:Lista album.php");
?>