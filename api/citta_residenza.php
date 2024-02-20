<?php

header("Content-type: application/json");
header("Access-Control-Allow-Origin: *\r\n");
include ('../common/connection.php');
session_start();
$email = $_SESSION["email"];


$link = mysqli_connect($hostname, $username, $password) or die("failed to connect to server !!");
mysqli_select_db($link, $db);

//Altrimenti restituisce in output le warning
error_reporting(E_ERROR | E_NOTICE);


if(!$link->set_charset("utf8"))
{
    exit();
}

$risultato= array("msg"=>"","status"=>"ok");

   /* inserire controlli dell'input */
   $sql = "SELECT citta_residenza FROM utente where email = '$email'";
   $res = $cid->query($sql);
   	if ($res==null)
	{
		$risultato["status"]="ko";
		$risultato["msg"]="errore nella esecuzione della interrogazione " . $cid->error;
		echo json_encode($risultato);
	}
    $row = $res->fetch_assoc();
	$cittab = $row["citta_residenza"];
    //$risultato["contenuto"] = $cittab;
    

    $utenti_citta_comuni = array();
    $sql = "SELECT email FROM utente where citta_residenza = '$cittab' and email<>'$email'";
    $res = $cid->query($sql);
    if ($res==null)
    {
        $risultato["status"]="ko";
        $risultato["msg"]="errore nella esecuzione della interrogazione " . $cid->error;
        echo json_encode($risultato);
    }
    while ($row = $res->fetch_assoc()){
        $utenti_citta_comuni[] = $row["email"];
    }

    //$risultato["contenuto"]=array_unique($utenti_citta_comuni); 
    //echo json_encode($risultato);



    $nickname_citta_comuni = array();
    foreach($utenti_citta_comuni as $utente_citta_comuni){
        $sql = "SELECT nickname FROM utente where email = '$utente_citta_comuni'";
        $res = $cid->query($sql);
            if ($res==null)
            {
                $risultato["status"]="ko";
                $risultato["msg"]="errore nella esecuzione della interrogazione " . $cid->error;
                echo json_encode($risultato);
            }
            while ($row = $res->fetch_assoc()){
                $nickname_citta_comuni[] = $row["nickname"];
            }
    }
    $risultato["contenuto"]=array_unique($nickname_citta_comuni);
    echo json_encode(array_unique($risultato)); 

?>