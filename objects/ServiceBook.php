<?php
/**
 * Created by PhpStorm.
 * User: Marko
 * Date: 6/28/2019
 * Time: 1:15 AM
 */

class ServiceBook
{

    private $conn;
    private $table_name = "service_book";

    private $id;
    private $created;
    private $carId;


    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function setCreated($created){
        $this->created = $created;
        return $this;
    }

    public function setCarId($carId){
        $this->carId = $carId;
        return $this;
    }

    public function getId(){
        return $this->id;
    }

    public function getCreated(){
        return $this->created;
    }

    public function getCarId(){
        return $this->carId;
    }

    function save(){

        if($this->isAlreadyExist()){
            return false;
        }



        // query to insert record
        $query = "INSERT INTO " . $this->table_name . " SET created=:created, car_id=:car_id";


        // prepare query
        $stmt = $this->conn->prepare($query);


        // sanitize
        $this->created=htmlspecialchars(strip_tags($this->created));
        $this->carId=htmlspecialchars(strip_tags($this->carId));

        // bind values
        $stmt->bindParam(":created", $this->created);
        $stmt->bindParam(":car_id", $this->carId);




        // execute query
        if($stmt->execute()){
            $this->id = $this->conn->lastInsertId();
            return true;
        }

        return false;

    }


    public function findServiceBookByCarId(){

        $query = "select * from " . $this->table_name . " left join cars on service_book.car_id = cars.id 
            where car_id = " . $this->carId;

        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        return $stmt;

    }

    function isAlreadyExist(){
        $query = "SELECT * FROM " . $this->table_name . " WHERE car_id= " . $this->carId;
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