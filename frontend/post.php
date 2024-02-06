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
            <?php $utenti = getUtenti($cid); foreach($utenti as $utente){
                $codici = getCodiceFoto($cid, $utente); foreach($codici as $codice){
                    if ($codice != null){?>
                        <div class="content">
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
                        <h2> Post suggested for you </h2>  
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="card mb-4"> 
                                    <div class="card-body">
                                   
                                        <div class="media mb-3">
                                           
                                            <?php if (empty(getFotoProfilo($cid, $utente))){?>
                                                <img src="../images/profilo.jpeg" class="avatar" alt="Avatar">
                                            <?php } else { ?>
                                                <img src=<?php echo getFotoProfilo($cid, $utente);?>class="avatar" alt="Avatar">
                                            <?php } ?>
                                            
                                        <span class="media-body ml-3" id = "name">
                                        
                                        <button type="button"  class="goToProfile" onclick="location.href='profile.php?utente=<?php echo $utente ?>'"> <?php echo(getNickname($cid, $utente));?></button>
                                        
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

                                                    <strong><?php echo(count(getCodiceCommentoFoto($cid, $codice)))?></strong> <small class="align-middle">Comments: </small>
                                                    <?php
                                                        $codici_commento = getCodiceCommentoFoto($cid, $codice);
                                                       
                                                        foreach($codici_commento as $codice_commento){
                                                            $email_commentatore = getCommentatore($cid, $codice_commento);
                                                            $nickname_commentatore = getNickname($cid, $email_commentatore);?>
                                                             <br><br> <small><img class = "iLikeIt" src="../images/i_like_it.jpeg"> <?php echo($nickname_commentatore). ": "; echo(getCommento($cid, $codice_commento)[0])?><br><?php echo("commento scritto il: "); echo(getTimeCommento($cid, $codice_commento));?> </small>
                                                        <?php }
                                                    ?>
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
                        <h2> Post suggested for you </h2>
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
                                            
                                            </span>
                                            </div>
                                            </a>
                                            <div class="gallery-item" tabindex="0">

                                                <p class="gallery-image" alt=""><?php echo getTesto($cid, $codice);?></p>
                                                    <div class="card-footer">
                                                        <strong><?php echo(count(getCodiceCommentoTesto($cid, $codice)))?></strong> <small class="align-middle">Comments: </small>

                                                        <?php
                                                        $codici_commento = getCodiceCommentoTesto($cid, $codice);
                                                        foreach($codici_commento as $codice_commento){
                                                            $email_commentatore = getCommentatore($cid, $codice_commento);
                                                            $nickname_commentatore = getNickname($cid, $email_commentatore);?>
                                                            <br><br><small> <img class = "iLikeIt" src="../images/i_like_it.jpeg"> <?php echo($nickname_commentatore). ": "; echo(getCommento($cid, $codice_commento)[0])?> <br><?php echo("commento scritto il: "); echo(getTimeCommento($cid, $codice_commento));?></small>  
                                                        <?php }
                                                    ?>
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