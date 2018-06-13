<?php
// output headers so that the file is downloaded rather than displayed
require_once('../init.php');
$name=time();
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=PropertyDataGeneral_'.$name.'.csv');

// create a file pointer connected to the output stream
$output = fopen('php://output', 'w');

// output the column headings
fputcsv($output, array(0=>'External_PropertyID', 
						1=>'Status', 
						2=>'Headline', 
						3=>'Bedrooms', 
						4=>'Bathrooms', 
						5=>'GarageSpaces', 
						6=>'ParkingSpaces', 
						7=>'MinStay', 
						8=>'YearBuilt', 
						9=>'AdjLivingSpace', 
						10=>'LotSize', 
						11=>'Stories', 
						12=>'Sleeps', 
						13=>'Floor', 
						14=>'HideAvailability', 
						15=>'IsBookable', 
						16=>'AvailableOnline', 
						17=>'Address1', 
						18=>'Address2', 
						19=>'City', 
						20=>'State', 
						21=>'PostalCode', 
						22=>'Country', 
						23=>'Neighborhood', 
						24=>'Latitude', 
						25=>'Longitude', 
						26=>'Development', 
						27=>'Type'));

// fetch the data
$db= new getQueries;
$villas=$db->show_all($table='villas', $order='id');

foreach($villas AS $k){

if($k['able_r']=='1'){
	$bookable='VERDADERO';
	$AvailableOnline='VERDADERO';
	$status='Active For Rent';
}else{
	$bookable='FALSO';
	$AvailableOnline='FALSO';
	$status='Inactive';
}

$rows = array(0=>$k['id'], 
			  1=>$status, 
			  2=>'Villa '.$k['no'].' - '.$k['bed'].' bedrooms', 
			  3=>$k['bed'], 
			  4=>$k['bath'], 
			  5=>'0', 
			  6=>'1', 
			  7=>'2', 
			  8=>'0', 
			  9=>$k['ft2'], 
			  10=>'0', 
			  11=>'0', 
			  12=>$k['bed']*2, 
			  13=>'1', 
			  14=>'FALSO', 
			  15=>$bookable, /*if it is for rent verdadero*/
			  16=>$AvailableOnline, /*if it is for rent verdadero*/
			  17=>'Carretera Sosua-Cabarete, Entrada el Choco', 
			  18=>'', 
			  19=>'Sosua/Cabarete', 
			  20=>'Puerto Plata', 
			  21=>'57000', 
			  22=>'Dominican Republic', 
			  23=>'', 
			  24=>'19.771581', 
			  25=>'-70.491666', 
			  26=>'Residencial Casa Linda', 
			  27=>'Villa');
//$rows2 = array('4','5','6');
//$rows3 = array(date('l jS \of F Y h:i:s A'), date('l jS \of F Y h:i:s A',$name), $name);

// loop over the rows, outputting them
fputcsv($output, $rows);
}
//fputcsv($output, $rows2);
//fputcsv($output, $rows3);
?>