<?php if(isset($_SESSION['user_code'])){ ?>
	<button onclick="window.location.href='logout.php'">Logout</button>
<?php }else{ ?>
	<button onclick="window.location.href='AreaPersonale.php'">Area Personale</button>
<?php } ?>