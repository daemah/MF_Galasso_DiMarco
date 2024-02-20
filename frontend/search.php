<!DOCTYPE html>
<html lang="en">
<?php
session_start();
include_once "../common/connection.php";
include_once "../common/funzioni.php";
$email = $_SESSION["email"];
$utenti = getUtenti($cid, $email);
if(isset($_SESSION['email'])){
?>
    <?php require "../common/header.php"?> 
    <script src="../js/myscript.js"></script>

    <body>
        <link href="../styles/search.css" rel="stylesheet">
        <div><?php require "../common/navbar.php"?></div>
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
             <div class="text-center text-sm-right">
                <div class="text-muted"><small>All is art ©</small></div>
            </div>
            <h2> Cerca i tuoi futuri amici: </h2>
            <div>
                <form class="modulo-ricerca">
                    <input id="search" type="text" placeholder="Cerca un amico" onkeyup="search_profile();" required>
                </form>
            </div>  
            <div>
                <form class="modulo-ricerca">
                    <p> Cerca un amico in base a: </p>
                    <button class = "btn post-edit-btn" type="button" id = "ricerca1" onclick = "changeColorBlu1(); "> hobby </button>
                    <button class = "btn post-edit-btn" type="button" id = "ricerca2" onclick = "changeColorBlu2(); "> città nascita </button>
                    <button class = "btn post-edit-btn" type="button" id = "ricerca3" onclick = "changeColorBlu3(); "> città residenza </button>
                </form>
            </div>
            <link href="../styles/request.css" rel="stylesheet">
    <?php foreach ($utenti as $utente){?>
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="people-nearby">
                    
                        <div class="nearby-user">
                            <div class="row">
                                <div class="col-md-2 col-sm-2" >
                            
                                    <img src="<?php echo(getFotoProfilo($cid, $utente));?>" alt="user" class="profile-photo-lg">
                                
                                </div>
                               
                                <div class="col-md-7 col-sm-7" >
                                    <h5> <button type="button" class="goToProfile" onclick="location.href='profile.php?utente=<?php echo $utente ?>'"> <?php echo(getNickname($cid, $utente));?></button></h5>
                                </div>

                                <?php
                                if ($utente != $email){
                                $data_accettazione = getDataAccettazione($cid, $utente, $email);
                                $data_richiesta = getDataRichiesta($cid, $utente, $email);

                                if ($data_richiesta==0) {
                                ?>
                                <div class="col-md-3 col-sm-3">
                                    <button class="btn post-edit-btn"  onclick="location.href='../backend/request_friendship-exe.php?utente=<?php echo $utente ?>'">Invia Richiesta</button>
                                </div>
                                <?php } elseif (($data_richiesta!=0) && ($data_accettazione==0)) { ?>
                                <div class="col-md-3 col-sm-3">
                                    <button class="btn post-edit-btn" onclick="location.href='../backend/eliminateRequest-exe.php?utente=<?php echo $utente ?>'">Richiesta Inviata</button>
                                    <div class="text-muted small"><?php echo "Richiesta inviata il: ", $data_richiesta ?></div>
                                </div>
                                <?php } else {?>
                                <div class="col-md-3 col-sm-3">
                                    <button class="btn post-edit-btn" onclick="location.href='../backend/unfollow-exe.php?utente=<?php echo $utente ?>'">Unfollow</button>
                                    <div class="text-muted small"><?php echo "Richiesta inviata il: ", $data_richiesta, " e accettata il giorno: ", $data_accettazione ?></div>
                                </div>    
                                <?php }}?>
                                
                                <div style="clear:both;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>         
    
    <?php } ?>         
    <?php require "../common/footer.php"?>
        </div>
    </body>
    <?php
    }
    else{
        header("location:../index.php");
    }
    ?>
</html>