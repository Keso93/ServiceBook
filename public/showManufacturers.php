<?php
/**
 * Created by PhpStorm.
 * User: Marko
 * Date: 6/10/2019
 * Time: 11:13 PM
 */


// include database and object files
include_once '../config/Database.php';
include_once '../objects/Manufacturer.php';

$database = new Database();
$db = $database->getConnection();

$manufacturer = new Manufacturer($db);

$stmt = $manufacturer->findAll();

$row = $stmt->fetchAll();

print_r(json_encode($row));
?>