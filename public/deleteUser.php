<?php
/**
 * Created by PhpStorm.
 * User: Marko
 * Date: 7/17/2019
 * Time: 8:11 PM
 */

include_once '../config/Database.php';
include_once '../objects/User.php';

$database = new Database();
$db = $database->getConnection();

$user = new User($db);

//$stmt = $user->deleteUserById($_POST['id']);

if($user->deleteUserById($_POST['id'])){
    $user_arr=array(
        "status" => true,
        "message" => "Successfully deleted!",
    );
}
else{
    $user_arr=array(
        "status" => false,
        "message" => "Failed to delete!"
    );
}
print_r(json_encode($user_arr));