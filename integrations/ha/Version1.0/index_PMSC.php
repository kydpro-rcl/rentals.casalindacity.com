<?php
header("Content-type: text/xml");
require_once('../../booking/init.php');

$link= new getQueries();
$villas = $link->showTable_restrinted("villas", "able_r=1 AND `wish_referal`='0' AND `vonline`='0'" ,'id');

$protocol = ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https" : "http";
$base_url="$protocol://" . $_SERVER['SERVER_NAME'] . dirname($_SERVER["REQUEST_URI"]);

echo '<?xml version="1.0" encoding="UTF-8"?>';
echo '<!--Sample XML file generated by XMLSpy v2016 rel. 2 sp1 (http://www.altova.com)-->';
echo '<advertisersContentIndex>';
	echo '<documentVersion>4.1</documentVersion>';
	if($villas){
		foreach($villas AS $k){
			echo '<advertiserIndexEntry>';
				echo '<advertiserAssignedId>'.$k['id'].'</advertiserAssignedId>';
				echo '<advertiserName> Villa '.$k['no'].'</advertiserName>';
				echo '<advertiserListingContentIndexUrl>'.$base_url.'/listingsIndex.php?advertiser='.$k['id'].'</advertiserListingContentIndexUrl>';
				echo '<advertiserLodgingConfigurationContentIndexUrl>'.$base_url.'/configIndex.php?advertiser='.$k['id'].'</advertiserLodgingConfigurationContentIndexUrl>';
				echo '<advertiserLodgingRateContentIndexUrl>'.$base_url.'/lodgingRatesIndex.php?advertiser='.$k['id'].'</advertiserLodgingRateContentIndexUrl>';
				echo '<advertiserUnitAvailabilityContentIndexUrl>'.$base_url.'/availabilityIndex.php?advertiser='.$k['id'].'</advertiserUnitAvailabilityContentIndexUrl>';
			echo '</advertiserIndexEntry>';
		}
	}
echo '</advertisersContentIndex>';