<!DOCTYPE html>
<html lang="en">
    <?php
    session_start(); 
    include_once "../common/connection.php";
    include_once "../common/funzioni.php";
    require "../common/header.php"
    /* sdfsdhgghgggsf */ 
    ?>


        <body>
        <div><?php require "../common/navbar.php";?></div>
            <link href="../styles/post.css" rel="stylesheet">
            <script src="../js/myscript.js"></script>
            <div class = "content">
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
                        <h2> Posts suggested for you </h2>
            </div>
            <?php $utenti = getUsers($cid); foreach($utenti as $utente){
                $codici = getCodiceFoto($cid, $utente); foreach($codici as $codice){
                    if ($codice != null){?> 
                        <div class="content"> 
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="card mb-4"> 
                                    <div class="card-body">
                                   
                                        <div class="media mb-3">
                                           
                                        <?php if (empty(getFotoProfilo($cid, $utente))){?>
                                            <img src="../images/profilo.jpeg" class="avatar" alt="Avatar">
                                        <?php } else { ?>
                                            <img src=<?php echo(getFotoProfilo($cid, $utente));?>class="avatar" alt="Avatar">
                                        <?php } ?>
                                            
                                        <span class="media-body ml-3" id = "name">
                                        
                                        <button type="button"  class="goToProfile" onclick="location.href='profile.php?utente=<?php echo $utente ?>'"> <?php echo(getNickname($cid, $utente));?></button>
                                        <?php
                                        if ($utente != $email){
                                            $data_richiesta = getDataRichiesta($cid, $utente, $email);
                                            $data_accettazione = getDataAccettazione($cid, $utente, $email);
                                            if ($data_richiesta==0){
                                        ?>
                                            <button class="btn profile-edit-btn"  onclick="location.href='../backend/request_friendship-exe.php?utente=<?php echo $utente ?>'">Invia Richiesta</button>
                                        <?php } elseif (($data_richiesta!=0) && ($data_accettazione==0)) { ?>
                                            <button class="btn profile-edit-btn" onclick="location.href='../backend/eliminateRequest-exe.php?utente=<?php echo $utente ?>'">Richiesta Inviata</button>
                                        <?php } else {?>
                                            <button class="btn profile-edit-btn"  onclick="location.href='../backend/unfollow-exe.php?utente=<?php echo $utente ?>'">Unfollow</button>
                                        <?php }}?>

                                        <?php if (($utente != $email) & getAdmin($cid, $email)!=0){?>
                                            <?php if (getDataBlocco($cid, $utente) == 0){?>
                                                <button class="btn profile-edit-btn" onclick="location.href='../backend/bloccaUtente-exe.php?utente=<?php echo $utente ?>'">Blocca utente</button>
                                            <?php } else { ?>
                                                <button class="btn profile-edit-btn" onclick="location.href='../backend/sbloccaUtente-exe.php?utente=<?php echo $utente ?>'">Sblocca utente</button>
                                            <?php } ?>                                            
                                            <button class="btn profile-edit-btn" onclick="location.href='../backend/deleteUtente-exe.php?utente=<?php echo $utente ?>'">Elimina utente</button>
                                        <?php } ?>
                                        
                                        </span>
                                        </div>
                                        </a>
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

                                                    <strong><?php echo(count(getCodiceCommentoFoto($cid, $codice)))?></strong> <span class="align-middle">Comments: </span>
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
                                                                foreach($codici_foto as $codice_foto){ print_r(" ".strpos($commento, '@'.$codice_foto));
                                                                if (strpos($commento, '@'.$codice_foto)==true){?> <button onclick= "popUp('<?php echo $codice_foto;?>');"> ➔ Clicca qui per andare al messaggio riferito </button> <?php }}
                                                                foreach($codici_testo as $codice_testo){ print_r(" ".strpos($commento, '@'.$codice_testo));
                                                                if (strpos($commento, '@'.$codice_testo)==true){?> <button onclick= "popUp('<?php echo $codice_testo;?>');"> ➔ Clicca qui per andare al messaggio riferito </button> <?php }}?>

                                                                <?php if ($nickname_commentatore == getNickname($cid,$email)){?>
                                                                <br><button class="btn profile-edit-btn" onclick= "location.href='../backend/deleteComment-exe.php?codice=<?php echo $codice_commento ?>'">Delete comment</button>
                                                                <?php }elseif (getValutazione($cid, $email, $codice_commento)!=0) { ?>
                                                                <br><button class="btn profile-edit-btn" onclick= "location.href='../backend/deleteValutazione-exe.php?codice=<?php echo $codice_commento ?>&utente=<?php echo $utente?>'">Delete valutazione</button>
                                                                <?php } ?>
                                                                <br><small>
                                                                <br><?php echo("commento scritto il: "); echo(getTimeCommento($cid, $codice_commento));?> 
                                                                <br>
                                                                <?php  
                                                                $gradimenti = getIndGradimento($cid, $codice_commento);
                                                                $somma = 0;
                                                                if (!empty($gradimenti)){
                                                                    foreach ($gradimenti as $gradimento){$somma += $gradimento;}
                                                                    echo("La media delle valutazioni di questo commento è (indice di gradimento): ". $somma/count($gradimenti));
                                                                }else{
                                                                    echo("Il commento non ha ricevuto valutazioni");
                                                                }
                                                                ?><br></small>
                                                        <?php }
                                                    ?>
                                                </div>
                                            </div>
                                                <div class="card-footer">
                                                   
                                                    <form method="POST" action="../backend/comment-exe_foto.php?utente=<?php echo $utente?>">
                                                        <div class="container">
                                                            <input type="text" placeholder="Inserisci un commento" name="commento" >
                                                            <input class="btn profile-edit-btn" type="submit" value="invia">
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="text-muted small"><?php echo "Postato il giorno ", getTimeFoto($cid, $codice); ?></div>
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
                                           
                                            <?php if (empty(getFotoProfilo($cid, $utente))){?>
                                                <img src="../images/profilo.jpeg" class="avatar" alt="Avatar">
                                            <?php } else { ?>
                                                <img src=<?php echo(getFotoProfilo($cid, $utente));?>class="avatar" alt="Avatar">
                                            <?php } ?>
                                          
                                            
                                            <span class="media-body ml-3" id = "name">
                                            
                                            <button type="button"  class="goToProfile" onclick="location.href='profile.php?utente=<?php echo $utente ?>'"> <?php echo(getNickname($cid, $utente));?></button>
                                            <?php
                                            if ($utente != $email){
                                                $data_richiesta = getDataRichiesta($cid, $utente, $email);
                                                $data_accettazione = getDataAccettazione($cid, $utente, $email);
                                            if ($data_richiesta==0){
                                            ?>
                                                <button class="btn profile-edit-btn"  onclick="location.href='../backend/request_friendship-exe.php?utente=<?php echo $utente ?>'">Invia Richiesta</button>
                                            <?php } elseif (($data_richiesta!=0) && ($data_accettazione==0)) { ?>
                                                <button class="btn profile-edit-btn" onclick="location.href='../backend/eliminateRequest-exe.php?utente=<?php echo $utente ?>'">Richiesta Inviata</button>
                                            <?php } else {?>
                                                <button class="btn profile-edit-btn"  onclick="location.href='../backend/unfollow-exe.php?utente=<?php echo $utente ?>'">Unfollow</button>
                                            <?php }}?>

                                            <?php if (($utente != $email) & getAdmin($cid, $email)!=0){?>
                                                <?php if (getDataBlocco($cid, $utente) == 0){?>
                                                    <button class="btn profile-edit-btn" onclick="location.href='../backend/bloccaUtente-exe.php?utente=<?php echo $utente ?>'">Blocca utente</button>
                                                <?php } else { ?>
                                                    <button class="btn profile-edit-btn" onclick="location.href='../backend/sbloccaUtente-exe.php?utente=<?php echo $utente ?>'">Sblocca utente</button>
                                                <?php } ?>
                                                <button class="btn profile-edit-btn" onclick="location.href='../backend/deleteUtente-exe.php?utente=<?php echo $utente ?>'">Elimina utente</button>
                                                <?php } ?>
                                            </span>
                                            </div>
                                            </a>
                                            <div class="gallery-item" tabindex="0">

                                                <p class="gallery-image" alt=""><?php echo getTesto($cid, $codice);?></p>
                                                    <div class="card-footer">
                                                        <strong><?php echo(count(getCodiceCommentoTesto($cid, $codice)))?></strong> <span class="align-middle">Comments: </span>

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
                                                                if (strpos($commento, '@'.$codice_foto)==true){?><button onclick= "popUp('<?php echo $codice_foto;?>');"> ➔ Clicca qui per andare al messaggio riferito </button> <?php }}
                                                            foreach($codici_testo as $codice_testo){ 
                                                                if (strpos($commento, '@'.$codice_testo)==true){?> <button onclick= "popUp('<?php echo $codice_testo;?>');"> ➔ Clicca qui per andare al messaggio riferito </button> <?php }}?>

                                                            <?php if ($nickname_commentatore == getNickname($cid,$email)){?>
                                                                <br><button class="btn profile-edit-btn" onclick = "location.href='../backend/deleteComment-exe.php?codice=<?php echo $codice_commento ?>'">Delete comment</button>
                                                            <?php }elseif (getValutazione($cid, $email, $codice_commento)!=0) { ?>
                                                                <br><button class="btn profile-edit-btn" onclick= "location.href='../backend/deleteValutazione-exe.php?codice=<?php echo $codice_commento ?>&utente=<?php echo $utente?>'">Delete valutazione</button>
                                                            <?php } ?>
                                                            <small><br><br><?php echo("commento scritto il: "); echo(getTimeCommento($cid, $codice_commento));?>
                                                            <br>
                                                                <?php  
                                                                $gradimenti = getIndGradimento($cid, $codice_commento);
                                                                $somma = 0;
                                                                if (!empty($gradimenti)){
                                                                    foreach ($gradimenti as $gradimento){$somma += $gradimento;}
                                                                    echo("La media delle valutazioni di questo commento è (indice di gradimento): ". $somma/count($gradimenti));
                                                                }else{
                                                                    echo("Il commento non ha ricevuto valutazioni");
                                                                }
                                                                ?><br></small>  
                                                        <?php } ?>
                                                    </div>
                                            </div>
                                                    <div class="card-footer">
                                                    <form method="POST" action="../backend/comment-exe_testo.php?utente=<?php echo $utente ?>">
                                                        <div class="container">
                                                            <input type="text" placeholder="Inserisci un commento" name="commento">
                                                            <input type="submit" value="invia">
                                                        </div>
                                                    </form>
                                                    </div>
                                                    <div class="text-muted small"><?php echo "Postato il giorno ", getTimeTesto($cid, $codice); ?></div>
                                        </div>
                                        </div>
                                    </div>
                                 </div>
                                 
                                 <?php require "../common/footer.php";?>       
                        </div>
                <?php }}} ?>
                
             
        </body>
   
</html>