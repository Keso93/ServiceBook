<?php
/**
 * Created by PhpStorm.
 * User: Marko
 * Date: 6/10/2019
 * Time: 11:33 PM
 */

// include database and object files
include_once '../config/Database.php';
include_once '../objects/Model.php';

$database = new Database();
$db = $database->getConnection();

$model = new Model($db);

$model->setName($_POST['name'])->setManufacturer($_POST['manufactor_id']);

if($model->save()){
    $user_arr=array(
        "status" => true,
        "message" => "Successfully Saved!",
        "id" => $model->getId(),
        "model" => $model->getName(),
        "manufacturer" => $model->getManufacturer()
    );
}
else{
    $user_arr=array(
        "status" => false,
        "message" => "Model already exists!"
    );
}
print_r(json_encode($user_arr));
?>