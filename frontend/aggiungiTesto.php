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
        <link rel='stylesheet' href='../styles/aggiungiTesto.css' >
        <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@4.1.1/dist/css/bootstrap.min.css'>
        <script src="../js/myscript.js"></script>
        <button type="button" class="cancelbtn" onclick="location.href='profile.php?utente=<?php echo $email?>'">X</button>
        <div class = "content">
        <article id="main-content" role="main">  
            <section class="container">
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
                    <h3 class="text-info">Insert a Text</h3>
                    <div class="box">
                    <div class="row">
                    <div class="col">
                              <div class="form-group">
                                <label>Text</label>
                                <textarea name="testo" rows="5" cols="40"  class='insertText' >
                                </textarea>
                              </div>
                              <button type="button" class="btn btn-primary btn-block">
                                <i class="icon-upload icon-white"></i> Post 
                            </button>
                            </div>
                        </div>
                    </section>
                    </article>
        </div>
    </body>
</html>