<?php
session_start();
include_once "../common/connection.php";
include_once "../common/funzioni.php";

$file_name= $_FILES['ImageToUpload']['name'];
$tmp_name =  $_FILES['ImageToUpload']['tmp_name'];

$position= strpos($file_name, ".");
$fileextension= substr($file_name, $position + 1);
$fileextension= strtolower($fileextension);

$fileExtensionsAllowed = ['jpeg','jpg','png']; // These will be the only file extensions allowed 


$fileSize = $_FILES['ImageToUpload']['size'];
$errore = false;
if (! in_array($fileextension,$fileExtensionsAllowed)) {
  $errore = true;
  $msg .= "L'estesione non è corretta</br>";
}

if (empty($file_name)){
    $msg .= "Non hai inserito alcun file</br>";
    //header('location: ../frontend/updateprofile.php?status=ko&msg='. urlencode($msg));
}


if (isset($_POST['submit'])) {



  if ($fileSize > 4000000) {
      $errore = true;
    $msg .= "Il file è troppo grande, supera i 4Mb</br>";
  }


  if (!($errore)) {
    echo("Move uploaded file " . $tmp_name . " uploadPath ". $file_name);
      if(move_uploaded_file($tmp_name, $file_name)){
        $msg .= "Upload successes</br>";
        echo($file_name);
        $base_path = "../images/". $file_name;
        header('location: ../frontend/updateprofile.php?status=ok&msg='. urlencode($msg));
        /*exit();*/
      } else {
        $msg .= "Upload fails</br>";
        echo("ERROR". $msg);
        // print_r($_FILES);
        // exit();
        header('location: ../frontend/updateprofile.php?status=ko&msg='. urlencode($msg));
    
      }
    } else {
      foreach ($errors as $error) {
        header('location: ../frontend/updateprofile.php?status=ko&msg='. urlencode($msg));
        /*exit();*/
      }
    }

}


?>