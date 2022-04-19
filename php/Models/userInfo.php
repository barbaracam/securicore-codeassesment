<?php

Namespace securicore_codec\php\Models;

class userInfo{
   
    //get all information from the users table
    public function getUsers($db)
    {
        $query = "SELECT * FROM users";
        $pdostm = $db->prepare($query);
        $pdostm->execute();
        //fetch all result
        $results = $pdostm->fetchAll(\PDO::FETCH_OBJ);
        return $results;
    } 
    //get all info from the database filtered by user
    public function getInfo($user, $db)
    {
        $query = "SELECT userInfo.userInfo_id, userInfo.uname as uname, userInfo.email as email, userInfo.user_id as user FROM userInfo, users where userInfo.user_id = users.user_id AND userInfo.user_id = :user";
        $pdostm = $db->prepare($query);
        $pdostm->bindValue(':user', $user, \PDO::PARAM_STR);
        $pdostm->execute();
        //fetch all result
        $infos = $pdostm->fetchAll(\PDO::FETCH_OBJ);
        return $infos;
    }
    //Add information to the fields by user
    public function addInfo($uname, $email, $user, $db)    
    {
    $sql = "INSERT INTO userInfo(uname, email, user_id) values (:uname, :email, :user_id)";
        $pst = $db->prepare($sql);
        $pst->bindParam(':uname', $uname);
        $pst->bindParam(':email', $email); 
        $pst->bindParam(':user_id', $user);               
        $infos = $pst->execute();
        return $infos;
    }
    //Delete information from the fields
    public function deleteInfo($id, $db)
    {
        $sql = "DELETE FROM userInfo WHERE userInfo_id = :id";
        $pst = $db->prepare($sql);
        $pst->bindParam(':id', $id);
        $count = $pst->execute();
        return $count;
    }
    //Update Information
    public function updateInfo($id, $uname, $email, $user, $db)
    {
        $sql = "UPDATE userInfo 
                set uname = :uname, email = :email, user_id = :user 
                WHERE userInfo_id = :userInfo_id";
            $pst = $db->prepare($sql);
            $pst->bindParam(':userInfo_id', $id);
            $pst->bindParam(':uname', $uname);
            $pst->bindParam(':email', $email);
            $pst->bindParam(':user', $user);
            $count = $pst->execute();
            return $count;
    }
    // get information in every field by userInformation_id
    public function getUserInfoById($id, $db)
    {
        $sql = "SELECT ui.userInfo_id, ui.uname, ui.email, ui.user_id FROM userInfo ui, users u where u.user_id = ui.user_id AND ui.userInfo_id = :id";        
        $pst = $db->prepare($sql);
        $pst->bindParam(':id', $id);
        $pst->execute();        
        $u = $pst->fetch(\PDO::FETCH_OBJ);
        return $u;
    }
}


?>