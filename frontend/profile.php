
<!DOCTYPE html>
<html lang="en">
<?php require "../common/header.php"?>  
<?php
session_start();
include_once "../common/connection.php";
include_once "../common/funzioni.php";
$email = $_SESSION["email"];
$utente = $_GET["utente"];
if(isset($_SESSION['email'])){
?>
<div><?php require "../common/navbar.php"?></div> 

<?php if ($utente == $email){ ?>
        <body>
        
        <link href="../styles/profile.css" rel="stylesheet">
        <script src="../js/myscript.js"></script>
        <div class = "content">
        <?php
        if (isset($_GET["status"])) {
            if ($_GET["status"]=='ok')
                    {
                        echo "<div class='alert-success'>\n";
                        echo $_GET["msg"];
                        echo "</div>";
                    }
        }
                   
        ?>
        <div class="container">
                <div class="profile">
                    <div class="profile-image">

                      <img src=<?php echo(getFotoProfilo($cid, $email));?> class="avatar" alt="Avatar">

                    </div>

                    <div class="profile-user-settings">

                        <h1 class="profile-user-name"><?php echo(getNickname($cid, $email)); ?></h1>

                        <button class="btn profile-edit-btn"  onclick="location.href='updateprofile.php'">Edit Profile</button>
                        <br><span>Aggiungi post</span> <button class="btn add-message-btn"  onclick="location.href=''">+</button> 
                        
                    </div>

                    <div class="profile-stats">

                        <ul id = "ul_profile">
                            <li id = "li-profile"><span class="profile-stat-count"><?php echo(count(getCodiceFoto($cid, $email)) + count(getCodiceTesto($cid, $email))); ?></span> posts</li>
                            <li id = "li-profile"> <button type="button" class="goToFriends" onclick ="location.href='users.php?utente=<?php echo $email ?>&page=followers'"><?php echo count(getFollowers($cid, $email)); ?></button> followers</li>
                            <li id = "li-profile"> <button type="button" class="goToFriends" onclick ="location.href='users.php?utente=<?php echo $email ?>&page=following'"><?php echo count(getFollowing($cid, $email)); ?></button> following</li>
                        </ul>

                    </div>  
                </div>
                <!-- End of profile section -->
                
                </div>
                <!-- End of container -->

                <main>

                <div class="container">

                <div class="gallery">
                    <?php $codici = getCodiceFoto($cid, $email); foreach($codici as $codice){ ?>
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
                            <strong><?php echo(count(getCodiceCommentoFoto($cid, $codice)))?></strong> <small class="align-middle">Comments: </small>
                                    <?php
                                    $codici_commento = getCodiceCommentoFoto($cid, $codice);
                                    foreach($codici_commento as $codice_commento){
                                        $email_commentatore = getCommentatore($cid, $codice_commento);
                                        $nickname_commentatore = getNickname($cid, $email_commentatore);?> 
                                        <br><br><small>
                                            <?php echo($nickname_commentatore). ": "; echo(getCommento($cid, $codice_commento)[0])?><br>
                                            <?php echo("commento scritto il: "); echo(getTimeCommento($cid, $codice_commento));?></small>  
                                    <?php }?>
                        </div>
                        <div class="text-muted small"><?php echo "Pubblicato il giorno ", getTimeFoto($cid, $codice); ?></div>
                    <?php } ?>
                    </div>

                <div class="gallery-item" tabindex="0">
                <?php $codici_t = getCodiceTesto($cid, $email); foreach($codici_t as $codice_t){ ?>
                <p id = "messaggio_testo"><?php echo getTesto($cid, $codice_t);?></p>

                        <div class="card-footer">
                                
                                <strong><?php echo(count(getCodiceCommentoTesto($cid, $codice_t)))?></strong> <small class="align-middle">Comments: </small>

                                    <?php
                                    $codici_commento = getCodiceCommentoTesto($cid, $codice_t);
                                    foreach($codici_commento as $codice_commento){
                                        $email_commentatore = getCommentatore($cid, $codice_commento);
                                        $nickname_commentatore = getNickname($cid, $email_commentatore);
                                        ?> <br><br><small> 
                                        <?php echo($nickname_commentatore). ": "; echo(getCommento($cid, $codice_commento)[0])?><br>
                                        <?php echo("Commento scritto il: "); echo(getTimeCommento($cid, $codice_commento));?></small>  
                                    <?php }?>
                                   
                        </div>
                        <div class="text-muted small"><?php echo "Pubblicato il giorno  ", getTimeTesto($cid, $codice_t); ?></div>
                <?php } ?>
                
                </div>

                </div>
                <?php require "../common/footer.php"?>   
            </div>

    <?php }else{?>
        <body>
        <link href="../styles/profile.css" rel="stylesheet">
        <div class = "content">
        <?php
        if (isset($_GET["status"])) {
            if ($_GET["status"]=='ok')
                    {
                        echo "<div class='alert-success'>\n";
                        echo $_GET["msg"];
                        echo "</div>";
                    } 
            if  ($_GET["status"]=='ko')
                    {
                        echo "<div class='alert-warning'>\n";
                        echo $_GET["msg"];
                        echo "</div>";
                    } 
        }
        ?>
        <div class="container">
                <div class="profile">
                    <div class="profile-image">
                    
                        <?php if (empty(getFotoProfilo($cid, $utente))){?>
                            <img src="../images/profilo.jpeg" class="avatar" alt="Avatar">
                        <?php } else { ?>
                            <img src=<?php echo(getFotoProfilo($cid, $utente));?>class="avatar" alt="Avatar">
                        <?php } ?>

                    </div>

                    <div class="profile-user-settings">

                        <h1 class="profile-user-name"><?php echo(getNickname($cid, $utente)); ?></h1>
                        <?php
                        $data_richiesta = getDataRichiesta($cid, $utente, $email);
                        $data_accettazione = getDataAccettazione($cid, $utente, $email);
                        if ($data_richiesta==0){
                        ?>
                            <button class="btn profile-edit-btn"  onclick="location.href='../backend/request_friendship-exe.php?utente=<?php echo $utente ?>'">Invia Richiesta</button>
                        <?php } elseif (($data_richiesta!=0) && ($data_accettazione==0)) { ?>
                            <button class="btn profile-edit-btn" onclick="location.href='../backend/eliminateRequest-exe.php?utente=<?php echo $utente ?>'">Richiesta Inviata</button>
                        <?php } else {?>
                            <button class="btn profile-edit-btn"  onclick="location.href='../backend/unfollow-exe.php?utente=<?php echo $utente ?>'">Unfollow</button>
                        <?php }?>
                    </div>

                    <div class="profile-stats">

                        <ul id = "ul_profile">
                            <li id = "li-profile"><span class="profile-stat-count"><?php echo(count(getCodiceFoto($cid, $utente)) + count(getCodiceTesto($cid, $utente))); ?></span> posts</li>
                            <li id = "li-profile"><button type="button" class="goToFriends" onclick ="location.href='users.php?utente=<?php echo $utente ?>&page=followers'"><?php echo count(getFollowers($cid, $utente)); ?></button> followers</li>
                            <li id = "li-profile"><button type="button" class="goToFriends" onclick ="location.href='users.php?utente=<?php echo $utente ?>&page=following'"><?php echo count(getFollowing($cid, $utente)); ?></button> following</li>
                        </ul>

                    </div>

                    

                </div>
                <!-- End of profile section -->

                </div>
                <!-- End of container -->

                <main>

                <div class="container">

                <div class="gallery">
                    <?php $codici = getCodiceFoto($cid, $utente); foreach($codici as $codice){ ?>
                    <div >  
                        <p id = "luogo">
                            <?php echo getCitta($cid, $codice)." "; echo getStato($cid, $codice); ?>
                        </p>
                    </div>
                    <div class="gallery-item" tabindex="0">

                        <img src=<?php echo getFoto($cid, $codice);?> class="gallery-image" alt="">

                        <div class="card-footer">
                           
                            <strong><?php print_r($codice); echo(count(getCodiceCommentoFoto($cid, $codice)))?></strong> <small class="align-middle">Comments: </small>
                            <?php
                                $codici_commento = getCodiceCommentoFoto($cid, $codice);
                                print_r($codici_commento);
                                foreach($codici_commento as $codice_commento){
                                    $email_commentatore = getCommentatore($cid, $codice_commento);
                                    $nickname_commentatore = getNickname($cid, $email_commentatore);
                                ?> <br><br><small> 
                                <a onclick="ValutaCommento()"><img class = "iLikeIt" src="../images/i_like_it.jpeg"></a><div id="visualizza"></div>
                                <?php echo($nickname_commentatore). ": "; echo(getCommento($cid, $codice_commento)[0])?><br>
                                <?php echo("Commento scritto il: "); echo(getTimeCommento($cid, $codice_commento));?></small>  
                            <?php }?>
                            <p>
                            <?php echo getDescrizioneFoto($cid, $codice); ?>
                            </p>
                        </div>
                    </div>
                    <div class="card-footer">
                        <form method="POST" action="../backend/comment-exe_foto.php?utente=<?php echo $utente?>">
                            <div class="container">
                                <input type="text" placeholder="Inserisci un commento" name="commento">
                                <input type="submit" value="invia">
                            </div>
                        </form>
                    </div>
                    <div class="text-muted small"><?php echo "Foto pubblicata il giorno ", getTimeFoto($cid, $codice); ?></div>
                    <?php } ?>
                <div class="gallery-item" tabindex="0">

                <?php $codici_t = getCodiceTesto($cid, $utente); foreach($codici_t as $codice_t){ ?>
                <p id = "messaggio_testo"><?php echo getTesto($cid, $codice_t);?></p>

                        <div class="card-footer">
                        <strong><?php echo(count(getCodiceCommentoTesto($cid, $codice_t)))?></strong> <small class="align-middle">Comments: </small>
                                <?php
                                    $codici_commento = getCodiceCommentoTesto($cid, $codice_t);
                                    foreach($codici_commento as $codice_commento){
                                        $email_commentatore = getCommentatore($cid, $codice_commento);
                                        $nickname_commentatore = getNickname($cid, $email_commentatore);?>
                                        <br><br><small> 
                                        <a onclick="ValutaCommento()"><img class = "iLikeIt" src="../images/i_like_it.jpeg"></a><div id="visualizza"></div>
                                        <?php echo($nickname_commentatore). ": "; echo(getCommento($cid, $codice_commento)[0])?> 
                                        <br><?php echo("commento scritto il: "); echo(getTimeCommento($cid, $codice_commento));?></small>  
                                    <?php } ?>
                        </div>
                </div>
                <div class="card-footer">
                        <form method="POST" action="../backend/comment-exe_foto.php?utente=<?php echo $utente?>">
                            <div class="container">
                                <input type="text" placeholder="Inserisci un commento" name="commento">
                                <input type="submit" value="invia">
                            </div>
                        </form>
                </div>
                <div class="text-muted small"><?php echo "Testo pubblicato il giorno ", getTimeTesto($cid, $codice_t); ?></div>
                <?php } ?>
                </div>
                </div>
                <!-- End of gallery --> 
                <?php require "../common/footer.php"?>                
            </div>
        <?php } ?>
        </body>
    <?php
    }
    else{
        header("location:../index.php");
    }
    ?>
    </html>