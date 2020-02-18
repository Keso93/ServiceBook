<?php
/**
 * Created by PhpStorm.
 * User: Marko
 * Date: 6/25/2019
 * Time: 6:00 PM
 */

include_once '../config/Database.php';
include_once '../objects/Service.php';

$database = new Database();
$db = $database->getConnection();

$service = new Service($db);

$stmt = $service->findAll();

$row = $stmt->fetchAll();

print_r(json_encode($row));

?>