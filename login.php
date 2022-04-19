<?php

// Copied and modified from https://www.tutorialrepublic.com/php-tutorial/php-mysql-login-system.php

//Use references
use securicore_codec\php\Models\{Database};

// Initialize the session
session_start(); 

// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: userinfo.php");
    exit;
}
 
// Include config file
require_once './php/Models/Database.php';
 
// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = $login_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    $pdo= Database::getDb();
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT user_id, username, password FROM users WHERE username = :username";
        
        
        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Check if username exists, if yes then verify password
                if($stmt->rowCount() == 1){
                    if($row = $stmt->fetch()){
                        $id = $row->user_id;
                        $username = $row->username;
                        $hashed_password = $row->password;
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["user_id"] = $id;
                            $_SESSION["username"] = $username;                            
                            
                            // Redirect user to welcome page
                            header("location: userinfo.php");
                        } else{
                            // Password is not valid, display a generic error message
                            $login_err = "Invalid username or password.";
                        }
                    }
                } else{
                    // Username doesn't exist, display a generic error message
                    $login_err = "Invalid username or password.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
            // Close statement
            unset($stmt);
        }
    }    
    // Close connection
    unset($pdo);
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Securicore - Code Challenge</title>
        <meta name="description" content="Login" />
        <meta name="viewport" content="width=device-width">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href=css/style.css>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
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
            <div class="logo"> <img src="img/icon.jpg" width="460" height="460" alt=""> </div>
            <div class="text-center mt-4 name"> Login </div>
            <div class="icons">
                <div class="icon"> <img src="https://www.freepnglogos.com/uploads/facebook-logo-28.png" width="200" alt="facebook icon brand logo png" /></div>
                <div class="icon"> <img src="https://www.freepnglogos.com/uploads/google-logo-png/google-logo-vector-graphic-pixabay-15.png" width="200" alt="google logo vector graphic pixabay" alt=""> </div>
                <div class="icon"> <img src="https://www.freepnglogos.com/uploads/twitter-logo-png/twitter-bird-symbols-png-logo-0.png" alt=""> </div>
                <div class="icon"> <img src="https://www.freepnglogos.com/uploads/512x512-logo/512x512-transparent-logo-github-logo-24.png" width="200" alt="512x512 transparent logo, github logo" alt=""> </div>
            </div>
            <!-- Message for errors (login process) -->
            <?php 
            if(!empty($login_err)){
                echo '<div class="alert alert-danger">' . $login_err . '</div>';
            }        
            ?>
            <!-- Login Form - fields(username, password) -->
            <form class="p-3 mt-3" id="loginform" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="form-field d-flex align-items-center"> <span class="far fa-user"></span> 
                    <input type="text" name="username" id="userName" placeholder="Username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                    <span class="invalid-feedback"><?php echo $username_err; ?></span> 
                </div>
                <div class="form-field d-flex align-items-center"> <span class="fas fa-key"></span> 
                    <input type="password" name="password" id="pwd" placeholder="Password" class="form-control<?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                    <span class="invalid-feedback"><?php echo $password_err; ?></span>
                </div> 
                <button class="btn mt-3">Sign In</button>
                <div class="text-center fs-6" style="padding:20px;"><a href="signup.php">Sign up</a> </div>
            </form>		
        </div>
    </body>
</html>
<!-- Code bootstrap from https://bbbootstrap.com/snippets/bootstrap-5-login-form-using-neomorphism-89456141
Modified by Barbara Cam -->