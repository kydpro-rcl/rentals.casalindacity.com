<?php
//============================START ACCESS RESTRICTED======================================================================
require_once('../core/config.php');
$db= new Basededatos();

//$vi = $db->checkUser($username='juan',$password='test');
$vi = $db->checkToken($token=$_GET['token']);
if(!$vi){
	die('Access denied: restricted access');
}else{
	//print_r($vi);
	$actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	$info=array('ipaddress'=>$_SERVER['REMOTE_ADDR'],
				'url_access'=>$actual_link,
				'iduser'=>$vi[0]['id'],
				'date'=>time());
	$saveVisit = $db->insert_id($info, $table='api_access');
}
//============================END ACCESS RESTRICTED======================================================================

include('include/ical_rcl.php');
include('include/SimpleICS.php');
$cal = new SimpleICS();
include 'include/ICS.php';
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