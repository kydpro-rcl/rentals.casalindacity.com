<?php
// output headers so that the file is downloaded rather than displayed
require_once('../init.php');
$name=time();
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=PropertyTextData_'.$name.'.csv');

// create a file pointer connected to the output stream
$output = fopen('php://output', 'w');

// output the column headings
fputcsv($output, array(0=>'External_PropertyID', 
						1=>'Locale', 
						2=>'Description', 
						3=>'Summary', 
						4=>'CheckinInstructions'));

// fetch the data
$db= new getQueries;
$villas=$db->show_all($table='villas', $order='id');

foreach($villas AS $k){

$rows = array(0=>$k['id'],  
			  1=>'en-us',
			  2=>'<p>'.$k['head'].'</p><p>This villa has A/C in all rooms, BBQ outside ready for enjoying, Fully equipped Kitchen for cooking, Toaster, Coffee maker, Microwave oven, Pool, Sunbeds. We provide you with a Shuttle bus that comes on set schedule to pick you up close to your villa and drops you off in nearby Cabarete/Sosua and picks you up as well. Long term price available upon request. Any questions don\'t hesitate to ask Contact us by email reservations@casalindacity.com or call +1 809 571 1190!</p>',
			  3=>'<p>Photos and Description of the Villa '.$k['no'].', '.$k['bed'].' Bedroom, Sleeps '.($k['bed']*2).','.$k['bath'].' Bathroom</p>',
			  4=>'<p>Check in and Check out through reception.</p><p> Check in from: 15.00 - Check out: 12.00</p><p>Late Check-out can be arranged upon request for a fee.</p><p>Valid Passport or Local ID is needed at Check-In for each client, this is required by guests as well</p>');

fputcsv($output, $rows);
}
?>