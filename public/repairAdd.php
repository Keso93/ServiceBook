<?php
/**
 * Created by PhpStorm.
 * User: Marko
 * Date: 6/28/2019
 * Time: 6:08 PM
 */

include_once "../config/Database.php";
include_once "../objects/Repair.php";

$database = new Database();
$db = $database->getConnection();

$repair = new Repair($db);

$repair->setRepair($_POST['repair'])->setDate($_POST['date'])->setDistance($_POST['distance'])->setPrice($_POST['price'])
->setCarServiceId($_POST['car_service'])->setServiceBookId($_POST['service_book']);

// create the user
if($repair->save()){
    $user_arr=array(
        "status" => true,
        "message" => "Successfully Created!",
        "id" => $repair->getId(),
    );
}
else{
    $user_arr=array(
        "status" => false,
        "message" => "Error"
    );
}
print_r(json_encode($user_arr));