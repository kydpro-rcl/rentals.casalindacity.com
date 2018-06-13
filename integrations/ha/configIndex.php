<?php
if ($_GET['advertiser']!=''){
header("Content-type: text/xml");
require_once('../../booking/init.php');

 //$link= new getQueries();
 //$bookings=$link->availability_flipkey($_GET['property_id']);
 
 $protocol = ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https" : "http";
	$base_url="$protocol://" . $_SERVER['SERVER_NAME'] . dirname($_SERVER["REQUEST_URI"]);
	
	 $link= new getQueries();
	 $villa=$link->show_id($table='villas', $id=$_GET['advertiser']);
	 $v=$villa[0];
 
echo '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>';
echo '<advertiserLodgingConfigurationContentIndex>';
	echo '<documentVersion>4.1</documentVersion>';
	echo '<advertiser>';
		echo '<assignedId>'.$_GET['advertiser'].'</assignedId>';
		echo '<lodgingConfigurationDefaults>';
			echo '<acceptedPaymentForms>';
				echo '<paymentCardDescriptor>';
					echo '<paymentFormType>CARD</paymentFormType>';
					echo '<cardCode>MASTERCARD</cardCode>';
					echo '<cardType>CREDIT</cardType>';
				echo '</paymentCardDescriptor>';
				echo '<paymentCardDescriptor>';
					echo '<paymentFormType>CARD</paymentFormType>';
					echo '<cardCode>VISA</cardCode>';
					echo '<cardType>CREDIT</cardType>';
				echo '</paymentCardDescriptor>';
				echo '<paymentCardDescriptor>';
					echo '<paymentFormType>CARD</paymentFormType>';
					echo '<cardCode>VISA_ELECTRON</cardCode>';
					echo '<cardType>DEBIT</cardType>';
				echo '</paymentCardDescriptor>';
			echo '</acceptedPaymentForms>';
			echo '<bookingPolicy>';
				echo '<policy>INSTANT</policy>';
			echo '</bookingPolicy>';
			echo '<cancellationPolicy>';
				echo '<policy>Firm</policy>';
			echo '</cancellationPolicy>';
			echo '<checkInTime>15:00</checkInTime>';
			echo '<checkOutTime>12:00</checkOutTime>';
			echo '<childrenAllowedRule>';
				echo '<allowed>true</allowed>';
			echo '</childrenAllowedRule>';
			echo '<eventsAllowedRule>';
				echo '<allowed>true</allowed>';
			echo '</eventsAllowedRule>';
			echo '<lastUpdatedDate>'.gmdate("Y-m-d\TH:i:s").'+01:00</lastUpdatedDate>';
			echo '<locale>en</locale>';
			echo '<maximumOccupancyRule>';
				echo '<adults>'.$v['capacity'].'</adults>';
				echo '<guests>'.$v['capacity'].'</guests>';
			echo '</maximumOccupancyRule>';
			echo '<minimumAgeRule>';
				echo '<age>18</age>';
			echo '</minimumAgeRule>';
			echo '<petsAllowedRule>';
				echo '<allowed>false</allowed>';
			echo '</petsAllowedRule>';
			echo '<pricingPolicy>';
				echo '<policy>GUARANTEED</policy>';
			echo '</pricingPolicy>';
			echo '<rentalAgreementFile>';
				echo '<rentalAgreementPdfUrl>https://rentals.casalindacity.com/vacationrentals/terms-conditions.php</rentalAgreementPdfUrl>';
			echo '</rentalAgreementFile>';
			echo '<smokingAllowedRule>';
				echo '<allowed>false</allowed>';
			echo '</smokingAllowedRule>';
		echo '</lodgingConfigurationDefaults>';
		echo '<lodgingConfigurationContentIndexEntry>';
			echo '<listingExternalId>'.$_GET['advertiser'].'</listingExternalId>';
			echo '<unitExternalId>'.$_GET['advertiser'].'</unitExternalId>';
			echo '<lastUpdatedDate>'.gmdate("Y-m-d\TH:i:s").'+01:00</lastUpdatedDate>';
			echo '<lodgingConfigurationContentUrl>'.$base_url.'/lodgingConfig.php?id='.$_GET['advertiser'].'</lodgingConfigurationContentUrl>';
		echo '</lodgingConfigurationContentIndexEntry>';
		
	echo '</advertiser>';
echo '</advertiserLodgingConfigurationContentIndex>';
}