<?php
	require_once('config.php');
    $head = file_get_contents("../Templates/headerFormCorsi.txt");
    $foot = file_get_contents("../Templates/footer.txt");
	$formcorsi = file_get_contents("../Templates/formAggcorsi.txt");
	$disiscrizFormCorsi = file_get_contents("../Templates/disiscrizFormCorsi.txt");
	$endFormCorsi = file_get_contents("../Templates/endFormCorsi.txt");
	$notAdmin = file_get_contents("../Templates/NotAdmin.txt");
	$logout = "<button id=\"logoutButton\" onclick=\"window.location.href='logout.php'\">Logout</button>";
	$login = "<button onclick=\"window.location.href='AreaPersonale.php'\">Area Personale</button>";
	$adminPanel = "<button onclick=\"window.location.href='AdminPanel.php'\">Admin Panel</button>";
	$userPanel = "<button onclick=\"window.location.href='UserPanel.php'\">User Panel</button>";
	$pswvalidation = "<script src=\"../JS/PswValidation.js\"></script>";
	$closediv = "</div>";
	$closebody = "</body>";
	$closehtml = "</html>";
	
	echo $head;
	if(isset($_SESSION['user_code']) && $_SESSION['user_type'] == 'user') {
		echo $logout;
		echo $userPanel;
	} else {
		echo $login;
	}
	
	echo $closediv;
	echo $closediv;


	if(isset($_SESSION['user_code']) && $_SESSION['user_type'] == 'user') {

        if($_GET['attr'] == 0) {
            $corsiDisp = select("SELECT NomeCorso from corso where NomeCorso <> all(SELECT NomeCorso from iscrizionecorso where CodiceUtente = ".$_SESSION['user_code'].")");
		    echo $formcorsi;
		    $counter = 1;
		    while($counter <= sizeOf($corsiDisp))
		        {
		            echo "<input type=\"checkbox\" name=\"select".$counter."\" id=\"select".$counter."\" value=\"".$corsiDisp[$counter-1]['NomeCorso']."\" /> ".$corsiDisp[$counter-1]['NomeCorso']." </br> ";
		            $counter++;
		         }

		    if($counter ==1)
                echo "</br> Sei già iscritto a tutti i corsi disponibili nella nostra palestra!";
		}
		else if($_GET['attr'] == 1) {
		    $corsiRimov = select("SELECT NomeCorso from iscrizionecorso where CodiceUtente = ".$_SESSION['user_code']."");
		    echo $disiscrizFormCorsi;
		    $counter = 1;
            while($counter <= sizeOf($corsiRimov))
            {
                echo "<input type=\"checkbox\" name=\"select".$counter."\" id=\"select".$counter."\" value=\"".$corsiRimov[$counter-1]['NomeCorso']."\" /> ".$corsiRimov[$counter-1]['NomeCorso']." </br> ";
                $counter++;
            }
            if($counter ==1)
               echo "</br> Non sei iscritto a nessuno dei corsi disponibili nella nostra palestra!";
		}
		 echo $endFormCorsi;
	}
	else {
		echo $notAdmin;
	}
	
	echo $foot;
	echo $closebody;
	echo $closehtml;
?>