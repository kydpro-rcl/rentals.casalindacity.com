<?php
	$q=$_GET["q"];

	if (strlen($q)>0){
		require_once('inc/init.php');
		
		$db= new getQueries();
		$result=$db->search_villas_online($query=$q, $field="no");

		$hint="";
		  if($result){
		   foreach($result AS $k){
			$hint.="<a href='villa-details.php?v=".$k['id']."'> Villa ".$k['no']." (".$k['bed']." bedrooms)</a><br/>";
		   }
		  }
	}

	// Set output to "no suggestion" if no hint were found
	// or to the correct values
	if ($hint=="")
	  {
	  $response="<span style='color:red'>No properties found</span>";
	  }
	else
	  {
	  $response=$hint;
	  }

	//output the response
	echo $response;
	?>