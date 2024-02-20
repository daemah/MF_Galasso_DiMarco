<!DOCTYPE html>
<html lang="en">
 
<?php
session_start();
include_once "../common/connection.php";
include_once "../common/funzioni.php";

$email = $_SESSION["email"];
if(isset($_SESSION['email'])){

?>
<head>
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@4.1.1/dist/css/bootstrap.min.css'>
<link rel='stylesheet' href='../styles/updateprofile.css' >
<script src='https://cdn.jsdelivr.net/npm/bootstrap@4.1.1/dist/js/bootstrap.bundle.min.js'></script>
<script src="../js/places.js"></script>
</head>
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



<div class="container">

<div class="row flex-lg-nowrap">
  
  <div class="col">
    <div class="row">
      <div class="col mb-3">
        <div class="card">
          <div class="card-body">
          <div class="text-center text-sm-right">
                    <div class="text-muted"><small>All is art ©</small></div>
          </div>
          <button type="button" class="cancelbtn" onclick="location.href='profile.php?utente=<?php echo $email?>'">X</button>
            <div class="e-profile">
              <div class="row">
                <div class="col-12 col-sm-auto mb-3">
                  <div class="mx-auto" style="width: 140px;">
                    <div class="d-flex justify-content-center align-items-center rounded">
                      <img src=<?php echo(getFotoProfilo($cid, $email));?> class="avatar" alt="Avatar">
                    </div>
                  </div>
                </div>
            
                <div class="col d-flex flex-column flex-sm-row justify-content-between mb-3">
                  <div class="text-center text-sm-left mb-2 mb-sm-0">
                    <h4 class="pt-sm-2 pb-1 mb-0 text-nowrap"><?php $nickname = getNickname($cid,$email); if ($nickname != null){print_r($nickname);}?></h4>
                  
                  <form  method="post" action="../backend/uploadfile-exe.php" enctype="multipart/form-data">
                                  <div class="mt-2">
                                    Profile photo
                                    <input type="file" class="form-control" name="ImageToUpload" id="ImageToUpload" >
                                    <input type="submit" class="form-control" value="Submit" name="submit">
                                  </div>
                  </form> 
          <form  method="POST" action="../backend/updateprofile-exe.php" autocomplete="off">
                  </div>
                  
                </div>
              </div>
              <ul class="nav nav-tabs">
                <li class="nav-item"><a href="" class="active nav-link">Settings</a></li>
              </ul>
              <div class="tab-content pt-3">
                <div class="tab-pane active">
                  <form class="form" novalidate="">
                    <div class="row">
                      <div class="col">

                        <div class="row">
                            <div class="col">
                              <div class="form-group">
                                <label>Username</label>
                                <input type="text" class="form-control" value = "<?php $nickname = getNickname($cid,$email); if ($nickname != null){print_r($nickname);}?>" placeholder= "<?php if ($nickname == null){ echo 'insert nickname';}?>" name="nickname">
                              </div>
                            </div>
                          </div>

                        <div class="row">
                          <div class="col">
                            <div class="form-group">
                              <label>First name</label>
                              <input type="text" class="form-control" value = "<?php $nome = getNome($cid,$email); if ($nome != null){ print_r($nome);}?>" placeholder= "<?php if ($nome == null){ echo 'insert name';}?>" name="name">	
                            </div>
                          </div>
                          <div class="col">
                            <div class="form-group">
                              <label>Last Name</label>
                              <input type="text" class="form-control" value= "<?php $cognome = getCognome($cid,$email); if ($cognome != null){ print_r($cognome);}?>" placeholder= "<?php if ($cognome == null){ echo 'insert last name';}?>" name="lname">
                            </div>
                          </div>
                        </div>

                        <div class="row">
                            <div class="col">
                              <div class="form-group">
                                <label>Sex</label>
                                <select id="sex" class="form-control" name="sex">
                                  <option value="" <?php $sex = getSesso($cid,$email); if(empty($sex)){ echo "selected";}?> >---</option>
                                  <option value="m" <?php $sex = getSesso($cid,$email); if($sex == "m"){ echo "selected";}?> >male</option>
                                  <option value="f" <?php $sex = getSesso($cid,$email); if($sex == "f"){ echo "selected";}?> >female</option>
                                  <option value="n" <?php $sex = getSesso($cid,$email); if($sex == "n"){ echo "selected";}?> >other</option>
                                </select>
                              </div>
                            </div>
                            <div class="col">
                              <div class="form-group">
                                <label>Date of birthday</label>
                                <input type="date" class="form-control" value="<?php $dateb = getDataNascita($cid,$email); if (!empty($dateb)){ print_r($dateb);}?>" placeholder= "<?php if (empty($dateb)){ echo null;}?>" name="dateb">
                              </div>
                            </div>
                          </div>

                          <ul class="nav nav-tabs">
                            <li class="nav-item"><a href="" class="active nav-link">Address</a></li>
                          </ul>

                          <div class="row">
                            <div class="col">
                              <div class="form-group">
                                <label>Country of birth</label>
                                <input class="form-control" id="CountryBir" type="text" name="countrybir" value="<?php $countryb = getStatoNascita($cid,$email); if (!empty($countryb)){ print_r($countryb);}?>" placeholder="Country of birth">
                              </div>
                              
                            </div>
                            <div class="col">
                              <div class="form-group">
                                <label>Region of Birth</label>
                                <input class="form-control" id="RegionBir" type="text" name="regionbir" value="<?php $regionb = getRegioneNascita($cid,$email); if (!empty($regionb)){ print_r($regionb);}?>" placeholder="Region of birth">
                              </div>
                            </div>
                            <div class="col">
                              <div class="form-group">
                                <label>City of birth</label>
                                <input class="form-control" id="CityBir" type="text" name="citybir" value="<?php $cityb = getCittaNascita($cid,$email); if (!empty($cityb)){ print_r($cityb);}?>" placeholder="City of birth">
                              </div>
                            </div>
                          </div>

                   

                 

                          <div class="row">
                            <div class="col">
                              <div class="form-group">
                                <label>Country of residence</label>
                                <input class="form-control" id="CountryRes" type="text" name="countryres" value="<?php $countryr = getStatoResidenza($cid,$email); if (!empty($countryr)){ print_r($countryr);}?>" placeholder="Country of residence">
                              </div>
                            </div>
                            <div class="col">
                              <div class="form-group">
                                <label>Region of residence</label>
                                <input class="form-control" id="RegionRes" type="text" name="regionres"  value="<?php $regionr = getRegioneResidenza($cid,$email); if (!empty($regionr)){ print_r($regionr);}?>" placeholder="Region of residence">
                              </div>
                            </div>
                            <div class="col">
                              <div class="form-group">
                                <label>City of residence</label>
                                <input class="form-control"id="CityRes" type="text" name="cityres"  value="<?php $cityr = getCittaResidenza($cid,$email); if (!empty($cityr)){ print_r($cityr);}?>" placeholder="City of residence">
                              </div>
                            </div>
                          </div>


                          <ul class="nav nav-tabs">
                            <li class="nav-item"><a href="" class="active nav-link">Hobbies</a></li>
                          </ul>

                          <div class="row">
                            <div class="col">
                              <div class="form-group">
                                <label>Hobby</label>
                                <input class="form-control" id="Hobby" type="text" name="hobby" placeholder="Write your hobby">
                              </div>
                            </div>
                          </div>
                          <ul>
                          <?php $hobbies = getHaHobby($cid , $email); foreach($hobbies as $hobby){?>
                                    
                                <div class="row">
                                  <div class="col">
                                    <div class="form-group">
                                    <li class="list-group-item"><?php print_r($hobby); ?> </li>
                                    </div>
                                  </div>
                                  <div class="col">
                                    <div class="form-group">
                                    <button class="btn profile-edit-btn"  onclick="location.href='../backend/cancelhobby-exe.php?nome=<?php echo $hobby ?>'">Cancella</button>
                                    </div>
                                  </div>
                                </div>
                        
              
                            <?php } ?>
                          </ul>
  
                    
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-12 col-sm-6 mb-3">
                        <ul class="nav nav-tabs">
                            <li class="nav-item"><a href="" class="active nav-link">Change password</a></li>
                          </ul>
                        <div class="row">
                          <div class="col">
                            <div class="form-group">
                              <label>Current Password</label>
                              <input class="form-control" type="password" name='currentpw' placeholder="••••••">
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col">
                            <div class="form-group">
                              <label>New Password</label>
                              <input class="form-control" type="password" name='changepw1' placeholder="••••••">
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col">
                            <div class="form-group">
                              <label>Confirm <span class="d-none d-xl-inline">Password</span></label>
                              <input class="form-control" type="password" name='changepw2' placeholder="••••••"></div>
                          </div>
                        </div>
                      </div>
               
                    </div>
                    <div class="row">
                      <div class="col d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary btn-lg" >Update profile</button>
                      </div>
                    </div>
                  </form>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>
</div>
</form>

<?php
    }
    else{
        header("location:../index.php");
    }
    ?>
</html>