
<!DOCTYPE html>
<html lang="en">
<?php require "../common/header.php"?>  
    <?php
    session_start();
    include_once "../common/connection.php";
    include_once "../common/funzioni.php";
    if(isset($_SESSION['email'])){
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
    
    <button type="button" class="cancelbtn" onclick="location.href='profile.php?utente=<?php echo $utente?>'">X</button>


<link href="../styles/request.css" rel="stylesheet">
<body>



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

   <?php foreach ($users as $user){?>
            <div class="container">
              
                <div class="row">
                    <div class="col-md-8">
                        <div class="people-nearby">
                        
                            <div class="nearby-user">
                                <div class="row">
                                        <img src="<?php echo getFotoProfilo($cid, $user);?>" alt="user" class="profile-photo-lg">
                                   
                                    <div class="col-md-7 col-sm-7">
                                        <h5><button type="button"  class="goToProfile" onclick="location.href='profile.php?utente=<?php echo $user ?>'"> <?php echo(getNickname($cid, $user));?></button></h5>
                                    </div>
                                    
                                    <?php
                                        if ($user != $email){
                                            $data_richiesta = getDataRichiesta($cid, $user, $email);
                                            $data_accettazione = getDataAccettazione($cid, $user, $email);
                                            
                                            if ($data_richiesta==0) {
                                                ?>
                                                <div class="col-md-3 col-sm-3">
                                                    <button class="btn profile-edit-btn"  onclick="location.href='../backend/request_friendshipDaUsers.php?user=<?php echo $user ?>&utente=<?php echo $utente ?>&page=<?php echo $page ?>'">Invia Richiesta</button>
                                                </div>
                                                <?php } elseif (($data_richiesta!=0) && ($data_accettazione==0)) { ?>
                                                <div class="col-md-3 col-sm-3">
                                                    <button class="btn profile-edit-btn" onclick="location.href='../backend/eliminateRequestDaUsers.php?user=<?php echo $user ?>&utente=<?php echo $utente ?>&page=<?php echo $page ?>'">Richiesta Inviata</button>
                                                    <div class="text-muted small"><?php echo "Richiesta inviata il: ", $data_richiesta ?></div>
                                                </div>
                                                <?php } else {?>
                                                <div class="col-md-3 col-sm-3">
                                                    <button class="btn profile-edit-btn" onclick="location.href='../backend/unfollow-exe.php?utente=<?php echo $utente ?>'">Unfollow</button>
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