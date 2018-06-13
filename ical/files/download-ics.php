<?php

include 'ICS.php';

header('Content-type: text/calendar; charset=utf-8');
header('Content-Disposition: attachment; filename=Villa'.$_GET['property_id'].'.ics');


//echo $ics_file_contents = $ics->to_string();

$dom = new DOMDocument;
//$dom->load('http://rentals.casalindacity.com/flipkey/getavailability.php?property_id='.$_GET['property_id']);
$dom->load('http://localhost/rentals.casalindacity.com/flipkey/getavailability.php?property_id='.$_GET['property_id']);
$start = $dom->getElementsByTagName('ArrivalDate');
$end = $dom->getElementsByTagName('DepartureDate');
$x=0;
foreach ($start as $start) {
    //echo $start->nodeValue.'<br>';
	$ics = new ICS(array(
	  'location' => "Sosua, Dominican Republic",
	  'description' => "Property id".$_GET['property_id'],
	  'dtstart' => $start->nodeValue,
	  'dtend' => $end[$x]->nodeValue,
	  'summary' => "Not available",
	  'url' => "http://casalindacity.com"
	));
$x++;
	echo $ics->to_string();
}

/*
$xmlstr = file_get_contents('http://localhost/rentals.casalindacity.com/flipkey/getavailability.php?property_id=126');
$parseXML = new SimpleXMLElement($xmlstr);
print($parseXML);*/
?>