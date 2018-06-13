<?php
$row = 1;
if (($handle = fopen("services.csv", "r")) !== FALSE) {
	$this_line=array();
	$datainfo=array();
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        #$num = count($data);
		if($row!=1){//skip first row as it is header
			$this_line=array('VILLAID'=>$data[0],
							  'VILLANO'=>$data[1],
							  'SUBDIVISION'=> $data[2],
							  'POOLGARDEN'=>$data[3],
							  'MAIDS'=>$data[4],
							  'WIFI'=>$data[5],
							  'CABLE'=>$data[6],
							  'WATER'=>$data[7],
							  'ELECTRICITY'=>$data[8],
							  'ADMIN'=>$data[9],
							  'ACCOUNTING'=>$data[10],
							  'RENTAL'=>$data[11],
							  'WAIVER'=>$data[12],
							  'GUARANTEE'=>$data[13],
							  'SPECIAL'=>$data[14],
							  'INSURANCE'=>$data[15],
							  'OTHER'=>$data[16]);
			array_push($datainfo, $this_line);
		}
		 $row++;
    }
    fclose($handle);
}else{
	echo "no se pudo obtener el contenido";
}
//echo "<pre>";
//print_r($datainfo);
//echo "</pre>";
require_once('init.php');
$db= new subDB();
		
if($datainfo){
	
	foreach($datainfo AS $k){
		//echo $k['VILLANO'];
		//echo "<br/>";
		$fields=array('villa_id'=>$k['VILLAID'],
			  'pool_garden'=>$k['POOLGARDEN'],
			  'maid'=>$k['MAIDS'],
			  'wifi'=>$k['WIFI'],
			  'cable'=>$k['CABLE'],
			  'electricity'=>$k['ELECTRICITY'],
			  'admin_fee'=>$k['ADMIN'],
			  'acc_fee'=>$k['ACCOUNTING'],
			  'agr_rental'=>$k['RENTAL'],
			  'agr_waiver'=>$k['WAIVER'],
			  'agr_rent_gua'=>$k['GUARANTEE'],
			  'agr_special'=>$k['SPECIAL'],
			  'insurance'=>$k['INSURANCE'],
			  'agr_other'=>$k['OTHER']);
			$table='villa_services_contracted';
			$db->insert_id($fields, $table);
			
			$table2='villas';
			$fields2=array('maintenance'=>$k['SUBDIVISION'], 'water_long'=>$k['WATER']);
			$db->update($id=$k['VILLAID'], $fields2, $table2);
	}
}	
	
?>