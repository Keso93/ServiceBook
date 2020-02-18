<?php
/**
 * Created by PhpStorm.
 * User: Marko
 * Date: 6/28/2019
 * Time: 5:51 PM
 */

class Repair
{

    private $conn;
    private $table_name = "repairs";

    private $id;
    private $repair;
    private $date;
    private $distance;
    private $price;
    private $serviceBookId;
    private $carServiceId;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function setRepair($repair){
        $this->repair = $repair;
        return $this;
    }

    public function setDate($date){
        $this->date = $date;
        return $this;
    }
    public function setDistance($distance){
        $this->distance = $distance;
        return $this;
    }

    public function setPrice($price){
        $this->price = $price;
        return $this;
    }

    public function setServiceBookId($serviceBookId){
        $this->serviceBookId = $serviceBookId;
        return $this;
    }

    public function setCarServiceId($carServiceId){
        $this->carServiceId = $carServiceId;
        return $this;
    }

    public function getId(){
        return $this->id;
    }

    public function getRepair(){
        return $this->repair;
    }

    public function getDate(){
        return $this->date;
    }

    public function getDistance(){
        return $this->distance;
    }

    public function getPrice(){
        return $this->price;
    }

    public function getServiceBookId(){
        return $this->serviceBookId;
    }

    public function getCarServiceId(){
        return $this->carServiceId;
    }


    public function save(){


        $query = "INSERT INTO " . $this->table_name . " SET repair=:repair, date=:date, distance=:distance, 
        price=:price, car_service_id=:car_service_id, service_book_id=:service_book_id";


        // prepare query
        $stmt = $this->conn->prepare($query);


        // sanitize
        $this->repair=htmlspecialchars(strip_tags($this->repair));
        $this->date=htmlspecialchars(strip_tags($this->date));
        $this->distance=htmlspecialchars(strip_tags($this->distance));
        $this->price=htmlspecialchars(strip_tags($this->price));
        $this->serviceBookId=htmlspecialchars(strip_tags($this->serviceBookId));
        $this->carServiceId=htmlspecialchars(strip_tags($this->carServiceId));


        $stmt->bindParam(":repair", $this->repair);
        $stmt->bindParam(":date", $this->date);
        $stmt->bindParam(":distance", $this->distance);
        $stmt->bindParam(":price", $this->price);
        $stmt->bindParam(":car_service_id", $this->carServiceId);
        $stmt->bindParam(":service_book_id", $this->serviceBookId);


        // execute query
        if($stmt->execute()){
            $this->id = $this->conn->lastInsertId();
            return true;
        }

        return false;
    }

    public function findRepairByServiceBook($serviceBookId){
        $query = "select *, car_services.name from " . $this->table_name . " left join car_services 
        on repairs.car_service_id = car_services.id where service_book_id = $serviceBookId";

        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        return $stmt;

    }














}