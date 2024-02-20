<?php

$hostname = 'localhost';
$username = 'root';
$password = '';
$db = 'Minifacebook3';

try {
    $cid = new mysqli($hostname,$username,$password,$db);
} catch (Exception $e) {
    $cid=null;
}

mysqli_report(MYSQLI_REPORT_ERROR);

?>
