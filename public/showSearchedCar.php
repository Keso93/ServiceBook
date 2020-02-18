<?php
/**
 * Created by PhpStorm.
 * User: Marko
 * Date: 7/17/2019
 * Time: 6:45 PM
 */

include_once '../config/Database.php';
include_once '../objects/Car.php';

$database = new Database();
$db = $database->getConnection();

$car = new Car($db);
$stmt = $db->prepare($car->showSearchedCarById($_POST['id']));


$stmt->execute();


$row = $stmt->fetchAll();

print_r(json_encode($row));