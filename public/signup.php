<?php
/**
 * Created by PhpStorm.
 * User: Marko
 * Date: 6/9/2019
 * Time: 3:42 PM
 */


// get database connection
include_once '../config/Database.php';

// instantiate user object
include_once '../objects/User.php';

$database = new Database();
$db = $database->getConnection();

$user = new User($db);

// set user property values
$user->setUsername($_POST['username'])->setPassword(base64_encode($_POST['password']))->setEmail($_POST['email'])
    ->setCreated(date('Y-m-d H:i:s'));

var_dump($user->signup());die;

// create the user
if($user->signup()){
    $user_arr=array(
        "status" => true,
        "message" => "Successfully Signup!",
        "id" => $user->getId(),
        "username" => $user->getUsername()
    );
}
else{
    $user_arr=array(
        "status" => false,
        "message" => "Username already exists!"
    );
}
print_r(json_encode($user_arr));
?>