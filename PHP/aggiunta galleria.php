<?php

require_once('config.php');

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }


$Titolo=$Immagine=$Descrizione=$Titoloerr=$Immagineerr=$Descrizioneerr="";

   if ($_SERVER["REQUEST_METHOD"] == "POST") 
      {
          if (empty($_FILES["Immagine"]["name"])) {
              $Immagineerr = "Immagine is required";
              } 
         
        if (empty($_POST["Album"])) {
            $Albumerr = "Album is required";
            } else {
              $Album = test_input($_POST["Album"]);
              }
      }
    $counter=0;
    while(isset($_FILES['Immagine']['name'][$counter]))
    {   
      $Immagine=$_FILES['Immagine']['name'][$counter];
        $sql = "INSERT INTO galleria (NomeImmagine, Album)
            VALUES ('$Immagine', '$Album')";

           if ($connessione->query($sql) === TRUE) {
              echo "New record created successfully. <br />";
              }         
             else {
                echo "Error: " . $sql . "<br />" . $connessione->error;
              }
        $counter++;
    }
	$connessione->close();

$target_dir = "../galleria/";
if(isset($_FILES['Immagine']['name']))
{

    $count=0;
    foreach ($_FILES['Immagine']['name'] as $filename) {
        $destination=$target_dir;
        $origin=$_FILES['Immagine']['tmp_name'][$count];
        $count++;
        $destination=$destination.basename($filename);
        if (move_uploaded_file($origin, $destination)) 
        {
          echo "The file ".basename($_FILES["Immagine"]["name"][$count-1])." has been uploaded. <br />";
        } 
        else 
        {
          echo "Sorry, there was an error uploading your file. <br />";
        }
    }
} 

?>
