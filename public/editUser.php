<?php
/**
 * Created by PhpStorm.
 * User: Marko
 * Date: 7/17/2019
 * Time: 10:17 PM
 */

include_once '../config/Database.php';
include_once '../objects/User.php';

$database = new Database();
$db = $database->getConnection();

$user = new User($db);

//var_dump($_POST['username']);
//var_dump($_POST['id']);
//var_dump($_POST['email']);
//var_dump($user->editUser($_POST['id'], $_POST['username'], $_POST['email']));die;


// create the user
if($user->editUser($_POST['id'], $_POST['username'], $_POST['email'])){
    $user_arr=array(
        "status" => true,
        "message" => "Successfully changed!",
    );
}
else{
    $user_arr=array(
        "status" => false,
        "message" => "Username already exists!"
    );
}
print_r(json_encode($user_arr));