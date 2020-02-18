<?php
/**
 * Created by PhpStorm.
 * User: Marko
 * Date: 6/11/2019
 * Time: 1:57 PM
 */

include_once '../config/Database.php';
include_once '../objects/Service.php';

$database = new Database();
$db = $database->getConnection();

$service = new Service($db);

$service->setName($_POST['name'])->setAddress($_POST['address']);

if ($service->save()){
    $user_arr=array(
        "status" => true,
        "message" => "Successfully Saved!",
        "id" => $service->getId(),
        "service" => $service->getName(),
        "address" => $service->getAddress(),
    );
}
else{
    $user_arr=array(
        "status" => false,
        "message" => "Service already exists!"
    );
}
print_r(json_encode($user_arr));
