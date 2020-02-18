<?php
/**
 * Created by PhpStorm.
 * User: Marko
 * Date: 6/25/2019
 * Time: 2:50 PM
 */

class Admin
{

    // database connection and table name
    private $conn;
    private $table_name = "admin";

    // object properties
    private $id;
    private $name;
    private $password;

    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    public function setName($name){
        $this->name = $name;
        return $this;
    }

    public function setPassword($password){
        $this->password = $password;
        return $this;
    }


    public function getId(){
        return $this->id;
    }

    public function getName(){
        return $this->name;
    }

    public function getPassword(){
        $this->password;
    }


    // login user
    function loginAdmin(){
        // select all query
        $query = "SELECT `id`, `name`, `password` FROM " . $this->table_name . " WHERE name='".$this->name."' AND password='".$this->password."'";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // execute query
        $stmt->execute();
        return $stmt;
    }


}