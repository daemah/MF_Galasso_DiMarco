
<!DOCTYPE html>
<html lang="en">
<?php require "../common/header.php"?>  
    <?php
    #session_start();
    include_once "../common/connection.php";
    include_once "../common/funzioni.php";
    $email = $_SESSION["email"];
    $utente = $_GET["utente"];
    $page = $_GET["page"];
    if ($page == 'followers'){
        $users = getFollowers($cid, $utente);
    }
    if($page == 'following'){
        $users = getFollowing($cid, $utente);
    }
    ?>

<link href="../styles/request.css" rel="stylesheet">
<body>
<button type="button" class="cancelbtn" onclick="location.href='profile.php?utente=<?php echo $utente ?>'">X</button>  
<div class = "content">
   <?php foreach ($users as $user){?>
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <div class="people-nearby">
                        
                            <div class="nearby-user">
                                <div class="row">
                                    <?php if (empty(getFotoProfilo($cid, $user))){?>
                                        <img src="../images/profilo.jpeg" alt="user" class="profile-photo-lg">
                                    <?php } else { ?>
                                        <img src=<?php echo getFotoProfilo($cid, $user);?>alt="user" class="profile-photo-lg">
                                    <?php } ?>
                                   
                                    <div class="col-md-7 col-sm-7">
                                        <h5><a href="profile.php?utente=<?php echo $user ?>" class="profile-link"><?php echo getNickname($cid, $user); ?></a></h5>
                                    </div>
                                    
                                    <?php
                                        if ($user != $email){
                                        $sql = "SELECT data_accettazione, data_richiesta FROM chiede_amicizia WHERE utente_ricevente = '$user' and utente_richiedente = '$email';";
                                        $res=$cid->query($sql);
                                        $row = $res->fetch_assoc();
                                        $data_accettazione = $row["data_accettazione"];
                                        $data_richiesta = $row["data_richiesta"];
                                        
                                        if (empty($data_richiesta)) {
                                        ?>
                                        <div class="col-md-3 col-sm-3">
                                            <button class="btn profile-edit-btn"  onclick="location.href='../backend/request_friendship-exe.php?utente=<?php echo $user ?>'">Invia Richiesta</button>
                                        </div>
                                        <?php } elseif ((!empty($data_richiesta)) && (empty($data_accettazione))) { ?>
                                        <div class="col-md-3 col-sm-3">
                                            <button class="btn profile-edit-btn" >Richiesta Inviata</button>
                                        </div>
                                        <?php } else {?>
                                        <div class="col-md-3 col-sm-3">
                                            <button class="btn profile-edit-btn" >Unfollow</button>
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
    
</html>