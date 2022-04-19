<?php

Namespace securicore_codec\php\Models;

class user
{   
    //get all users 
    public function getUsers($db)
    {
        $query = "SELECT * FROM users";
        $pdostm = $db->prepare($query);
        $pdostm->execute();
        //fetch all result
        $results = $pdostm->fetchAll(\PDO::FETCH_OBJ);
        return $results;
    } 
    //Add information to the fields
    public function addUser($username, $password, $db)    
    {
    //Insert values with hashed password
    $sql = "INSERT INTO users(username, password) values (:username, MD5(:password))";
        $pst = $db->prepare($sql);
        $pst->bindParam(':username', $username);
        $pst->bindParam(':password', $password);                      
        $u = $pst->execute();
        return $u;
    }

}