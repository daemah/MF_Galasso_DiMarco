<!DOCTYPE html>
<html lang="en">
<?php
session_start();
include_once "../common/connection.php";
include_once "../common/funzioni.php";
?>
<link href="../styles/request.css" rel="stylesheet">
<?php require "../common/header.php";
$codice = $_GET["codice"];
$utente = getUtenteFromCodeFoto($cid, $codice);
if ($utente == null) {
    $utente = getUtenteFromCodeTesto($cid, $codice);
}
$email = $_SESSION["email"];?>
<body>
<link href="../styles/profile.css" rel="stylesheet">
<script src="../js/myscript.js"></script>
<div class="container">
                <div class="profile">
                    <div class="profile-image">

                      <img src=<?php echo(getFotoProfilo($cid, $utente));?> class="avatar" alt="Avatar">

                    </div>

                    <div class="profile-user-settings">

                        <h1 class="profile-user-name"><?php echo(getNickname($cid, $utente)); ?></h1>
                        <br><br>Indice di rispettabilità: <?php echo(getRispettabilità($cid, $utente)); ?>
                        
                    </div>
                </div>
                <!-- End of profile section -->
                
                </div>
                <!-- End of container -->
                <?php if (getUtenteFromCodeFoto($cid, $codice)!= null) { ?>
                <main>

                <div class="container">

                <div class="gallery">
                    <div >  
                        <p id = "luogo">
                            <?php echo getCitta($cid, $codice)." "; echo getStato($cid, $codice); ?>
                        </p>
                    </div>
                    <div class="gallery-item" tabindex="0">

                        <img src=<?php echo getFoto($cid, $codice);?> class="gallery-image" alt="">

                        <div class="card-footer">
                            <p>
                            <?php echo getDescrizioneFoto($cid, $codice); ?>
                            </p>
                        </div>
                        <div class="text-muted small"><?php echo "Pubblicato il giorno ", getTimeFoto($cid, $codice); ?></div>
                    </div>
                    <?php } else { ?>
                        <div class="container">
                        <div class="gallery-item" tabindex="0">
                        <p id = "messaggio_testo"><?php echo getTesto($cid, $codice);?></p>
                        <div class="text-muted small"><?php echo "Pubblicato il giorno  ", getTimeTesto($cid, $codice); ?></div>
                        </div>  
                        </div>
                        <?php } ?>
                <?php require "../common/footer.php"?>   
            </div>

</body>

</html>
