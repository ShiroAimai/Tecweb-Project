<?php

    $head = file_get_contents("../Templates/headerGallery.txt");
    $foot = file_get_contents("../Templates/footerGallery.txt");

    $query="SELECT NomeImmagine, Album FROM galleria GROUP BY Album";
    require "db_connection.php";
    $queryresult= mysqli_query($connessione,$query);

    echo $head;

    $opendiv = "<div class=\"gallerymain\">"
    echo $opendiv;

    $aux=null; $stampa=null;
    while($row = mysqli_fetch_assoc($queryresult))
            {   
                
                if($aux==null)//caso in cui siamo appena entrati a prelevare nel database
                    {
                    $stampa = "<a href=\"templategalleria.php?album=".$row['Album']."\"><div class=\"album\"> <h3 class=\"albumname\">".$row['Album']."</h3><img class=\"galleryimg\" src=\"../galleria/".$row['NomeImmagine']."\" alt=\"Immagine dell'album ".$row['Album']."\"></div></a>";// aggiungere il primo $row di ogni album
                        $aux=$row['Album'];
                    }
                else if($row['Album']!=$aux)
                {
                    echo $stampa;
                    $stampa="<a href=\"templategalleria.php?album=".$row['Album']."\"><div class=\"album\"> <h3 class=\"albumname\">".$row['Album']."</h3><img class=\"galleryimg\" src=\"../galleria/".$row['NomeImmagine']."\" alt=\"Immagine dell'album ".$row['Album']."\"/></div></a>";
                    $aux=$row['Album'];
                }
            
                
            }
            
    echo $stampa;

    $closediv = "</div>";
    echo $closediv;

    echo $foot;
    
    $connessione->close();
?>
