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
          if (empty($_POST["newsTitle"])) {
            $Titoloerr = "Titolo is required";
            } else {
              $Titolo = test_input($_POST["newsTitle"]);
              }
  
        if (empty($_FILES["newsImage"]["name"])) {
            $Immagineerr = "Immagine is required";
            } else {
              $Immagine = test_input($_FILES["newsImage"]["name"]);
              }
        if (empty($_POST["newsDescription"])) {
            $Descrizioneerr = "Descrizione is required";
            } else {
              $Descrizione = test_input($_POST["newsDescription"]);
              }
      }
      
    $sql = "INSERT INTO news (Titolo, Immagine, Descrizione)
        VALUES ('$Titolo', '$Immagine', '$Descrizione')";

       if (query($sql) === TRUE) {
          echo "New record created successfully";
          }
$connessione->close();

$target_dir = "../uploads/";
$target_file = $target_dir . basename($_FILES["newsImage"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if (move_uploaded_file($_FILES["newsImage"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["newsImage"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }

?>