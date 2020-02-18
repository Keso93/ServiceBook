<?php
/**
 * Created by PhpStorm.
 * User: Marko
 * Date: 7/9/2019
 * Time: 1:52 PM
 */

include_once '../config/Database.php';
include_once '../objects/Car.php';

$database = new Database();
$db = $database->getConnection();

$car = new Car($db);
//var_dump($_POST['registration']);die;
$stmt = $db->prepare($car->findCarByRegistration($_POST['registration']));

//$stmt = $car->findCarByOwnerId($_POST['id']);

$stmt->execute();

$row = $stmt->fetchAll();

print_r(json_encode($row));