<?php
/**
 * Created by PhpStorm.
 * User: Marko
 * Date: 6/11/2019
 * Time: 10:37 PM
 */

include_once '../config/Database.php';
include_once '../objects/Car.php';

$database = new Database();
$db = $database->getConnection();

$car = new Car($db);
$car->setModel($_POST['model_id'])->setManufacturer($_POST['manufactor_id'])->setBrojSasije($_POST['broj_sasije'])
    ->setRegistarskaOznaka($_POST['registarska_oznaka'])->setSnagaMotora($_POST['snaga_motora'])->setKubikaza($_POST['kubikaza'])
    ->setGodinaProizvodnje($_POST['godina_proizvodnje'])->setVlasnik($_POST['vlasnik_id'])->setPrivacy($_POST['privacy']);



if($car->save()){
    $user_arr=array(
        "status" => true,
        "message" => "Successfully Saved!",
        "id" => $car->getId(),
        "model" => $car->getModel(),
        "manufacturer" => $car->getManufacturer()
    );
}
else{
    $user_arr=array(
        "status" => false,
        "message" => "Car already exists!"
    );
}
print_r(json_encode($user_arr));