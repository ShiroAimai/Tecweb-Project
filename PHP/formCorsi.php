<?php
	require_once('config.php');
    require_once('printHeader.php');
    $foot = file_get_contents("../Templates/footer.txt");
	$formcorsi = file_get_contents("../Templates/formCorsi.txt");
	$disiscrizFormCorsi = file_get_contents("../Templates/disiscrizFormCorsi.txt");
	$notAdmin = file_get_contents("../Templates/notAdmin.txt");
	$logout = "<a id=\"logoutButton\" title=\"Effettua il logout\" href=\"logout.php\"><span lang=\"en\">Logout</span></a>";
	$login = "<a id=\"panelButton\" title=\"Effettua il login\" href=\"areaPersonale.php\">Area Personale</a>";
	$adminPanel = "<a id=\"panelButton\" title=\"Vai al pannello amministratore\" href=\"adminPanel.php\"><span lang=\"en\">Admin Panel</span></a>";
	$userPanel = "<a id=\"panelButton\" title=\"Vai al pannello utente\" href=\"userPanel.php\"><span lang=\"en\">User Panel</span></a>";
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
		$tabindex = 10;
        if($_GET['attr'] == 0) {
            $corsiDisp = select("SELECT NomeCorso from corso where NomeCorso <> all(SELECT NomeCorso from iscrizionecorso where CodiceUtente = ".$_SESSION['user_code'].")");
		    echo $formcorsi;

		    while($counter <= sizeOf($corsiDisp))
		        {
		            echo "<br><label class=\"invisibleLabel\" for=\"select".$counter."\">".$corsiDisp[$counter-1]['NomeCorso']."</label><input tabindex=\"".$tabindex."\" title=\"Seleziona ".$corsiDisp[$counter-1]['NomeCorso']."\" type=\"checkbox\" name=\"select".$counter."\" id=\"select".$counter."\" value=\"".$corsiDisp[$counter-1]['NomeCorso']."\" /> ".$corsiDisp[$counter-1]['NomeCorso']."";
		            $counter++;
					$tabindex = $tabindex + 10;
		         }

		    if($counter ==1)
                echo "<br> Sei già iscritto a tutti i corsi disponibili nella nostra palestra!";
		}
		else if($_GET['attr'] == 1) {
		    $corsiRimov = select("SELECT NomeCorso from iscrizionecorso where CodiceUtente = ".$_SESSION['user_code']."");
		    echo $disiscrizFormCorsi;

            while($counter <= sizeOf($corsiRimov))
            {
                echo "<br><label class=\"invisibleLabel\" for=\"select".$counter."\">".$corsiRimov[$counter-1]['NomeCorso']."</label><input tabindex=\"".$tabindex."\" title=\"Seleziona ".$corsiRimov[$counter-1]['NomeCorso']."\" type=\"checkbox\" name=\"select".$counter."\" id=\"select".$counter."\" value=\"".$corsiRimov[$counter-1]['NomeCorso']."\" /> ".$corsiRimov[$counter-1]['NomeCorso']." ";
                $counter++;
				$tabindex = $tabindex + 10;
            }
            if($counter ==1)
               echo "<br> Non sei iscritto a nessuno dei corsi disponibili nella nostra palestra!";
		}
		if($counter == 1)
		    echo "</div>
                    </form>
					<div class=\"group\">
						<button class=\"button\" onclick=\"window.location.href='userPanel.php'\" title=\"Torna al pannello utente\">Torna al pannello utente!</button>
					</div></div></div></div></div></div>";
		else
		    echo "</div>
					<div class=\"group\">
						<input tabindex=$tabindex title=\"Procedi con la richiesta\" type=\"submit\" class=\"button\" value=\"Procedi\"/>
						</div>
					</form>
				</div></div></div></div></div></div>";
	}
	else {
		echo $notAdmin;
	}
	
	close_connection();
	echo $foot;
	echo $closebody;
	echo $closehtml;
?>