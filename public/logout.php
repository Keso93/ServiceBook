<?php
/**
 * Created by PhpStorm.
 * User: Marko
 * Date: 6/26/2019
 * Time: 6:39 PM
 */


session_start();
unset($_SESSION['id']);
unset($_SESSION['username']);
unset($_SESSION['name']);

$arr=array(
    'status' => true
);

print_r(json_encode($arr));
