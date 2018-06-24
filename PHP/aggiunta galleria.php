<?php

require_once('config.php');
$head = file_get_contents("../Templates/headerAddGallery.txt");
$foot = file_get_contents("../Templates/footer.txt");
$addGallery = file_get_contents("../Templates/AddGallery.txt");
$logout = "<button id=\"logoutButton\" onclick=\"window.location.href='logout.php'\">Logout</button>";
$login = "<button onclick=\"window.location.href='../HTML/AreaPersonale.html'\">Area Personale</button>";
$adminPanel = "<button onclick=\"window.location.href='AdminPanel.php'\">Admin Panel</button>";
$userPanel = "<button onclick=\"window.location.href='UserPanel.php'\">User Panel</button>";
$closediv = "</div>";
$closebody = "</body>";
$closehtml = "</html>";


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


$Titolo=$Immagine=$Descrizione=$Titoloerr=$Immagineerr=$Albumerr="";

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
  if($Immagineerr=="" && $Albumerr=="")
  {
    $counter=0;
    while(isset($_FILES['galleryFile']['name'][$counter]))
    {   
      $Immagine=$_FILES['galleryFile']['name'][$counter];
        $sql = "INSERT INTO galleria (NomeImmagine, Album)
            VALUES ('$Immagine', '$Album')";
		query($sql);
      $counter++;
    }
  }
  else
    header("Location: queryfallita.php");


	if (!file_exists('../galleria/'.$_POST["galleryName"].'/')) {
		mkdir('../galleria/'.$_POST["galleryName"].'/', 0777, true);
	}
	$target_dir = '../galleria/'.$_POST["galleryName"].'/';
	if(isset($_FILES['galleryFile']['name']))
	{

		$count=0;
		foreach ($_FILES['galleryFile']['name'] as $filename) {
			$destination=$target_dir;
			$origin=$_FILES['galleryFile']['tmp_name'][$count];
			$count++;
			$destination=$destination.basename($filename);
			if (!move_uploaded_file($origin, $destination)) 
			{
			  header("Location: queryfallita.php");			 
			}
		}
	}


echo $addGallery;

echo $foot;
echo $closebody;
echo $closehtml;

?>
