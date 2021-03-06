<?php
/**
 * Created by PhpStorm.
 * User: Marko
 * Date: 6/11/2019
 * Time: 10:58 PM
 */

include_once '../config/Database.php';
include_once '../objects/Model.php';

$database = new Database();
$db = $database->getConnection();

$car = new Model($db);

$stmt = $db->prepare($car->findModelByManufactor($_POST['manufactor_id']));

//$stmt = $car->findCarByOwnerId($_POST['id']);

$stmt->execute();

$row = $stmt->fetchAll();

print_r(json_encode($row));