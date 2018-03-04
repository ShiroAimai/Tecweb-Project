<?php
require "db_connection.php";

$Immagine=$Album=$Immagineerr=$Albumerr="";

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
   if ($_SERVER["REQUEST_METHOD"] == "POST") 
      {
          
        if (empty($_FILES["Immagine"]["name"])) {
            $Immagineerr = "Immagine is required";
            } else {
              $Immagine = test_input($_FILES["Immagine"]["name"]);
              }
        if (empty($_POST["Album"])) {
            $Albumerr = "Album is required";
            } else {
              $Album = test_input($_POST["Album"]);
              }
      }
      
    $sql = "INSERT INTO galleria (NomeImmagine, Album)
        VALUES ('$Immagine', '$Album')";

       if ($connessione->query($sql) === TRUE) {
          echo "New record created successfully";
          }         
         else {
            echo "Error: " . $sql . "<br>" . $connessione->error;
          }
$connessione->close();

$target_dir = "../galleria/";
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