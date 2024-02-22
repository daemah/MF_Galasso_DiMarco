<!DOCTYPE html>
<html lang="en">
    <?php
    session_start(); 
    include_once "../common/connection.php";
    include_once "../common/funzioni.php";
    include_once "../common/header.php";
    $email = $_SESSION["email"];
    if(isset($_SESSION['email'])){
    /* sdfsdhgghgggsf */ 
    ?>


        <body>
        <div><?php require "../common/navbar.php";?></div>
            <link href="../styles/post.css" rel="stylesheet">
            <script src="../js/myscript.js"></script>
            <div class = "content">
            <div class="text-center text-sm-right">
                <div class="text-muted"><small>All is art ©</small></div>
            </div>
            <?php
                if (isset($_GET["status"])) {
                    if ($_GET["status"]=='ko')
                            {
                
                                {
                                    echo "<div class='alert-warning'>\n";
                                    echo $_GET["msg"];
                                    echo "</div>";
                                }
                            }
                        }
                ?>
                <?php if (isset($_GET["status"]))
                        {
                            if ($_GET["status"]=='ok')
                            {
                                echo "<div class='alert-success'>\n";
                                echo $_GET["msg"];
                                echo "</div>";
                            }
                      
            }?>
                        <h2> Messagges suggested for you </h2>
                       
            </div>
            
            <?php $utenti = getUsers($cid); foreach($utenti as $utente){
                $codici = getCodiceFoto($cid, $utente); foreach($codici as $codice){
					$codice_profilo = getCodeFotoProfilo($cid, $utente);
                    if (($codice != null) and ($codice != $codice_profilo)){?> 
                        <div class="content"> 
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="card mb-4"> 
                                    <div class="card-body">
                                   
                                        <div class="media mb-3">
                                           
                                    
                                        <img src="<?php echo(getFotoProfilo($cid, $utente));?>" class="avatar" alt="Avatar">
                                        
                                            
                                        <span class="media-body ml-3" id = "name">
                                        
                                        <button type="button"  class="goToProfile" onclick="location.href='profile.php?utente=<?php echo $utente ?>'"> <?php echo(getNickname($cid, $utente));?></button>
                                        <?php
                                        if ($utente != $email){
                                            $data_richiesta = getDataRichiesta($cid, $utente, $email);
                                            $data_accettazione = getDataAccettazione($cid, $utente, $email);
                                            if ($data_richiesta==0){
                                        ?>
                                            <button class="btn post-edit-btn"  onclick="location.href='../backend/request_friendshipDaPost.php?utente=<?php echo $utente ?>'">Send request</button>
                                        <?php } elseif (($data_richiesta!=0) && ($data_accettazione==0)) { ?>
                                            <button class="btn post-edit-btn" onclick="location.href='../backend/eliminateRequestDaPost.php?utente=<?php echo $utente ?>'">Request sent</button>
                                        <?php } else {?>
                                            <button class="btn post-edit-btn"  onclick="location.href='../backend/unfollowDaPost.php?utente=<?php echo $utente ?>'">Unfollow</button>
                                        <?php }}?>

                                        <?php if (($utente != $email) & getAdmin($cid, $email)!=0){?>
                                            <?php if (getDataBlocco($cid, $utente) == 0){?>
                                                <button class="btn post-edit-btn" onclick="location.href='../backend/bloccaUtente-exe.php?utente=<?php echo $utente ?>'">Block User</button>
                                            <?php } else { ?>
                                                <button class="btn post-edit-btn" onclick="location.href='../backend/sbloccaUtente-exe.php?utente=<?php echo $utente ?>'">Unlock User</button>
                                            <?php } ?>                                            
                                            <button class="btn post-edit-btn" onclick="location.href='../backend/deleteUtente-exe.php?utente=<?php echo $utente ?>'">Delete User</button>
                                        <?php } ?>
                                        
                                        </span>
                                        </div>
                                        </a>
                                        <div >  
                                            <p id = "luogo">
                                                <?php echo getCitta($cid, $codice)." "; echo getStato($cid, $codice);?>
                                            </p>
                                        </div>
                                        <div class="gallery-item" tabindex="0">

                                            <img src=<?php echo getFoto($cid, $codice);?> class="gallery-image" alt="">
                                                <div class="card-footer">
                                                <?php if(getDescrizioneFoto($cid, $codice)!=0){ ?>
                                                <strong> Descrizione foto: </strong>
                                                    <p>
                                                        <?php echo getDescrizioneFoto($cid, $codice); ?>
                                                    </p>
                                                <?php } ?>
                                                    <strong><?php echo(count(getCodiceCommentoFoto($cid, $codice)))?> Comments</strong>
                                                    <button  onclick = " MostraNascondiCommenti('<?php echo $codice ?>');" >Show/Hide Comments</button>
                                                    <div id="comments_container<?php echo $codice ?>" style="display: none;">
                                                    <?php
                                                    
                                                        $codici_commento = getCodiceCommentoFoto($cid, $codice);
                                                       
                                                        foreach($codici_commento as $codice_commento){
                                                            $email_commentatore = getCommentatore($cid, $codice_commento);
                                                            $nickname_commentatore = getNickname($cid, $email_commentatore);?>
                                                             
                                                                <br><br> 
                                                                <?php if ($nickname_commentatore != getNickname($cid,$email)){ ?>
                                                                <a onclick="ValutaCommento('<?php echo $codice_commento;?>', '<?php echo $email_commentatore;?>');"> <img class = "iLikeIt" src="../images/i_like_it.jpeg"> </a>
                                                                <?php } ?>
                                                                <button type="button"  class="goToProfileComment" onclick="location.href='profile.php?utente=<?php echo $email_commentatore;?>'"> <?php echo($nickname_commentatore . ": ");?></button>
                                                                <?php $commento = (getCommento($cid, $codice_commento)[0]); echo($commento); 
                                            
                                                                $codici_foto = getPostsFoto($cid); $codici_testo = getPostsTesto($cid); 
                                                                foreach($codici_foto as $codice_foto){ 
                                                                if (strpos($commento, '@'.$codice_foto)==true){?><button onclick= "popUp('<?php echo $codice_foto;?>');"> ➔ Click here to go to the reported message </button> <?php }}
																foreach($codici_testo as $codice_testo){ 
                                                                if (strpos($commento, '@'.$codice_testo)==true){?> <button onclick= "popUp('<?php echo $codice_testo;?>');"> ➔ Click here to go to the reported message </button> <?php }}?>

                                                                <?php if ($nickname_commentatore == getNickname($cid,$email)){?>
                                                                <br><button class="btn post-edit-btn" onclick= "location.href='../backend/deleteComment-exe.php?codice=<?php echo $codice_commento ?>'">Delete Comment</button>
                                                                <?php }elseif (getValutazione($cid, $email, $codice_commento)!=0) { ?>
                                                                <br><button class="btn post-edit-btn" onclick= "location.href='../backend/deleteValutazione-exe.php?codice=<?php echo $codice_commento ?>&utente=<?php echo $email_commentatore?>'">Delete Rating</button>
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
                                                        <?php }
                                                    ?>
                                                </div>
                                                </div>
                                            </div>
                                           
                                                <?php if ($utente != $email) {?>
                                                <div class="card-footer">
                                                   
                                                    <form method="POST" action="../backend/comment-exe_foto.php?utente=<?php echo $utente?>&codice_foto=<?php echo $codice?>">
                                                        <div class="container">
                                                            <input type="text" placeholder="Enter a comment" name="commento" >
                                                            <input class="btn profile-edit-btn" type="submit" value="send">
                                                        </div>
                                                    </form>
                                                </div>
                                                <?php } ?>
                                                <div class="text-muted small"><?php echo "Message published on: ", getTimeFoto($cid, $codice); ?></div>
                                                <div class="text-muted small"><?php echo "Photo code: ". $codice; ?></div>
                                    </div>
                                    </div>
                                </div>
                            </div>
                            
                    </div>
            <?php }} ?>
                <?php $codici = getCodiceTesto($cid, $utente); foreach($codici as $codice){
                        if ($codice != null){?>
                        <div class="content">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="card mb-4">
                                        <div class="card-body">
                                        
                                            <div class="media mb-3">
                                           
                                            
                                            <img src="<?php echo(getFotoProfilo($cid, $utente));?>"class="avatar" alt="Avatar">
                                            
                                          
                                            
                                            <span class="media-body ml-3" id = "name">
                                            
                                            <button type="button"  class="goToProfile" onclick="location.href='profile.php?utente=<?php echo $utente ?>'"> <?php echo(getNickname($cid, $utente));?></button>
                                            <?php
                                            if ($utente != $email){
                                                $data_richiesta = getDataRichiesta($cid, $utente, $email);
                                                $data_accettazione = getDataAccettazione($cid, $utente, $email);
                                            if ($data_richiesta==0){
                                            ?>
                                                <button class="btn post-edit-btn"  onclick="location.href='../backend/request_friendshipDaPost.php?utente=<?php echo $utente ?>'">Send request</button>
                                            <?php } elseif (($data_richiesta!=0) && ($data_accettazione==0)) { ?>
                                                <button class="btn post-edit-btn" onclick="location.href='../backend/eliminateRequestDaPost.php?utente=<?php echo $utente ?>'">Request sent</button>
                                            <?php } else {?>
                                                <button class="btn post-edit-btn"  onclick="location.href='../backend/unfollowDaPost.php?utente=<?php echo $utente ?>'">Unfollow</button>
                                            <?php }}?>

                                            <?php if (($utente != $email) & getAdmin($cid, $email)!=0){?>
                                                <?php if (getDataBlocco($cid, $utente) == 0){?>
                                                    <button class="btn post-edit-btn" onclick="location.href='../backend/bloccaUtente-exe.php?utente=<?php echo $utente ?>'">Block User</button>
                                                <?php } else { ?>
                                                    <button class="btn post-edit-btn" onclick="location.href='../backend/sbloccaUtente-exe.php?utente=<?php echo $utente ?>'">Unlock User</button>
                                                <?php } ?>
                                                <button class="btn post-edit-btn" onclick="location.href='../backend/deleteUtente-exe.php?utente=<?php echo $utente ?>'">Delete User</button>
                                                <?php } ?>
                                            </span>
                                            </div>
                                            </a>
                                            <div class="gallery-item" tabindex="0">

                                                <p class="gallery-image" id = "messaggio_testo" alt=""><?php echo getTesto($cid, $codice);?></p>
                                                    <div class="card-footer">
                                                    
                                                        <strong><?php echo(count(getCodiceCommentoTesto($cid, $codice)))?> Comments </strong>
                                                        <button onclick = " MostraNascondiCommenti('<?php echo $codice ?>');" > Show/Hide Comments </button>
                                                        <div id="comments_container<?php echo $codice ?>" style="display:none;">
                                                        

                                                        <?php
                                                        $codici_commento = getCodiceCommentoTesto($cid, $codice);
                                                        foreach($codici_commento as $codice_commento){
                                                            $email_commentatore = getCommentatore($cid, $codice_commento);
                                                            $nickname_commentatore = getNickname($cid, $email_commentatore);?>
                                                            <br><br>
                                                            <?php if ($nickname_commentatore != getNickname($cid,$email)){ ?>
                                                            <a onclick="ValutaCommento('<?php echo $codice_commento;?>', '<?php echo $email_commentatore;?>')"><img class = "iLikeIt" src="../images/i_like_it.jpeg"></a>
                                                            <?php } ?>
                                                            <button type="button"  class="goToProfileComment" onclick="location.href='profile.php?utente=<?php echo $email_commentatore ?>'"> <?php echo($nickname_commentatore . ": ");?></button>
                                                            <?php $commento = (getCommento($cid, $codice_commento)[0]); echo($commento); 

                                                            $codici_foto = getPostsFoto($cid); $codici_testo = getPostsTesto($cid); 
                                                            foreach($codici_foto as $codice_foto){ 
                                                                if (strpos($commento, '@'.$codice_foto)==true){?><button onclick= "popUp('<?php echo $codice_foto;?>');"> ➔ Click here to go to the reported message </button> <?php }}
                                                            foreach($codici_testo as $codice_testo){ 
                                                                if (strpos($commento, '@'.$codice_testo)==true){?> <button onclick= "popUp('<?php echo $codice_testo;?>');"> ➔ Click here to go to the reported message </button> <?php }}?>

                                                            <?php if ($nickname_commentatore == getNickname($cid,$email)){?>
                                                                <br><button class="btn post-edit-btn" onclick = "location.href='../backend/deleteComment-exe.php?codice=<?php echo $codice_commento ?>'">Delete Comment</button>
                                                            <?php }elseif (getValutazione($cid, $email, $codice_commento)!=0) { ?>
                                                                <br><button class="btn post-edit-btn" onclick= "location.href='../backend/deleteValutazione-exe.php?codice=<?php echo $codice_commento ?>&utente=<?php echo $email_commentatore?>'">Delete Rating</button>
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
                                                </div>
                                            </div>
                                            <?php if ($utente != $email) {?>
                                                    <div class="card-footer">
                                                    <form method="POST" action="../backend/comment-exe_testo.php?utente=<?php echo $utente ?>&codice_testo=<?php echo $codice ?>">
                                                        <div class="container">
                                                            <input type="text" placeholder="Enter a comment" name="commento">
                                                            <input type="submit" value="send">
                                                        </div>
                                                    </form>
                                                    </div>
                                            <?php } ?>
                                                    <div class="text-muted small"><?php echo "Message published on: ", getTimeTesto($cid, $codice); ?></div>
                                                    <div class="text-muted small"><?php echo "Text code: ". $codice; ?></div>
                                        </div>
                                        </div>
                                    </div>
                                 </div>
                                 
                                 <?php require "../common/footer.php";?>       
                        </div>
                <?php }}} ?>
                
             
        </body>
        <?php
    }
    else{
        header("location:../index.php");
    }
    ?>
   
</html>