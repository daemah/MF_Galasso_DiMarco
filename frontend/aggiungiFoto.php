<!DOCTYPE html>
<html lang="en">
    <?php
    session_start(); 
    include_once "../common/connection.php";
    include_once "../common/funzioni.php";
    require "../common/header.php";
    $email = $_SESSION["email"];
    if(isset($_SESSION['email'])){
    /* sdfsdhgghgggsf */ 
    ?>


        <body>
        <link rel='stylesheet' href='../styles/aggiungiFoto.css' >
        <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@4.1.1/dist/css/bootstrap.min.css'>
        <script src="../js/myscript.js"></script>
        <script src="../js/places.js"></script>
        <button type="button" class="cancelbtn" onclick="location.href='profile.php?utente=<?php echo $email?>'; ">X</button>
        <div class = "content">
        <article id="main-content" role="main">  
            <section class="container">
            <div class="text-center text-sm-right">
                    <div class="text-muted"><small>All is art ©</small></div>
                  </div>
                        <div class="row">
                            <div class="col">
                              <div class="form-group">
                                <label>Sate</label>
                                <input class="form-control" id="CountryBir" type="text" name="countrybir" placeholder="Country">
                              </div>
                              
                            </div>
                            <div class="col">
                              <div class="form-group">
                                <label>Region</label>
                                <input class="form-control" id="RegionBir" type="text" name="regionbir" placeholder="Region">
                              </div>
                            </div>
                            <div class="col">
                              <div class="form-group">
                                <label>City</label>
                                <input class="form-control" id="CityBir" type="text" name="citybir" placeholder="City">
                              </div>
                            </div>
                          </div>
                   
                    <p>&nbsp;</p>
                    <hr>
                    <h3 class="text-info">Insert an image</h3>
                    <div class="box">
                    <form  method="post" action="../backend/uploadfoto-exe.php" class="text-center" enctype="multipart/form-data">
                        <div class="margin-bottom-20"> 
                        <img src=<?php echo(getFotoRecente($cid, $email));?> class="avatar" alt="Avatar">
                        </div>
                   
                    

                        <div class="row">
                            <div class="col-sm-10">
                            <span class="control-fileupload">
                                <label for="file1" class="text-left">Please choose a file on your computer.</label>
                                <input type="file" class="form-control" name="ImageToUpload" id="ImageToUpload" >
                            </span>
                            </div>
                            <div class="col-sm-2">  
                            <input type="submit" class="form-control" value="Submit" name="submit">
                            </div>
                        </div>
                        </div>
                    </form>
                        <span>
                            <label >Insert a description:</label>
                            <input class="form-control" type="text" id="descriptionInput">
                        </span>
                        
                            <button type="button" class="btn btn-primary btn-block">
                                <i class="icon-upload icon-white"></i> Post 
                            </button>
                       
                        <hr>
                        </div>
                        </div>
                    </section>
                    </article>
        </div>
        
        <?php require "../common/footer.php"?>   
    </body>
    <?php
    }
    else{
        header("location:../index.php");
    }
    ?>
</html>