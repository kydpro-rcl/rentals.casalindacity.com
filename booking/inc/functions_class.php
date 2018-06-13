<?
 class subDB extends DB{

   public function authenticateUser($user,$pass) {

		$authed=$this->checkUser($user,$pass);
		foreach ($authed as $authed) //to avoid say array possition zero
		return($authed['id']);

	}

	public function userDetails($uid) {

		$userDetails=$this->getUserDetails($uid);
		foreach ($userDetails as $userDetails)
		return($userDetails);

	}

	 public function authenticateCustomer($email,$pass) {

		$authed=$this->checkCustomer($email,$pass);
		foreach ($authed as $authed) //to avoid say array possition zero
		return($authed['id']);

	}

	public function customerDetails($uid) {

		$userDetails=$this->getCustomerDetails($uid);
		foreach ($userDetails as $userDetails)
		return($userDetails);

	}

	 public function authenticateReferal($email,$pass) {

		$authed=$this->checkReferal($email,$pass);
		foreach ($authed as $authed) //to avoid say array possition zero
		return($authed['id']);

	}

	public function referalDetails($rid) {

		$userDetails=$this->getReferalDetails($rid);
		foreach ($userDetails as $userDetails)
		return($userDetails);

	}

	 public function authenticateOwners($user,$pass) {

		$authed=$this->checkOwner($user,$pass);
		foreach ($authed as $authed) //to avoid say array possition zero
		return($authed['id']);

	}

	public function OwnerDetails($oid) {

		$userDetails=$this->getOwnerDetails($oid);
		foreach ($userDetails as $userDetails)
		return($userDetails);

	}

	public function insert_ocupacion_short_reserve($starting, $ending, $id_villa, $id_admin){
	 $starting_date_cutted=explode("-", $starting);
	 $yyyy=$starting_date_cutted[0];
	 $mm=$starting_date_cutted[1];
     $type=1; //1= short, 2=long, 3=maintenance
     $active=1; //canccelled if 0
     #$date=date("Y-m-d h:m:s");
	 $date=date("Y-m-d G:i:s");
     $id_update="";
     $comment="";
	$this->insert_ocupacion($starting, $ending, $type, $active, $id_villa, $id_admin, $comment, $date, $mm, $yyyy, $id_update);
	return $this->getInsertId();
	}

	public function insert_short_reserva($ref, $id_ocupacion, $id_customer, $adults_qty, $children_qty, $interm_id, $qty_nights, $HS_nights, $LS_nights, $price_per_night, $priceHS, $amount_commision, $sub_total_rent, $ITBIS, $services_amount, $deposit, $general_amount, $status, $source){


    $this->insert_reserve($ref, $id_ocupacion, $id_customer, $adults_qty, $children_qty, $interm_id, $qty_nights, $HS_nights, $LS_nights, $price_per_night, $priceHS, $amount_commision, $sub_total_rent, $ITBIS, $services_amount, $deposit, $general_amount, $status, $source);
	return $this->getInsertId();
	}
    ///-----------abajo se inserta las reservas de temporada baja enlinea-----------------------------------------------------------------------------------------
	public function insert_short_reserva_online($ref, $id_ocupacion, $id_customer, $adults_qty, $children_qty, $interm_id, $qty_nights, $HS_nights, $LS_nights, $price_per_night, $priceHS, $amount_commision, $sub_total_rent, $ITBIS, $services_amount, $deposit, $general_amount, $status, $reserve_comment, $online){
    /*NOTE: THE RESERVE ONLINE NEED TO HAVE THE NOTE FIELD IN CASE THE CLIENT IS INSTERESTED IN BUYING PROPERTIES*/

     $this->insert_reserve_online($ref, $id_ocupacion, $id_customer, $adults_qty, $children_qty, $interm_id, $qty_nights, $HS_nights, $LS_nights, $price_per_night, $priceHS, $amount_commision, $sub_total_rent, $ITBIS, $services_amount, $deposit, $general_amount, $status, $reserve_comment, $online);
	return $this->getInsertId();
	}
     //------------------------------------------------------ long term info ---------------------------------------------------------------------------------------------
	public function insert_long_reserva($ref, $id_ocupacion, $id_customer, $adults_qty, $children_qty, $interm_id, $qty_nights, $HS_nights, $LS_nights, $price_per_night, $priceHS, $amount_commision, $sub_total_rent, $ITBIS, $services_amount, $deposit, $general_amount, $status, $pago_qty,$pagos_monto,$price_long,$extra_nights){


    $this->insert_reserve_long($ref, $id_ocupacion, $id_customer, $adults_qty, $children_qty, $interm_id, $qty_nights, $HS_nights, $LS_nights, $price_per_night, $priceHS, $amount_commision, $sub_total_rent, $ITBIS, $services_amount, $deposit, $general_amount, $status, $pago_qty,$pagos_monto,$price_long,$extra_nights);
	return $this->getInsertId();
	}

	public function insert_fechas_de_pago($id_reserve, $fecha_de_pago){

	$result=$this->insert_payment_dates($id_reserve, $fecha_de_pago);
	return $result;
	}

	public function insert_servicios_long($id_reserve, $name, $precio){

	$result=$this->insert_serv_long($id_reserve, $name, $precio);
	return $result;
	}
	//------long term modified----------------------------------------------------------------------------------------------------------------------------------------------------------
	public function insert_long_reserva_mod($ref, $id_occ_mod, $id_customer, $adults_qty, $children_qty, $vehicles, $interm_id, $qty_nights, $HS_nights, $LS_nights, $price_per_night, $priceHS, $amount_commision, $sub_total_rent, $ITBIS, $services_amount, $deposit, $general_amount, $status, $reserve_comment,$pago_qty,$pagos_monto,$price_long,$extra_nights){


    $this->insert_reserve_long_mod($ref, $id_occ_mod, $id_customer, $adults_qty, $children_qty, $vehicles, $interm_id, $qty_nights, $HS_nights, $LS_nights, $price_per_night, $priceHS, $amount_commision, $sub_total_rent, $ITBIS, $services_amount, $deposit, $general_amount, $status, $reserve_comment,$pago_qty,$pagos_monto,$price_long,$extra_nights);
	return $this->getInsertId();
	}

	public function insert_fechas_de_pago_mod($id_res_mod, $fecha_de_pago){

	$result=$this->insert_payment_dates_mod($id_res_mod, $fecha_de_pago);
	return $result;
	}

	public function insert_servicios_long_mod($id_res_mod, $name, $price){

	$result=$this->insert_serv_long_mod($id_res_mod, $name, $price);
	return $result;
	}
   //-------------------------------end long term info ------------------------
    public function insert_adults($id_reserve, $name, $lastname, $passport){
    $type=1;
	$result=$this->insert_people($id_reserve, $name, $lastname, $passport, $type);
	return $result;
	}

	public function insert_children($id_reserve, $name, $lastname, $passport){
    $type=2;
	$result=$this->insert_people($id_reserve, $name, $lastname, $passport, $type);
	return $result;
	}

 	/*public function insert_additional_services($id_service, $id_reserve, $qty, $price, $comment){
    //$qty=1;
	$result=$this->insert_services($id_service, $id_reserve, $qty, $price, $comment);
	return $result;
	}*/
	
	public function insert_additional_services($id_service, $id_reserve, $qty, $price, $desc, $tax, $tipo, $unit){
	$result=$this->insert_services($id_service, $id_reserve, $qty, $price, $desc, $tax, $tipo, $unit);
	return $result;
	}

    public function insertVilla($no,$type, $m2, $bed, $ac, $bath, $l_price, $h_price, $long_price, $maintenance, $water_service, $long_able,$sale_price, $maid, $garden_pool, $title, $pic, $able_sale, $able_rent, $owner_id, $wish_referal){

	 $ft2=($m2*10.76);
     $cap=($bed*2);
	 $fecha=date("Y-m-d G:i:s");

	//$result=$this->newVilla($no,$type, $m2, $ft2, $bed, $ac, $bath, $cap, $l_price, $h_price, $ll_price, $lh_price, $sale_price, $in_clear_price, $out_clear_price, $head_eng, $desc_eng, $pic, $able_sale, $able_rent, $owner_id, $head_esp, $desc_esp, $head_fre, $desc_fre, $head_nor, $desc_nor, $head_ger, $desc_ger, $head_ned, $desc_ned, $head_rus, $desc_rus, $fecha);

	$result=$this->newVilla($no,$type, $m2, $ft2, $bed, $ac, $bath, $cap, $l_price, $h_price, $long_price, $maintenance, $water_service, $long_able,$sale_price, $maid, $garden_pool, $title, $pic, $able_sale, $able_rent, $owner_id, $fecha, $wish_referal);

 	 return $result;
	}

	public function villa_update($id, $no,$type, $m2, $bed, $ac, $bath, $l_price, $h_price, $long_price, $maintenance, $water_service, $long_available, $sale_price, $maid, $garden_pool, $title, $pic, $able_sale, $able_rent, $owner_id, $wish_referal){

	 $ft2=($m2*10.76);
     $cap=($bed*2);
	 /*$fecha=date("Y-m-d G:i:s");   */

	//$result=$this->updateVilla($id, $no,$type, $m2, $ft2, $bed, $ac, $bath, $cap, $l_price, $h_price, $ll_price, $lh_price, $sale_price, $in_clear_price, $out_clear_price, $head_eng, $desc_eng, $pic, $able_sale, $able_rent, $owner_id, $head_esp, $desc_esp, $head_fre, $desc_fre, $head_nor, $desc_nor, $head_ger, $desc_ger, $head_ned, $desc_ned, $head_rus, $desc_rus, $fecha);
	 $result=$this->updateVilla($id, $no,$type, $m2, $ft2, $bed, $ac, $bath, $cap, $l_price, $h_price, $long_price, $maintenance, $water_service, $long_available, $sale_price, $maid, $garden_pool, $title, $pic, $able_sale, $able_rent, $owner_id, $wish_referal);
 	 return $result;
	}

	public function new_user($username, $password, $level, $name, $lastname, $email, $phone, $info, $active, $report, $receiveEmails){

	#$date=date("Y-m-d h:m:s");
	$date=date("Y-m-d G:i:s");
	$result=$this->Insert_User($username, $password, $level, $name, $lastname, $email, $phone, $info, $active, $date, $report, $receiveEmails);
	 if (!$result){
 	 return false;
 	 }else{

 	 return true;
	 }
	}

	public function newCustomers($intermediario, $password, $online, $name, $lastname, $email, $phone, $phone2, $fax, $cedula, $passport, $language, $zip, $address, $country, $state, $city, $photo, $comentario,  $active, $clasiffy, $id_adm, $id_update, $ename, $ephone){

	 //$date=date("Y-m-d");     //yyyy-mm-dd
	// $time=date("h: m: s");   //hh:mm:ss
	#$date=date("Y-m-d h:m:s");
	// $ip=$_SERVER['REMOTE_ADDR'];
	$date=date("Y-m-d G:i:s");
	$result=$this->insertCustomers($intermediario, $password, $online, $name, $lastname, $email, $phone, $phone2, $fax, $cedula, $passport, $language, $zip, $address, $country, $state, $city, $photo, $comentario, $date, $active, $clasiffy, $id_adm, $id_update,$ename, $ephone);

 	 return $this->getInsertId();

	}

	public function newCustomer_online($intermediario, $password, $online, $name, $lastname, $email, $phone, $phone2, $fax, $cedula, $passport, $language, $zip, $address, $country, $state, $city, $photo, $comentario,  $active, $clasiffy, $id_adm, $id_update, $ename, $ephone, $buy){

	$date=date("Y-m-d G:i:s");
	$result=$this->insertCustomers_online($intermediario, $password, $online, $name, $lastname, $email, $phone, $phone2, $fax, $cedula, $passport, $language, $zip, $address, $country, $state, $city, $photo, $comentario, $date, $active, $clasiffy, $id_adm, $id_update,$ename, $ephone, $buy);

 	 return $this->getInsertId();

	}

	public function customers_mod($id_mod, $id_commiss, $online, $pass, $name, $lastname, $email, $phone, $phone2, $fax, $cedula, $passport, $language, $zip, $address, $country, $state, $city, $photo, $info, $active, $clasiffy, $id_adm_mod, $ename, $ephone){

	 //$date=date("Y-m-d");     //yyyy-mm-dd
	// $time=date("h: m: s");   //hh:mm:ss
	#$date_mod=date("Y-m-d h:m:s");
	// $ip=$_SERVER['REMOTE_ADDR'];
	$date_mod=date("Y-m-d G:i:s");

	$result=$this->insert_customers_mod($id_mod, $id_commiss, $online, $pass, $name, $lastname, $email, $phone, $phone2, $fax, $cedula, $passport, $language, $zip, $address, $country, $state, $city, $photo, $info, $date_mod, $active, $clasiffy, $id_adm_mod, $ename, $ephone);

 	 return $this->getInsertId();
	}

	public function update_Customers($id, $commiss, $pass, $name, $lastname, $email, $phone, $phone2, $fax, $cedula, $passport, $language, $zip, $address, $country, $state, $city, $photo, $info, $active, $class, $id_update, $ename, $ephone){
	$result=$this->update_clients($id, $commiss, $pass, $name, $lastname, $email, $phone, $phone2, $fax, $cedula, $passport, $language, $zip, $address, $country, $state, $city, $photo, $info, $active, $class, $id_update, $ename, $ephone);
 	 return true;
	}

	public function newOwner($username, $password, $name, $lastname, $email, $phone, $movil, $fax, $cedula, $passport, $language, $zip, $address, $country, $photo, $rent_contract, $serv_contract, $comentario, $active, $id_adm, $cedula2, $passport2){

	$date=date("Y-m-d G:i:s");
	$result=$this->insertOwner($username, $password, $name, $lastname, $email, $phone, $movil, $fax, $cedula, $passport, $language, $zip, $address, $country, $photo, $rent_contract, $serv_contract,$comentario, $date, $active, $id_adm, $cedula2, $passport2);

 	 return true;

	}
	public function UpdateOwner($id, $username, $password, $name, $lastname, $email, $phone, $movil, $fax, $cedula, $passport, $language, $zip, $address, $country, $photo, $rent_contract, $serv_contract, $comentario, $active, $id_adm, $cedula2, $passport2){

	$date=date("Y-m-d G:i:s");
	$result=$this->updOwner($id, $username, $password, $name, $lastname, $email, $phone, $movil, $fax, $cedula, $passport, $language, $zip, $address, $country, $photo, $rent_contract, $serv_contract, $comentario, $date, $active, $id_adm, $cedula2, $passport2);

 	 return true;

	}

	public function sendMail($body, $address, $subject, $from_add, $from_name) {

		$extra_header  = '';
		$extra_header  .= "MIME-Version: 1.0\n";
		$extra_header  .= "Content-type: text/html; charset=utf-8\n";
		$extra_header  .= "Content-transfer-encoding: 8bit\n";
		$extra_header  .= "Date: ". date('r'). "\n";
		$extra_header  .= "X-Priority: 3\n";
		$extra_header  .= "X-Mailer: PHP\n";
		$extra_header  .= "X-MSMail-Priority: Normal\n";
		$extra_header  .= "From: $from_name <$from_add>\n";
		$extra_header  .= "Reply-to: <$from_add>\n";
		$extra_header  .= "Return-path: $from_name <$from_add>\n";
		$extra_header  .= "Bcc: ".ADMIN_EMAIL."\n";


		$mailsend = mail($address, $subject, $body, $extra_header);

		return true;

	}
   /*
	public function days_in_month($mes,$ano){ //UNCONCLUDED FUNCTION
			$ultimo_dia=28;
			while (checkdate($mes,$ultimo_dia + 1,$ano)){
			   $ultimo_dia++;
			}
			return $ultimo_dia;
	} */

   public function daysDifference($endDate, $beginDate){ //this work fine but with warnings sometimes if not add @ begining


	   //explode the date by "-" and storing to array
	   $date_parts1=explode("-", $beginDate);
	   $date_parts2=explode("-", $endDate);
	   //gregoriantojd() Converts a Gregorian date to Julian Day Count
	   $start_date=gregoriantojd($date_parts1[1], $date_parts1[2], $date_parts1[0]);
	   $end_date=gregoriantojd($date_parts2[1], $date_parts2[2], $date_parts2[0]);
	   return $end_date - $start_date;
   }

   public function nights_qty($ending, $starting){
      $inicio=strtotime($starting); //return in seconds the introduced date
      $final=strtotime($ending);

      $result=floor(($final-$inicio)/(60*60*24));

     return $result;
   }

     public function insert_invoice($ref, $src, $id_adm, $invoice_no, $tip){
     $date=date("Y-m-d G:i:s");

	$result=$this->in_factura($ref, $src, $id_adm, $date, $invoice_no, $tip);


     return true;
   }

    public function insert_register_sheet($ref, $src,$sheet_no, $id_adm){
		$date=date("Y-m-d G:i:s");

		$result=$this->in_register_sheet($ref, $src, $sheet_no, $date, $id_adm);


     return true;
   }

   public function UpdateUser($id, $level, $name, $lastname, $email, $phone, $info, $active, $report, $receiveEmails){

		$date=date("Y-m-d G:i:s");
		$result=$this->updUsers($id, $level, $name, $lastname, $email, $phone, $info, $active, $date, $report, $receiveEmails);

 	 return true;

	}

	public function InsertAddService($name, $price, $desc, $type, $comment, $active, $pri_min, $pHS, $pHS2){

		$date=date("Y-m-d G:i:s");
		$result=$this->ins_add_service ($name, $price, $desc, $type, $comment, $date, $active, $pri_min, $pHS, $pHS2);

 	 return true;

	}

	public function InsertCommission($pass, $name, $lastname, $email, $url, $phone, $percent,$percent_long, $comment, $active, $tipo){

		$date=date("Y-m-d G:i:s");
		$result=$this->ins_commission ($pass, $name, $lastname, $email, $url, $phone, $percent,$percent_long, $comment, $date, $active, $tipo);

 	 return $this->getInsertId();

	}

	public function UpdateAddService($current_id, $name, $price, $desc, $type, $comment, $active, $pri_min, $pHS, $pHS2){

		$date=date("Y-m-d G:i:s");$percent_long=($percent_long/100);
		$result=$this->upd_add_service ($current_id, $name, $price, $desc, $type, $comment, $date, $active, $pri_min, $pHS, $pHS2);

 	 return true;

	}

	public function UpdateCommission($current_id, $pass, $name, $lastname, $email, $url, $phone, $percent,$percent_long, $comment, $active, $tipo){

		$date=date("Y-m-d G:i:s");$percent_long=($percent_long/100);
		$result=$this->upd_commission($current_id, $pass, $name, $lastname, $email, $url, $phone, $percent,$percent_long, $comment, $date, $active, $tipo);

 	 return true;

	}

	public function goto_insert_cancelled($ref, $reasons, $id_adm){

		$date=date("Y-m-d G:i:s");
		$result=$this->insert_cancelled($ref, $reasons, $id_adm, $date);

 	 return true;

	}
	////////////////////////////////////////////////////////////////////////////////////////////////////////////
	public function in_ocupacion_mod($starting, $ending, $type, $id_villa, $id_adm_mod, $comment){
		 $starting_date_cutted=explode("-", $starting);
		 $yyyy=$starting_date_cutted[0];
		 $mm=$starting_date_cutted[1];
		 $date=date("Y-m-d G:i:s");
		 $this->in_busy_mod($starting, $ending, $type, 1, $id_villa, $id_adm_mod, $comment, $date, $mm, $yyyy);
		 return $this->getInsertId();
	}

	public function in_res_mod($ref, $id_ocupacion, $id_customer, $adults_qty, $children_qty, $vehicles, $interm_id, $qty_nights, $HS_nights, $LS_nights, $price_per_night, $PHS, $amount_commision, $sub_total_rent, $ITBIS, $services_amount, $deposit, $general_amount, $status, $reserve_comment){

		$this->in_reserve_mod($ref, $id_ocupacion, $id_customer, $adults_qty, $children_qty, $vehicles, $interm_id, $qty_nights, $HS_nights, $LS_nights, $price_per_night, $PHS, $amount_commision, 	$sub_total_rent, $ITBIS, $services_amount, $deposit, $general_amount, $status, $reserve_comment);
		return $this->getInsertId();

	}

	public function in_persons_mod($id_reserve, $name, $lastname, $comment, $type ){

		$result=$this->in_people_mod($id_reserve, $name, $lastname, $comment, $type);
	return $result;
	}
	/*
	public function in_children_mod($id_reserve, $name, $lastname){
	$type=2; $comment="";
		$result=$this->in_people_mod($id_reserve, $name, $lastname, $comment, $type);
	return $result;
	}
	*/
	public function InAddServMod($id_service, $id_reserve, $qty, $price, $comment){
    //$qty=1;
	$result=$this->in_serv_mod($id_service, $id_reserve, $qty, $price, $comment);
	return $result;
	}
	public function update_busy($id, $start, $end, $villa, $adm, $update, $date){
	 $starting_date_cutted=explode("-", $start);
	 $yyyy=$starting_date_cutted[0];
	 $mm=$starting_date_cutted[1];
     $type=1; //1= short, 2=long, 3=maintenance
     $active=1;

     $comment="";
	 $result=$this->update_ocupacion($id, $start, $end, $type, $active, $villa, $adm, $comment, $date, $mm, $yyyy, $update);
	return $result;
	}

	public function update_reserva($id, $ref, $idbusy, $client, $adults, $kids,  $vehicle, $interm, $nights, $HS_nights, $LS_nights, $price_nights, $priceHS, $commision, $sub_total_rent, $tax, $samount, $deposit, $total, $status){

     $result=$this->update_reservation($id, $ref, $idbusy, $client, $adults, $kids, $vehicle, $interm, $nights, $HS_nights, $LS_nights, $price_nights, $priceHS, $commision, $sub_total_rent, $tax, $samount, $deposit, $total, $status);
	return $result;
	}

	public function vip_record($id_client, $id_adm){
	 $date=date("Y-m-d G:i:s");
     $result=$this->save_vip($id_client, $date,  $id_adm);
	return $result;
	}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	public function update_reserva_long($id, $ref, $idbusy, $client, $adults, $kids, $vehiculos, $interm, $nights, $HS_nights, $LS_nights, $price, $priceHS, $commision, $amount, $tax, $samount, $deposit, $total, $status, $pago_qty,$pagos_monto,$price_long,$qty_nights_extra){

     $result=$this->update_reservation_long($id, $ref, $idbusy, $client, $adults, $kids, $vehiculos, $interm, $nights, $HS_nights, $LS_nights, $price, $priceHS, $commision, $amount, $tax, $samount, $deposit, $total, $status, $pago_qty,$pagos_monto,$price_long,$qty_nights_extra);
	return $result;
	}
//--------------ASIGN BOOKING TO REFERAL--------------------------------------------------------------------------------------------------------------------------
   public function Assign_a_booking($reference, $referal, $id_adm, $amountdiscounted){
	$date=date("Y-m-d G:i:s");
    $id_update="";
    $result=$this->assignBooking($reference, $referal, $id_adm, $date, $id_update, $amountdiscounted);
	//return $this->getInsertId();
	return $result;
	}
//-----------------ASIGN BOOKING TO REFERAL UPDATE------------------------------------------------------------------------------------------------------------------
	public function update_assign($id, $reference, $referal, $id_adm, $id_update){
  	 $date=date("Y-m-d G:i:s");
	 $result=$this->update_assignedBook($id, $reference, $referal, $id_adm, $fecha, $id_update);
	return $result;
	}

//-----------------INSERT ASSIGN MODIFIED --------------------------------------------------------------------------------------------------------------------
	public function insert_assign_modified($reference, $referal, $id_adm, $fecha){
		$this->assign_modified($reference, $referal, $id_adm, $fecha);
	return $this->getInsertId();
	}


	//--------------insert promotion--------------------------------------------------------------------------------------------------------------------------
   public function pro_in($code, $tipo, $monto_porc, $mdays, $maxdays,  $desde, $hasta, $bookingfrom, $bookingto, $id_adm, $activo, $title){
	$date=date("Y-m-d G:i:s");
    $result=$this->insert_promotion($code, $tipo, $monto_porc, $mdays, $maxdays,  $desde, $hasta, $bookingfrom, $bookingto, $id_adm, $activo, $date, $title);
	return $result;
	}
//-----------------update promotion------------------------------------------------------------------------------------------------------------------
	public function pro_up($id, $code, $tipo, $monto_porc, $mdays, $maxdays,  $desde, $hasta, $bookingfrom, $bookingto, $id_adm, $activo, $title){
  	 $fecha=date("Y-m-d G:i:s");
	 $result=$this->update_promotion($id, $code, $tipo, $monto_porc, $mdays, $maxdays, $desde, $hasta, $bookingfrom, $bookingto, $id_adm, $activo, $fecha, $title);
	return $result;
	}

	//-------------- INSERT DISCOUNT TO BOOKING ----------------------------------------------------------------------------------------------------------------------
   public function insert_discount($ref,$pro_code,$pro_id,$pro_from,$pro_to,$pro_type,$pro_qty,$min_days,$max_days,$bookfrom,$bookto, $discounted, $id_adm, $new){
	$fecha=date("Y-m-d G:i:s");
    $update="";
    $result=$this->insert_discount_DB($fecha,$ref,$pro_code,$pro_id,$pro_from,$pro_to,$pro_type,$pro_qty,$min_days,$max_days,$bookfrom,$bookto, $discounted, $id_adm,$update, $new);
	return $result;
	}
//-----------------UPDATE DISCOUNT TO BOOKING ---------------------------------------------------------------------------------------------------------------
	public function update_discount(	$id,
										$ref,
										$pro_code,
										$pro_id,
										$pro_from,
										$pro_to,
										$pro_type,
										$pro_qty,
										$min_days,
										$max_days, 
										$bookfrom, 
										$bookto, 
										$discounted, 
										$id_adm,
										$update){
	$fecha=date("Y-m-d G:i:s");
	$result=$this->update_discount_DB($id,
										$fecha,
										$ref,
										$pro_code,
										$pro_id,
										$pro_from,
										$pro_to,
										$pro_type,
										$pro_qty,
										$min_days,
										$max_days, 
										$bookfrom, 
										$bookto, 
										$discounted, 
										$id_adm,
										$update);
	return $result;
	}

//-----------------INSERT A DISCOUNT MODIFIED --------------------------------------------------------------------------------------------------------------------
	public function insert_discount_modified(
											$fecha,
											$ref,
											$pro_code,
											$pro_id,
											$pro_from,
											$pro_to,
											$pro_type,
											$pro_qty, 
											$min_days,
											$max_days,
											$bookfrom,
											$bookto, 
											$discounted,   
											$id_adm)
	{
		$this->insert_discount_modified_DB(
											$fecha,
											$ref,
											$pro_code,
											$pro_id,
											$pro_from,
											$pro_to,
											$pro_type,
											$pro_qty, 
											$min_days,
											$max_days,
											$bookfrom,
											$bookto, 
											$discounted,   
											$id_adm);
	return $this->getInsertId();
	}

	public function in_webpage($ref, $url){
	$date=date("Y-m-d G:i:s");
    $result=$this->insert_webpage($ref, $url, $date);
	return $result;
	}

	//-------------- insert referral details -----------------------------------------------------------------------------------------------------------------
   public function insert_referral_details($referral_id, $cell, $agency, $language, $question1, $answer1, $question2, $answer2){

    $result=$this->insert_referral_det($referral_id, $cell, $agency, $language, $question1, $answer1, $question2, $answer2);
	return $result;
	}
//----------------- update referral details ------------------------------------------------------------------------------------------------------------------
	public function update_referral_details($id, $referral_id, $cell, $agency, $language, $question1, $answer1, $question2, $answer2){

	 $result=$this->update_referra_det($id, $referral_id, $cell, $agency, $language, $question1, $answer1, $question2, $answer2);
	return $result;
	}

	//--------------INSERT A VEHICLULE--------------------------------------------------------------------------------------------------------------------------
   public function insert_vehicule($reference, $make, $model, $placa, $color){

    $result=$this->Insert_vehicules($reference, $make, $model, $placa, $color);

	return $result;
	}
//-----------------UPDATE VEHICULE------------------------------------------------------------------------------------------------------------------
	public function update_vehicle($id, $reference, $make, $model, $placa, $color){

	 $result=$this->update_vehicules($id, $reference, $make, $model, $placa, $color);
	return $result;
	}

 }
?>