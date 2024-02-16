<?php
session_start();
include_once "../common/connection.php";
include_once "../common/funzioni.php";

$currentDir = getCwd();
$uploadDirectory = $currentDir . "/". "uploads/";
$fileExtensionsAllowed = ['jpeg','jpg','png']; // These will be the only file extensions allowed 

$fileName = basename($_FILES['ImageToUpload']['name']);
$fileSize = $_FILES['ImageToUpload']['size'];
$fileTmpName  = $_FILES['ImageToUpload']['tmp_name'];
$fileType = $_FILES['ImageToUpload']['type'];
$fileExtension = strtolower(end(explode('.',$fileName)));

if (empty($fileName)){
    $msg .= "Non hai inserito alcun file</br>";
    header('location: ../frontend/updateprofile.php?status=ko&msg='. urlencode($msg));
}

$uploadPath =  $uploadDirectory . basename($fileName); 
$errore = false;

if (isset($_POST['submit'])) {

if (! in_array($fileExtension,$fileExtensionsAllowed)) {
    $errore = true;
	$msg .= "L'estesione non è corretta</br>";
}

if ($fileSize > 4000000) {
    $errore = true;
	$msg .= "Il file è troppo grande, supera i 4Mb</br>";
}


if (!($errore)) {
    $didUpload = move_uploaded_file($fileTmpName, $uploadPath);

    if ($didUpload) {
      $msg .= "Upload successes</br>";
      header('location: ../frontend/updateprofile.php?status=ok&msg='. urlencode($msg));
      /*exit();*/
    } else {
      $msg .= "Upload fails</br>";
       print_r($_FILES);
       exit();
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