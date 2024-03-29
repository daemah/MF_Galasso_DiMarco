<!DOCTYPE html>
<html lang="en">
<?php
session_start();
include_once "../common/connection.php";
include_once "../common/funzioni.php";
require "../common/header.php";
$email = $_SESSION["email"];
$utenti = getUtenti($cid, $email);
if(isset($_SESSION['email'])){
?>
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
            <h2> Search for your future friends:</h2>
            <div>
                <form class="modulo-ricerca">
                    <input id="search" type="text" placeholder="look for a friend" onkeyup="search_profile();" required>
                </form>
            </div>  
            <div>
                <form class="modulo-ricerca">
                    <p> Search for a friend based on:</p>
                    <button class = "btn post-edit-btn" type="button" id = "ricerca1" onclick = "sameHobbies();" style="background-color:white;"> hobbies </button>
                    <button class = "btn post-edit-btn" type="button" id = "ricerca2" onclick = "sameCityBir(); " style="background-color:white;"> city ​​of birth </button>
                    <button class = "btn post-edit-btn" type="button" id = "ricerca3" onclick = "sameCityRes(); " style="background-color:white;"> city ​​of residence </button>
                </form>
            </div>
            <link href="../styles/request.css" rel="stylesheet">

    <?php foreach ($utenti as $utente){?>
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="people-nearby" >
                    
                        <div class="nearby-user" >
                            <div class="row" >
                                <div class="col-md-2 col-sm-2" >
                            
                                    <img src="<?php echo(getFotoProfilo($cid, $utente));?>" alt="user" class="profile-photo-lg">
                                
                                </div>
                               
                                <div class="col-md-7 col-sm-7" >
                                    <p id ="nickname" class="goToProfile"  > <button   type="button" class="goToProfile" onclick="location.href='profile.php?utente=<?php echo $utente ?>'"> <?php echo(getNickname($cid, $utente));?></button></p>
                                </div>

                                <?php
                            
                                $data_accettazione = getDataAccettazione($cid, $utente, $email);
                                $data_richiesta = getDataRichiesta($cid, $utente, $email);

                                if ($data_richiesta==0) {
                                ?>
                                <div class="col-md-3 col-sm-3">
                                    <button class="btn post-edit-btn"  onclick="location.href='../backend/request_friendshipDaSearch.php?utente=<?php echo $utente ?>'">Send request</button>
                                </div>
                                <?php } elseif (($data_richiesta!=0) && ($data_accettazione==0)) { ?>
                                <div class="col-md-3 col-sm-3">
                                    <button class="btn post-edit-btn" onclick="location.href='../backend/eliminateRequest-exe.php?utente=<?php echo $utente ?>'">Request sent</button>
                                    <div class="text-muted small"><?php echo "Request sent on: ", $data_richiesta ?></div>
                                </div>
                                <?php } else {?>
                                <div class="col-md-3 col-sm-3">
                                    <button class="btn post-edit-btn" onclick="location.href='../backend/unfollowDaSearch.php?utente=<?php echo $utente ?>'">Unfollow</button>
                                    <div class="text-muted small"><?php echo "Request sent on: ", $data_richiesta, " and accepted on: ", $data_accettazione ?></div>
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