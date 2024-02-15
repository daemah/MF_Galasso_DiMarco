<?php 
include_once "connection.php";
include_once "funzioni.php";
?>

<link rel="stylesheet" href="../styles/navbar.css">
<script src="../js/myscript.js"> </script>
<nav class="side-nav">
    <ul>
         <!--LOGO-->
        <li id="logo">
            <img src="../images/gioconda.jpeg" class="avatar-logo" alt="Avatar">
            <div id = "text-logo"><text id = "text" font-style="lighter">All is Art</text></div>
        </li>

        <!--LOGOUT-->
        <?php $email = $_SESSION["email"];
        if (isset($_SESSION["logged"]) & getAdmin($cid, $email) == 0) {
            ?>
            <div> 
                <button type="button" id = "login" onclick=" logOutConfirm()"> Logout </button>
            </div>
            <!--PROFILE-->
            <li id="profile">
                <a  href="profile.php?utente=<?php echo $email ?>"> 
                    <?php if (empty(getFotoProfilo($cid, $email))){?>
                        <img src="../images/profilo.jpeg"class="avatar" alt="Avatar">
                    <?php } else { ?>
                    <img src=<?php echo(getFotoProfilo($cid, $email));?>class="avatar" alt="Avatar">
                    <?php } ?>
                </a>
            </li>
            <!--HOME-->
            <li id="home">
                <a class="nav-link" href="post.php"  >
                    <img src="../images/home.png" class="avatar" alt="Avatar">
                </a>
            </li>

            <!--SEARCH-->
            <li id="home">
                <a class="nav-link" href="search.php"  >
                    <img src="../images/search.png" class="avatar" alt="Avatar">
                </a>
            </li>

            <!--NOTIFICATION-->
            <li id="home">
                <a class="nav-link" href="notifications.php"  >
                    <img src="../images/notifications.jpeg" class="avatar" alt="Avatar">
                    <span id="notificationCount"> </span>
                    
                </a>
            </li>
            <?php } elseif (isset($_SESSION["logged"]) & getAdmin($cid, $email) != 0){ ?>

                <div> 
                <button type="button" id = "login" onclick=" logOutConfirm()"> Logout </button>
            </div>
            <!--PROFILE-->
            <li id="profile">
                <a  href="profile.php?utente=<?php echo $email ?>"> 
                    <?php if (empty(getFotoProfilo($cid, $email))){?>
                        <img src="../images/profilo.jpeg"class="avatar" alt="Avatar">
                    <?php } else { ?>
                    <img src=<?php echo(getFotoProfilo($cid, $email));?>class="avatar" alt="Avatar">
                    <?php } ?>
                </a>
            </li>
            <!--HOME-->
            <li id="home">
                <a class="nav-link" href="post.php"  >
                    <img src="../images/home.png" class="avatar" alt="Avatar">
                </a>
            </li>

            <!--SEARCH-->
            <li id="home">
                <a class="nav-link" href="search.php"  >
                    <img src="../images/search.png" class="avatar" alt="Avatar">
                </a>
            </li>

            <!--NOTIFICATION-->
            <li id="home">
                <a class="nav-link" href="notifications.php"  >
                    <img src="../images/notifications.jpeg" class="avatar" alt="Avatar">
                    <span id="notificationCount"> </span>
                    
                </a>
            </li>

            <!--STATISTICS-->
            <li id="home">
                <a class="nav-link" href="statistics.php"  >
                <script> updateNotificationCount(); </script>
                    <img src="../images/statistics.png" class="avatar" alt="Avatar">
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
