<?php
/**
 * Created by PhpStorm.
 * User: Marko
 * Date: 6/11/2019
 * Time: 1:45 PM
 */

class Service
{

    private $conn;
    private $table_name = "car_services";

    private $id;
    private $name;
    private $address;
    private $rating;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function setName($name){
        $this->name = $name;
        return $this;
    }

    public function setAddress($address){
        $this->address = $address;
        return $this;
    }

    public function getId(){
        return $this->id;
    }

    public function getName(){
        return $this->name;
    }

    public function getAddress(){
        return $this->address;
    }

    public function getRating(){
        return $this->rating;
    }

    public function save(){
        if ($this->isAlreadyExist()){
            return false;
        }

        $query = "INSERT INTO " . $this->table_name . " SET name=:name, address=:address";

        $stmt = $this->conn->prepare($query);

        $this->name=htmlspecialchars(strip_tags($this->name));
        $this->address=htmlspecialchars(strip_tags($this->address));

        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":address", $this->address);

        if($stmt->execute()){
            $this->id = $this->conn->lastInsertId();
            return true;
        }

        return false;
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

    public function findAll(){

        $query = "select * from " . $this->table_name;

        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        return $stmt;

    }

}