<?php
require_once('config.php');
register('name');
query("DELETE FROM galleria WHERE Album='$name'");
header("Location:Lista album.php");
?>