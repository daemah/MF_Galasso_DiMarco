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
<div class="text-center text-sm-right">
    <div class="text-muted"><small>All is art ©</small></div>
</div>
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
                            
                                        <img src="<?php echo(getFotoProfilo($cid, $richiesta));?>" alt="user" class="profile-photo-lg">
                               
                                    </div>
                                   
                                    <div class="col-md-7 col-sm-7">
                                        <h5><button type="button"  class="goToProfile" onclick="location.href='profile.php?utente=<?php echo $richiesta ?>'"> <?php echo(getNickname($cid, $richiesta));?></button></h5>
                                    </div>
                                    <?php
                                        $data_accettazione = getDataAccettazione($cid, $email, $richiesta);    
                                        if (empty($data_accettazione)){
                                        ?>
                                        <div class="col-md-3 col-sm-3">
                                            <button class="btn post-edit-btn"  onclick="location.href='../backend/acceptRequest-exe.php?utente=<?php echo $richiesta ?>'" >Accept request</button>
                                        </div>
                                        <?php } else { ?>
                                        <div class="col-md-3 col-sm-3">
                                            <button class="btn post-edit-btn" onclick="location.href='../backend/deleteAccettazione-exe.php?utente=<?php echo $richiesta ?>'" >Request accepted</button>
                                            <div class="text-muted small"><?php echo "Request accepted on: ", $data_accettazione ?></div>
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