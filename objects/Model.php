<?php
/**
 * Created by PhpStorm.
 * User: Marko
 * Date: 6/10/2019
 * Time: 10:55 PM
 */

class Model
{

    private $conn;
    private $table_name = "models";

    private $id;
    private $name;
    private $manufacturer;


    public function __construct($db){
        $this->conn = $db;
    }

    public function setName($name){
        $this->name = $name;
        return $this;
    }

    public function setManufacturer($manufacturer){
        $this->manufacturer = $manufacturer;
        return $this;
    }

    public function getId(){
        return $this->id;
    }

    public function getName(){
        return $this->name;
    }

    public function getManufacturer(){
        return $this->manufacturer;
    }


    function save(){

    if($this->isAlreadyExist()){
        return false;
    }
    // query to insert record
    $query = "INSERT INTO " . $this->table_name . " SET manufactor_id=:manufactor_id, name=:name";


    // prepare query
    $stmt = $this->conn->prepare($query);


    // sanitize
    $this->name=htmlspecialchars(strip_tags($this->name));
    $this->manufacturer=htmlspecialchars(strip_tags($this->manufacturer));


    // bind values
    $stmt->bindParam(":name", $this->name);
    $stmt->bindValue(":manufactor_id", $this->manufacturer, PDO::PARAM_INT);




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

public function findModelByManufactor($manufacturerId){

    return "select models.* from " . $this->table_name . " left join manufacturers on models.manufactor_id = manufacturers.id 
            where models.manufactor_id = $manufacturerId";

//    $stmt = $this->conn->prepare($query);
//
//    $stmt->execute();
//
//    return $stmt;

}

public function findManufactorByModel($modelId){
    return "select models.*, manufacturers.id, manufacturers.name as manufactor from " . $this->table_name . " left join manufacturers on models.manufactor_id = manufacturers.id 
            where models.id = $modelId";
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