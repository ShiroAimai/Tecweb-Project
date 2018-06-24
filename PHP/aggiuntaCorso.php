<?php
	require_once('config.php');
	register('corsiselect1');
	register('corsiselect2');
	register('corsiselect3');
	register('corsiselect4');
	register('corsiselect5');		
		
		if(isset($corsiselect1) || isset($corsiselect2) || isset($corsiselect3) || isset($corsiselect4) || isset($corsiselect5))
		{
			
			if(isset($corsiselect1))
				if(query("INSERT INTO iscrizionecorso (CodiceUtente, CodiceCorso, NomeCorso) VALUES ('$userCode', 1, '$corsiselect1')") == FALSE)
				{
					header("Location: iscrizioneCorsoFallita.php");
				}
			if(isset($corsiselect2))
				if(query("INSERT INTO iscrizionecorso (CodiceUtente, CodiceCorso, NomeCorso) VALUES ('$userCode', 5, '$corsiselect2')") == FALSE)
					header("Location: iscrizioneCorsoFallita.php");
			if(isset($corsiselect3))
				if(query("INSERT INTO iscrizionecorso (CodiceUtente, CodiceCorso, NomeCorso) VALUES ('$userCode', 4, '$corsiselect3')") == FALSE)
					header("Location: iscrizioneCorsoFallita.php");
			if(isset($corsiselect4))
				if(query("INSERT INTO iscrizionecorso (CodiceUtente, CodiceCorso, NomeCorso) VALUES ('$userCode', 3, '$corsiselect4')") == FALSE)
					header("Location: iscrizioneCorsoFallita.php");
			if(isset($corsiselect5))
				if(query("INSERT INTO iscrizionecorso (CodiceUtente, CodiceCorso, NomeCorso) VALUES ('$userCode', 2, '$corsiselect5')") == FALSE)
					header("Location: iscrizioneCorsoFallita.php");

			header("Location: iscrizioneCorsoAvvenuta.php");
		}
		else
			header("Location: queryfallita.php");

	

?>