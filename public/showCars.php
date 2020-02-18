<?php
/**
 * Created by PhpStorm.
 * User: Marko
 * Date: 6/28/2019
 * Time: 2:00 AM
 */

include_once '../config/Database.php';
include_once '../objects/Car.php';

$database = new Database();
$db = $database->getConnection();

$car = new Car($db);

$stmt = $car->findAll();

$row = $stmt->fetchAll();

print_r(json_encode($row));