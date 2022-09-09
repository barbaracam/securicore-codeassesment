<?php

namespace securicore_codec\php\Models
{

use PDOException;

    class Database {

        // These variables must be set to the specific database connection information.
        // private static $dbName = "barbrdep_pmWafadb";
        // private static $host = "127.0.0.1:3306";
        // private static $userName = "barbrdep_barbie";
        // private static $password = "ux#=Z}f^eoDH";

        private static $dbName = "barbrdep_securicore";
        private static $host = "66.29.132.88:3306";
        private static $userName = "barbrdep_barbara";
        private static $password = "0HF601rsrT1P";


        // Private variables to interact with the database.
        private static $dataSourceName;
        private static $dbconnection;
    
        // Static class.
        private function __construct()
        {        
        }
        
        // Construct the PDO if required, then return PDO.
        public static function getDb()
        {
            if( self::$dbconnection == null ) {
                self::$dataSourceName  = "mysql:host=" .self::$host . ";dbname=" . self::$dbName;
    
                try {
                // Establish the connection.
                self::$dbconnection = new \PDO( self::$dataSourceName, self::$userName, self::$password );

                // Set some connection attributes.
                self::$dbconnection->setAttribute( \PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION );

                } catch( PDOException $e ) {
                    echo $e->getMessage()();
                    exit();
                }

            }
            return self::$dbconnection;
        }
    }

}