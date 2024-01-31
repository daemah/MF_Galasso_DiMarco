<!DOCTYPE html>
<html lang="en">
<?php
session_start();
include_once "../common/connection.php";
include_once "../common/funzioni.php";
$email = $_SESSION["email"];
$richieste = leggiRichieste($cid, $email);
if(isset($_SESSION['email'])){
?>
<link href="../styles/request.css" rel="stylesheet">
<?php require "../common/header.php";?>
<body>
<?php require "../common/navbar.php"?>   
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
   <?php foreach ($richieste as $richiesta){?>
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <div class="people-nearby">
                        
                            <div class="nearby-user">
                                <div class="row">
                                    <div class="col-md-2 col-sm-2">
                                    <?php if (empty(getFotoProfilo($cid, $richiesta))){?>
                                        <img src="../images/profilo.jpeg" alt="user" class="profile-photo-lg">
                                    <?php } else { ?>
                                        <img src=<?php echo(getFotoProfilo($cid, $richiesta));?>alt="user" class="profile-photo-lg">
                                    <?php } ?>
                                    </div>
                                   
                                    <div class="col-md-7 col-sm-7">
                                        <h5><a href="profile.php?utente=<?php echo $richiesta ?>" class="profile-link"><?php echo getNickname($cid, $richiesta); ?></a></h5>
                                    </div>
                                    <?php
                                        $sql = "SELECT data_accettazione, data_richiesta FROM chiede_amicizia WHERE utente_ricevente = '$email' and utente_richiedente = '$richiesta';";
                                        $res=$cid->query($sql);
                                        $row = $res->fetch_assoc();
                                        $data_accettazione = $row["data_accettazione"];
                                        $data_richiesta = $row["data_richiesta"];
                                        
                                        if (empty($data_accettazione)){
                                        ?>
                                        <div class="col-md-3 col-sm-3">
                                            <button class="btn profile-edit-btn"  onclick="location.href='../backend/acceptRequest-exe.php?utente=<?php echo $richiesta ?>'" >Accetta Richiesta</button>
                                        </div>
                                        <?php } else { ?>
                                        <div class="col-md-3 col-sm-3">
                                            <button class="btn profile-edit-btn" >Richiesta Accettata</button>
                                        </div>
                                        <?php }?>

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