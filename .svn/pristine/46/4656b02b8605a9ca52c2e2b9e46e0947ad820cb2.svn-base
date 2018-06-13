<?php
// output headers so that the file is downloaded rather than displayed
require_once('../init.php');
$name=time();
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=PropertyDataAmenities_'.$name.'.csv');

// create a file pointer connected to the output stream
$output = fopen('php://output', 'w');

// output the column headings
fputcsv($output, array(0=>'External_PropertyID', 
						1=>'Amenities'));

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
			  1=>$k['bed'].' Bedrooms,Wi-Fi,Available for long term,Outdoor Pool,Stove/Oven,Patio Furniture,King Bed,Iron/Board,Dining and Livingroom,Double Bed,Gas BBQ,Air Conditioning,Deck or Balcony,Microwave,Gas Grill,Cable/Sattelite,Pool Access,View,DVD or VCR,Satellite,DVD Player,Stereo System,Pool,Golf Nearby,BBQ,Swimming Pool,Stereo or CD,Shuttle,Coffeemaker,BBQ Grill,Patio,Pool View,DVD,TV,Linens Provided,Private Pool,A/C,Daily Maidservice,Pool and Garden Service,Airconditioner,Air Conditioner');

fputcsv($output, $rows);
}
?>