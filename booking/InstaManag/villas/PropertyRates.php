<?php
// output headers so that the file is downloaded rather than displayed
require_once('../init.php');
$name=time();
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=PropertyRates_'.$name.'.csv');

// create a file pointer connected to the output stream
$output = fopen('php://output', 'w');

// output the column headings
fputcsv($output, array(0=>'External_PropertyID', 
						1=>'StartDate', 
						2=>'EndDate', 
						3=>'LengthOfStay', 
						4=>'Value'));

// fetch the data
$db= new getQueries;
$villas=$db->show_all($table='villas', $order='id');

foreach($villas AS $k){

$rows = array( 0=>$k['id'],  
				1=>'12/1/2015  12:00:00 AM',
				2=>'4/30/2015  12:00:00 AM',
				3=>'1',
				4=>$k['p_high']);
$rows2 = array( 0=>$k['id'],  
				1=>'12/1/2015  12:00:00 AM',
				2=>'4/30/2015  12:00:00 AM',
				3=>'7',
				4=>(($k['p_high']*0.93)*7));
$rows3 = array( 0=>$k['id'],  
				1=>'12/1/2015  12:00:00 AM',
				2=>'4/30/2015  12:00:00 AM',
				3=>'30',
				4=>(($k['p_high']*0.70)*30));	

$rows4 = array( 0=>$k['id'],  
				1=>'5/1/2014  12:00:00 AM',
				2=>'11/30/2014  12:00:00 AM',
				3=>'1',
				4=>$k['p_low']);
$rows5 = array( 0=>$k['id'],  
				1=>'5/1/2014  12:00:00 AM',
				2=>'11/30/2014  12:00:00 AM',
				3=>'7',
				4=>(($k['p_low']*0.93)*7));	
$rows6 = array( 0=>$k['id'],  
				1=>'5/1/2014  12:00:00 AM',
				2=>'11/30/2014  12:00:00 AM',
				3=>'30',
				4=>(($k['p_low']*0.70)*30));					

fputcsv($output, $rows);
fputcsv($output, $rows2);
fputcsv($output, $rows3);
fputcsv($output, $rows4);
fputcsv($output, $rows5);
fputcsv($output, $rows6);

}
?>