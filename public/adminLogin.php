<?php
/**
 * Created by PhpStorm.
 * User: Marko
 * Date: 6/25/2019
 * Time: 2:54 PM
 */


// include database and object files
include_once '../config/Database.php';
include_once '../objects/Admin.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare user object
$admin = new Admin($db);
// set ID property of user to be edited
$admin->setName(isset($_POST['name']) ? $_POST['name'] : die());
$admin->setPassword(base64_encode(isset($_POST['password']) ? $_POST['password'] : die()));
// read the details of user to be edited
$stmt = $admin->loginAdmin();
session_start();
if($stmt->rowCount() > 0){
    // get retrieved row
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    $adminId = $row['id'];
    $adminName = $row['name'];
    $_SESSION['id'] = $adminId;
    $_SESSION['name'] = $adminName;
    // create array
    $user_arr=array(
        "status" => true,
        "message" => "Successfully Login!",
        "id" => $row['id'],
        "name" => $row['name']
    );
}
else{
    $user_arr=array(
        "status" => false,
        "message" => "Invalid Username or Password!",
    );
}
// make it json format
print_r(json_encode($user_arr));
?>