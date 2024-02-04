<?php
session_start();
include_once "../common/connection.php";
include_once "../common/funzioni.php";

$uploadDirectory = "uploads/";
$fileExtensionsAllowed = ['jpeg', 'jpg', 'png']; // These will be the only file extensions allowed

$fileName = basename($_FILES['ImageToUpload']['name']);
$fileSize = $_FILES['ImageToUpload']['size'];
$fileTmpName  = $_FILES['ImageToUpload']['tmp_name'];
$fileType = $_FILES['ImageToUpload']['type'];
$fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

$msg = '';
$errore = false;

if (empty($fileName)) {
    $msg .= "Non hai inserito alcun file</br>";
    header('location: ../frontend/updateprofile.php?status=ko&msg=' . urlencode($msg));
    exit();
}

$uploadPath = $uploadDirectory . basename($fileName);

if (isset($_POST['submit'])) {

    if (!in_array($fileExtension, $fileExtensionsAllowed)) {
        $errore = true;
        $msg .= "L'estensione non è corretta</br>";
    }

    if ($fileSize > 4000000) {
        $errore = true;
        $msg .= "Il file è troppo grande, supera i 4Mb</br>";
    }

    chmod($uploadPath, 0755);
    if (!$errore) {
        if (copy($fileTmpName, $uploadPath)) {
            $msg .= "Tutto ok</br>";
            header('location: ../frontend/updateprofile.php?status=ok&msg=' . urlencode($msg));
        } else {
            $msg .= "Errore durante il caricamento del file:  ". "$fileTmpName" . "</br>";
        }
    }

    header('location: ../frontend/updateprofile.php?status=ko&msg=' . urlencode($msg));
    exit();
}
?>
