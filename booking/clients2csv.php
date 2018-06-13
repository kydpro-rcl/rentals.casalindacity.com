<?php
require_once('inc/session.php');
if ($_SESSION['info']){
	//require_once('template/print_clients.php');
	require_once('init.php');

$data= new getQueries ();

$customers=$data->show_all('customers', 'lastname');
//$total_records=$data->getAffectedRows();
$list = array (
				array('LastName', 'FirstName', 'Email', 'Phone 1', 'Street Address 1', 'City', 'State', 'PostalCode', 'Country')
		);
//$stack = array("orange", "banana");
//array_push($stack, "apple", "raspberry");		
foreach ($customers AS $k){$list[]=array($k['lastname'], $k['name'], $k['email'], $k['phone'], $k['address'], $k['city'], $k['state'], $k['zip'], $k['country']);}
$fp = fopen('csv/clients'.date('YmdGis').'.csv', 'w');

foreach ($list as $fields) {
    fputcsv($fp, $fields);
}

fclose($fp);
}
?>