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
<div class="container">
<div class="row">
		<div class="col-12">
			<!-- Page title -->
			<div class="my-5">
				<h3>My Profile</h3>
			</div>
			<!-- Form START -->
			<form class="file-upload" method="POST" action="../backend/updateprofile-exe.php">
				<div class="row mb-5 gx-5">
					<!-- Contact detail -->
					<div class="col-xxl-8 mb-5 mb-xxl-0">
						<div class="bg-secondary-soft px-4 py-5 rounded">
							<div class="row g-3">
								<h4 class="mb-4 mt-0">Contact detail</h4>

								<!-- Nickname -->
								<div class="col-md-6">
									<label class="form-label">Nickname *</label>
									<input type="text" class="form-control" value = "<?php $nickname = getNickname($cid,$email); if ($nickname != null){print_r($nickname);}?>" placeholder= "<?php if ($nickname == null){ echo 'insert nickname';}?>" name="nickname">
								</div>

								<!-- First Name -->
								<div class="col-md-6">
									<label class="form-label">First Name </label>
							 		<input type="text" class="form-control" value = "<?php $nome = getNome($cid,$email); if ($nome != null){ print_r($nome);}?>" placeholder= "<?php if ($nome == null){ echo 'insert name';}?>" name="name">	
								</div>
								<!-- Last name -->
								<div class="col-md-6">
									<label class="form-label">Last Name </label>
									<input type="text" class="form-control" value= "<?php $cognome = getCognome($cid,$email); if ($cognome != null){ print_r($cognome);}?>" placeholder= "<?php if ($cognome == null){ echo 'insert last name';}?>" name="lname">
								</div>
								<!-- Sex -->
								<div class="col-md-6">
									<label class="form-label">Sex </label>
									<select id="sex" class="form-control" name="sex">
										<option value="" <?php $sex = getSesso($cid,$email); if(empty($sex)){ echo "selected";}?> >---</option>
										<option value="m" <?php $sex = getSesso($cid,$email); if($sex == "m"){ echo "selected";}?> >male</option>
										<option value="f" <?php $sex = getSesso($cid,$email); if($sex == "f"){ echo "selected";}?> >female</option>
										<option value="n" <?php $sex = getSesso($cid,$email); if($sex == "n"){ echo "selected";}?> >other</option>
									</select>
							
								</div>
								<!-- Birthday -->
								<div class="col-md-6">
									<label class="form-label">Birthday</label>
									<input type="date" class="form-control" value="<?php $dateb = getDataNascita($cid,$email); if (!empty($dateb)){ print_r($dateb);}?>" placeholder= "<?php if (empty($dateb)){ echo null;}?>" name="dateb">
								</div>
								
						
							</div> <!-- Row END -->
						</div>
					</div>
				
								<div class="gap-3 d-md-flex justify-content-md-end text-center">
									<button type="submit" class="btn btn-primary btn-lg" >Update profile</button>
								</div>
							</div>
						</div>
					</div>
				</div> <!-- Row END -->
				<!-- button -->
				
			</form> <!-- Form END -->
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