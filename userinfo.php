<?php

//Get Session
session_start();

//Include Statements
use securicore_codec\php\Models\{Database, userInfo};
require_once 'vendor/autoload.php';
require_once './php/Models/Database.php';
require_once './php/Models/userInfo.php';

//Get Database
//Get list with all information
$db = Database::getDb();

//initiate new class
$i = new userInfo();

//Get the User Id
$user_id = $_SESSION["user_id"];
$infos = $i->getInfo($user_id, Database::getDb());

// add information
$uname = '';
$email = '';
$user ='';
$id ='';

//Post the required fields
if(isset($_POST['addInfo'])){    
    $uname = $_POST['uname'];
    $email = $_POST['email'];       
      // $db = Database::getDb(); 
      //Posted fields, added to database            
      $b = $i->addInfo($uname, $email, $user_id, $db);
      if($b){
        header("Location: userInfo.php");
        exit;
      } else {
        echo "problem adding information";
      }      
}

//delete information by userinfo_id
if(isset($_POST['deleteInfo'])){
    $id = $_POST['userInfo_id'];
    // $db = Database::getDb();    
    $c = $i->deleteInfo($id, $db);
    if($c){
        header("Location: userInfo.php");
        exit;
    }
    else {
        echo("Problem deleting information");
        return false;
    }  
}

// Update Info

//get information from database
if(isset($_POST['updateInfo'])){
    $id= $_POST['userInfo_id'];
      
    //get the information by the userinfo_id
      // $db = Database::getDb();      
      $up = $i->getUserInfoById($id, $db);        
      $uname = $up->uname;
      $userInfo_id2 = $up->userInfo_id;
      $email = $up->email;
  }

//update and change the information into the database
//Repost information

if(isset($_POST['upInfo'])){
    $id= $_POST['ui_id'];
    $user = $_POST['user'];
    $email = $_POST['email'];
    $uname = $_POST['uname'];   

    // $db = Database::getDb();    
    $count = $i->updateInfo($id,$uname, $email, $user, $db);
      if($count){
        header('Location: userInfo.php');
        exit;
      } else {
        echo "Updating failed";
      }
}
 
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Securicore - Code Challenge</title>
    <meta name="description" content="UserInfo" />
    <link rel="stylesheet" href="css/style.css">    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">	
    <meta name="viewport" content="width=device-width">
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
    <div class="container-xl">
      <div class="table-responsive">
        <div class="table-wrapper">     
          <!-- Table (displaying user information)             -->
          <table class="table table-striped table-hover">
            <thead>
              <tr>					
                <th class="hidden">userInfo_id</th>
                <th>Name</th>
                <th>Email</th>						
                <th>Update</th>
                <th>Delete</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($infos as $info) { ?>
              <tr>
                <td class="hidden"><?= $info->userInfo_id; ?></td>
                <td><?= $info->uname; ?></td>
                <td><?= $info->email; ?></td>						
                <td>      
                   <!-- Requesting Update/Delete information -->
                  <form action="" method="post">
                    <input type="hidden" name="userInfo_id" value="<?= $info->userInfo_id; ?>"/>
                    <input type="submit" name="updateInfo" value="" style="background:url('img/pencil-solid.svg') no-repeat; width:20px;"/>
                  </form>
                </td>
                <td>
                  <form action="" method="post">
                    <input type="hidden" name="userInfo_id" value="<?= $info->userInfo_id; ?>"/>
                    <input type="submit" name="deleteInfo" value="" style="background:url('img/trash-solid.svg') no-repeat; width:20px;"/>
                  </form>
                 </td>
              </tr>
              <?php } ?>
            </tbody>
          </table>			
        </div>
      </div>        
    </div>
    <!-- Fields add/update iUser Information -->
    <div class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">
          <form id="userinformation" action="" method="POST">
            <input type="hidden" name="ui_id" value="<?= $id ?>"/>
            <div class="modal-body">					
              <div class="form-group">
                <label for="uname">Name: </label>
                <input type="text" class="form-control"  id="uname" name="uname" value="<?= $uname; ?>">
              </div>
              <div class="form-group">
                <label>Email: </label>
                <input type="email" class="form-control" id="email" name="email" value="<?= $email; ?>">
              </div>
              <div class="hidden">
                <label for="user">User_ID</label>
                <input type="text" name="user" id="user" value= "<?= $user_id; ?>" />
              </div> 		
              <div class="hidden">
                <label for="user">Userinfo_id</label>
                <input type="text" name="userinfo" id="userinfo" value= "<?= $id; ?>" />
              </div>						
            </div>
            <!-- Submitting New information or Updating information -->
            <div class="modal-footer">
              <button type="submit" name="addInfo" class="btn btn-default" data-dismiss="modal">Add</button>
              <button type="submit" name="upInfo" class="btn btn-success">Update</button>
              <button type="" class="btn"><a href="logout.php">Logout</a></button>
            </div>
          </form>                   
        </div>
      </div>
    </div>
  </body>
</html>

<!-- Copied and Modify from https://www.tutorialrepublic.com/codelab.php?topic=bootstrap&file=crud-data-table-for-database-with-modal-form -->