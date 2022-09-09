<?php

namespace securicore_codec\php\Models;

use PDOException;

class Database
{
    //properties database

    private static $user = 'root';
    private static $pass = '';
    private static $dsn = 'mysql:host=localhost;dbname=securicore';
    private static $dbcon;

    // private static $dbName = "barbrdep_securicore";
    // private static $host = "166.29.132.88:3306";
    // private static $userName = "barbrdep_barbara";
    // private static $password = "0HF601rsrT1P";
    
    private function __construct()
    {
    }
    
    // 66.29.132.88
    //0HF601rsrT1P

    //get pdo connection
    public static function getDb(){
        if(!isset(self::$dbcon)) {
            try {
                self::$dbcon = new \PDO(self::$dsn, self::$user, self::$pass);
                self::$dbcon->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
                self::$dbcon->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_OBJ);
            } catch (\PDOException $e) {
                $msg = $e->getMessage();
                include '../custom-error.php';
                exit();
            }
        }

        return self::$dbcon;
    }
}




 
?>