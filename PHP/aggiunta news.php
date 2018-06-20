<?php

require_once('config.php');
$head = file_get_contents("../Templates/headerAddNews.txt");
$foot = file_get_contents("../Templates/footer.txt");
$addNews = file_get_contents("../Templates/AddNews.txt");
$logout = "<button id=\"logoutButton\" onclick=\"window.location.href='logout.php'\">Logout</button>";
$login = "<button onclick=\"window.location.href='../HTML/AreaPersonale.html'\">Area Personale</button>";
$adminPanel = "<button onclick=\"window.location.href='AdminPanel.php'\">Admin Panel</button>";
$userPanel = "<button onclick=\"window.location.href='UserPanel.php'\">User Panel</button>";
$closediv = "</div>";
$ok = true;

echo $head;
	if(isset($_SESSION['user_code']) && $_SESSION['user_type'] == 'admin') {
		echo $logout;
		echo $adminPanel;
	} else if(isset($_SESSION['user_code']) && $_SESSION['user_type'] == 'user') {
		echo $logout;
		echo $userPanel;
	} else {
		echo $login;
	}
	
	echo $closediv;
	echo $closediv;

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

		if (query($sql) === FALSE) {
			$ok = false;
        }
$connessione->close();

$target_dir = "../uploads/";
$target_file = $target_dir . basename($_FILES["newsImage"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if (!move_uploaded_file($_FILES["newsImage"]["tmp_name"], $target_file)) {
        $ok = false;
    }
	
if($ok) {
	echo $addNews;
}
echo $foot;

?>