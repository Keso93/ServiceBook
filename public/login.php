<?php
/**
 * Created by PhpStorm.
 * User: Marko
 * Date: 6/9/2019
 * Time: 7:48 PM
 */


// include database and object files
include_once '../config/Database.php';
include_once '../objects/User.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare user object
$user = new User($db);
// set ID property of user to be edited
$user->setUsername(isset($_POST['username']) ? $_POST['username'] : die());
$user->setPassword(base64_encode(isset($_POST['password']) ? $_POST['password'] : die()));
// read the details of user to be edited
$stmt = $user->login();
session_start();
if($stmt->rowCount() > 0){
    // get retrieved row
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    $userId = $row['id'];
    $userName = $row['username'];
    $_SESSION['id'] = $userId;
    $_SESSION['username'] = $userName;

    $user_arr=array(
        "status" => true,
        "message" => "Successfully Login!",
        "id" => $userId,
        "username" => $userName
    );
}
else{
    $user_arr=array(
        "status" => false,
        "message" => "Invalid Username or Password!",
    );
    unset($_SESSION['id']);
}
// make it json format
print_r(json_encode($user_arr));
?>