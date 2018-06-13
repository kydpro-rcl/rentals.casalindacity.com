<?
header("Content-type: text/xml");
require_once('../booking/init.php');
$link= new getQueries();
/*$villas = $link->showTable_r("villas", "able_r", "1", "=");*/
$villas = $link->showTable_restrinted("villas", "able_r=1 AND wish_referal=0" ,'id');

echo '<?xml version="1.0"?>';

echo '<PropertySummary>';
//$pos = 0;
foreach ($villas as $k) {
      echo '<Property property_id="'.$k['id'].'" last_update="'.$k['date'].'" />';
}
echo '</PropertySummary>';
?>