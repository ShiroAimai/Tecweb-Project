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
          if (empty($_FILES["galleryFile"]["name"])) {
              $Immagineerr = "Immagine is required";
              } 
         
        if (empty($_POST["galleryName"])) {
            $Albumerr = "Album is required";
            } else {
              $Album = test_input($_POST["galleryName"]);
              }
      }
    $counter=0;
    while(isset($_FILES['galleryFile']['name'][$counter]))
    {   
      $Immagine=$_FILES['galleryFile']['name'][$counter];
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
if(isset($_FILES['galleryFile']['name']))
{

    $count=0;
    foreach ($_FILES['galleryFile']['name'] as $filename) {
        $destination=$target_dir;
        $origin=$_FILES['galleryFile']['tmp_name'][$count];
        $count++;
        $destination=$destination.basename($filename);
        if (move_uploaded_file($origin, $destination)) 
        {
          echo "The file ".basename($_FILES["galleryFile"]["name"][$count-1])." has been uploaded. <br />";
        } 
        else 
        {
          echo "Sorry, there was an error uploading your file. <br />";
        }
    }
} 

?>
