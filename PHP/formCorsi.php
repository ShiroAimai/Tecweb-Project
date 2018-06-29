<?php
	require_once('config.php');
    require_once('printHeader.php');
    $foot = file_get_contents("../Templates/footer.txt");
	$formcorsi = file_get_contents("../Templates/formAggCorsi.txt");
	$disiscrizFormCorsi = file_get_contents("../Templates/disiscrizFormCorsi.txt");
	$endFormCorsi = file_get_contents("../Templates/endFormCorsi.txt");
	$backpanel =  file_get_contents("../Templates/backPanelUtente.txt");
	$notAdmin = file_get_contents("../Templates/notAdmin.txt");
	$logout = "<button id=\"logoutButton\" onclick=\"window.location.href='logout.php'\"><span xml:lang=\"en\">Logout</span></button>";
	$login = "<button onclick=\"window.location.href='areaPersonale.php'\">Area Personale</button>";
	$adminPanel = "<button onclick=\"window.location.href='adminPanel.php'\"><span xml:lang=\"en\">Admin Panel</span></button>";
	$userPanel = "<button onclick=\"window.location.href='userPanel.php'\"><span xml:lang=\"en\">User Panel</span</button>";
	$pswvalidation = "<script src=\"../JS/pswValidation.js\"></script>";
	$closediv = "</div>";
	$closebody = "</body>";
	$closehtml = "</html>";
	
	if($_GET['attr']== 0)
		printHead('Iscrizione corsi');
	else
		printHead('Disiscrizione corsi');
	if(isset($_SESSION['user_code']) && $_SESSION['user_type'] == 'user') {
		echo $logout;
		echo $userPanel;
	} else {
		echo $login;
	}
	
	echo $closediv;
	echo $closediv;


	if(isset($_SESSION['user_code']) && $_SESSION['user_type'] == 'user') {
        $counter = 1;
        if($_GET['attr'] == 0) {
            $corsiDisp = select("SELECT NomeCorso from corso where NomeCorso <> all(SELECT NomeCorso from iscrizionecorso where CodiceUtente = ".$_SESSION['user_code'].")");
		    echo $formcorsi;

		    while($counter <= sizeOf($corsiDisp))
		        {
		            echo " </br><input type=\"checkbox\" name=\"select".$counter."\" id=\"select".$counter."\" value=\"".$corsiDisp[$counter-1]['NomeCorso']."\" /> ".$corsiDisp[$counter-1]['NomeCorso']."";
		            $counter++;
		         }

		    if($counter ==1)
                echo "</br> Sei già iscritto a tutti i corsi disponibili nella nostra palestra!";
		}
		else if($_GET['attr'] == 1) {
		    $corsiRimov = select("SELECT NomeCorso from iscrizionecorso where CodiceUtente = ".$_SESSION['user_code']."");
		    echo $disiscrizFormCorsi;

            while($counter <= sizeOf($corsiRimov))
            {
                echo " </br><input type=\"checkbox\" name=\"select".$counter."\" id=\"select".$counter."\" value=\"".$corsiRimov[$counter-1]['NomeCorso']."\" /> ".$corsiRimov[$counter-1]['NomeCorso']." ";
                $counter++;
            }
            if($counter ==1)
               echo "</br> Non sei iscritto a nessuno dei corsi disponibili nella nostra palestra!";
		}
		if($counter == 1)
		    echo $backpanel;
		else
		    echo $endFormCorsi;
	}
	else {
		echo $notAdmin;
	}
	
	close_connection();
	echo $foot;
	echo $closebody;
	echo $closehtml;
?>