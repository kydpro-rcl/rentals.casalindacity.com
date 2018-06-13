<?
header("Content-type: text/xml");
echo '<?xml version="1.0"?>';
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
 if ($_GET['pro']){
	require_once('../../booking/init.php');
	$link= new getQueries();
	//$villas = $link->villa_forent($_GET['property_id']);
	//$villa=$villas[0];
	$pro=$link->display_table($table='promotion', $condition=" code='".trim($_GET['pro'])."' AND active='1'", $order='id');
	//$pro=$link->show_all_active($table='promotion', $order'id')
	if($pro){
		$p=$pro[0];
		echo '<Promotion>';
				echo '<ProName>'.$p['code'].'('.$p['title'].')</ProName>';
				echo '<Details>';
					echo '<Code>'.$p['code'].'</Code>';
					echo '<Type>'.$p['tipo'].'</Type>';
					echo '<PercentQty>'.$p['qty'].'</PercentQty>';
					echo '<MinDays>'.$p['min_days'].'</MinDays>';
					echo '<MaxDays>'.$p['max_days'].'</MaxDays>';
					echo '<TravelFrom>'.$p['desde'].'</TravelFrom>';
					echo '<TraveTo>'.$p['hasta'].'</TraveTo>';
					echo '<BookingFrom>'.$p['bookingfrom'].'</BookingFrom>';
					echo '<BookingTo>'.$p['bookingto'].'</BookingTo>';
				echo '</Details>';
		echo '</Promotion>';
	}else{
		die('Error: No promotion active found.');
	}
 }
?>