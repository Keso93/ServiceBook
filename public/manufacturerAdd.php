<?php
/**
 * Created by PhpStorm.
 * User: Marko
 * Date: 6/9/2019
 * Time: 8:26 PM
 */


// include database and object files
include_once '../config/Database.php';
include_once '../objects/Manufacturer.php';

$database = new Database();
$db = $database->getConnection();

$manufacturer = new Manufacturer($db);

$manufacturer->setName($_POST['name']);

if($manufacturer->save()){
    $user_arr=array(
        "status" => true,
        "message" => "Successfully Saved!",
        "id" => $manufacturer->getId(),
        "manufacturer" => $manufacturer->getName()
    );
}
else{
    $user_arr=array(
        "status" => false,
        "message" => "Manufacturer already exists!"
    );
}
print_r(json_encode($user_arr));
?>