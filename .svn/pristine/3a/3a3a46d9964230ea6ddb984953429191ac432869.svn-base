<?php
require_once('inc/session.php');
if ($_SESSION['info']){
	//require_once('template/print_clients.php');
	require_once('init.php');

$data= new getQueries ();

$customers=$data->show_all('customers', 'lastname');
//$total_records=$data->getAffectedRows();
$list = array (
				array(	'LastName', 
						'FirstName', 
						'Title', 
						'Email', 
						'Phone 1', 
						'Street Address 1', 
						'City', 
						'State', 
						'PostalCode', 
						'Country',
						'Company',
						'Lead Source',
						'Contact Notes',
						'Person Type',
						'Website',
						'Tags')
		);
//$stack = array("orange", "banana");
//array_push($stack, "apple", "raspberry");
/*echo "<pre>";
print_r($customers);
echo "</pre>";*/
	
foreach ($customers AS $k){
	$booked=$data->occupancy_customer_3($k['id']);
 if($k['email']!=''){
	$personType='';	
	if($booked){
		/*echo "<pre>";
		print_r($booked);
		echo "</pre>";*/	
		foreach($booked AS $b){
			if($b['nights']<5){
				if (strpos($personType,'Renter - Short Term') !== false) {
					//echo 'true';
				}else{
					if($personType!=''){$personType.=',';}
					$personType.='Renter - Short Term';	
				}
			}elseif(($b['nights']>5) && ($b['nights']<14)){
				
				if (strpos($personType,'Renter - Mid Term') !== false) {
					//echo 'true';
				}else{
					if($personType!=''){$personType.=',';}
					$personType.='Renter - Mid Term';
				}
				
			}elseif($b['nights']>14){
				if (strpos($personType,'Renter - Long Term') !== false) {
					//echo 'true';
				}else{
					if($personType!=''){$personType.=',';}
					$personType.='Renter - Long Term';
				}
			}else{
				if (strpos($personType,'Renter - Short Term') !== false) {
					//echo 'true';
				}else{
					if($personType!=''){$personType.=',';}
					$personType.='Renter - Short Term';	
				}
			}
			//$b['status']
		}
		
		$tags='Renter';	
	}else{
		$tags='Renter';	
		$personType='Prospect';	
	}

	$list[]=array(	$k['lastname'], 
					$k['name'], 
					'Mr.', 
					$k['email'], 
					$k['phone'], 
					$k['address'], 
					$k['city'], 
					$k['state'], 
					$k['zip'], 
					$k['country'], 
					'', 
					'Internal Lead', 
					'', 
					$personType, 
					'', 
					$tags);
 }
}
$agents=$data->show_all('commission', 'lastname');
/*echo "<pre>";
print_r($agents);
echo "</pre>";*/
foreach ($agents AS $k){
	
		switch($k['tipo']){
			case 0: $personType='Agent - Referral';	
					$tags='Referral';	
					break;
			case 1: $personType='Agent - Referral';	
					$tags='Referral';	
					break;
			case 2: $personType='Agent - Real Estate';	
					$tags='Real Estate';	
					break;
			case 3: $personType='Agent - Booking';	
					$tags='Referral';	
					break;
		}
	//$personType='Agent - Real Estate, Agent - Booking, Agent - Referral';	
	//$tags='Referral, Real Estate';	
	$list[]=array(	$k['lastname'], 
					$k['name'], 
					'Mr./Ms.', 
					$k['email'], 
					$k['phone'], 
					$k['address'], 
					$k['city'], 
					$k['state'], 
					$k['zip'], 
					$k['country'], 
					'', 
					'Internal Lead', 
					'', 
					$personType, 
					'', 
					$tags);
}
$owners=$data->show_all('owners', 'lastname');
/*echo "<pre>";
print_r($owners);
echo "</pre>";*/
foreach ($owners AS $k){
	if($k['active']==1){ $tags='Owner - Active';	}else{ $tags='Owner - Inactive';}
	$personType='Owner';	
	
	$list[]=array(	$k['lastname'], 
					$k['name'], 
					'Mr./Ms.', 
					$k['email'], 
					$k['phone'], 
					$k['address'], 
					$k['city'], 
					$k['state'], 
					$k['zip'], 
					$k['country'], 
					'', 
					'Internal Lead', 
					$k['info'], 
					$personType, 
					'', 
					$tags);
}


$fp = fopen($filename='csv/clients'.date('YmdGis').'.csv', 'w');

foreach ($list as $fields) {
    fputcsv($fp, $fields);
}

fclose($fp);
/*==============================BUILD THE LINKS TO DOWNLOAD================*/
print 'Right-click on the link below and select "Save as":' . '<br/><br/>';
print 'Download File: <a href="'.$filename.'" target="_blank">Download Link</a>'; 
}
?>