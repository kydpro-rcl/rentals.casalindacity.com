<?php
if ($_GET['id']!=''){
//header("Content-type: text/xml");
require_once('../../booking/init.php');
	 $link= new getQueries();
	 $villa=$link->show_id($table='villas', $id=$_GET['id']);
	 $v=$villa[0];
	 /*print_r($v);
	die();*/
	
 if(($v['able_r']==1)&&($v['vonline']==0)){
	 $villa_lo=$link->show_id($table='villas_location', $id=$_GET['id']);
	 $vl=$villa_lo[0];
	 
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
		
		$directorio='../../for_rent/tor_pics/photos/villa'.$v['no'].'/full/';
	//$protocol = ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https" : "http";
	//$base_url="$protocol://" . $_SERVER['SERVER_NAME'] . dirname($_SERVER["REQUEST_URI"]);
	$fotos = dirImages($directorio);
	 
	 header("Content-type: text/xml");
	echo '<?xml version="1.0" encoding="UTF-8"?>';
	echo '<listing>';
		echo '<externalId>'.$_GET['id'].'</externalId>';
		echo '<active>true</active>';
		echo '<adContent>';
			echo '<accommodationsSummary>';
				echo '<texts>';
					echo '<text locale="en">';
						echo '<textValue>Villa, '.$v['bed'].' Bedrooms, '.$v['bath'].' Baths, (Sleeps '.($v['bed']*2).') - '.$v['no'].'</textValue>';
					echo '</text>';
				echo '</texts>';
			echo '</accommodationsSummary>';
			echo '<description>';
				echo '<texts>';
					echo '<text locale="en">';
						echo '<textValue>'.$v['head'].'</textValue>';
					echo '</text>';
				echo '</texts>';
			echo '</description>';
			echo '<headline>';
				echo '<texts>';
					echo '<text locale="en">';
						echo '<textValue>'.$v['head'].'</textValue>';
					echo '</text>';
				echo '</texts>';
			echo '</headline>';
			echo '<ownerListingStory>';
				echo '<texts>';
					echo '<text locale="en">';
						echo '<textValue>This home was purchased by our grandfather in 1963.</textValue>';
					echo '</text>';
				echo '</texts>';
			echo '</ownerListingStory>';
			echo '<propertyName>';
				echo '<texts>';
					echo '<text locale="en">';
						echo '<textValue>Oceanside Estate</textValue>';
					echo '</text>';
				echo '</texts>';
			echo '</propertyName>';
			echo '<uniqueBenefits>';
				echo '<texts>';
					echo '<text locale="en">';
						echo '<textValue>Minutes from the ocean!</textValue>';
					echo '</text>';
				echo '</texts>';
			echo '</uniqueBenefits>';
			echo '<whyPurchased>';
				echo '<texts>';
					echo '<text locale="en">';
						echo '<textValue>To provide a relaxing summer resort.</textValue>';
					echo '</text>';
				echo '</texts>';
			echo '</whyPurchased>';
			echo '<yearPurchased>2018</yearPurchased>';
		echo '</adContent>';
		echo '<featureValues>';
			echo '<featureValue>';
				echo '<count>1</count>';
				echo '<listingFeatureName>LOCATION_TYPE_BEACH</listingFeatureName>';
			echo '</featureValue>';
			echo '<featureValue>';
				echo '<count>1</count>';
				echo '<listingFeatureName>SPORTS_SAILING</listingFeatureName>';
			echo '</featureValue>';
			echo '<featureValue>';
				echo '<count>1</count>';
				echo '<listingFeatureName>CAR_RECOMMENDED</listingFeatureName>';
			echo '</featureValue>';
		echo '</featureValues>';
		echo '<location>';
			echo '<address>';
				echo '<addressLine1>Carretera Sosua-Cabarete, Entrada el Choco </addressLine1>';
				echo '<addressLine2>Sosua, Puerto Plata - Dominican Republic 57000</addressLine2>';
				echo '<city>Sosua</city>';
				echo '<stateOrProvince>Puerto Plata</stateOrProvince>';
				echo '<country>Dominican Republic</country>';
				echo '<postalCode>57000</postalCode>';
			echo '</address>';
			echo '<description>';
			echo '	<texts>';
					echo '<text locale="en">';
						echo '<textValue>Carretera Sosua-Cabarete, Entrada el Choco Sosua, Puerto Plata - Dominican Republic 57000</textValue>';
					echo '</text>';
				echo '</texts>';
			echo '</description>';
			
			if(($vl['latitude']!='')&&($vl['logitude']!='')){
				echo '<geoCode>';
					echo '<latLng>';
					echo '	<latitude>'.$vl['latitude'].'</latitude>';
					echo '	<longitude>'.$vl['logitude'].'</longitude>';
					echo '</latLng>';
				echo '</geoCode>';
			}
			
			echo '<nearestPlaces>';
				echo '<nearestPlace placeType="AIRPORT">';
					echo '<distance>7</distance>';
					echo '<distanceUnit>MILES</distanceUnit>';
					echo '<name>';
						echo '<texts>';
							echo '<text locale="en">';
								echo '<textValue>Gregorio Luperon International Airport</textValue>';
							echo '</text>';
						echo '</texts>';
					echo '</name>';
				echo '</nearestPlace>';
				echo '<nearestPlace placeType="BEACH">';
					echo '<distance>5</distance>';
					echo '<distanceUnit>MINUTES</distanceUnit>';
					echo '<name>';
						echo '<texts>';
							echo '<text locale="en">';
								echo '<textValue>Sosua Beach</textValue>';
							echo '</text>';
						echo '</texts>';
					echo '</name>';
				echo '</nearestPlace>';
			echo '</nearestPlaces>';
			echo '<otherActivities>';
				echo '<texts>';
					echo '<text locale="en">';
						echo '<textValue>24-hour front desk, complimentary travel planning/excursion booking, cable tv, private yard/pool, optional chef/spa services (fee), tennis, mini-golf (small fee), access to onsite restaurant &amp; mini-market, and our best service - for every part of your stay.</textValue>';
					echo '</text>';
				echo '</texts>';
			echo '</otherActivities>';
			echo '<showExactLocation>true</showExactLocation>';
		echo '</location>';
		echo '<images>';
			echo '<image>';
				echo '<externalId>img123</externalId>';
				echo '<title>';
					echo '<texts>';
						echo '<text locale="en">';
							echo '<textValue>The Main House</textValue>';
						echo '</text>';
					echo '</texts>';
				echo '</title>';
				echo '<uri>../../booking/'.$v['pic'].'</uri>';
			echo '</image>';
		echo '</images>';
		echo '<units>';
			echo '<unit>';
				echo '<externalId>'.$v['id'].'</externalId>';
				echo '<active>true</active>';
				echo '<area>'.$v['ft2'].'</area>';
				echo '<areaUnit>SQUARE_FEET</areaUnit>';
				echo '<bathroomDetails>';
					echo '<texts>';
						echo '<text locale="en">';
							echo '<textValue>Very large Master Bath</textValue>';
						echo '</text>';
					echo '</texts>';
				echo '</bathroomDetails>';
				echo '<bathrooms>';
				
				/*for($i=1; $i<=$v['bath']; $i++){
					echo '<bathroom>';
						echo '<amenities>';
							echo '<amenity>';
								echo '<count>1</count>';
								echo '<bathroomFeatureName>AMENITY_TOILET</bathroomFeatureName>';
							echo '</amenity>';
							echo '<amenity>';
								echo '<count>1</count>';
								echo '<bathroomFeatureName>AMENITY_JETTED_TUB</bathroomFeatureName>';
							echo '</amenity>';
						echo '</amenities>';
						echo '<name>';
							echo '<texts>';
								echo '<text locale="en">';
									echo '<textValue>Bathroom '.$i.'</textValue>';
								echo '</text>';
							echo '</texts>';
						echo '</name>';
						if($i==$v['bath']){
							echo '<note>';
								echo '<texts>';
									echo '<text locale="en">';
										echo '<textValue>Master Suite</textValue>';
									echo '</text>';
								echo '</texts>';
							echo '</note>';
						}
						echo '<roomSubType>FULL_BATH</roomSubType>';
					echo '</bathroom>';
				}*/
				
				echo '</bathrooms>';
				echo '<bedroomDetails>';
					echo '<texts>';
						echo '<text locale="en">';
							echo '<textValue>Master Suite.  Formal Suite with garden view and pool.</textValue>';
						echo '</text>';
					echo '</texts>';
				echo '</bedroomDetails>';
				echo '<bedrooms>';
				/*for($i=1; $i<=$v['bed']; $i++){
					echo '<bedroom>';
						echo '<amenities>';
							echo '<amenity>';
								echo '<count>1</count>';
								echo '<bedroomFeatureName>AMENITY_QUEEN</bedroomFeatureName>';
							echo '</amenity>';
							echo '<amenity>';
								echo '<count>1</count>';
								echo '<bedroomFeatureName>AMENITY_SLEEP_SOFA</bedroomFeatureName>';
							echo '</amenity>';
						echo '</amenities>';
						echo '<name>';
							echo '<texts>';
								echo '<text locale="en">';
									echo '<textValue>Bedroom '.$i.'</textValue>';
								echo '</text>';
							echo '</texts>';
						echo '</name>';
						if($i==$v['bed']){
							echo '<note>';
								echo '<texts>';
									echo '<text locale="en">';
										echo '<textValue>Master Suite</textValue>';
									echo '</text>';
								echo '</texts>';
							echo '</note>';
						}
						echo '<roomSubType>BEDROOM</roomSubType>';
					echo '</bedroom>';
				}*/
				echo '</bedrooms>';
				echo '<description>';
					echo '<texts>';
						echo '<text locale="en">';
							echo '<textValue>Beautiful views surround the unit.</textValue>';
						echo '</text>';
					echo '</texts>';
				echo '</description>';
				echo '<diningSeating>'.$v['capacity'].'</diningSeating>';
				echo '<featuresDescription>';
					echo '<texts>';
						echo '<text locale="en">';
							echo '<textValue>This charming home will meet all your expectations.</textValue>';
						echo '</text>';
					echo '</texts>';
				echo '</featuresDescription>';
				echo '<featureValues>';
					echo '<featureValue>';
						echo '<count>1</count>';
						echo '<unitFeatureName>AMENITIES_GARAGE</unitFeatureName>';
					echo '</featureValue>';
					echo '<featureValue>';
						echo '<count>1</count>';
						echo '<unitFeatureName>AMENITIES_INTERNET</unitFeatureName>';
					echo '</featureValue>';
				echo '</featureValues>';
				echo '<images>';
				 if ($fotos){
					 $foto_orden=0;
					foreach ($fotos AS $key => $image){
					 $foto_orden++;
						echo '<image>';
						echo '<externalId>'.$v['no'].$foto_orden.'</externalId>';
						echo '<uri>'.$directorio.$image.'</uri>';
						echo '</image>';
					}
				  }
				echo '</images>';
				echo '<loungeSeating>'.$v['capacity'].'</loungeSeating>';
				echo '<propertyType>PROPERTY_TYPE_HOUSE</propertyType>';
				echo '<registrationNumber>123456</registrationNumber>';
				echo '<representedUnits>1</representedUnits>';
				echo '<unitMonetaryInformation>';
					echo '<currency>USD</currency>';
				echo '</unitMonetaryInformation>';
				echo '<unitName>';
					echo '<texts>';
						echo '<text locale="en">';
							echo '<textValue>Villa '.$v['no'].'</textValue>';
						echo '</text>';
					echo '</texts>';
				echo '</unitName>';
			echo '</unit>';
		echo '</units>';
	echo '</listing>';
 }
}