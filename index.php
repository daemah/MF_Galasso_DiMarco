<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="stylesheet" href="styles/common.css">
        <link href="styles/indice.css" rel="stylesheet">

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Mini Facebook">
        <meta name="author" content="Carmilla Galasso e Filippo Di Marco">
        <title>All is Art</title>
        
    </head>
    <body>
        
        <link rel="stylesheet" href="styles/navbar.css">
        <nav class="side-nav">
            <ul>
                <!--LOGO-->
                <li id="logo">
                    <img src="images/gioconda.jpeg" class="avatar-logo" alt="Avatar">
                    <div id = "text-logo"><text id = "text" font-style="lighter">All is Art</text></div>
                </li>

                <!--LOGOUT-->
                <?php if (isset($_SESSION["logged"])) {
                    $email = $_SESSION["email"];?>
                    <div> 
                        <button type="button" id = "login" onclick="location.href='backend/logout-exe.php'"> Logout </button>
                    </div>
                    <!--PROFILE-->
                    <li id="profile">
                        <a  href="profile.php?utente=<?php echo $email ?>"> 
                            <?php if (empty(getFotoProfilo($cid, $email))){?>
                                <img src="images/profilo.jpeg"class="avatar" alt="Avatar">
                            <?php } else { ?>
                            <img src=<?php echo(getFotoProfilo($cid, $email));?>class="avatar" alt="Avatar">
                            <?php } ?>
                        </a>
                    </li>
                    <!--HOME-->
                    <li id="home">
                        <a class="nav-link" href="post.php"  >
                            <img src="images/home.png" class="avatar" alt="Avatar">
                        </a>
                    </li>

                    <!--SEARCH-->
                    <li id="home">
                        <a class="nav-link" href="search.php"  >
                            <img src="images/search.png" class="avatar" alt="Avatar">
                        </a>
                    </li>

                    <!--NOTIFICATION-->
                    <li id="home">
                        <a class="nav-link" href="notifications.php"  >
                            <img src="images/notifications.jpeg" class="avatar" alt="Avatar">
                        </a>
                    </li>

                <?php } else { ?> 
                <!--LOGIN-->
                <li>
                    <div> 
                        <button type="button" id = "login" onclick="location.href='frontend/login.php'"> Login </button>
                    </div>
                </li>
                <!--SIGN IN-->    
                <li>
                    <div> 
                        <button type="button" id = "signin" onclick="location.href='frontend/signin.php'"> Sign in </button>
                    </div>
                </li>
                <?php } ?>
            </ul>
        </nav>

            <div class = "content">
            <?php
            if (!isset($_SESSION["logged"]))
            { ?>
             <h2> Wellcome in All is Art, a social where you can post all you think is art, also thoughts :) ➔
             Authenticate to enjoy the services! </h2>
            <?php
            } else {
                if (isset($_GET["op"]))
                {
                    echo "<div class='well'>\n";
                    include "frontend/" . $_GET["op"] . ".php";
                    echo "</div>"; 
                }
            }
                    
            ?>
            <?php require "common/footer.php";?>
            </div> 
              
            
    </body>

</html>