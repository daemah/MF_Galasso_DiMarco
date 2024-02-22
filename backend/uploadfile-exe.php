<?php
session_start();
include_once "../common/connection.php";
include_once "../common/funzioni.php";


$file_name= $_FILES['ImageToUpload']['name'];
$file_path = "../images/".$file_name;
$tmp_name =  $_FILES['ImageToUpload']['tmp_name'];
$email = $_SESSION["email"];

//rimozione degli spazi dal nome
$file_name = str_replace(' ', '', $file_name);


$position= strpos($file_name, ".");
$fileextension= substr($file_name, $position + 1);

$fileextension= strtolower($fileextension); print_r($fileextension);


$fileExtensionsAllowed = ['jpeg','jpg','png'];


$fileSize = $_FILES['ImageToUpload']['size'];

$errore = false;

if (!in_array($fileextension,$fileExtensionsAllowed)) {
  $errore = true;
  $msg .= "L'estesione non è corretta</br>";
  header('location: ../frontend/updateprofile.php?status=ko&msg='. urlencode($msg));
}

if (empty($file_name)){
	$errore = true;
    $msg .= "Non hai inserito alcun file</br>";
    header('location: ../frontend/updateprofile.php?status=ko&msg='. urlencode($msg));
}

if (strlen($file_name) > 39){
	$errore = true;
  $msg .= "Nome del file troppo lungo</br>";
  header('location: ../frontend/updateprofile.php?status=ko&msg='. urlencode($msg));
}


if (isset($_POST['submit'])) {



  if ($fileSize > 4000000) {
      $errore = true;
      $msg .= "Il file è troppo grande, supera i 4Mb</br>";
      header('location: ../frontend/updateprofile.php?status=ko&msg='. urlencode($msg));
  }


  if (!($errore)) {
    //echo("Move uploaded file " . $tmp_name . " uploadPath ". $file_name);
      if(move_uploaded_file($tmp_name,$file_path)){
      
        $msg = "Upload successes</br>";
        $base_path = "../images/". $file_name; 
		$codice_profilo = getCodeFotoProfilo($cid, $email); print_r($codice_profilo);
		$delete = deleteFoto($cid, $codice_profilo, $email);
        $ris = updatePhoto($cid,$email,$base_path,$file_name);
		

       
        if ($ris["status"]=='ok')
        {
          header('location: ../frontend/updateprofile.php?status=ok&msg='. urlencode($msg)) . urlencode($ris["msg"]);
		  
        }
        else
        {	
          header('location: ../frontend/updateprofile.php?status=ok&msg='. urlencode($msg)). urlencode($ris["msg"]);
        }

      } else {
        $msg = "<br>Upload fails</br>";
        echo("ERROR". $msg);
        header('location: ../frontend/updateprofile.php?status=ko&msg='. urlencode($msg));
    
      }
    } else {
      $msg .= "Errore nel caricamento</br>";
      header('location: ../frontend/updateprofile.php?status=ko&msg='. urlencode($msg));
    }

}


?>