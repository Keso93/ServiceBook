<?php
/**
 * Created by PhpStorm.
 * User: Marko
 * Date: 6/9/2019
 * Time: 12:00 AM
 */

class Database
{

    private $host="localhost";
    private $username="root";
    private $password="";
    private $dbName="proba_servis";

    public $conn;

    public function getConnection(){

        $this->conn = null;

        try{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->dbName, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->conn;
    }
}

