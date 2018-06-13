<?php
/*
 //Import uploaded file to Database
    //$handle = fopen($_FILES['filename']['tmp_name'], "r");
	$handle = fopen('services.csv', "r");
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        //$import="INSERT into importing(text,number)values('$data[0]','$data[1]')";

        //mysql_query($import) or die(mysql_error());
    }
	echo $data;
	*/
	$row = 1;
if (($handle = fopen("services.csv", "r")) !== FALSE) {
	/*$data = fgetcsv($handle, 1000, ",");
	echo "<pre>";
	print_r($data);
	echo "</pre>";*/
	$this_line=array();
	$datainfo=array();
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $num = count($data);
		
        #echo "<p> $num fields in line $row: <br /></p>\n";
       
        #for ($c=0; $c < $num; $c++) {
          #  echo $data[$c] . "<br />\n";
			
       # }
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

echo "<pre>";
	print_r($datainfo);
	echo "</pre>";
?>