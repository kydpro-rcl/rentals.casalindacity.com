<?php
session_start();
error_reporting(E_ALL & ~E_NOTICE);// Report all errors except E_NOTICE
/*
error_reporting(E_ALL);
ini_set("display_errors", 1);
*/
require_once('inc/init.php');
$_SESSION['RCL']="rcladministraciones";/*REQUIRED FOR SECURITY SO, DON'T LET PEOPLE ACCESS DIRECTLY TO NEXT PAGE*/
draw_resp('vacation_rental');
?>
