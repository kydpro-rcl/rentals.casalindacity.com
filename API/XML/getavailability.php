<?
header("Content-type: text/xml");

echo '<?xml version="1.0"?>';
require_once('../../booking/init.php');
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

//$_GET['property_id']='22';
 if ($_GET['property_id']){
 $link= new getQueries();
 $bookings=$link->availability_flipkey($_GET['property_id']);
 	echo '<Availability>';
 		echo '<BookedStays property_id="'.$_GET['property_id'].'">';
 	foreach ($bookings as $k) {
			echo '<BookedStay>';
				echo '<ArrivalDate>'.$k['start'].'</ArrivalDate>';
				echo '<DepartureDate>'.$k['end'].'</DepartureDate>';
			echo '</BookedStay>';
	}
		echo '</BookedStays>';
	echo '</Availability>';

 }

?>



