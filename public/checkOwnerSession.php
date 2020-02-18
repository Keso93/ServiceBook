<?php
/**
 * Created by PhpStorm.
 * User: Marko
 * Date: 7/17/2019
 * Time: 6:12 PM
 */

include_once '../config/database.php';

$session = $_POST['owner_id'];
session_start();
if(isset($_SESSION['id']) && $_SESSION['id'] == $session)
//if(isset($_SESSION['id']))
{

    $arr = array(
        'status' => true,
        'name' => $_SESSION['username'],
        'id' => $_SESSION['id']
    );
}
else
{
    $arr = array(
        'status' => false
    );
}

print_r(json_encode($arr));