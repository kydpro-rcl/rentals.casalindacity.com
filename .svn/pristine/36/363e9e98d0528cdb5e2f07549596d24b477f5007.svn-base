<?
header("Content-type: text/xml");

echo '<?xml version="1.0"?>';
require_once('../booking/init.php');

//$_GET['property_id']='22';
 if ($_GET['property_id']){ $link= new getQueries();
 $bookings=$link->availability_flipkey($_GET['property_id']); 	echo '<Availability>';
 		echo '<BookedStays property_id="'.$_GET['property_id'].'">';
 	foreach ($bookings as $k) {
			echo '<BookedStay>';
				echo '<ArrivalDate>'.$k['start'].'</ArrivalDate>';
				echo '<DepartureDate>'.$k['end'].'</DepartureDate>';
			echo '</BookedStay>';
	}
		echo '</BookedStays>';
	echo '</Availability>';
 }

?>



