<!DOCTYPE html>
<html lang="en">
    <?php
    session_start(); 
    include_once "../common/connection.php";
    include_once "../common/funzioni.php";
    require "../common/header.php";
    $email = $_SESSION["email"];
    /* sdfsdhgghgggsf */ 
    ?>


        <body>
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
        <link rel='stylesheet' href='../styles/aggiungiTesto.css' >
        <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@4.1.1/dist/css/bootstrap.min.css'>
        <script src="../js/myscript.js"></script>
        <button type="button" class="cancelbtn" onclick="location.href='profile.php?utente=<?php echo $email?>'">X</button>
        <div class = "content">
        <article id="main-content" role="main">  
            <section class="container">
                  <div class="text-center text-sm-right">
                    <div class="text-muted"><small>All is art ©</small></div>
                  </div>
                    <p>&nbsp;</p>
                    <hr>
                    <h3 class="text-info">Insert a Text</h3>
                    <div class="box">
                    <div class="row">
                    <div class="col">
                    <div class="form-group">
                    <form  method="POST" action="../backend/insertText-exe.php" autocomplete="off">
                      <label>Text</label>
                      <textarea id= "testo" name="testo" rows="5" cols="40"  class='insertText' > </textarea> </div>
                      <button type="submit" class="btn btn-primary btn-block">
                        <i class="icon-upload icon-white"></i> Post 
                      </button>
                    </form>
                    </div>
                  </div>
                </section>
              </article>
        </div>
    </body>
</html>