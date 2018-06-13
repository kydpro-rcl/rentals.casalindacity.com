<?php
// output headers so that the file is downloaded rather than displayed
require_once('../init.php');
$name=time();
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=PropertyImages_'.$name.'.csv');

// create a file pointer connected to the output stream
$output = fopen('php://output', 'w');

// output the column headings
fputcsv($output, array(0=>'External_PropertyID', 
						1=>'Image', 
						2=>'Caption', 
						3=>'ImageOrder'));

// fetch the data
$db= new getQueries;
$villas=$db->show_all($table='villas', $order='id');

$url = "https://". $_SERVER['SERVER_NAME'].'/';

//$url = "http://". $_SERVER['SERVER_NAME'].'/https/';

foreach($villas AS $k){

$a = glob('../../../for_rent/tor_pics/photos/villa'.$k['no'].'/full/*.jpg');




$c=0;
/*
$path_pieces = pathinfo($k['pic']);
$file=$path_pieces['basename'];
*/
$rows = array(0=>$k['id'],  
					1=>$url.'booking/'.$k['pic'],
					2=>'',
					3=>$c);

	fputcsv($output, $rows);
	$c++;

if(!$a){
$a = glob('../../../for_rent/tor_pics/photos/villa'.$k['no'].'/full/*.JPG');
}else{
$extra = glob('../../../for_rent/tor_pics/photos/villa'.$k['no'].'/full/*.JPG');
}

foreach($a AS $kp){
$path_parts = pathinfo($kp);
$file=$path_parts['basename'];

	$rows = array(0=>$k['id'],  
					1=>$url.'for_rent/tor_pics/photos/villa'.$k['no'].'/full/'.$file,
					2=>'',
					3=>$c);

	fputcsv($output, $rows);
	$c++;
}

if($extra){
	foreach($extra AS $p){
	$path_parts = pathinfo($p);
	$file=$path_parts['basename'];

		$rows = array(0=>$k['id'],  
						1=>$url.'for_rent/tor_pics/photos/villa'.$k['no'].'/full/'.$file,
						2=>'',
						3=>$c);

		fputcsv($output, $rows);
		$c++;
	}

}


}
?>