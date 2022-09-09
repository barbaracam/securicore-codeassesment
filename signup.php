<?php

// Include config file, Include Statements
use securicore_codec\php\Models\{Database, user};
require_once './php/Models/Database.php';
require_once './php/Models/user.php';

//Get Database, Initiate new class
$db = Database::getDb();
$u = new user();
$username ='';
$password='';

//Add  New Users
if(isset($_POST['register'])){    
    $username = $_POST['username'];
    $password = $_POST['password'];  
	// $hashed_password = password_hash($password , PASSWORD_DEFAULT); 
	$hashed_password = password_hash($password , PASSWORD_DEFAULT); 
	//Function call to database
    $b = $u->addUser($username, $hashed_password, $db);
    if($b){
    	header("Location: login.php");
        exit;
    } else {
        echo "problem adding information";
    }    
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Securicore - Code Challenge</title>
		<meta name="description" content="SignUp" />
		<meta name="viewport" content="width=device-width">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
		<link rel="stylesheet" type="text/css" href=css/style.css>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
		<meta name="viewport" content="width=device-width, initial-scale=1">	
		<!-- <script src="js/jquery-3.5.1.js"></script> -->
		<!-- Load Jquery -->
		<script
		src="https://code.jquery.com/jquery-3.6.0.min.js"
		integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
		crossorigin="anonymous"
		></script>
		<!-- Load Jquery validation -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"
		integrity="sha512-37T7leoNS06R80c8Ulq7cdCDU5MNQBwlYoy1TX/WUsLFC2eYNqtKlV0QjH7r8JpG/S0GUMZwebnVFLPd6SU5yg=="
		crossorigin="anonymous"></script>	
		<script src="js/script.js" async defer></script>
	</head>
	<body>
		<div class="wrapper">		
			<div class="logo"><img src="img/reg.png" width="460" height="460" alt=""></div>
			<div class="text-center mt-4 name"> Registration </div>
			<!-- Form with the fields required for signing up (name and password) -->
			<form class="p-3 mt-3" id="signupform" action="" method="post">
				<div class="form-field d-flex align-items-center"> <span class="far fa-user"></span> 
					<input type="text" name="username" id="username" placeholder="Username" class="form-control">                
				</div>
				<div class="form-field d-flex align-items-center"> <span class="fas fa-key"></span> 
					<input type="password" name="password" id="pwd" placeholder="Password" class="form-control">                
				</div> 
				<button class="btn mt-3" name="register">Sign Up</button>            
			</form>		
		</div>
	</body>
</html>
<!-- Code bootstrap from https://bbbootstrap.com/snippets/bootstrap-5-login-form-using-neomorphism-89456141
Modified by Barbara Cam -->