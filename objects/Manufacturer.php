<?php
/**
 * Created by PhpStorm.
 * User: Marko
 * Date: 6/9/2019
 * Time: 8:18 PM
 */

class Manufacturer
{

    private $conn;
    private $table_name = "manufacturers";

    private $id;
    private $name;


    public function __construct($db){
        $this->conn = $db;
    }

    public function setName($name){
        $this->name = $name;
    }

    public function getId(){
        return $this->id;
    }

    public function getName(){
        return $this->name;
    }

    public function save(){

        if($this->isAlreadyExist()){
            return false;
        }
        // query to insert record
        $query = "INSERT INTO " . $this->table_name . " SET name=:name";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->name=htmlspecialchars(strip_tags($this->name));


        // bind values
        $stmt->bindParam(":name", $this->name);

        // execute query
        if($stmt->execute()){
            $this->id = $this->conn->lastInsertId();
            return true;
        }

        return false;

    }

    public function findAll(){

        $query = "select * from " . $this->table_name;

        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        return $stmt;

    }

    function isAlreadyExist(){
        $query = "SELECT * FROM " . $this->table_name . " WHERE name='".$this->name."'";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // execute query
        $stmt->execute();
        if($stmt->rowCount() > 0){
            return true;
        }
        else{
            return false;
        }
    }


}