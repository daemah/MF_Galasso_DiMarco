<!DOCTYPE html>
<html lang="en">
    <?php require "../common/header.php"?>
    <body>
        
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
         <?php if (isset($_GET["status"]))
                {
                    if ($_GET["status"]=='ok')
                    {
                        echo "<div class='alert-success'>\n";
                        echo $_GET["msg"];
                        echo "</div>";
                    }
                      
                    }?>
        <br>
        
            <link rel="stylesheet" href="../styles/login.css">
            <button type="button" class="cancelbtn" onclick="location.href='../index.php'">X</button>
            <form method="POST" action="../backend/login-exe.php">
                <h2> Login here <h2>
                <div class="container">
                    <input type="text" placeholder="Enter Email" name="email">
                    <input type="password" placeholder="Enter Password" name="pass">
                    <button id = "login" type="submit">Login</button>
                    <!--Remember me: <input type="checkbox" id = "remember" name="rememberme"> 
                    <span class="pass">Forgot <a href="#">password?</a></span>
                    <div class="login-help">-->
                        <a href="signin.php">Registrazione</a> 
                    </div>
                </div>
            </form>
            <?php require "../common/footer.php";?> 
        </div>
    </body>

</html>
