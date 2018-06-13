<?php
session_start();
if ($_SESSION['referal']){
	//create_person($api_token, $person);
	//create_deal($api_token, $deal);
	 
	function create_organization($api_token, $organization)
	{
	 $url = "https://api.pipedrive.com/v1/organizations?api_token=" . $api_token;
	 
	 $ch = curl_init();
	 curl_setopt($ch, CURLOPT_URL, $url);
	 curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	 curl_setopt($ch, CURLOPT_POST, true);
	 
	 curl_setopt($ch, CURLOPT_POSTFIELDS, $organization);
	 $output = curl_exec($ch);
	 $info = curl_getinfo($ch);
	 curl_close($ch);
	 // create an array from the data that is sent back from the API
	 $result = json_decode($output, 1);
	 // check if an id came back
	 if (!empty($result['data']['id'])) {
	  $org_id = $result['data']['id'];
	  return $org_id;
	 } else {
	  return false;
	 }
	}
	 
	function create_person($api_token, $person)
	{
	 $url = "https://api.pipedrive.com/v1/persons?api_token=" . $api_token;
	 
	 $ch = curl_init();
	 curl_setopt($ch, CURLOPT_URL, $url);
	 curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	 curl_setopt($ch, CURLOPT_POST, true);
	 
	 curl_setopt($ch, CURLOPT_POSTFIELDS, $person);
	 $output = curl_exec($ch);
	 $info = curl_getinfo($ch);
	 curl_close($ch);
	 
	 // create an array from the data that is sent back from the API
	 $result = json_decode($output, 1);
	 // check if an id came back
	 if (!empty($result['data']['id'])) {
	  $person_id = $result['data']['id'];
	  return $person_id;
	 } else {
	  return false;
	 }
	}
	 
	function create_deal($api_token, $deal)
	{
	 $url = "https://api.pipedrive.com/v1/deals?api_token=" . $api_token;
	 
	 $ch = curl_init();
	 curl_setopt($ch, CURLOPT_URL, $url);
	 curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	 curl_setopt($ch, CURLOPT_POST, true);
	 
	 curl_setopt($ch, CURLOPT_POSTFIELDS, $deal);
	 $output = curl_exec($ch);
	 $info = curl_getinfo($ch);
	 curl_close($ch);
	 
	 // create an array from the data that is sent back from the API
	 $result = json_decode($output, 1);
	 // check if an id came back
	 if (!empty($result['data']['id'])) {
	  $deal_id = $result['data']['id'];
	  return $deal_id;
	 } else {
	  return false;
	 }
	}
	
	
	
	require_once('init.php');
	/*print_r($_SESSION['referal']);
	exit();*/
	// your API token goes here
	//$api_token = "3adf2d8f45cfef1fa9d2d5446f55e10fe3b0bc7c";/*real pipedrive account*/
	$api_token = "d98fa6a264ef076ed50bb61dd619a7878edf118e";/*prueba pipedrive account*/ 
	 
	// main data about the organization
	$organization = array(
	 'name' => $_SESSION['referal']['name'].' '.$_SESSION['referal']['lastname'], 
	 'address' => '' 
	);
	 
	// main data about the person. org_id is added later dynamically
	$person = array(
	 'name' => 'Tony Fring', 
	 'email' => 'tony@lospolloshermanos.com', 
	 'phone' => '555-818-1234' 
	);
	 
	// main data about the deal. person_id and org_id is added later dynamically
	$deal = array(
	 'title' => 'AP - client name',
	 'value' => '' 
	);
	 $link= new getQueries();
	 // look in db about this agent for updated organization id instead using the session variable which may content no updated content.
	 $new_search_id=$link->show_any_data_limit1('commission', 'id', $_SESSION['referal']['id'], '=');
	// try adding an organization and get back the ID
	if($new_search_id[0]['organization_id']==''){
		$org_id = create_organization($api_token, $organization);
		//guardar organization id para este referral
		
		if ($org_id) {/* if organization created save the id on this agent*/
		 $db= new DB;
		 $info=array('organization_id'=>$org_id);
	     $db->update_gral($id=$_SESSION['referal']['id'], $info, $table='commission');/*update the agent organization id for this broker*/
		}
	}else{
		$org_id =$new_search_id[0]['organization_id'];/*give this organization belonging id*/
	}
	// if the organization was added successfully add the person and link it to the organization
	if ($org_id) {
	 $person['org_id'] = $org_id;
	 // try adding a person and get back the ID
	 $person_id = create_person($api_token, $person);
	 
	 // if the person was added successfully add the deal and link it to the organization and the person
	 if ($person_id) {
	 
	  $deal['org_id'] = $org_id;
	  $deal['person_id'] = $person_id;
	  // try adding a person and get back the ID
	  $deal_id = create_deal($api_token, $deal);
	 
	  if ($deal_id) {
	   echo "Deal was added successfully!";
	  }
	 } else {
	  echo "There was a problem with adding the person!";
	 }
	 
	} else {
	 echo "There was a problem with adding the organization!";
	}
	 
	
}else{
	echo "Error: no logged in.";
}
?>