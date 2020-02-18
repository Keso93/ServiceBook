<?php
/**
 * Created by PhpStorm.
 * User: Marko
 * Date: 6/11/2019
 * Time: 10:57 PM
 */

include_once '../config/Database.php';
include_once '../objects/Model.php';

$database = new Database();
$db = $database->getConnection();

$model = new Model($db);

$stmt = $model->findAll();

$row = $stmt->fetchAll();

print_r(json_encode($row));

?>
