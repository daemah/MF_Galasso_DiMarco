
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

                    </div>

                    <div class="profile-stats">

                        <ul id = "ul_profile">
                            <li id = "li-profile"><span class="profile-stat-count"><?php echo(count(getCodiceFoto($cid, $email)) + count(getCodiceTesto($cid, $email))); ?></span> posts</li>
                            <li id = "li-profile"><a href='users.php?utente=<?php echo $email ?>&page=followers'><?php echo count(getFollowers($cid, $email)); ?></a> followers</li>
                            <li id = "li-profile"><a href='users.php?utente=<?php echo $email ?>&page=following'><?php echo count(getFollowing($cid, $email)); ?></a> following</li>
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
                                <strong>12</strong> <small class="align-middle">Comments</small>
                            <p>
                            <?php echo getDescrizioneFoto($cid, $codice); ?>
                            </p>
                            <div class="text-muted small"><?php echo "il giorno ", getTimeFoto($cid, $codice); ?></div>
                        </div>
                    <?php } ?>
                    </div>

                <div class="gallery-item" tabindex="0">
                <?php $codici_t = getCodiceTesto($cid, $email); foreach($codici_t as $codice_t){ ?>
                <p id = "messaggio_testo"><?php echo getTesto($cid, $codice_t);?></p>

                        <div class="card-footer">
                                <strong>12</strong> <small class="align-middle">Comments</small>
                                <div class="text-muted small"><?php echo "il giorno  ", getTimeTesto($cid, $codice_t); ?></div>
                        </div>
                        
                <?php } ?>
                
                </div>
                <!-- End of gallery -->
                </div>
                   
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
                        $sql = "SELECT data_accettazione, data_richiesta FROM chiede_amicizia WHERE utente_ricevente = '$utente' and utente_richiedente = '$email';";
                        $res=$cid->query($sql);
                        $row = $res->fetch_assoc();
                        $data_accettazione = $row["data_accettazione"];
                        $data_richiesta = $row["data_richiesta"];
                        
                        if (empty($data_richiesta)){
                        ?>
                            <button class="btn profile-edit-btn"  onclick="location.href='../backend/request_friendship-exe.php?utente=<?php echo $utente ?>'">Invia Richiesta</button>
                        <?php } elseif ((!empty($data_richiesta)) && (empty($data_accettazione))) { ?>
                            <button class="btn profile-edit-btn">Richiesta Inviata</button>
                        <?php } else {?>
                            <button class="btn profile-edit-btn"  onclick="location.href='../backend/unfollow-exe.php?utente=<?php echo $utente ?>'">Unfollow</button>
                        <?php }?>
                    </div>

                    <div class="profile-stats">

                        <ul id = "ul_profile">
                            <li id = "li-profile"><span class="profile-stat-count"><?php echo(count(getCodiceFoto($cid, $utente)) + count(getCodiceTesto($cid, $utente))); ?></span> posts</li>
                            <li id = "li-profile"><a href='users.php?utente=<?php echo $utente ?>&page=followers'><?php echo count(getFollowers($cid, $utente)); ?></a> followers</li>
                            <li id = "li-profile"><a href='users.php?utente=<?php echo $utente ?>&page=following'><?php echo count(getFollowing($cid, $utente)); ?></a> following</li>
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
                                <strong>12</strong> <small class="align-middle">Comments</small>
                            <p>
                            <?php echo getDescrizioneFoto($cid, $codice); ?>
                            </p>
                            <div class="text-muted small"><?php echo "il giorno ", getTimeFoto($cid, $codice); ?></div>
                        </div>
                    </div>
                    <?php } ?>
                <div class="gallery-item" tabindex="0">
                <?php $codici_t = getCodiceTesto($cid, $utente); foreach($codici_t as $codice_t){ ?>
                <p id = "messaggio_testo"><?php echo getTesto($cid, $codice_t);?></p>

                        <div class="card-footer">
                                <strong>12</strong> <small class="align-middle">Comments</small>
                            <div class="text-muted small"><?php echo "il giorno ", getTimeTesto($cid, $codice_t); ?></div>
                        </div>
                </div>
                <?php } ?>
                </div>
                </div>
                <!-- End of gallery -->                
            </div>
        <?php } ?>
        <?php require "../common/footer.php"?> 
        </body>
    <?php
    }
    else{
        header("location:../index.php");
    }
    ?>
    </html>