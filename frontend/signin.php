<!DOCTYPE html>
<html lang="en">
    <?php require "../common/header.php"?>
    <body>
    <div class="text-center text-sm-right">
        <div class="text-muted"><small>All is art ©</small></div>
    </div>
        <div class= "container" id = "login-container">
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
        <br>
        <button type="button" class="cancelbtn" onclick="location.href='../index.php'">X</button>
            <link rel="stylesheet" href="../styles/login.css">
            <form method="POST" action="../backend/signin-exe.php">
            <h2> Sign in here </h2>
            <div class="container">
                <input type="text" placeholder="Enter Email" name="email">
                <input type="password" placeholder="Enter Password" name="pass">
                <input type="nickname" placeholder="Enter Nickname" name="nickname">
                <button id = "login" type="submit">Sign in</button>
            </div>
            <h2> Usa una password di almeno 8 caratteri, contenente un numero e un carattere speciale </h2>
            </form>
        </div>
        <?php require "../common/footer.php";?> 
    </body>

</html>