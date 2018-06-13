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
 if ($_GET['property_id']){
	function dirImages($dir) {
				$d = dir($dir); //Open Directory
				while (false!== ($file = $d->read())) //Reads Directory
				{
				$extension = substr($file, strrpos($file, '.')); // Gets the File Extension
				if($extension == ".jpg" || $extension == ".JPG" || $extension == ".jpeg" || $extension == ".gif" |$extension == ".png") // Extensions Allowed
				$images[$file] = $file; // Store in Array
				}
				$d->close(); // Close Directory
				@asort($images); // Sorts the Array

				return $images; //Author: ActiveMill.com
			}


	require_once('../../booking/init.php');
	$link= new getQueries();
	$villas = $link->villa_forent($_GET['property_id']);
	$villa=$villas[0];
	$season=$link->seasons3(); //temporadas informations
	//$temporada=$season[0];
	$directorio='../../for_rent/tor_pics/photos/villa'.$villa['no'].'/full/';
	/*echo "<pre>";
	print_r($villa);
	echo "</pre>";   */

	$fotos = dirImages($directorio);

	echo '<Property property_id="'.$villa['id'].'" last_update="'.$villa['date'].'">';
			echo '<PropertyName>Villa-'.$villa['no'].'</PropertyName>';
			echo '<Address>';
				echo '<Address1>Carretera Sosua-Cabarete, Entrada el Choco</Address1>';
				echo '<Address2></Address2>';
				echo '<City>Cabarete</City>';
				echo '<State>Puerto Plata</State>';
				echo '<ZipCode>57000</ZipCode>';
				echo '<Country>Dominican Republic</Country>';
				echo '<Latitude>19.771168</Latitude>';
				echo '<Longitude>-70.491366</Longitude>';
			echo '</Address>';
			echo '<Details>';
				echo '<MaximumOccupancy>'.($villa['bed']*2).'</MaximumOccupancy>';
				echo '<PropertyType type="villa"></PropertyType>';
				echo '<Bedrooms count="'.$villa['bed'].'">';
					for($i=1; $i<=$villa['bed']; $i++){
					echo '<Bedroom king="0" queen="1" full="0" twin="0" bunk="0" other="0"></Bedroom>';
					//echo '<Bedroom king="0" queen="0" full="0" twin="0" bunk="0" other="0"></Bedroom>';
					}
				echo '</Bedrooms>';

				echo '<Bathrooms count="'.$villa['bath'].'">';
	 			for($i=1; $i<=$villa['bath']; $i++){
					echo '<Bathroom full="1" half="0" shower="0"></Bathroom>';
					//echo '<Bathroom full="0" half="0" shower="0"></Bathroom>';
				}
				echo '</Bathrooms>';
					echo '<MinimumStayLength>2</MinimumStayLength>';
					echo '<CheckIn>15:00:00</CheckIn>';
					echo '<CheckOut>12:00:00</CheckOut>';
					echo '<Currency>USD</Currency>';
					echo '<UnitSize units="meters">'.$villa['m2'].'</UnitSize>';
			echo '</Details>';
			echo '<Descriptions>';
				echo '<PropertyHeadline>'.$villa['headline'].'</PropertyHeadline>';
				echo '<PropertyDescription>'.htmlentities($villa['head']).'</PropertyDescription>';
			//	echo '<RateDescription></RateDescription>';
				echo '<LocationDescription>
								
				</LocationDescription>';
			echo '</Descriptions>';
			echo '<Suitability>';
				echo '<Pets value="no" />';
				echo '<Smoking value="no" />';
				echo '<HandicapAccessible value="yes" />';
				echo '<ElderlyAccessible value="yes" />';
				echo '<Children value="yes" />';
			echo '</Suitability>';
			echo '<Amenities>';
				echo '<Amenity order="1">Parking</Amenity>';
				echo '<Amenity order="2">Private Pool</Amenity>';
				echo '<Amenity order="3">Air conditioners</Amenity>';
				echo '<Amenity order="4">Internet Access</Amenity>';
				echo '<Amenity order="5">TV/Cable</Amenity>';
				echo '<Amenity order="6">Laundry</Amenity>';
				echo '<Amenity order="7">Maid Service</Amenity>';
				echo '<Amenity order="8">On Site Chef</Amenity>';
				echo '<Amenity order="9">Filled Fridge</Amenity>';
				echo '<Amenity order="10">Nearby Beaches</Amenity>';
				echo '<Amenity order="11">24 hours electricity</Amenity>';
				echo '<Amenity order="12">24/7 Security</Amenity>';
			echo '</Amenities>';
			echo '<Photos src_base="https://www.rentals.casalindacity.com/API/XML/">';
			 if ($fotos){
				 $foto_orden=0;
				foreach ($fotos AS $key => $image){
				 $foto_orden++;
				echo '<Photo order="'.$foto_orden.'">';
				echo '<URL>'.$directorio.$image.'</URL>';
				//echo '<Description></Description>';
				echo '</Photo>';
				}
			  }
			echo '</Photos>';
			echo '<Rates>';
				echo '<Rate>';
					echo '<Label>None-Peak Season</Label>';
					foreach($season AS $k){
						if($k['type']==1){
						echo '<StartDate>'.date('Y')."-".str_pad($k['start_mont'],  2, 0, STR_PAD_LEFT)."-".str_pad($k['start_day'],  2, 0, STR_PAD_LEFT).'</StartDate>';
						echo '<EndDate>'.date('Y')."-".str_pad($k['end_mont'],  2, 0, STR_PAD_LEFT)."-".str_pad($k['end_day'],  2, 0, STR_PAD_LEFT).'</EndDate>';
						}
					}
					//echo '<EndDate>'.$temporada['l_ending'].'</EndDate>';
					echo '<DailyMinRate>'.$villa['p_low'].'</DailyMinRate>';
					echo '<DailyMaxRate>'.$villa['p_low'].'</DailyMaxRate>';
					/*echo '<DailyWeeknightRate></DailyWeeknightRate >';
					echo '<DailyWeekendRate></DailyWeekendRate >';
					echo '<WeeklyMinRate></WeeklyMinRate>';
					echo '<WeeklyMaxRate></WeeklyMaxRate>';
					echo '<MonthlyMinRate></MonthlyMinRate>';
					echo '<MonthlyMaxRate></MonthlyMaxRate>';*/
					echo '<MinimumStayLength>2 Nights</MinimumStayLength>';
					/*echo '<TurnDay></TurnDay>';*/
				echo '</Rate>';
				echo '<Rate>';
					echo '<Label>Shoulder Season</Label>';
					foreach($season AS $k){
						if($k['type']==2){
						echo '<StartDate>'.date('Y')."-".str_pad($k['start_mont'],  2, 0, STR_PAD_LEFT)."-".str_pad($k['start_day'],  2, 0, STR_PAD_LEFT).'</StartDate>';
						echo '<EndDate>'.date('Y')."-".str_pad($k['end_mont'],  2, 0, STR_PAD_LEFT)."-".str_pad($k['end_day'],  2, 0, STR_PAD_LEFT).'</EndDate>';
						}
					}
					echo '<DailyMinRate>'.$villa['p_shoulder'].'</DailyMinRate>';
					echo '<DailyMaxRate>'.$villa['p_shoulder'].'</DailyMaxRate>';
					echo '<MinimumStayLength>2 Nights</MinimumStayLength>';
				echo '</Rate>';
				echo '<Rate>';
					echo '<Label>Peak Season</Label>';
					foreach($season AS $k){
						if($k['type']==3){
						echo '<StartDate>'.(date('Y')-1)."-".str_pad($k['start_mont'],  2, 0, STR_PAD_LEFT)."-".str_pad($k['start_day'],  2, 0, STR_PAD_LEFT).'</StartDate>';
						echo '<EndDate>'.date('Y')."-".str_pad($k['end_mont'],  2, 0, STR_PAD_LEFT)."-".str_pad($k['end_day'],  2, 0, STR_PAD_LEFT).'</EndDate>';
						}
					}
					echo '<DailyMinRate>'.$villa['p_high'].'</DailyMinRate>';
					echo '<DailyMaxRate>'.$villa['p_high'].'</DailyMaxRate>';
					echo '<MinimumStayLength>2 Nights</MinimumStayLength>';
				echo '</Rate>';
			echo '</Rates>';
			echo '<Fees>';
				echo '<Fee required="yes">';
					echo '<Name>Government Tax</Name>';
					//echo '<Description></Description>';
					echo '<Cost type="percent">18</Cost>';
					echo '<FeeType type="tax" />';
				echo '</Fee>';
			echo '</Fees>';
	echo '</Property>';
 }
?>