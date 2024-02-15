<!DOCTYPE html>
<html lang="en">
    <?php
    session_start(); 
    include_once "../common/connection.php";
    include_once "../common/funzioni.php";
    require "../common/header.php"
    ?>


        <body>
        <div><?php require "../common/navbar.php";?></div>
            <!--<link href="../styles/post.css" rel="stylesheet">-->
           
<div class="content"> 
                <h1> Statistiche All is Art: </h2>
                <h2> - Nickname degli utenti iscritti: </h2>
                <?php $utenti = getUtenti($cid);
                foreach ($utenti as $utente){$nickname = getNickname($cid, $utente);
                    ?> <p> <?php echo($nickname)?></p>
                <?php } ?>

                <h2> - Numero di messaggi inseriti dagli utenti nell'uteima settimana: </h2>
                <h2> - I 5 utenti che hanno ricevuto il maggior numero di commenti positivi: </h2>
                
</div>