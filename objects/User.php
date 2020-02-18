<?php
/**
 * Created by PhpStorm.
 * User: Marko
 * Date: 6/9/2019
 * Time: 1:11 AM
 */

class User
{

    // database connection and table name
    private $conn;
    private $table_name = "users";

    // object properties
    private $id;
    private $username;
    private $password;
    private $email;
    private $created;

    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    public function setUsername($username){
        $this->username = $username;
        return $this;
    }

    public function setPassword($password){
        $this->password = $password;
        return $this;
    }

    public function setEmail($email){
        $this->email = $email;
        return $this;
    }

    public function setCreated($created){
        $this->created = $created;
        return $this;
    }

    public function getId(){
        return $this->id;
    }

    public function getUsername(){
        return $this->username;
    }

    public function getPassword(){
        return $this->password;
    }

    public function getEmail(){
        return $this->email;
    }

    // signup user
    function signup(){

        if($this->isAlreadyExist()){
            return false;
        }
        // query to insert record
        $query = "INSERT INTO " . $this->table_name . " SET username=:username, password=:password, email=:email, created=:created";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->username=htmlspecialchars(strip_tags($this->username));
        $this->password=htmlspecialchars(strip_tags($this->password));
        $this->email=htmlspecialchars(strip_tags($this->email));
        $this->created=htmlspecialchars(strip_tags($this->created));

        // bind values
        $stmt->bindParam(":username", $this->username);
        $stmt->bindParam(":password", $this->password);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":created", $this->created);

        // execute query
        if($stmt->execute()){
            $this->id = $this->conn->lastInsertId();
            return true;
        }

        return false;

    }
    // login user
    function login(){
        // select all query
        $query = "SELECT `id`, `username`, `password`, `created` FROM " . $this->table_name . " WHERE username='".$this->username."' AND password='".$this->password."'";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // execute query
        $stmt->execute();
        return $stmt;
    }
    function isAlreadyExist(){
        $query = "SELECT * FROM " . $this->table_name . " WHERE username='".$this->username."'";
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

        $query = "select id, username, email from " . $this->table_name;

        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        return $stmt;

    }

    public function findUserById($id){
        $query = "select id, username, email from " . $this->table_name . " where id = $id";

        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        return $stmt;
    }

    public function editUser($id, $username, $email){
        $query = "update users set username = " . "'" .$username . "', email = " . "'". $email . "' where id = " . $id;

        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        return $stmt;

    }


    public function deleteUserById($id){

        $query = "delete from " . $this->table_name . " where id = $id";

        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        return $stmt;

    }

}