<? session_start();
if ($_SESSION['referal']['tipo']==2){
  $_GET['main']=3;   $_GET['secund']=3.2;
  require_once('init.php');
	if ($_POST){
		 // start validation
		 $name = $_POST['name'];
		 $lastname = $_POST['lastname'];
		 $passport = strtoupper($_POST['passport']);
		 $cedula = $_POST['cedula'];
		 $email = strtolower($_POST['email']);
		 $phone = $_POST['phone']; 
		 $phone2 = $_POST['phone2'];
		 $fax = $_POST['fax'];
		 $language = $_POST['language'];
		 $zip = $_POST['zip'];
		 $country = $_POST['country'];
		 $password = $_POST['password'];
		 $address = $_POST['address'];
		 $comentario = $_POST['info']; 
		 $ename = $_POST['name_emerg']; 
		 $ephone = $_POST['phone_emerg'];
		 $state=$_POST['state'];
		 $city=$_POST['city'];
			 if(!filter_var($email, FILTER_VALIDATE_EMAIL))
			  {
				$_GET['error']['email']='E-mail is not valid';
			  }else{
				$db= new getQueries();
				$result=$db->checkEmail($email);
			  if ($result[0]['email']==$email){ 
				   $_GET['error']['email']='Email already registered';
				   //send email to admin and agent
				   $body_agent='The client that your are trying to create is already in our system, please, contact us for more information.';
				   correo_agent($toemail=$_SESSION['referal']['email'], $body_agent, $type='2');
							   
				   $body_admin='This referral Agent is trying to register a client already saved in the system ('.$result[0]['id'].')';		
					
				   correo_info2($body_admin, $fromadd=$_SESSION['referal']['email'], $fromnam=$_SESSION['referal']['name']." ".$_SESSION['referal']['lastname'], $type='2', $result[0]);
			   }
			  }
			  if (!filter_var($_POST['name'], FILTER_SANITIZE_STRING)) $_GET['error']['name']='Invalid name';
			  if (!filter_var($_POST['lastname'], FILTER_SANITIZE_STRING)) $_GET['error']['lastname']='Invalid Last name';
			  if(!preg_match("#^[-A-Za-z' 'ñíÑáéóúÁÉÍÓÚ]*$#",utf8_decode($_POST['name']))) $_GET['error']['name']='Invalid name';
			  if(!preg_match("#^[-A-Za-z' 'ñíÑáéóúÁÉÍÓÚ]*$#",utf8_decode($_POST['lastname']))) $_GET['error']['lastname']='Invalid Last name';
			  if ($cedula!=''){
				 if (!validate_cedula($cedula)){  $_GET['error']['cedula']='Invalid Cedula';	}else{
						$db= new getQueries();	$result=$db->checkCedula($cedula);  if ($result[0]['cedula']==$cedula){ $_GET['error']['cedula']='Cedula already registered:'.$result[0]['id'];}
					}
				}
			if ($passport!=''){
				$db= new getQueries();	$result=$db->checkPassport($passport);  if ($result[0]['passport']==$passport){ $_GET['error']['passport']='already registered:'.$result[0]['id'];}
			}						 
		    if (!$_GET['error']){ // if not error save data
			  //introducir aqui en la base de datos
			  $db= new DB;
			  $info=array('id_commission'=>$_SESSION['referal']['id'],
						  'pass'=>$password,
						  'online'=>'2',
						  'name'=>$name,
						  'lastname'=>$lastname,
						  'email'=>$email,
						  'phone'=>$phone,
						  'phone2'=>$phone2,
						  'fax'=>$fax,
						  'cedula'=>$cedula,
						  'passport'=>$passport,
						  'language'=>$language,
						  'zip'=>$zip,
						  'address'=>$address,
						  'country'=>$country,
						  'state'=>$state,
						  'city'=>$city,
						  'info'=>$comentario,
						  'date'=>FECHA,
						  'active'=>'1',
						  'ename'=>$ename,
						  'ephone'=>$ephone,
						  'id_seller'=>$_SESSION['referal']['id']);
			  $id_inserted=$db->insert_gral($info, 'customers');
			   $info2=array('fecha'=>FECHA,
						  '	id_client'=>$id_inserted,
						  'id_sale'=>$_SESSION['referal']['id'],
						  'id_rental'=>$_SESSION['referal']['id'],
						  'active'=>'1');
				$db->insert_gral($info2, 'clients_referred');
				
				/*===========================================CONNECT TO PIPEDRIVE.COM AND SAVE INFORMATION THERE========================================*/
				
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
					
					
					
					#require_once('init.php');
					/*print_r($_SESSION['referal']);
					exit();*/
					// your API token goes here
					//$api_token = "3adf2d8f45cfef1fa9d2d5446f55e10fe3b0bc7c";/*real pipedrive account it@casalindacity.com*/
					$api_token = "67a0e024a6ab35b36fbed6ca7b962093a2082265";/*real pipedrive account tony@casalindacity.com*/
					//$api_token = "d98fa6a264ef076ed50bb61dd619a7878edf118e";/*prueba pipedrive account casalindacity@gmail.com*/ 
					 
					// main data about the organization
					$organization = array(
					 'name' => $_SESSION['referal']['name'].' '.$_SESSION['referal']['lastname'], 
					 'address' => '' 
					);
					 
					// main data about the person. org_id is added later dynamically
					$person = array(
					 'name' => $name.' '.$lastname, 
					 'email' => $email, 
					 'phone' => $phone 
					);
					 
					// main data about the deal. person_id and org_id is added later dynamically
					$deal = array(
					 'title' => 'AP - '.$name.' '.$lastname,
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
					   //echo "Deal was added successfully!";
					  }
					 } else {
					  echo "There was a problem with adding the person!";
					 }
					 
					} else {
					 echo "There was a problem with adding the organization!";
					}
				
				
				
				/*===========================================END SAVING INFO INTO PIPEDRIVE =============================================================*/
			  //send email to admin and 
			   $body_agent='Your client has been created in our system, please, contact us if you need more information.';
			   correo_agent($toemail=$_SESSION['referal']['email'], $body_agent);			   			   
			   
			   $body_admin='This referal Agent has created a new client ('.$id_inserted.').\n';
				$body_admin .= "Client Details\n";
				$body_admin .= "Name: ".$name." $lastname\n";
				$body_admin .= "Email: ".$email."\n\n";
				$body_admin .= "id: ".$id_inserted."\n";
				
			   correo_info($body_admin, $fromadd=$_SESSION['referal']['email'], $fromnam=$_SESSION['referal']['name']." ".$_SESSION['referal']['lastname'], $type='1');
			   
			  $_GET['done']=1;
		   }
	}
  dibujar('new_client');
}else{
	header('Location:login.php');
	die();
}
?>