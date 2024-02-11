<!DOCTYPE html>
<html lang="en">
 
<?php
session_start();
include_once "../common/connection.php";
include_once "../common/funzioni.php";
$email = $_SESSION["email"];
if(isset($_SESSION['email'])){

?>
<?php require "../common/header.php"?> 
<body>

<link rel = "stylesheet" href= "../styles/updateprofile.css" >

<button type="button" class="cancelbtn" onclick="location.href='profile.php?utente=<?php echo $email ?>'">X</button>
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
<div class="content">
<div class="row">
		<div class="col-12">
			
			<div class="my-5">
				<h3>My Profile</h3>
			</div>		
			<form  method="POST" action="../backend/updateprofile-exe.php" autocomplete="off">
				<script src="../js/places.js"></script>
				<div class="row mb-5 gx-5">
					
					<div class="col-xxl-8 mb-5 mb-xxl-0">
						<div class="bg-secondary-soft px-4 py-5 rounded">
							<div class="row g-3">
								<h4 class="mb-4 mt-0">Contact detail</h4>

								
								<div class="col-md-6">
									<label class="form-label">Nickname *</label>
									<input type="text" class="form-control" value = "<?php $nickname = getNickname($cid,$email); if ($nickname != null){print_r($nickname);}?>" placeholder= "<?php if ($nickname == null){ echo 'insert nickname';}?>" name="nickname">
								</div>

							
								<div class="col-md-6">
									<label class="form-label">First Name </label>
							 		<input type="text" class="form-control" value = "<?php $nome = getNome($cid,$email); if ($nome != null){ print_r($nome);}?>" placeholder= "<?php if ($nome == null){ echo 'insert name';}?>" name="name">	
								</div>
							
								<div class="col-md-6">
									<label class="form-label">Last Name </label>
									<input type="text" class="form-control" value= "<?php $cognome = getCognome($cid,$email); if ($cognome != null){ print_r($cognome);}?>" placeholder= "<?php if ($cognome == null){ echo 'insert last name';}?>" name="lname">
								</div>
							
								<div class="col-md-6">
									<label class="form-label">Sex </label>
									<select id="sex" class="form-control" name="sex">
										<option value="" <?php $sex = getSesso($cid,$email); if(empty($sex)){ echo "selected";}?> >---</option>
										<option value="m" <?php $sex = getSesso($cid,$email); if($sex == "m"){ echo "selected";}?> >male</option>
										<option value="f" <?php $sex = getSesso($cid,$email); if($sex == "f"){ echo "selected";}?> >female</option>
										<option value="n" <?php $sex = getSesso($cid,$email); if($sex == "n"){ echo "selected";}?> >other</option>
									</select>
							
								</div>
								
								<div class="col-md-6">
									<label class="form-label">Birthday</label>
									<input type="date" class="form-control" value="<?php $dateb = getDataNascita($cid,$email); if (!empty($dateb)){ print_r($dateb);}?>" placeholder= "<?php if (empty($dateb)){ echo null;}?>" name="dateb">
								</div>

								<div class="autocomplete">
									<label class="form-label">State of birth</label>
									<input id="CountryBir" type="text" name="countrybir" value="<?php $countryb = getStatoNascita($cid,$email); if (!empty($countryb)){ print_r($countryb);}?>" placeholder="Country of birth">
								</div>

								<div class="autocomplete">
									<label class="form-label">Region of birth</label>
									<input id="RegionBir" type="text" name="regionbir" value="<?php $regionb = getRegioneNascita($cid,$email); if (!empty($regionb)){ print_r($regionb);}?>" placeholder="Region of birth">
								</div>

								<div class="autocomplete">
									<label class="form-label">City of birth </label>
									<input id="CityBir" type="text" name="citybir" value="<?php $cityb = getCittaNascita($cid,$email); if (!empty($cityb)){ print_r($cityb);}?>" placeholder="City of birth">
								</div>

								<div class="autocomplete">
									<label class="form-label">Country of residence</label>
									<input id="CountryRes" type="text" name="countryres" value="<?php $countryr = getStatoResidenza($cid,$email); if (!empty($countryr)){ print_r($countryr);}?>" placeholder="Country of residence">
								</div>

								<div class="autocomplete">
									<label class="form-label">Region of residence</label>
									<input id="RegionRes" type="text" name="regionres"  value="<?php $regionr = getRegioneResidenza($cid,$email); if (!empty($regionr)){ print_r($regionr);}?>" placeholder="Region of residence">
								</div>

								<div class="autocomplete">
									<label class="form-label">City of residence </label>
									<input id="CityRes" type="text" name="cityres"  value="<?php $cityr = getCittaResidenza($cid,$email); if (!empty($cityr)){ print_r($cityr);}?>" placeholder="City of residence">
								</div>
								
				

							</div> 
						</div>
					</div>
				
								<div class="gap-3 d-md-flex justify-content-md-end text-center">
									<button type="submit" class="btn btn-primary btn-lg" >Update profile</button>
								</div>
							</div>
						</div>
					</div>
				</div>
		
				
			</form>

			<!--
			<form  method="post" action="../backend/uploadfile-exe2.php" enctype="multipart/form-data">
								<div class="col-md-6">
									Profile photo
									<input type="file" class="form-control" name="ImageToUpload" id="ImageToUpload" >
									<input type="submit" class="form-control" value="Submit" name="submit">
								</div>
			</form> -->
				

		</div>
	</div>
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