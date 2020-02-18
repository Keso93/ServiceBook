<?php
/**
 * Created by PhpStorm.
 * User: Marko
 * Date: 6/26/2019
 * Time: 4:42 PM
 */

$sessionI = $_POST['id'];
session_start();
//if(isset($_SESSION['id']) && $_SESSION['id'] == $session)
if(isset($_SESSION['id']) && isset($_SESSION['name']))
{

    $arr = array(
        'status' => true,
        'name' => $_SESSION['name']
    );
}
else
{
    $arr = array(
        'status' => false
    );
}

print_r(json_encode($arr));