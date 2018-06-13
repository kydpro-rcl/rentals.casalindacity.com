<?php
session_start();
require_once('init.php');
$db= new getQueries();
//$p=$db->get_season3_prices($startdate='2019-03-30', $pricelow='500', $priceshoulder='1500', $pricehigh='2000');	
$p=dates_between($s='2010-10-01', $e='2010-10-05');
print_r($p);
?>