<?php
/**
 * Created by PhpStorm.
 * User: Marko
 * Date: 6/30/2019
 * Time: 2:55 PM
 */
include_once "../config/Database.php";
include_once "../objects/Repair.php";

$database = new Database();
$db = $database->getConnection();

$repair = new Repair($db);

$stmt = $repair->findRepairByServiceBook($_POST['service_book_id']);

$row = $stmt->fetchAll();

print_r(json_encode($row));


