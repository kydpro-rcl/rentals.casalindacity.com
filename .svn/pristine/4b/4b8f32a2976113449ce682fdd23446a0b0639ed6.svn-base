<?php
//include database class
include_once 'core/db.php';
$db = new DB();

//get images id and generate ids array
$idArray = explode(",",$_POST['ids']);

//update images order
$db->updateOrder($idArray, $id_villa);
?>