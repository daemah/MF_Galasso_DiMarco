
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
        <div class="text-center text-sm-right">
            <div class="text-muted"><small>All is art ©</small></div>
        </div>
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

                   
                    <img src="<?php echo(getFotoProfilo($cid, $utente));?>"class="avatar" alt="Avatar">
                    

                    </div>

                    <div class="profile-user-settings">

                        <h1 class="profile-user-name"><?php echo(getNickname($cid, $email)); ?></h1>

                        <button class="btn profile-edit-btn"  onclick="location.href='updateprofile.php'">Edit Profile</button>
                        <br><span>Aggiungi foto </span> <button class="btn add-message-btn"  onclick="location.href='aggiungiFoto.php'">+</button> 
                        <br><span>Aggiungi testo</span> <button class="btn add-message-btn"  onclick="location.href='aggiungiTesto.php'">+</button> 
                        <br><br>Indice di rispettabilità: <?php echo(getRispettabilità($cid, $email)); ?>
                        
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

               

                <div class="gallery">
                    <?php $codici = getCodiceFoto($cid, $email); foreach($codici as $codice){ 
					$codice_profilo = getCodeFotoProfilo($cid, $email);
                    if (($codice != null) and ($codice != $codice_profilo)){?>
                        <div class="card-body">
                        
                   
                    <div class="gallery-item" tabindex="0">
                    <button class = "btn post-edit-btn" onclick="location.href='../backend/deleteFoto-exe.php?codice=<?php echo $codice ?>'"> Delete Photo </button>
                        <p id = "luogo">
                            <?php echo getCitta($cid, $codice)." "; echo getStato($cid, $codice); ?>
                        </p>

                        <img src=<?php echo getFoto($cid, $codice);?> class="gallery-image" alt="">

                        <div class="card-footer">
                        <?php if(getDescrizioneFoto($cid, $codice)!=0){ ?>
                            <strong> Descrizione foto: </strong>
                            <p>
                            <?php echo getDescrizioneFoto($cid, $codice); ?>
                            </p>
                        <?php } ?>
                            <strong><?php echo(count(getCodiceCommentoFoto($cid, $codice)))?> Comments </strong>
                            <button onclick = " MostraNascondiCommenti('<?php echo $codice ?>');" > Show/Hide Comments </button>
                            <div id="comments_container<?php echo $codice ?>" style="display:none;">
                                    <?php
                                    $codici_commento = getCodiceCommentoFoto($cid, $codice);
                                    foreach($codici_commento as $codice_commento){
                                        $email_commentatore = getCommentatore($cid, $codice_commento);
                                        $nickname_commentatore = getNickname($cid, $email_commentatore);?>
                                        <br><br>
                                        <?php if ($nickname_commentatore != getNickname($cid,$email)){ ?>
                                            <a onclick="ValutaCommentoDaProfileAut('<?php echo $codice_commento;?>', '<?php echo $email_commentatore;?>');"> <img class = "iLikeIt" src="../images/i_like_it.jpeg"> </a>
                                        <?php } ?>

                                        <button type="button"  class="goToProfile" onclick="location.href='profile.php?utente=<?php echo $email_commentatore ?>'"> <?php echo($nickname_commentatore . ": ");?></button>
                                        <span><?php $commento = (getCommento($cid, $codice_commento)[0]); echo($commento);?> </span> 

                                        <?php $codici_foto = getPostsFoto($cid); $codici_testo = getPostsTesto($cid); 
                                            foreach($codici_foto as $codice_foto){
                                            if (strpos($commento, '@'.$codice_foto)){ ?> 
                                            <button onclick= "popUp('<?php echo $codice_foto;?>');"> ➔ Click here to go to the reported message </button> <?php }}
                                            foreach($codici_testo as $codice_testo){ 
                                            if (strpos($commento, '@'.$codice_testo)){?> <button onclick= "popUp('<?php echo $codice_testo;?>');"> ➔ Click here to go to the reported message </button> <?php }}?>

                                        <?php if ($nickname_commentatore == getNickname($cid,$email)){?><br>
                                            <button  class = "btn post-edit-btn" onclick= "location.href='../backend/deleteCommentDaProfile.php?codice=<?php echo $codice_commento ?>&utente=<?php echo $email ?>'">Delete comment</button>
                                            <?php }elseif (getValutazione($cid, $email, $codice_commento)!=0) { ?> <br>
                                            <span><button  class = "btn post-edit-btn" onclick= "location.href='../backend/deleteValutazioneDaProfileAut.php?codice=<?php echo $codice_commento ?>&utente=<?php echo $email_commentatore?>'">Delete valutazione</button></span>
                                        <?php } ?>
                                        <br><small>
                                        <br><?php echo("Comment written on: "); echo(getTimeCommento($cid, $codice_commento));?> 
                                        <br>
                                        <?php  
                                            $gradimenti = getIndGradimento($cid, $codice_commento);
                                            $somma = 0;
                                            if (!empty($gradimenti)){
                                                foreach ($gradimenti as $gradimento){$somma += $gradimento;}
                                                echo("The approval rating for this comment is (average rating): ". number_format(($somma/count($gradimenti)),1));
                                                }else{
                                                echo("The comment has not received any ratings");
                                                }
                                                ?><br></small>  
                                    <?php } ?>
                        </div>
                        </div>
                                
                        <div class="text-muted small"><?php echo "Message published on: ", getTimeFoto($cid, $codice); ?></div>
                        <div class="text-muted small codice"><?php echo "Photo code: ". $codice; ?></div>
                        </div>
                        </div>

                    <?php }} ?>
                    </div>
                    
               

                <?php $codici_t = getCodiceTesto($cid, $email); foreach($codici_t as $codice_t){ ?>
                    <div class="gallery-item" tabindex="0">
                <div class="card-body">
                    <button class = "btn post-edit-btn" onclick="location.href='../backend/deleteTesto-exe.php?codice=<?php echo $codice_t ?>'"> Delete Text </button>
                <p id = "messaggio_testo"><?php echo getTesto($cid, $codice_t);?></p>

                        <div class="card-footer">
                                
                                <strong><?php echo(count(getCodiceCommentoTesto($cid, $codice_t)))?> Comments </strong>
                                <button onclick = " MostraNascondiCommenti('<?php echo $codice_t ?>');" > Show/Hide Comments </button>
                                <div id="comments_container<?php echo $codice_t ?>" style="display:none;">
                                    <?php
                                    $codici_commento = getCodiceCommentoTesto($cid, $codice_t);
                                    foreach($codici_commento as $codice_commento){
                                        $email_commentatore = getCommentatore($cid, $codice_commento);
                                        $nickname_commentatore = getNickname($cid, $email_commentatore);
                                        ?> <br><br>
                                        <?php if ($nickname_commentatore != getNickname($cid,$email)){ ?>
                                            <a onclick="ValutaCommentoDaProfileAut('<?php echo $codice_commento;?>', '<?php echo $email_commentatore;?>');"> <img class = "iLikeIt" src="../images/i_like_it.jpeg"> </a>
                                        <?php } ?>

                                        <button type="button"  class="goToProfile" onclick="location.href='profile.php?utente=<?php echo $email_commentatore ?>'"> <?php echo($nickname_commentatore . ": ");?></button>
                                        <span><?php $commento = (getCommento($cid, $codice_commento)[0]); echo($commento);?></span>

                                        <?php $codici_foto = getPostsFoto($cid); $codici_testo = getPostsTesto($cid); 
                                            foreach($codici_foto as $codice_foto){
                                            if (strpos($commento, '@'.$codice_foto)){ ?> 
                                            <button onclick= "popUp('<?php echo $codice_foto;?>');"> ➔ Click here to go to the reported message </button> <?php }}
                                            foreach($codici_testo as $codice_testo){ 
                                            if (strpos($commento, '@'.$codice_testo)){?> <button onclick= "popUp('<?php echo $codice_testo;?>');"> ➔ Click here to go to the reported message </button> <?php }}?>

                                        <?php if ($nickname_commentatore == getNickname($cid,$email)){?><br>
                                            <br><button  class = "btn post-edit-btn" onclick= "location.href='../backend/deleteCommentDaProfile.php?codice=<?php echo $codice_commento ?>&utente=<?php echo $email ?>'">Delete comment</button>
                                            <?php }elseif (getValutazione($cid, $email, $codice_commento)!=0) { ?> <br>
                                            <br><button  class = "btn post-edit-btn" onclick= "location.href='../backend/deleteValutazioneDaProfileAut.php?codice=<?php echo $codice_commento ?>&utente=<?php echo $email_commentatore?>'">Delete valutazione</button>
                                        <?php } ?> <br> <br>
                                        <small><?php echo("Comment written on: "); echo(getTimeCommento($cid, $codice_commento));?>
                                        <br>
                                        <?php  
                                            $gradimenti = getIndGradimento($cid, $codice_commento);
                                            $somma = 0;
                                            if (!empty($gradimenti)){
                                                foreach ($gradimenti as $gradimento){$somma += $gradimento;}
                                                echo("The approval rating for this comment is (average rating): ". number_format(($somma/count($gradimenti)),1));
                                            }else{
                                                echo("The comment has not received any ratings");
                                            }
                                            ?><br></small>  
                                    <?php }?>
                                   
                        </div>
                        </div>
                        <div class="text-muted small"><?php echo "Message published on: ", getTimeTesto($cid, $codice_t); ?></div>
                        <div class="text-muted small codice"><?php echo "Text code: ". $codice_t; ?></div>
                        </div>
                        </div>
                      
                      
                <?php } ?>
                
                </div>
                
                <div class="content"> <?php require "../common/footer.php"?></div>
                </div>
                   
            </div>

    <?php }else{?>
        <body>
        <link href="../styles/profile.css" rel="stylesheet">
        <div class = "content">
        <div class="text-center text-sm-right">
            <div class="text-muted"><small>All is art ©</small></div>
        </div>
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
                    
                        
                        <img src="<?php echo(getFotoProfilo($cid, $utente));?>" class="avatar" alt="Avatar">
                        

                    </div>

                    <div class="profile-user-settings">

                        <h1 class="profile-user-name"><?php echo(getNickname($cid, $utente)); ?></h1>
                        <?php
                        $data_richiesta = getDataRichiesta($cid, $utente, $email);
                        $data_accettazione = getDataAccettazione($cid, $utente, $email);
                        if ($data_richiesta==0){
                        ?>
                            <button class="btn profile-edit-btn"  onclick="location.href='../backend/request_friendship-exe.php?utente=<?php echo $utente ?>'">Send request</button>
                        <?php } elseif (($data_richiesta!=0) && ($data_accettazione==0)) { ?>
                            <button class="btn profile-edit-btn" onclick="location.href='../backend/eliminateRequestDaProfile.php?utente=<?php echo $utente ?>'">Request sent</button>
                        <?php } else {?>
                            <button class="btn profile-edit-btn"  onclick="location.href='../backend/unfollow-exe.php?utente=<?php echo $utente ?>'">Unfollow</button>
                        <?php }?>
                        <span>
                        <?php if (getAdmin($cid, $email)!=0){ $codice_foto = getCodiceFoto($cid, $email);?>
                            <?php if (getDataBlocco($cid, $utente) == 0){?>
                                <button class="btn profile-edit-btn" onclick="location.href='../backend/bloccaUtenteDaProfile.php?utente=<?php echo $utente ?>'">Block User</button>
                            <?php } else { ?>
                                <button class="btn profile-edit-btn" onclick="location.href='../backend/sbloccaUtenteDaProfile.php?utente=<?php echo $utente ?>'">Unlock User</button>
                            <?php } ?>                                            
                                <button class="btn profile-edit-btn" onclick="location.href='../backend/deleteUtente-exe.php?utente=<?php echo $utente ?>'">Delete User</button>
                            <?php } ?> </span>
                        <br><br>Indice di rispettabilità: <?php echo(getRispettabilità($cid, $utente)); ?>
                        
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
               
                    <?php $codici = getCodiceFoto($cid, $utente); foreach($codici as $codice){
					$codice_profilo = getCodeFotoProfilo($cid, $utente);
                    if (($codice != null) and ($codice != $codice_profilo)){?>						
                        <div class="card-body">
                        
                    <div class="gallery-item" tabindex="0">
                    <p id = "luogo">
                            <?php echo getCitta($cid, $codice)." "; echo getStato($cid, $codice); ?>
                        </p>

                        <img src=<?php echo getFoto($cid, $codice);?> class="gallery-image" alt="">

                        <div class="card-footer">
                        <?php if(getDescrizioneFoto($cid, $codice)!=0){ ?>
                            <strong> Descrizione foto: </strong>
                            <p>
                            <?php echo getDescrizioneFoto($cid, $codice); ?>
                            </p>
                            <?php } ?>
                           
                            <strong><?php echo(count(getCodiceCommentoFoto($cid, $codice)))?> Comments </strong>
                            <button onclick = " MostraNascondiCommenti('<?php echo $codice ?>');" > Show/Hide Comments </button>
                            <div id="comments_container<?php echo $codice ?>" style="display:none;">
                            <?php
                                $codici_commento = getCodiceCommentoFoto($cid, $codice);
                                print_r($codici_commento);
                                foreach($codici_commento as $codice_commento){
                                    $email_commentatore = getCommentatore($cid, $codice_commento);
                                    $nickname_commentatore = getNickname($cid, $email_commentatore);
                                ?> <br><br> 
                                <?php if ($nickname_commentatore != getNickname($cid,$email)){ ?>
                                <a onclick="ValutaCommentoDaProfile('<?php echo $codice_commento;?>', '<?php echo $utente;?>')"><img class = "iLikeIt" src="../images/i_like_it.jpeg"></a>
                                <?php } ?>
                                <button type="button"  class="goToProfile" onclick="location.href='profile.php?utente=<?php echo $email_commentatore ?>'"> <?php echo($nickname_commentatore),": ";?></button>
                                <span><?php $commento = (getCommento($cid, $codice_commento)[0]); echo($commento); ?></span>

                                <?php $codici_foto = getPostsFoto($cid); $codici_testo = getPostsTesto($cid); 
                                            foreach($codici_foto as $codice_foto){
                                            if (strpos($commento, '@'.$codice_foto)){ ?> 
                                            <button onclick= "popUp('<?php echo $codice_foto;?>');"> ➔  Click here to go to the reported message </button> <?php }}
                                            foreach($codici_testo as $codice_testo){ 
                                            if (strpos($commento, '@'.$codice_testo)){?> <button onclick= "popUp('<?php echo $codice_testo;?>');"> ➔ Click here to go to the reported message </button> <?php }}?>

                                <?php if ($nickname_commentatore == getNickname($cid,$email)){?>
                                    <br><button class = "btn post-edit-btn" onclick= "location.href='../backend/deleteCommentDaProfile.php?codice=<?php echo $codice_commento ?>&utente=<?php echo $utente ?>'">Delete comment</button>
                                    <?php } elseif (getValutazione($cid, $email, $codice_commento)!=0) { ?><br>
                                    <br><button class = "btn post-edit-btn" onclick= "location.href='../backend/deleteValutazioneDaProfile.php?codice=<?php echo $codice_commento ?>&utente=<?php echo $utente?>'">Delete valutazione</button>
                                <?php } ?><br><br>
                                <small><?php echo("Comment written on: "); echo(getTimeCommento($cid, $codice_commento)); ?>
                                <br>
                                <?php  
                                    $gradimenti = getIndGradimento($cid, $codice_commento);
                                    $somma = 0;
                                    if (!empty($gradimenti)){
                                        foreach ($gradimenti as $gradimento){$somma += $gradimento;}
                                        echo("The approval rating for this comment is (average rating): ". number_format(($somma/count($gradimenti)),1));
                                    }else{
                                        echo("The comment has not received any ratings");
                                    }
                                    ?><br></small>  
					<?php }?>
                        </div>
                    
                    <div class="card-footer">
                        <form method="POST" action="../backend/commentDaProfile_foto.php?utente=<?php echo $utente?>&codice_foto=<?php echo $codice?>">
                            <div class="container">
                                <input type="text" placeholder="Inserisci un commento" name="commento">
                                <input type="submit" value="invia">
                            </div>
                        </form>
                    </div>
                    <div class="text-muted small"><?php echo "Message published on: ", getTimeFoto($cid, $codice); ?></div>
                    <div class="text-muted small codice"><?php echo "Photo code: ". $codice; ?></div>
                    </div>
                    </div>
                    <?php }} ?>
                    </div>
                 </div>
                

                <?php $codici_t = getCodiceTesto($cid, $utente); foreach($codici_t as $codice_t){ ?>
                    <div class="gallery-item" tabindex="0">
                <p id = "messaggio_testo"><?php echo getTesto($cid, $codice_t);?></p>
                <div class="card-body">
                        <div class="card-footer">
                        <strong><?php echo(count(getCodiceCommentoTesto($cid, $codice_t)))?> Comments </strong>
                        <button onclick = " MostraNascondiCommenti('<?php echo $codice_t ?>');" > Show/Hide Comments </button>
                        <div id="comments_container<?php echo $codice_t ?>" style="display:none;">
                                <?php
                                    $codici_commento = getCodiceCommentoTesto($cid, $codice_t);
                                    foreach($codici_commento as $codice_commento){
                                        $email_commentatore = getCommentatore($cid, $codice_commento);
                                        $nickname_commentatore = getNickname($cid, $email_commentatore);?>
                                        <br><br> 
                                        <?php if ($nickname_commentatore != getNickname($cid,$email)){ ?>
                                        <a onclick="ValutaCommentoDaProfile('<?php echo $codice_commento;?>', '<?php echo $utente;?>')"><img class = "iLikeIt" src="../images/i_like_it.jpeg"></a>
                                        <?php } ?>
                                        <button type="button"  class="goToProfile" onclick="location.href='profile.php?utente=<?php echo $email_commentatore ?>'"> <?php echo($nickname_commentatore. ": "); ?></button>
                                        <span><?php $commento = (getCommento($cid, $codice_commento)[0]); echo($commento); ?></span>

                                        <?php $codici_foto = getPostsFoto($cid); $codici_testo = getPostsTesto($cid); 
                                            foreach($codici_foto as $codice_foto){
                                            if (strpos($commento, '@'.$codice_foto)){ ?> 
                                            <button onclick= "popUp('<?php echo $codice_foto;?>');"> ➔ Click here to go to the reported message </button> <?php }}
                                            foreach($codici_testo as $codice_testo){ 
                                            if (strpos($commento, '@'.$codice_testo)){?> <button onclick= "popUp('<?php echo $codice_testo;?>');"> ➔ Click here to go to the reported message</button> <?php }}?>

                                        <?php if ($nickname_commentatore == getNickname($cid,$email)){?>
                                            <br><button  class = "btn post-edit-btn" onclick= "location.href='../backend/deleteCommentDaProfile.php?codice=<?php echo $codice_commento ?>&utente=<?php echo $utente ?>'">Delete comment</button>
                                            <?php }elseif (getValutazione($cid, $email, $codice_commento)!=0) { ?><br>
                                            <br><button  class = "btn post-edit-btn" onclick= "location.href='../backend/deleteValutazioneDaProfile.php?codice=<?php echo $codice_commento ?>&utente=<?php echo $utente?>'">Delete valutazione</button>
                                        <?php } ?>
                                        <small><br><br><?php echo("Comment written on: "); echo(getTimeCommento($cid, $codice_commento));?>
                                        <br>
                                        <?php  
                                            $gradimenti = getIndGradimento($cid, $codice_commento);
                                            $somma = 0;
                                            if (!empty($gradimenti)){
                                                foreach ($gradimenti as $gradimento){$somma += $gradimento;}
                                                echo("The approval rating for this comment is (average rating): ". number_format(($somma/count($gradimenti)),1));
                                            }else{
                                                echo("The comment has not received any ratings");
                                            }
                                        ?><br></small>  
                                    <?php } ?>
                        </div>
                <div class="card-footer">
                        <form method="POST" action="../backend/commentDaProfile_testo.php?utente=<?php echo $utente?>&codice_testo=<?php echo $codice_t?>">
                            <div class="container">
                                <input type="text" placeholder="Inserisci un commento" name="commento">
                                <input type="submit" value="invia">
                            </div>
                        </form>
                </div>
                </div>
                <div class="text-muted small"><?php echo "Message published on: ", getTimeTesto($cid, $codice_t); ?></div>
                <div class="text-muted small codice"><?php echo "Text code: ". $codice_t; ?></div>
                </div>
                </div>
                <?php } ?>
                </div>
                </div>
                </div>
                                        </div>
                <!-- End of gallery --> 
                <div class="content">
                <?php require "../common/footer.php"?>   </div>             
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