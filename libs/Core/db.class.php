<?php
/**
 * Databaseclass based on PDO
 * Author: Steffen Lindner
 */
include "dbhandler.class.php";

class DB implements DBHandler {
    /**
     * active connection
     * @var [object]
     */
    private $con;
    /**
     * db object
     * @var [object]
     */
    public static $db;
    
    /**
     * [Creates the pdo object
     * @param [string] $host [host]
     * @param [string] $db   [database]
     * @param [string] $user [db-user]
     * @param [string] $pw   [db-pw]
     */
    public function __construct($host, $db, $user, $pw) {
        try {
            $this->con = @new PDO('mysql:host=' . $host . ';dbname=' . $db . '', $user, $pw, array(
                PDO::ATTR_PERSISTENT => true
            ));
            $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch (PDOException $e) {
            print $e->getMessage();
            die();
        }
        
        return $this->con;
    }
    
    /**
     * Executes a query
     * @param  [string]     $sql   [sql statement]
     * @param  array|null $param [bind parameters]
     * @return [object]            [query object]
     */
    public function query($sql, array $param = null) {
        try {
            $stm = $this->con->prepare($sql);
            $stm->execute($param);
        }
        catch (PDOException $e) {
            print $e->getMessage();
            die();
        }
        
        return $stm;
    }
    
    /**
     * Counts the rows
     * @param  [string]     $sql   [sql statement]
     * @param  array|null $param [bind parameters]
     * @return [int]            [amount of rows]
     */
    public function num_rows($sql, array $param = null) {
        $stm = $this->query($sql, $param);
        return $stm->rowCount();
    }
    
    /**
     * Fetches single row
     * @param  [string]     $sql   [sql statement]
     * @param  array|null $param [bind parameters]
     * @return [array]            [assoc-array]
     */
    public function fetch_assoc($sql, array $param = null) {
        $stm = $this->query($sql, $param);
        return $stm->fetch(PDO::FETCH_ASSOC);
    }
    
    /**
     * Fetches rows
     * @param  [string]     $sql   [sql statement]
     * @param  array|null $param [bind parameters]
     * @return [array]            [assoc multiple array]
     */
    public function fetch_all($sql, array $param = null) {
        $stm = $this->query($sql, $param);
        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }
    /* --------------- Interface implementation -------------- */
    /**
     * Initializes local database object
     */
    public static function initDB() {
        self::$db = new DB(Config::get("db_host"), Config::get("db_db"), Config::get("db_user"), Config::get("db_pw"));
    }
    /**
     * Returns local database object
     * @return [object] [database object]
     */
    public static function getDB() {
        return self::$db;
    }
}
?>