<?

$db= new getQueries();
$res=$db->see_occupancy_ref($_POST['ref']);
//echo $res[0]['status'];
  if  ($res[0]['status']==4){  	//send email to this cliente for tripadvisor
     echo '<p style=\'text-align:center\'><img src=\'images/home/checkout_icon2.png\' width=\'74\' height=\'89\'></p>';
	 echo '<h2 style=\'text-align:center\'>Successfully Checked Out</h2>';

    	  //enviar email de trip advisor.
       # $db= new getQueries();
       /* $cl=$db->customer($res[0]['client']);//get cliente details
         if($_POST['tripadvisor']=="yes"){
        	$tripadvisor1=sent_tripadvisor_request($cl, $_POST['ref']);
        	echo $tripadvisor1;
         }
         */


  }else{
  	 echo "<h2 style=\'text-align:center\'>invoice with checkout charge is not printed<br/><a href=\"check-out.php\">Go Back</h2>";
  }
?>