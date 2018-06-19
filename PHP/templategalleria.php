		<?php

				$head = file_get_contents("../Templates/headerTemplateGalleria.txt");
    			$foot = file_get_contents("../Templates/footerTemplateGalleria.txt");

    			echo $head;

				echo "<h2 id=\"gallerypictitle\">Album <span id=\"albumtitle\">".$_GET['album']."</span></h2>";
				$aux=$_GET['album'];
				$query="SELECT NomeImmagine,Album FROM galleria WHERE Album=\"$aux\"";
				require "db_connection.php";
				$queryresult= mysqli_query($connessione,$query);
				$aux=null;
				while($row = mysqli_fetch_assoc($queryresult))
					{	
						if($aux==null)
						{
							$stampa = "<a href=\"immaginesingola.php?nome=".$row['NomeImmagine']."&album=".$row['Album']."\"><img class=\"gallerypicmini\" src=\"../galleria/".$row['NomeImmagine']."\" alt=\"Immagine dell'album ".$row['Album']."\"/></a>";
						}
						echo $stampa;
					}
						
				echo $foot;

				$connessione->close();
		?>