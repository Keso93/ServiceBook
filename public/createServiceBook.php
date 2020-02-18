<?php
/**
 * Created by PhpStorm.
 * User: Marko
 * Date: 6/28/2019
 * Time: 1:39 AM
 */

// get database connection
include_once '../config/Database.php';

// instantiate user object
include_once '../objects/ServiceBook.php';

$database = new Database();
$db = $database->getConnection();

$serviceBook = new ServiceBook($db);

// set user property values
$serviceBook->setCarId($_POST['car_id'])->setCreated(date('Y-m-d H:i:s'));

// create the user
if($serviceBook->save()){
    $user_arr=array(
        "status" => true,
        "message" => "Successfully Created!",
        "id" => $serviceBook->getId(),
    );
}
else{
    $user_arr=array(
        "status" => false,
        "message" => "Car already has service book!"
    );
}
print_r(json_encode($user_arr));
?>