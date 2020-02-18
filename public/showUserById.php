<?php
/**
 * Created by PhpStorm.
 * User: Marko
 * Date: 6/28/2019
 * Time: 9:27 PM
 */

include_once '../config/Database.php';
include_once '../objects/User.php';

$database = new Database();
$db = $database->getConnection();

$user = new User($db);

$stmt = $user->findUserById($_POST['id']);

$row = $stmt->fetchAll();

print_r(json_encode($row));