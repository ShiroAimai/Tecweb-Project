		<?php

			$head = file_get_contents("../Templates/headerNews.txt");
    		$foot = file_get_contents("../Templates/footerNews.txt");

    		echo $head;

			$query = "SELECT Titolo, Data, Immagine, Descrizione FROM news";
			require "db_connection.php";
			$queryresult= mysqli_query($connessione,$query);
				while($row = mysqli_fetch_assoc($queryresult))
					{
						$stampa = "<div class=\"newscont\"> <h3 class=\"titlenews\"> ".$row['Titolo']." </h3> <div class=\"corpopos\"> <p class=\"pubblicazione\">Pubblicato il ".$row['Data']."</p><img class=\"imgnews\" src=\"../uploads/".$row['Immagine']."\" alt=\"Immagine della news\"/> <p class=\"textnews\"> ".$row['Descrizione']."  </p></div> </div>";
						echo $stampa;
					}

			echo $foot;
			$connessione->close();
		?>
		