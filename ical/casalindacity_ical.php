<?php
include('ical_rcl.php');
include('SimpleICS.php');
$cal = new SimpleICS();
include 'ICS.php';
$dom = new DOMDocument;
$dom->load('http://rentals.casalindacity.com/flipkey/getavailability.php?property_id='.$_GET['property_id']);
//$dom->load('http://localhost/rentals.casalindacity.com/flipkey/getavailability.php?property_id='.$_GET['property_id']);
$start = $dom->getElementsByTagName('ArrivalDate');
$end = $dom->getElementsByTagName('DepartureDate');
$x=0;
header('Content-type: text/calendar; charset=utf-8');
header('Content-Disposition: attachment; filename=Villa'.$_GET['property_id'].'.ics');
echo ical_header();
foreach ($start as $start) {
 $ini=date('Ymd\THis\Z', strtotime($start->nodeValue."3:00PM")); //echo "<br/>";
 $ter=date('Ymd\THis\Z', strtotime($end[$x]->nodeValue."1:00PM")); //echo "<br/>";
 echo ical_event($ini,$ter,$v_id=$_GET['property_id']);
 $x++;
}
echo ical_footer();
?>