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
          if (empty($_POST["Titolo"])) {
            $Titoloerr = "Titolo is required";
            } else {
              $Titolo = test_input($_POST["Titolo"]);
              }
  
        if (empty($_FILES["Immagine"]["name"])) {
            $Immagineerr = "Immagine is required";
            } else {
              $Immagine = test_input($_FILES["Immagine"]["name"]);
              }
        if (empty($_POST["Descrizione"])) {
            $Descrizioneerr = "Descrizione is required";
            } else {
              $Descrizione = test_input($_POST["Descrizione"]);
              }
      }
      
    $sql = "INSERT INTO news (Titolo, Immagine, Descrizione)
        VALUES ('$Titolo', '$Immagine', '$Descrizione')";

       if ($connessione->query($sql) === TRUE) {
          echo "New record created successfully";
          }         
         else {
            echo "Error: " . $sql . "<br>" . $connessione->error;
          }
$connessione->close();

$target_dir = "../uploads/";
$target_file = $target_dir . basename($_FILES["Immagine"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if (move_uploaded_file($_FILES["Immagine"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["Immagine"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }

?>