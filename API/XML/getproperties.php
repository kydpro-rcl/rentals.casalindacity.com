<?
header("Content-type: text/xml");
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



$link= new getQueries();
/*$villas = $link->showTable_r("villas", "able_r", "1", "=");*/
//$villas = $link->showTable_restrinted("villas", "able_r=1 AND wish_referal=0" ,'id');
$villas = $link->showTable_restrinted("villas", "able_r=1 AND vonline=0" ,'id');


echo '<?xml version="1.0"?>';

echo '<PropertySummary>';
//$pos = 0;
foreach ($villas as $k) {
      echo '<Property property_id="'.$k['id'].'" last_update="'.$k['date'].'" />';
}
echo '</PropertySummary>';
?>