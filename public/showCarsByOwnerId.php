<?php
/**
 * Created by PhpStorm.
 * User: Marko
 * Date: 6/28/2019
 * Time: 10:05 PM
 */

include_once '../config/Database.php';
include_once '../objects/Car.php';

$database = new Database();
$db = $database->getConnection();

$car = new Car($db);

$stmt = $db->prepare($car->findCarByOwnerId($_POST['id']));

//$stmt = $car->findCarByOwnerId($_POST['id']);

$stmt->execute();

$row = $stmt->fetchAll();

print_r(json_encode($row));