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

    <script>
    function search_profile() { 
    let input = document.getElementById('search').value 
    input=input.toLowerCase(); 
    let x = document.getElementsByClassName('container'); 
      
    for (i = 0; i < x.length; i++) {  
        if (!x[i].innerHTML.toLowerCase().includes(input)) { 
            x[i].style.display="none"; 
        } 
        else { 
            x[i].style.display="list-item";                  
        } 
    } 
    } 
    </script> 

    <body>
        <link href="../styles/search.css" rel="stylesheet">
        <div><?php require "../common/navbar.php"?></div>
        <div class = "content">
            <h2> Cerca </h2>
            <div>
                <form class="modulo-ricerca">
                    <input id="search" type="text" placeholder="Cerca un amico" onkeyup="search_profile()" required>
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
                                <div class="col-md-2 col-sm-2">
                                <?php if (empty(getFotoProfilo($cid, $utente))){?>
                                    <img src="../images/profilo.jpeg" alt="user" class="profile-photo-lg">
                                <?php } else { ?>
                                    <img src=<?php echo(getFotoProfilo($cid, $utente));?>alt="user" class="profile-photo-lg">
                                <?php } ?>
                                </div>
                               
                                <div class="col-md-7 col-sm-7">
                                    <h5><a href="profile.php?utente=<?php echo $utente ?>" class="profile-link"><?php echo getNickname($cid, $utente); ?></a></h5>
                                </div>

                                <?php
                                if ($utente != $email){
                                $sql = "SELECT data_accettazione, data_richiesta FROM chiede_amicizia WHERE utente_ricevente = '$utente' and utente_richiedente = '$email';";
                                $res=$cid->query($sql);
                                $row = $res->fetch_assoc();
                                $data_accettazione = $row["data_accettazione"];
                                $data_richiesta = $row["data_richiesta"];
                                
                                if (empty($data_richiesta)) {
                                ?>
                                <div class="col-md-3 col-sm-3">
                                    <button class="btn profile-edit-btn"  onclick="location.href='../backend/request_friendship-exe.php?utente=<?php echo $utente ?>'">Invia Richiesta</button>
                                </div>
                                <?php } elseif ((!empty($data_richiesta)) && (empty($data_accettazione))) { ?>
                                <div class="col-md-3 col-sm-3">
                                    <button class="btn profile-edit-btn" >Richiesta Inviata</button>
                                </div>
                                <?php } else {?>
                                <div class="col-md-3 col-sm-3">
                                    <button class="btn profile-edit-btn" onclick="location.href='../backend/unfollow-exe.php?utente=<?php echo $utente ?>'">Unfollow</button>
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