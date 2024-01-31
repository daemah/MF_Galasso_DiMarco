<!DOCTYPE html>
<html lang="en">
    <?php
    session_start(); 
    include_once "../common/connection.php";
    include_once "../common/funzioni.php";
    require "../common/header.php"
    /* sdfsdf */ 
    ?>


        <body>
        <div><?php require "../common/navbar.php";?></div>
            <link href="../styles/post.css" rel="stylesheet">
            <?php $utenti = getUtenti($cid); foreach($utenti as $utente){
                $codici = getCodiceFoto($cid, $utente); foreach($codici as $codice){
                    if ($codice != null){?>
                        <div class="content">
                        <h2> Post suggested for you </h2>  
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="card mb-4"> 
                                    <div class="card-body">
                                        <a  href="profile.php?utente=<?php echo $utente ?>"> 
                                        <div class="media mb-3">
                    
                                            <?php if (empty(getFotoProfilo($cid, $utente))){?>
                                                <img src="../images/profilo.jpeg" class="avatar" alt="Avatar">
                                            <?php } else { ?>
                                                <img src=<?php echo getFotoProfilo($cid, $utente);?>class="avatar" alt="Avatar">
                                            <?php } ?>
                                            
                                        <span class="media-body ml-3" id = "name">
                                        
                                        <?php echo(getNickname($cid, $utente));?>
                                        
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
                                                    <strong>12</strong> <small class="align-middle">Comments</small>
                                                    <p>
                                                        <?php echo getDescrizioneFoto($cid, $codice); ?>
                                                    </p>
                                                </div>
                                            </div>
                                                <div class="card-footer">
                                                    <input type="text" placeholder="Inserisci un commento" name="commento" value="">
                                                    <input type="submit" value="invia">
                                                </div>
                                                <div class="text-muted small"><?php echo "il giorno ", getTimeFoto($cid, $codice); ?></div>
                                    </div>
                                    </div>
                                </div>
                            </div>
                            
                    </div>
            <?php }} ?>
                <?php $codici = getCodiceTesto($cid, $utente); foreach($codici as $codice){
                        if ($codice != null){?>
                        <div class="content">
                        <h2> Post suggested for you </h2>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="card mb-4">
                                        <div class="card-body">
                                        <a  href="profile.php?utente=<?php echo $utente ?>"> 
                                            <div class="media mb-3">
                                           
                                            <?php if (empty(getFotoProfilo($cid, $utente))){?>
                                                <img src="../images/profilo.jpeg" class="avatar" alt="Avatar">
                                            <?php } else { ?>
                                                <img src=<?php echo(getFotoProfilo($cid, $utente));?>class="avatar" alt="Avatar">
                                            <?php } ?>
                                          
                                            
                                            <span class="media-body ml-3" id = "name">
                                            
                                                <?php echo(getNickname($cid, $utente));?>
                                            
                                            </span>
                                            </div>
                                            </a>
                                            <div class="gallery-item" tabindex="0">

                                                <p class="gallery-image" alt=""><?php echo getTesto($cid, $codice);?></p>
                                                    <div class="card-footer">
                                                        <strong>12</strong> <small class="align-middle">Comments</small>
                                                    </div>
                                            </div>
                                                    <div class="card-footer">
                                                        <input type="text" placeholder="Inserisci un commento" name="commento" value="">
                                                        <input type="submit" value="invia">
                                                    </div>
                                                    <div class="text-muted small"><?php echo "il giorno ", getTimeTesto($cid, $codice); ?></div>
                                        </div>
                                        </div>
                                    </div>
                                 </div>
                                 
                                 <?php require "../common/footer.php";?>       
                        </div>
                <?php }}} ?>
                
             
        </body>
   
</html>