<?php
/**
 * Created by PhpStorm.
 * User: Marko
 * Date: 6/11/2019
 * Time: 9:27 PM
 */

class Car
{

    private $conn;
    private $table_name = "cars";

    private $id;
    private $model;
    private $manufacturer;
    private $brojSasije;
    private $registarskaOznaka;
    private $snagaMotora;
    private $kubikaza;
    private $godinaProizvodnje;
    private $vlasnik;
    private $private;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function setModel($model)
    {
        $this->model = $model;
        return $this;
    }

    public function setManufacturer($manufacturer)
    {
        $this->manufacturer = $manufacturer;
        return $this;
    }

    public function setBrojSasije($brojSasije)
    {
        $this->brojSasije = $brojSasije;
        return $this;
    }

    public function setRegistarskaOznaka($registarskaOznaka)
    {
        $this->registarskaOznaka = $registarskaOznaka;
        return $this;
    }

    public function setSnagaMotora($snagaMotora)
    {
        $this->snagaMotora = $snagaMotora;
        return $this;
    }

    public function setKubikaza($kubikaza)
    {
        $this->kubikaza = $kubikaza;
        return $this;
    }

    public function setGodinaProizvodnje($godinaProizvodnje)
    {
        $this->godinaProizvodnje = $godinaProizvodnje;
        return $this;
    }

    public function setVlasnik($vlasnik)
    {
        $this->vlasnik = $vlasnik;
        return $this;
    }

    public function setPrivacy($private){
        $this->private = $private;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getModel()
    {
        return $this->model;
    }

    public function getManufacturer()
    {
        return $this->manufacturer;
    }

    public function getBrojSasije()
    {
        return $this->brojSasije;
    }

    public function getRegistarskaOznaka()
    {
        return $this->registarskaOznaka;
    }

    public function getSnagaMotora()
    {
        return $this->snagaMotora;
    }

    public function getKubikaza()
    {
        return $this->kubikaza;
    }

    public function getGodinaProizvodnje()
    {
        return $this->godinaProizvodnje;
    }

    public function getVlasnik()
    {
        return $this->vlasnik;
    }

    public function getPrivacy()
    {
        return $this->private;
    }

    public function save(){
        if($this->isAlreadyExist()){
            return false;
        }

        // query to insert record
        $query = "INSERT INTO " . $this->table_name . " SET manufactor_id=:manufactor_id, model_id=:model_id, 
        broj_sasije=:broj_sasije, registarska_oznaka=:registarska_oznaka, snaga_motora=:snaga_motora, 
        kubikaza=:kubikaza, godina_proizvodnje=:godina_proizvodnje, vlasnik_id=:vlasnik_id, private=:private";


        // prepare query
        $stmt = $this->conn->prepare($query);


        // sanitize
        $this->model=htmlspecialchars(strip_tags($this->model));
        $this->manufacturer=htmlspecialchars(strip_tags($this->manufacturer));
        $this->brojSasije=htmlspecialchars(strip_tags($this->brojSasije));
        $this->registarskaOznaka=htmlspecialchars(strip_tags($this->registarskaOznaka));
        $this->snagaMotora=htmlspecialchars(strip_tags($this->snagaMotora));
        $this->kubikaza=htmlspecialchars(strip_tags($this->kubikaza));
        $this->godinaProizvodnje=htmlspecialchars(strip_tags($this->godinaProizvodnje));
        $this->vlasnik=htmlspecialchars(strip_tags($this->vlasnik));
        $this->private=htmlspecialchars(strip_tags($this->private));


        // bind values
        $stmt->bindParam(":model_id", $this->model);
        $stmt->bindValue(":manufactor_id", $this->manufacturer, PDO::PARAM_INT);
        $stmt->bindParam(":broj_sasije", $this->brojSasije);
        $stmt->bindParam(":registarska_oznaka", $this->registarskaOznaka);
        $stmt->bindParam(":snaga_motora", $this->snagaMotora);
        $stmt->bindParam(":kubikaza", $this->kubikaza);
        $stmt->bindParam(":godina_proizvodnje", $this->godinaProizvodnje);
        $stmt->bindParam(":vlasnik_id", $this->vlasnik);
        $stmt->bindParam(":private", $this->private);




        // execute query
        if($stmt->execute()){
            $this->id = $this->conn->lastInsertId();
            return true;
        }

        return false;
    }

    public function findAll(){

        $query = "select cars.id, models.name from " . $this->table_name . " left join models on cars.model_id = models.id";

        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        return $stmt;

    }

    public function findCarByOwnerId($id){
        return "select cars.id, concat(manufacturers.name, ' ', models.name) as auto from " . $this->table_name . " left join 
         models on cars.model_id = models.id left join manufacturers on cars.manufactor_id = manufacturers.id
         where cars.vlasnik_id = $id";

//        $stmt = $this->conn->prepare($query);
//
//        $stmt->execute();
//
//        return $stmt;
    }

    public function findCarById($id){
        $query = "select concat(models.name, ' ', manufacturers.name) as auto, cars.id, cars.kubikaza, cars.godina_proizvodnje, 
         cars.snaga_motora, service_book.id as service_book_id from " . $this->table_name . " left join 
         models on cars.model_id = models.id left join manufacturers on cars.manufactor_id = manufacturers.id
         left join service_book on cars.id = service_book.car_id
         where cars.id = $id";

        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        return $stmt;
    }

    public function findCarByRegistration($registarskaOznaka){
        return "select concat(manufacturers.name, ' ', models.name) as auto, cars.id, cars.private, service_book.id as 
        service_book_id from " . $this->table_name . " left join models on cars.model_id = models.id left join 
        manufacturers on cars.manufactor_id = manufacturers.id left join service_book on cars.id = service_book.car_id 
        where cars.registarska_oznaka like '" . $registarskaOznaka . "'";

    }

    public function showSearchedCarById($id){
        return "select concat(models.name, ' ', manufacturers.name) as auto, cars.id, cars.kubikaza, cars.godina_proizvodnje, 
         cars.snaga_motora, service_book.id as service_book_id from " . $this->table_name . " left join 
         models on cars.model_id = models.id left join manufacturers on cars.manufactor_id = manufacturers.id
         left join service_book on cars.id = service_book.car_id
         where cars.private = 1 and cars.id = " . $id;

    }


    public function isAlreadyExist()
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE registarskaOznaka='" . $this->registarskaOznaka . "' OR brojSasije='" .
            $this->brojSasije . "'";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // execute query
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return true;
        } else {
            return false;
        }

    }
}