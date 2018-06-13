<?
//$link->connector(SERVER,USER,PASS,DB);

 class DB {

 	  //public $link;

     protected $link;

		  public function __construct(){
		  $this->link = new Database;

		  }


	 	 public function checkUser($username,$password) {

			$query="SELECT *
					FROM `".DB_PREFIX."users`
					WHERE `user`='".$this->link->myesc($username)."' AND `pass`='".$this->link->myesc($password)."'
					AND `active`=1 LIMIT 1
					";

			return $this->link->query($query);

		}

		public function getUserDetails($userid) {
			   //$this->link->myesc($userid);
			$query="SELECT *
					FROM `".DB_PREFIX."users`
					WHERE id='".$this->link->myesc($userid)."'
					LIMIT 1
					";
			return $this->link->query($query);      //$link->myesc($userid)

		}

		 public function checkCustomer($email,$password) {

			$query="SELECT *
					FROM `".DB_PREFIX."customers`
					WHERE `email`='".$this->link->myesc($email)."' AND `pass`='".$this->link->myesc($password)."'
					AND `active`=1 LIMIT 1
					";

			return $this->link->query($query);

		}

		public function getCustomerDetails($customerid) {

			$query="SELECT *
					FROM `".DB_PREFIX."customers`
					WHERE id='".$this->link->myesc($customerid)."'
					LIMIT 1
					";
			return $this->link->query($query);      //$link->myesc($userid)

		}

		public function checkReferal($email,$password) {

			$query="SELECT *
					FROM `".DB_PREFIX."commission`
					WHERE `email`='".$this->link->myesc($email)."' AND `password`='".$this->link->myesc($password)."'
					AND `active`=1 LIMIT 1
					";

			return $this->link->query($query);

		}

		public function getReferalDetails($referalid) {

			$query="SELECT *
					FROM `".DB_PREFIX."commission`
					WHERE id='".$this->link->myesc($referalid)."'
					LIMIT 1
					";
			return $this->link->query($query);

		}

		public function checkOwner($user,$pass) {

			$query="SELECT *
					FROM `".DB_PREFIX."owners`
					WHERE `user`='".$this->link->myesc($user)."' AND `pass`='".$this->link->myesc($pass)."'
					AND `active`=1 LIMIT 1
					";

			return $this->link->query($query);

		}

		public function getOwnerDetails($oid) {

			$query="SELECT *
					FROM `".DB_PREFIX."owners`
					WHERE id='".$this->link->myesc($oid)."'
					LIMIT 1
					";
			return $this->link->query($query);

		}
//ABOVE ONLY QUERIES HERE

		public function change_user_pass($id, $pass) {

			$query="UPDATE `".DB_PREFIX."users` SET
						`pass`='".$this->link->myesc($pass)."'
					WHERE `id`='".$this->link->myesc($id)."' LIMIT 1";

			return $this->link->execute($query);

		}

		public function profile_user($id, $name, $lastname, $email, $phone, $details) {

			$query="UPDATE `".DB_PREFIX."users` SET
							`name`='".$this->link->myesc($name)."',
                             `lastname`='".$this->link->myesc($lastname)."',
                             `email`='".$this->link->myesc($email)."',
                             `phone`='".$this->link->myesc($phone)."',
                             `info`='".$this->link->myesc($details)."'

	 					WHERE `id`='".$this->link->myesc($id)."' LIMIT 1";

			return $this->link->execute($query);

		}

	public function change_client_pass($id,$new_pass) {

			$query="UPDATE `".DB_PREFIX."customers` SET
						`pass`='".$this->link->myesc($new_pass)."'
					WHERE `id`='".$this->link->myesc($id)."' LIMIT 1";

			return $this->link->execute($query);

	}



	public function insert_ocupacion($starting, $ending, $type, $active, $id_villa, $id_admin, $comment, $date, $mm, $yyyy, $id_update){
    $query="INSERT INTO `".DB_PREFIX."occupancy` ( `id` ,
													`starting` ,
													`ending` ,
													`type` ,
													`active` ,
													`id_villa` ,
													`id_adm` ,
													`comment` ,
													`date` ,
													`mm` ,
													`yyyy` ,
													`id_update`)
 					VALUES ( NULL ,'".$this->link->myesc($starting)."','".$this->link->myesc($ending)."','".$this->link->myesc($type)."','".$this->link->myesc($active)."','".$this->link->myesc($id_villa)."','".$this->link->myesc($id_admin)."','".$this->link->myesc($comment)."','".$this->link->myesc($date)."','".$this->link->myesc($mm)."','".$this->link->myesc($yyyy)."','".$this->link->myesc($id_update)."')";

     $result = $this->link->execute($query);
     return $result;
	}

	public function insert_reserve($ref, $id_ocupacion, $id_customer, $adults_qty, $children_qty, $interm_id, $qty_nights, $HS_nights, $LS_nights, $price_per_night, $priceHS, $amount_commision, $sub_total_rent, $ITBIS, $services_amount, $deposit, $general_amount, $status, $source=0){
     $query="INSERT INTO `".DB_PREFIX."reserves` ( `id`,
     												`ref`,
													`id_occupancy`,
													`id_client`,
													`adults`,
													`children`,
													`id_interm`,
													`qty_nights`,
													`nightsHS`,
													`nightsLS`,
													`price_per_night`,
													`priceHS`,
													`commision`,
													`amount`,
													`tax`,
													`services_amount`,
													`deposit`,
													`total`,
													`status`,
													`online`)
 					VALUES ( NULL ,'".$this->link->myesc($ref)."','".$this->link->myesc($id_ocupacion)."','".$this->link->myesc($id_customer)."','".$this->link->myesc($adults_qty)."','".$this->link->myesc($children_qty)."','".$this->link->myesc($interm_id)."','".$this->link->myesc($qty_nights)."','".$this->link->myesc($HS_nights)."','".$this->link->myesc($LS_nights)."','".$this->link->myesc($price_per_night)."','".$this->link->myesc($priceHS)."','".$this->link->myesc($amount_commision)."','".$this->link->myesc($sub_total_rent)."','".$this->link->myesc($ITBIS)."','".$this->link->myesc($services_amount)."','".$this->link->myesc($deposit)."','".$this->link->myesc($general_amount)."','".$this->link->myesc($status)."','".$this->link->myesc($source)."')";

     $result = $this->link->execute($query);
     return $result;
	}
	//----------------abajo reserva temporada baja en linea--------------------------------------------------------------------------------------------------------
	public function insert_reserve_online($ref, $id_ocupacion, $id_customer, $adults_qty, $children_qty, $interm_id, $qty_nights, $HS_nights, $LS_nights, $price_per_night, $priceHS, $amount_commision, $sub_total_rent, $ITBIS, $services_amount, $deposit, $general_amount, $status, $reserve_comment, $online){
     $query="INSERT INTO `".DB_PREFIX."reserves` ( `id`,
     												`ref`,
													`id_occupancy`,
													`id_client`,
													`adults`,
													`children`,
													`id_interm`,
													`qty_nights`,
													`nightsHS`,
													`nightsLS`,
													`price_per_night`,
													`priceHS`,
													`commision`,
													`amount`,
													`tax`,
													`services_amount`,
													`deposit`,
													`total`,
													`status`,
													`comment`,
													`online`)
 					VALUES ( NULL ,'".$this->link->myesc($ref)."','".$this->link->myesc($id_ocupacion)."','".$this->link->myesc($id_customer)."','".$this->link->myesc($adults_qty)."','".$this->link->myesc($children_qty)."','".$this->link->myesc($interm_id)."','".$this->link->myesc($qty_nights)."','".$this->link->myesc($HS_nights)."','".$this->link->myesc($LS_nights)."','".$this->link->myesc($price_per_night)."','".$this->link->myesc($priceHS)."','".$this->link->myesc($amount_commision)."','".$this->link->myesc($sub_total_rent)."','".$this->link->myesc($ITBIS)."','".$this->link->myesc($services_amount)."','".$this->link->myesc($deposit)."','".$this->link->myesc($general_amount)."','".$this->link->myesc($status)."','".$this->link->myesc($reserve_comment)."','".$this->link->myesc($online)."')";
       /*NOTE: HERE IT IS IMPORTANTE THAT THE BOOKING CAN INSERT COMMENT IN CASE THAT THE ONLINE CLIENT IS INSTERETED IN BUYING INFO*/
     $result = $this->link->execute($query);
     return $result;
	}
   //-----------------inserting long term information below------------------------------------
	public function insert_reserve_long($ref, $id_ocupacion, $id_customer, $adults_qty, $children_qty, $interm_id, $qty_nights, $HS_nights, $LS_nights, $price_per_night, $priceHS, $amount_commision, $sub_total_rent, $ITBIS, $services_amount, $deposit, $general_amount, $status, $pago_qty,$pagos_monto,$price_long,$extra_nigths){
     $query="INSERT INTO `".DB_PREFIX."reserves` ( `id`,
     												`ref`,
													`id_occupancy`,
													`id_client`,
													`adults`,
													`children`,
													`id_interm`,
													`qty_nights`,
													`nightsHS`,
													`nightsLS`,
													`price_per_night`,
													`priceHS`,
													`commision`,
													`amount`,
													`tax`,
													`services_amount`,
													`deposit`,
													`total`,
													`status`,
													`pagos_qty`,
													`pagos_monto`,
													`price_long`,
													`extra_nights`)
 					VALUES ( NULL ,'".$this->link->myesc($ref)."','".$this->link->myesc($id_ocupacion)."','".$this->link->myesc($id_customer)."','".$this->link->myesc($adults_qty)."','".$this->link->myesc($children_qty)."','".$this->link->myesc($interm_id)."','".$this->link->myesc($qty_nights)."','".$this->link->myesc($HS_nights)."','".$this->link->myesc($LS_nights)."','".$this->link->myesc($price_per_night)."','".$this->link->myesc($priceHS)."','".$this->link->myesc($amount_commision)."','".$this->link->myesc($sub_total_rent)."','".$this->link->myesc($ITBIS)."','".$this->link->myesc($services_amount)."','".$this->link->myesc($deposit)."','".$this->link->myesc($general_amount)."','".$this->link->myesc($status)."','".$this->link->myesc($pago_qty)."','".$this->link->myesc($pagos_monto)."','".$this->link->myesc($price_long)."','".$this->link->myesc($extra_nigths)."')";

     $result = $this->link->execute($query);
     return $result;
	}

	public function insert_payment_dates($id_reserve, $fecha_de_pago){
     $query="INSERT INTO `".DB_PREFIX."long_pay` (`id`,
												`id_reserve`,
												`fecha_pago`)
 					VALUES ( NULL ,'".$this->link->myesc($id_reserve)."','".$this->link->myesc($fecha_de_pago)."')";
     $result = $this->link->execute($query);
     return $result;
	}

	public function insert_serv_long($id_reserve, $name, $precio){
     $query="INSERT INTO `".DB_PREFIX."serv_long` (`id`,
												`id_reserve`,
												`name`,
												`price`)
 					VALUES ( NULL ,'".$this->link->myesc($id_reserve)."','".$this->link->myesc($name)."','".$this->link->myesc($precio)."')";
     $result = $this->link->execute($query);
     return $result;
	}

	//-----------long term modified----------------------------------------------------------

		public function insert_reserve_long_mod($ref, $id_occ_mod, $id_customer, $adults_qty, $children_qty, $vehicles, $interm_id, $qty_nights, $HS_nights, $LS_nights, $price_per_night, $priceHS, $amount_commision, $sub_total_rent, $ITBIS, $services_amount, $deposit, $general_amount, $status, $reserve_comment,$pago_qty,$pagos_monto,$price_long,$extra_nigths){
     $query="INSERT INTO `".DB_PREFIX."reserves_mod` ( `id`,
     												`ref`,
													`id_occ_mod`,
													`id_client`,
													`adults`,
													`children`,
													`vehicles`,
													`id_interm`,
													`qty_nights`,
													`nightsHS`,
													`nightsLS`,
													`price_nights`,
													`priceHS`,
													`commision`,
													`amount`,
													`tax`,
													`serv_amount`,
													`deposit`,
													`total`,
													`status`,
													`comment`,
													`pagos_qty`,
													`pagos_monto`,
													`price_long`,
													`extra_nights`)
 					VALUES ( NULL ,'".$this->link->myesc($ref)."','".$this->link->myesc($id_occ_mod)."','".$this->link->myesc($id_customer)."','".$this->link->myesc($adults_qty)."','".$this->link->myesc($children_qty)."','".$this->link->myesc($vehicles)."','".$this->link->myesc($interm_id)."','".$this->link->myesc($qty_nights)."','".$this->link->myesc($HS_nights)."','".$this->link->myesc($LS_nights)."','".$this->link->myesc($price_per_night)."','".$this->link->myesc($priceHS)."','".$this->link->myesc($amount_commision)."','".$this->link->myesc($sub_total_rent)."','".$this->link->myesc($ITBIS)."','".$this->link->myesc($services_amount)."','".$this->link->myesc($deposit)."','".$this->link->myesc($general_amount)."','".$this->link->myesc($status)."','".$this->link->myesc($reserve_comment)."','".$this->link->myesc($pago_qty)."','".$this->link->myesc($pagos_monto)."','".$this->link->myesc($price_long)."','".$this->link->myesc($extra_nigths)."')";

     $result = $this->link->execute($query);
     return $result;
	}

	public function insert_payment_dates_mod($id_res_mod, $fecha_de_pago){
     $query="INSERT INTO `".DB_PREFIX."long_pay_mod` (`id`,
												`id_res_mod` ,
												`fecha_pago`)
 					VALUES ( NULL ,'".$this->link->myesc($id_res_mod)."','".$this->link->myesc($fecha_de_pago)."')";
     $result = $this->link->execute($query);
     return $result;
	}

	public function insert_serv_long_mod($id_res_mod, $name, $price){
     $query="INSERT INTO `".DB_PREFIX."serv_long_mod` (`id`,
												`id_res_mod`,
												`name`,
												`price`)
 					VALUES ( NULL ,'".$this->link->myesc($id_res_mod)."','".$this->link->myesc($name)."','".$this->link->myesc($price)."')";
     $result = $this->link->execute($query);
     return $result;
	}
   //--------------- end long term modified---------------
	public function insert_people($id_reserve, $name, $lastname, $comment, $type){
     $query="INSERT INTO `".DB_PREFIX."people` (`id`,
												`id_reserve` ,
												`name` ,
												`lastname` ,
												`passport` ,
												`type`)
 					VALUES ( NULL ,'".$this->link->myesc($id_reserve)."','".$this->link->myesc($name)."','".$this->link->myesc($lastname)."','".$this->link->myesc($comment)."','".$this->link->myesc($type)."')";
     $result = $this->link->execute($query);
     return $result;
	}

	public function insert_services($id_service, $id_reserve, $qty, $price, $desc, $tax, $tipo, $unit){  //to register reserve services price, because original can change or this
     $query="INSERT INTO `".DB_PREFIX."serv_reserv` (`id`,
													`id_service`,
													`id_reserve`,
													`qty`,
													`price`,
													`comment`,
													`tax`,
													`tipo`,
													`unit`)
 					VALUES ( NULL ,'".$this->link->myesc($id_service)."',
					'".$this->link->myesc($id_reserve)."',
					'".$this->link->myesc($qty)."',
					'".$this->link->myesc($price)."',
					'".$this->link->myesc($desc)."',
					'".$this->link->myesc($tax)."',
					'".$this->link->myesc($tipo)."',
					'".$this->link->myesc($unit)."')";
     $result = $this->link->execute($query);
     return $result;
	}

	public function newVilla($no,$type, $m2, $ft2, $bed, $ac, $bath, $cap, $l_price, $h_price, $long_price, $maintenance, $water_service, $long_able,$sale_price, $maid, $garden_pool, $title, $pic, $able_sale, $able_rent, $owner_id, $fecha,$wish_referal) {

		$query="INSERT INTO `".DB_PREFIX."villas` ( `id` ,
													`no` ,
													`type` ,
													`m2` ,
													`ft2` ,
													`bed` ,
													`AC` ,
													`bath` ,
													`capacity` ,
													`p_low` ,
													`p_high` ,
													`p_long` ,
													`maintenance`,
													`water_long`,
													`long_able`,
													`p_sale` ,
													`p_in_clear` ,
													`p_out_clear` ,
													`head` ,
													`pic` ,
													`able_s` ,
													`able_r` ,
													`id_owner`,
													`date`,
													`wish_referal`)
 					VALUES ( NULL ,'".$this->link->myesc($no)."','".$this->link->myesc($type)."','".$this->link->myesc($m2)."','".$this->link->myesc($ft2)."','".$this->link->myesc($bed)."','".$this->link->myesc($ac)."','".$this->link->myesc($bath)."','".$this->link->myesc($cap)."','".$this->link->myesc($l_price)."','".$this->link->myesc($h_price)."','".$this->link->myesc($long_price)."','".$this->link->myesc($maintenance)."','".$this->link->myesc($water_service)."','".$this->link->myesc($long_able)."','".$this->link->myesc($sale_price)."','".$this->link->myesc($maid)."','".$this->link->myesc($garden_pool)."','".$this->link->myesc($title)."','".$this->link->myesc($pic)."','".$this->link->myesc($able_sale)."','".$this->link->myesc($able_rent)."','".$this->link->myesc($owner_id)."','".$this->link->myesc($fecha)."','".$this->link->myesc($wish_referal)."')";

    $result = $this->link->execute($query);

     return $result;
    }

	public function updateVilla($id, $no,$type, $m2, $ft2, $bed, $ac, $bath, $cap, $l_price, $h_price, $long_price, $maintenance, $water_service, $long_available, $sale_price, $maid, $garden_pool, $title, $pic, $able_sale, $able_rent, $owner_id, $wish_referal) {

		$query="UPDATE `".DB_PREFIX."villas` SET
						`no`='".$this->link->myesc($no)."',
						`type`='".$this->link->myesc($type)."',
						`m2`='".$this->link->myesc($m2)."',
						`ft2`='".$this->link->myesc($ft2)."',
						`bed`='".$this->link->myesc($bed)."',
						`AC`='".$this->link->myesc($ac)."',
						`bath`='".$this->link->myesc($bath)."',
						`capacity`='".$this->link->myesc($cap)."',
						`p_low`='".$this->link->myesc($l_price)."',
						`p_high`='".$this->link->myesc($h_price)."',
						`p_long`='".$this->link->myesc($long_price)."',
						`maintenance`='".$this->link->myesc($maintenance)."',
						`water_long`='".$this->link->myesc($water_service)."',
						`long_able`='".$this->link->myesc($long_available)."',
						`p_sale`='".$this->link->myesc($sale_price)."',
						`p_in_clear`='".$this->link->myesc($maid)."',
						`p_out_clear`='".$this->link->myesc($garden_pool)."',
						`head`='".$this->link->myesc($title)."',
						`pic`='".$this->link->myesc($pic)."',
						`able_s`='".$this->link->myesc($able_sale)."',
						`able_r`='".$this->link->myesc($able_rent)."',
						`id_owner`='".$this->link->myesc($owner_id)."',
					    `wish_referal`='".$this->link->myesc($wish_referal)."'
						WHERE `id`='".$this->link->myesc($id)."' LIMIT 1";


    $result = $this->link->execute($query);

     return $result;
    }

	 public function Insert_User($username, $password, $level, $name, $lastname, $email, $phone, $info, $active, $date, $report, $noemails) {

			$query="INSERT INTO `".DB_PREFIX."users` ( `id` ,
														`user` ,
														`pass` ,
														`level` ,
														`name` ,
														`lastname` ,
														`email` ,
														`phone` ,
														`info` ,
														`active` ,
														`date`,
														`report`,
														`noemails`
														)
	 					VALUES ( NULL,'".$this->link->myesc($username)."' ,'".$this->link->myesc($password)."','".$this->link->myesc($level)."','".$this->link->myesc($name)."','".$this->link->myesc($lastname)."','".$this->link->myesc($email)."','".$this->link->myesc($phone)."','".$this->link->myesc($info)."','".$this->link->myesc($active)."','".$this->link->myesc($date)."','".$this->link->myesc($report)."','".$this->link->myesc($noemails)."')";

	    $result = $this->link->execute($query);

	     return $result;

		}

	  public function insertCustomers($intermediario, $password, $online, $name, $lastname, $email, $phone, $phone2, $fax, $cedula, $passport, $language, $zip, $address, $country, $state, $city, $photo, $comentario, $date, $active, $clasiffy, $id_adm, $id_update, $ename, $ephone) {

			$query="INSERT INTO `".DB_PREFIX."customers` ( `id`,
														`id_commission`,
														`pass`,
														`online`,
														`name`,
														`lastname`,
														`email`,
														`phone`,
														`phone2`,
														`fax`,
														`cedula`,
														`passport`,
														`language`,
														`zip`,
														`address`,
														`country`,
														`state`,
														`city`,
														`photo`,
														`info`,
														`date`,
														`active`,
														`classify_cust`,
														`id_adm`,
														`id_update`,
														`ename`,
														`ephone`
														)
	 					VALUES ( NULL,'".$this->link->myesc($intermediario)."' ,'".$this->link->myesc($password)."','".$this->link->myesc($online)."','".$this->link->myesc($name)."','".$this->link->myesc($lastname)."','".$this->link->myesc($email)."','".$this->link->myesc($phone)."','".$this->link->myesc($phone2)."','".$this->link->myesc($fax)."','".$this->link->myesc($cedula)."','".$this->link->myesc($passport)."','".$this->link->myesc($language)."','".$this->link->myesc($zip)."','".$this->link->myesc($address)."','".$this->link->myesc($country)."','".$this->link->myesc($state)."','".$this->link->myesc($city)."','".$this->link->myesc($photo)."','".$this->link->myesc($comentario)."','".$this->link->myesc($date)."','".$this->link->myesc($active)."','".$this->link->myesc($clasiffy)."','".$this->link->myesc($id_adm)."','".$this->link->myesc($id_update)."','".$this->link->myesc($ename)."','".$this->link->myesc($ephone)."')";

	    $result = $this->link->execute($query);
	          // $result= connect::query($query);
	     return $result;
	    // return (printf($result));
		}

		 public function insertCustomers_online($intermediario, $password, $online, $name, $lastname, $email, $phone, $phone2, $fax, $cedula, $passport, $language, $zip, $address, $country, $state, $city, $photo, $comentario, $date, $active, $clasiffy, $id_adm, $id_update, $ename, $ephone, $buy) {

			$query="INSERT INTO `".DB_PREFIX."customers` ( `id`,
														`id_commission`,
														`pass`,
														`online`,
														`name`,
														`lastname`,
														`email`,
														`phone`,
														`phone2`,
														`fax`,
														`cedula`,
														`passport`,
														`language`,
														`zip`,
														`address`,
														`country`,
														`state`,
														`city`,
														`photo`,
														`info`,
														`date`,
														`active`,
														`classify_cust`,
														`id_adm`,
														`id_update`,
														`ename`,
														`ephone`,
														`buy`
														)
	 					VALUES ( NULL,'".$this->link->myesc($intermediario)."' ,'".$this->link->myesc($password)."','".$this->link->myesc($online)."','".$this->link->myesc($name)."','".$this->link->myesc($lastname)."','".$this->link->myesc($email)."','".$this->link->myesc($phone)."','".$this->link->myesc($phone2)."','".$this->link->myesc($fax)."','".$this->link->myesc($cedula)."','".$this->link->myesc($passport)."','".$this->link->myesc($language)."','".$this->link->myesc($zip)."','".$this->link->myesc($address)."','".$this->link->myesc($country)."','".$this->link->myesc($state)."','".$this->link->myesc($city)."','".$this->link->myesc($photo)."','".$this->link->myesc($comentario)."','".$this->link->myesc($date)."','".$this->link->myesc($active)."','".$this->link->myesc($clasiffy)."','".$this->link->myesc($id_adm)."','".$this->link->myesc($id_update)."','".$this->link->myesc($ename)."','".$this->link->myesc($ephone)."','".$this->link->myesc($buy)."')";

	    	$result = $this->link->execute($query);
	     return $result;
		}

	 public function insert_customers_mod($id_mod, $id_commiss, $online, $pass, $name, $lastname, $email, $phone, $phone2, $fax, $cedula, $passport, $language, $zip, $address, $country, $state, $city, $photo, $info, $date_mod, $active, $clasiffy, $id_adm_mod, $ename, $ephone) {

			$query="INSERT INTO `".DB_PREFIX."customers_mod` ( `id`,
														`id_cust_mod`,
														`id_commiss`,
														`online`,
														`pass`,
														`name`,
														`lastname`,
														`email`,
														`phone`,
														`phone2`,
														`fax`,
														`cedula`,
														`passport`,
														`language`,
														`zip`,
														`address`,
														`country`,
														`state`,
														`city`,
														`photo`,
														`info`,
														`date_mod`,
														`active`,
														`classify_cust`,
														`id_adm_mod`,
														`ename`,
														`ephone`
														)
	 					VALUES ( NULL,'".$this->link->myesc($id_mod)."' ,'".$this->link->myesc($id_commiss)."','".$this->link->myesc($online)."','".$this->link->myesc($pass)."','".$this->link->myesc($name)."','".$this->link->myesc($lastname)."','".$this->link->myesc($email)."','".$this->link->myesc($phone)."','".$this->link->myesc($phone2)."','".$this->link->myesc($fax)."','".$this->link->myesc($cedula)."','".$this->link->myesc($passport)."','".$this->link->myesc($language)."','".$this->link->myesc($zip)."','".$this->link->myesc($address)."','".$this->link->myesc($country)."','".$this->link->myesc($state)."','".$this->link->myesc($city)."','".$this->link->myesc($photo)."','".$this->link->myesc($info)."','".$this->link->myesc($date_mod)."','".$this->link->myesc($active)."','".$this->link->myesc($clasiffy)."','".$this->link->myesc($id_adm_mod)."','".$this->link->myesc($ename)."','".$this->link->myesc($ephone)."')";

	    $result = $this->link->execute($query);
	          // $result= connect::query($query);
	     return $result;
	    // return (printf($result));
		}

		 public function update_clients($id, $commiss, $pass, $name, $lastname, $email, $phone, $phone2, $fax, $cedula, $passport, $language, $zip, $address, $country, $state, $city, $photo, $info, $active, $class, $id_update, $ename, $ephone) {

			$query="UPDATE `".DB_PREFIX."customers` SET
							`id_commission`='".$this->link->myesc($commiss)."',
                             `pass`='".$this->link->myesc($pass)."',
                             `name`='".$this->link->myesc($name)."',
                             `lastname`='".$this->link->myesc($lastname)."',
                             `email`='".$this->link->myesc($email)."',
                             `phone`='".$this->link->myesc($phone)."',
                             `phone2`='".$this->link->myesc($phone2)."',
                             `fax`='".$this->link->myesc($fax)."',
                             `cedula`='".$this->link->myesc($cedula)."',
                             `passport`='".$this->link->myesc($passport)."',
                             `language`='".$this->link->myesc($language)."',
                             `zip`='".$this->link->myesc($zip)."',
                             `address`='".$this->link->myesc($address)."',
                             `country`='".$this->link->myesc($country)."',
                             `state`='".$this->link->myesc($state)."',
                             `city`='".$this->link->myesc($city)."',
                             `photo`='".$this->link->myesc($photo)."',
                             `info`='".$this->link->myesc($info)."',
                             `active`='".$this->link->myesc( $active)."',
							 `classify_cust`='".$this->link->myesc($class)."',
                             `id_update`='".$this->link->myesc($id_update)."',
							 `ename`='".$this->link->myesc($ename)."',
                             `ephone`='".$this->link->myesc($ephone)."'
	 					WHERE `id`='".$this->link->myesc($id)."' LIMIT 1";

	    $result = $this->link->execute($query);
	          // $result= connect::query($query);
	     return $result;
	    // return (printf($result));
		}

		public function save_vip($id_client, $date,  $id_adm){
			$query="INSERT INTO `".DB_PREFIX."vip` (`id`,
													`id_client`,
													`date`,
													`id_adm`)
			VALUES (NULL, '".$this->link->myesc($id_client)."', '".$this->link->myesc($date)."', '".$this->link->myesc($id_adm)."')";

		  $result = $this->link->execute($query);
		  return $result;

		}

		public function in_factura($ref, $src, $id_adm, $date, $invoice_no, $tipo) {

			$query="INSERT INTO `".DB_PREFIX."invoice` ( `id` ,
														`ref`,
														`src` ,
														`id_adm` ,
														`date` ,
														`fact_no`,
														`type`)
	 				VALUES ( NULL,'".$this->link->myesc($ref)."' ,'".$this->link->myesc($src)."','".$this->link->myesc($id_adm)."','".$this->link->myesc($date)."','".$this->link->myesc($invoice_no)."','".$this->link->myesc($tipo)."')";

	    $result = $this->link->execute($query);
	          // $result= connect::query($query);
	     return $result;
	    // return (printf($result));
		}

		public function in_register_sheet($ref, $src, $sheet_no, $date, $id_adm) {

			$query="INSERT INTO `".DB_PREFIX."register_sheets` ( `id` ,
														`ref`,
														`src` ,
														`regist_no` ,
														`date` ,
														`id_adm`)
	 				VALUES ( NULL,'".$this->link->myesc($ref)."' ,'".$this->link->myesc($src)."','".$this->link->myesc($sheet_no)."','".$this->link->myesc($date)."','".$this->link->myesc($id_adm)."')";

	    $result = $this->link->execute($query);
	    return $result;
		}

		public function check_in($id, $status) {

			$query="UPDATE `".DB_PREFIX."reserves` SET `status`='".$this->link->myesc($status)."' WHERE `id`='".$this->link->myesc($id)."' LIMIT 1";

	    $result = $this->link->execute($query);
	    return $result;
		}

		public function check_in_insert($ref, $date, $id_adm) {

			$query="INSERT INTO `".DB_PREFIX."checkin` (`id`,
														`reser_no`,
														`fecha`,
														`id_adm`)
			VALUES (NULL, '".$this->link->myesc($ref)."', '".$this->link->myesc($date)."', '".$this->link->myesc($id_adm)."')";

	    $result = $this->link->execute($query);
	    return $this->link->getInsertId();
		}

		public function check_out($id, $status) {

			$query="UPDATE `".DB_PREFIX."reserves` SET `status`='".$this->link->myesc($status)."' WHERE `id`='".$this->link->myesc($id)."' LIMIT 1";

	    $result = $this->link->execute($query);
	    return $result;
		}

		public function check_out_insert($ref, $date, $id_adm) {

			$query="INSERT INTO `".DB_PREFIX."checkout` (`id`,
														`reser_no`,
														`fecha`,
														`id_adm`)
			VALUES (NULL, '".$this->link->myesc($ref)."', '".$this->link->myesc($date)."', '".$this->link->myesc($id_adm)."')";

	    $result = $this->link->execute($query);
		//$this->link->execute($query);
	    return $this->link->getInsertId();
		}

		public function charge_per_ckout($id_ckout,$desc1,$desc2,$desc3,$desc4,$desc5,$price1,$price2,$price3,$price4,$price5) {

			$query="INSERT INTO `".DB_PREFIX."ckout_charge` (`id`,
														`id_checkout`,
														`desc1`,
														`desc2`,
														`desc3`,
														`desc4`,
														`desc5`,
														`price1`,
														`price2`,
														`price3`,
														`price4`,
														`price5`)
			VALUES (NULL, '".$this->link->myesc($id_ckout)."', '".$this->link->myesc($desc1)."', '".$this->link->myesc($desc2)."', '".$this->link->myesc($desc3)."', '".$this->link->myesc($desc4)."', '".$this->link->myesc($desc5)."', '".$this->link->myesc($price1)."', '".$this->link->myesc($price2)."', '".$this->link->myesc($price3)."', '".$this->link->myesc($price4)."', '".$this->link->myesc($price5)."')";

	    //$result = $this->link->execute($query);

	    return $this->link->execute($query);
		}

		public function insertOwner($username, $password, $name, $lastname, $email, $phone, $movil, $fax, $cedula, $passport, $language, $zip, $address, $country, $photo, $rent_contract, $serv_contract, $comentario, $date, $active, $id_adm, $cedula2, $passport2) {

			$query="INSERT INTO `".DB_PREFIX."owners` ( `id`,
														`user`,
														`pass`,
														`name`,
														`lastname`,
														`email`,
														`phone`,
														`movil`,
														`fax`,
														`cedula`,
														`passport`,
														`language`,
														`zip`,
														`address`,
														`country`,
														`photo`,
														`contract_rent`,
														`contract_serv`,
														`info`,
														`date`,
														`active`,
														`id_adm`,
														`cedula2`,
														`passport2`
														)
	 					VALUES ( NULL,'".$this->link->myesc($username)."' ,'".$this->link->myesc($password)."','".$this->link->myesc($name)."','".$this->link->myesc($lastname)."','".$this->link->myesc($email)."','".$this->link->myesc($phone)."','".$this->link->myesc($movil)."','".$this->link->myesc($fax)."','".$this->link->myesc($cedula)."','".$this->link->myesc($passport)."','".$this->link->myesc($language)."','".$this->link->myesc($zip)."','".$this->link->myesc($address)."','".$this->link->myesc($country)."','".$this->link->myesc($photo)."','".$this->link->myesc($rent_contract)."','".$this->link->myesc($serv_contract)."','".$this->link->myesc($comentario)."','".$this->link->myesc($date)."','".$this->link->myesc($active)."','".$this->link->myesc($id_adm)."','".$this->link->myesc($cedula2)."','".$this->link->myesc($passport2)."')";

	    $result = $this->link->execute($query);
	    return $result;
		}

		public function updOwner($id, $username, $password, $name, $lastname, $email, $phone, $movil, $fax, $cedula, $passport, $language, $zip, $address, $country, $photo, $rent_contract, $serv_contract, $comentario, $date, $active, $id_adm, $cedula2, $passport2) {

			$query="UPDATE `".DB_PREFIX."owners` SET
				`user`='".$this->link->myesc($username)."',
				`pass`='".$this->link->myesc($password)."',
				`name`='".$this->link->myesc($name)."',
				`lastname`='".$this->link->myesc($lastname)."',
				`email`= '".$this->link->myesc($email)."',
				`phone`='".$this->link->myesc($phone)."',
				`movil`='".$this->link->myesc($movil)."',
				`fax`='".$this->link->myesc($fax)."',
				`cedula`= '".$this->link->myesc($cedula)."',
				`passport`='".$this->link->myesc($passport)."',
				`language`='".$this->link->myesc($language)."',
				`zip`='".$this->link->myesc($zip)."',
				`address`='".$this->link->myesc($address)."',
				`country`='".$this->link->myesc($country)."',
				`photo`='".$this->link->myesc($photo)."',
				`contract_rent`='".$this->link->myesc($rent_contract)."',
				`contract_serv`='".$this->link->myesc($serv_contract)."',
				`info`='".$this->link->myesc($comentario)."',
				`date`='".$this->link->myesc($date)."',
				`active`='".$this->link->myesc($active)."',
				`id_adm`='".$this->link->myesc($id_adm)."',
				`cedula2`='".$this->link->myesc($cedula2)."',
				`passport2`='".$this->link->myesc($passport2)."'
				WHERE `id`='".$this->link->myesc($id)."' LIMIT 1";

	    $result = $this->link->execute($query);
	    return $result;
		}

		public function updUsers($id, $level, $name, $lastname, $email, $phone, $info, $active, $date, $report, $receiveEmails) {

			$query="UPDATE `".DB_PREFIX."users` SET
				`level`='".$this->link->myesc($level)."',
				`name`='".$this->link->myesc($name)."',
				`lastname`='".$this->link->myesc($lastname)."',
				`email`= '".$this->link->myesc($email)."',
				`phone`='".$this->link->myesc($phone)."',
				`info`='".$this->link->myesc($info)."',
				`active`='".$this->link->myesc($active)."',
				`date`='".$this->link->myesc($date)."',
				`report`='".$this->link->myesc($report)."',
				`noemails`='".$this->link->myesc($receiveEmails)."'
				WHERE `id`='".$this->link->myesc($id)."' LIMIT 1";

	    $result = $this->link->execute($query);
	    return $result;
		}

		public function ins_add_service ($name, $price, $desc, $type, $comment, $date, $active, $pri_min, $pHS, $pHS2){

           $query="INSERT INTO `".DB_PREFIX."serv_add` (
                                 `id`,
                                 `name`,
                                 `price`,
                                 `description`,
                                 `type`,
                                 `comment`,
                                 `date`,
                                 `active`,
                                 `price_min`,
                                 `hs_price`,
                                 `hs_price2`
           						 )
           		VALUES (NULL,'".$this->link->myesc($name)."', '".$this->link->myesc($price)."', '".$this->link->myesc($desc)."', '".$this->link->myesc($type)."', '".$this->link->myesc($comment)."', '".$this->link->myesc($date)."', '".$this->link->myesc($active)."', '".$this->link->myesc($pri_min)."', '".$this->link->myesc($pHS)."', '".$this->link->myesc($pHS2)."')";

  		return $this->link->execute($query);
		}

		public function ins_commission ($password, $name, $lastname, $email, $url, $phone, $percent,$percent_long, $comment, $date, $active, $tipo){

           $query="INSERT INTO `".DB_PREFIX."commission` (
                                 `id`,
                                 `password`,
                                 `name`,
                                 `lastname`,
                                 `email`,
                                 `url`,
                                 `phone`,
                                 `percent`,
                                 `long_percent`,
                                 `comment`,
                                 `date`,
                                 `active`,
                                 `tipo`
           						 )
           		VALUES (NULL,'".$this->link->myesc($password)."','".$this->link->myesc($name)."', '".$this->link->myesc($lastname)."', '".$this->link->myesc($email)."', '".$this->link->myesc($url)."', '".$this->link->myesc($phone)."', '".$this->link->myesc($percent)."', '".$this->link->myesc($percent_long)."', '".$this->link->myesc($comment)."', '".$this->link->myesc($date)."', '".$this->link->myesc($active)."', '".$this->link->myesc($tipo)."')";

  		return $this->link->execute($query);
		}

		public function upd_add_service ($current_id, $name, $price, $desc, $type, $comment, $date, $active, $pri_min, $pHS, $pHS2){

           $query="UPDATE `".DB_PREFIX."serv_add` SET
           						 `name`='".$this->link->myesc($name)."',
                                 `price`='".$this->link->myesc($price)."',
                                 `description`='".$this->link->myesc($desc)."',
                                 `type`='".$this->link->myesc($type)."',
                                 `comment`='".$this->link->myesc($comment)."',
                                 `date`='".$this->link->myesc($date)."',
                                 `active`='".$this->link->myesc($active)."',
                                 `price_min`='".$this->link->myesc($pri_min)."',
                                 `hs_price`='".$this->link->myesc($pHS)."',
                                 `hs_price2`='".$this->link->myesc($pHS2)."'
					WHERE `id`='".$this->link->myesc($current_id)."' LIMIT 1";

  		return $this->link->execute($query);
		}

		public function upd_commission ($current_id, $password, $name, $lastname, $email, $url, $phone, $percent,$percent_long, $comment, $date, $active, $tipo){

           $query="UPDATE `".DB_PREFIX."commission` SET
           						 `password`='".$this->link->myesc($password)."',
                                 `name`='".$this->link->myesc($name)."',
                                 `lastname`='".$this->link->myesc($lastname)."',
                                 `email`='".$this->link->myesc($email)."',
                                 `url`='".$this->link->myesc($url)."',
                                 `phone`='".$this->link->myesc($phone)."',
                                 `percent`='".$this->link->myesc($percent)."',
                                 `long_percent`='".$this->link->myesc($percent_long)."',
                                 `comment`='".$this->link->myesc($comment)."',
                                 `date`='".$this->link->myesc($date)."',
                                 `active`='".$this->link->myesc($active)."',
                                 `tipo`='".$this->link->myesc($tipo)."'
           			WHERE `id`='".$this->link->myesc($current_id)."' LIMIT 1";

  		return $this->link->execute($query);
		}

		public function upd_seasons ($current_id, $date, $HF, $HT, $LF, $LT){

           $query="UPDATE `".DB_PREFIX."seasons` SET
                                 `date`='".$this->link->myesc($date)."',
                                 `h_starting`='".$this->link->myesc($HF)."',
                                 `h_ending`='".$this->link->myesc($HT)."',
                                 `l_starting`='".$this->link->myesc($LF)."',
                                 `l_ending`='".$this->link->myesc($LT)."'
           			WHERE `id`='".$this->link->myesc($current_id)."' LIMIT 1";

  		return $this->link->execute($query);
		}

		public function delete_intermediary($id){

           $query="DELETE FROM `".DB_PREFIX."commission` WHERE `id`='".$this->link->myesc($id)."' LIMIT 1";

  		return $this->link->execute($query);
		}

		public function delete_users($id){

           $query="DELETE FROM `".DB_PREFIX."users` WHERE `id`='".$this->link->myesc($id)."' LIMIT 1";

  		return $this->link->execute($query);
		}

		public function insert_cancelled($ref, $reasons, $id_adm, $date){

        $query="INSERT INTO `".DB_PREFIX."cancelled_books` (
                                 `id`,
                                 `ref`,
                                 `reasons`,
                                 `id_adm`,
                                 `date`
           						 )
           		VALUES (NULL,'".$this->link->myesc($ref)."', '".$this->link->myesc($reasons)."', '".$this->link->myesc($id_adm)."', '".$this->link->myesc($date)."')";

  		return $this->link->execute($query);
		}

		public function cancel_reserve($id){

           $query="UPDATE `".DB_PREFIX."reserves` SET `status`='0' WHERE `id`='".$this->link->myesc($id)."' LIMIT 1";

  		return $this->link->execute($query);
		}
		//UPDATING RESERVE

		public function in_busy_mod($starting, $ending, $type, $active, $id_villa, $id_admin, $comment, $date, $mm, $yyyy){
			$query="INSERT INTO `".DB_PREFIX."occupancy_mod` (`id`,
															`starting`,
															`ending`,
															`type`,
															`active`,
															`id_villa`,
															`id_adm`,
															`comment`,
															`date`,
															`mm`,
															`yyyy`)
							VALUES ( NULL ,'".$this->link->myesc($starting)."','".$this->link->myesc($ending)."','".$this->link->myesc($type)."','".$this->link->myesc($active)."','".$this->link->myesc($id_villa)."','".$this->link->myesc($id_admin)."','".$this->link->myesc($comment)."','".$this->link->myesc($date)."','".$this->link->myesc($mm)."','".$this->link->myesc($yyyy)."')";

			 $result = $this->link->execute($query);
			 return $result;
		}

		public function in_reserve_mod($ref, $id_ocupacion, $id_customer, $adults_qty, $children_qty, $vehicles, $interm_id, $qty_nights, $HS_nights, $LS_nights, $price_per_night, $PHS, $amount_commision, 	$sub_total_rent, $ITBIS, $services_amount, $deposit, $general_amount, $status, $reserve_comment){
			 $query="INSERT INTO `".DB_PREFIX."reserves_mod` (`id`,
															`ref`,
															`id_occ_mod`,
															`id_client`,
															`adults`,
															`children`,
															`vehicles`,
															`id_interm`,
															`qty_nights`,
															`nightsHS`,
															`nightsLS`,
															`price_nights`,
															`priceHS`,
															`commision`,
															`amount`,
															`tax`,
															`serv_amount`,
															`deposit`,
															`total`,
															`status`,
															`comment`)
							VALUES ( NULL ,'".$this->link->myesc($ref)."','".$this->link->myesc($id_ocupacion)."','".$this->link->myesc($id_customer)."','".$this->link->myesc($adults_qty)."','".$this->link->myesc($children_qty)."','".$this->link->myesc($vehicles)."','".$this->link->myesc($interm_id)."','".$this->link->myesc($qty_nights)."','".$this->link->myesc($HS_nights)."','".$this->link->myesc($LS_nights)."','".$this->link->myesc($price_per_night)."','".$this->link->myesc($PHS)."','".$this->link->myesc($amount_commision)."','".$this->link->myesc($sub_total_rent)."','".$this->link->myesc($ITBIS)."','".$this->link->myesc($services_amount)."','".$this->link->myesc($deposit)."','".$this->link->myesc($general_amount)."','".$this->link->myesc($status)."','".$this->link->myesc($reserve_comment)."')";

			 $result = $this->link->execute($query);
			 return $result;
		}

		public function in_people_mod($id_reserve, $name, $lastname, $comment, $type){ //RECORD OF PEOPLE SAVED
			 $query="INSERT INTO `".DB_PREFIX."people_mod` (`id`,
														`id_res_mod`,
														`name`,
														`lastname`,
														`passport`,
														`type`)
							VALUES ( NULL ,'".$this->link->myesc($id_reserve)."','".$this->link->myesc($name)."','".$this->link->myesc($lastname)."','".$this->link->myesc($comment)."','".$this->link->myesc($type)."')";
			 $result = $this->link->execute($query);
			 return $result;
		}

		public function in_serv_mod($id_service, $id_reserve, $qty, $price, $comment){  //SAVE OLD SERVICES
			 $query="INSERT INTO `".DB_PREFIX."serv_reserv_mod` (`id`,
															`id_service`,
															`id_res_mod`,
															`qty`,
															`price`,
															`comment`)
							VALUES ( NULL ,'".$this->link->myesc($id_service)."','".$this->link->myesc($id_reserve)."','".$this->link->myesc($qty)."','".$this->link->myesc($price)."','".$this->link->myesc($comment)."')";
			 $result = $this->link->execute($query);
			 return $result;
		}
/////////procedure to modification
		/*public function update_ocupacion($id, $start, $end, $type, $active, $villa, $adm, $comment, $date, $mm, $yyyy, $update){

           $query="UPDATE `".DB_PREFIX."occupancy` SET
						`starting`='".$this->link->myesc($start)."',
						`ending`='".$this->link->myesc($end)."',
						`type`='".$this->link->myesc($type)."',
						`active`='".$this->link->myesc($active)."',
						`id_villa`='".$this->link->myesc($villa)."',
						`id_adm`='".$this->link->myesc($adm)."',
						`comment`='".$this->link->myesc($comment)."',
						`date`='".$this->link->myesc($date)."',
						`mm`='".$this->link->myesc($mm)."',
						`yyyy`='".$this->link->myesc($yyyy)."',
						`id_update`='".$this->link->myesc($update)."'
				   WHERE `id`='".$this->link->myesc($id)."' LIMIT 1";

  		return $this->link->execute($query);
		}*/
		
		public function update_ocupacion($id, $start, $end, $type, $active, $villa, $adm, $comment, $date, $mm, $yyyy, $update){

           $query="UPDATE `".DB_PREFIX."occupancy` SET
						`starting`='".$this->link->myesc($start)."',
						`ending`='".$this->link->myesc($end)."',
						`type`='".$this->link->myesc($type)."',
						`active`='".$this->link->myesc($active)."',
						`id_villa`='".$this->link->myesc($villa)."',
						`comment`='".$this->link->myesc($comment)."',
						`date`='".$this->link->myesc($date)."',
						`mm`='".$this->link->myesc($mm)."',
						`yyyy`='".$this->link->myesc($yyyy)."',
						`id_update`='".$this->link->myesc($update)."'
				   WHERE `id`='".$this->link->myesc($id)."' LIMIT 1";

  		return $this->link->execute($query);
		}

		public function update_reservation($id, $ref, $idbusy, $client, $adults, $kids, $vehiculos, $interm, $nights, $HS_nights, $LS_nights, $price, $priceHS, $commision, $amount, $tax, $samount, $deposit, $total, $status){

           $query="UPDATE `".DB_PREFIX."reserves` SET
						`ref`='".$this->link->myesc($ref)."',
						`id_occupancy`='".$this->link->myesc($idbusy)."',
						`id_client`='".$this->link->myesc($client)."',
						`adults`='".$this->link->myesc($adults)."',
						`children`='".$this->link->myesc($kids)."',
						`vehicles`='".$this->link->myesc($vehiculos)."',
						`id_interm`='".$this->link->myesc($interm)."',
						`qty_nights`='".$this->link->myesc($nights)."',
						`nightsHS`='".$this->link->myesc($HS_nights)."',
						`nightsLS`='".$this->link->myesc($LS_nights)."',
						`price_per_night`='".$this->link->myesc($price)."',
						`priceHS`='".$this->link->myesc($priceHS)."',
						`commision`='".$this->link->myesc($commision)."',
						`amount`='".$this->link->myesc($amount)."',
						`tax`='".$this->link->myesc($tax)."',
						`services_amount`='".$this->link->myesc($samount)."',
						`deposit`='".$this->link->myesc($deposit)."',
						`total`='".$this->link->myesc($total)."',
						`status`='".$this->link->myesc($status)."'
				   WHERE `id`='".$this->link->myesc($id)."' LIMIT 1";

  		return $this->link->execute($query);
		}
//=============================================== EDITING LONG RESERVATIONS================================================================
public function update_reservation_long($id, $ref, $idbusy, $client, $adults, $kids, $vehiculos, $interm, $nights, $HS_nights, $LS_nights, $price, $priceHS, $commision, $amount, $tax, $samount, $deposit, $total, $status,$pago_qty,$pagos_monto,$price_long,$qty_nights_extra){

           $query="UPDATE `".DB_PREFIX."reserves` SET
						`ref`='".$this->link->myesc($ref)."',
						`id_occupancy`='".$this->link->myesc($idbusy)."',
						`id_client`='".$this->link->myesc($client)."',
						`adults`='".$this->link->myesc($adults)."',
						`children`='".$this->link->myesc($kids)."',
						`vehicles`='".$this->link->myesc($vehiculos)."',
						`id_interm`='".$this->link->myesc($interm)."',
						`qty_nights`='".$this->link->myesc($nights)."',
						`nightsHS`='".$this->link->myesc($HS_nights)."',
						`nightsLS`='".$this->link->myesc($LS_nights)."',
						`price_per_night`='".$this->link->myesc($price)."',
						`priceHS`='".$this->link->myesc($priceHS)."',
						`commision`='".$this->link->myesc($commision)."',
						`amount`='".$this->link->myesc($amount)."',
						`tax`='".$this->link->myesc($tax)."',
						`services_amount`='".$this->link->myesc($samount)."',
						`deposit`='".$this->link->myesc($deposit)."',
						`total`='".$this->link->myesc($total)."',
						`status`='".$this->link->myesc($status)."',
						`pagos_qty`='".$this->link->myesc($pago_qty)."',
						`pagos_monto`='".$this->link->myesc($pagos_monto)."',
						`price_long`='".$this->link->myesc($price_long)."',
						`extra_nights`='".$this->link->myesc($qty_nights_extra)."'
				   WHERE `id`='".$this->link->myesc($id)."' LIMIT 1";

  		return $this->link->execute($query);
		}
//========================================================================================================================================
		public function delete_items($table, $field, $value){

			$sql="DELETE FROM `".DB_PREFIX.$table."` WHERE `".$field."`='".$value."' ";

		return $this->link->execute($sql);
		}

		public function getInsertId(){
		$result = $this->link->getInsertId();

		return $result;
		}
	//---------------ASSIGN BOOKING TO REFERAL-------------------------------------------------------------------------------------------
	public function assignBooking($reference, $referal, $id_adm, $fecha, $id_update, $amountdiscounted){
    $query="INSERT INTO `".DB_PREFIX."bookingreferred` ( `id`,
													`ref_book`,
													`id_referal`,
													`id_adm`,
													`fecha`,
													`id_update`,
													`discounted`)
 					VALUES ( NULL ,'".$this->link->myesc($reference)."','".$this->link->myesc($referal)."','".$this->link->myesc($id_adm)."','".$this->link->myesc($fecha)."','".$this->link->myesc($id_update)."','".$this->link->myesc($amountdiscounted)."')";

     $result = $this->link->execute($query);
     return $result;
	}

	public function update_assignedBook($id, $reference, $referal, $id_adm, $fecha, $id_update){
     $query="UPDATE `".DB_PREFIX."bookingreferred` SET
						`ref_book`='".$this->link->myesc($reference)."',
						`id_referal`='".$this->link->myesc($referal)."',
						`id_adm`='".$this->link->myesc($id_adm)."',
						`fecha`='".$this->link->myesc($fecha)."',
						`id_update`='".$this->link->myesc($id_update)."'
				   WHERE `id`='".$this->link->myesc($id)."' LIMIT 1";

     $result = $this->link->execute($query);
     return $result;
	}

	public function assign_modified($reference, $referal, $id_adm, $fecha){   //insert assign modified
    $query="INSERT INTO `".DB_PREFIX."bookingreferred_mod` ( `id`,
													`ref_book`,
													`id_referal`,
													`id_adm`,
													`fecha`)
 			VALUES ( NULL ,'".$this->link->myesc($reference)."','".$this->link->myesc($referal)."','".$this->link->myesc($id_adm)."','".$this->link->myesc($fecha)."')";

     $result = $this->link->execute($query);
     return $result;
	}
	//---------------promotion below--------------------------------------------------------------
	public function insert_promotion($code, $tipo, $monto_porc,  $mdays, $maxdays, $desde, $hasta, $bookingfrom, $bookingto, $id_adm, $activo, $fecha, $title){   //insert promotion
    $query="INSERT INTO `".DB_PREFIX."promotion` ( `id`,
													`code`,
													`tipo`,
													`qty`,
													`min_days`,
													`max_days`,
													`desde`,
													`hasta`,
													`bookingfrom`,
													`bookingto`,
													`id_adm`,
													`active`,
													`fecha`,
													`title`)
 			VALUES ( NULL ,'".$this->link->myesc($code)."','".$this->link->myesc($tipo)."','".$this->link->myesc($monto_porc)."','".$this->link->myesc($mdays)."','".$this->link->myesc($maxdays)."','".$this->link->myesc($desde)."','".$this->link->myesc($hasta)."','".$this->link->myesc($bookingfrom)."','".$this->link->myesc($bookingto)."','".$this->link->myesc($id_adm)."','".$this->link->myesc($activo)."','".$this->link->myesc($fecha)."','".$this->link->myesc($title)."')";

     $result = $this->link->execute($query);
     return $result;
	}
	public function update_promotion($id, $code, $tipo, $monto_porc, $mdays, $maxdays, $desde, $hasta, $bookingfrom, $bookingto, $id_adm, $activo, $fecha, $title){       //update promotion
     $query="UPDATE `".DB_PREFIX."promotion` SET
						`code`='".$this->link->myesc($code)."',
						`tipo`='".$this->link->myesc($tipo)."',
						`qty`='".$this->link->myesc($monto_porc)."',
						`min_days`='".$this->link->myesc($mdays)."',
						`max_days`='".$this->link->myesc($maxdays)."',
						`desde`='".$this->link->myesc($desde)."',
						`hasta`='".$this->link->myesc($hasta)."',
						`bookingfrom`='".$this->link->myesc($bookingfrom)."',
						`bookingto`='".$this->link->myesc($bookingto)."',
						`id_adm`='".$this->link->myesc($id_adm)."',
						`active`='".$this->link->myesc($activo)."',
						`fecha`='".$this->link->myesc($fecha)."',
						`title`='".$this->link->myesc($title)."'
				   WHERE `id`='".$this->link->myesc($id)."' LIMIT 1";
     $result = $this->link->execute($query);
     return $result;
	}

	//--------------- DISCOUNT FOR A BOOKING BELOW -------------------------------------------------------------------------------------------
	public function insert_discount_DB($fecha,$ref,$pro_code,$pro_id,$pro_from,$pro_to,$pro_type,$pro_qty,$min_days,$max_days,$bookfrom,$bookto, $discounted, $id_adm,$update, $new){
    $query="INSERT INTO `".DB_PREFIX."discount` ( `id`,
													`fecha`,
													`reference`,
													`pro_code`,
													`pro_id`,
													`pro_from`,
													`pro_to`,
													`pro_type`,
													`pro_qty`,
													`min_days`,
													`max_days`,
													`tobookfrom`,
													`tobookto`,
													`discounted`,
													`id_adm`,
													`updated`,
													`new`)
 					VALUES ( NULL ,'".$this->link->myesc($fecha)."',
					'".$this->link->myesc($ref)."',
					'".$this->link->myesc($pro_code)."',
					'".$this->link->myesc($pro_id)."',
					'".$this->link->myesc($pro_from)."',
					'".$this->link->myesc($pro_to)."',
					'".$this->link->myesc($pro_type)."',
					'".$this->link->myesc($pro_qty)."',
					'".$this->link->myesc($min_days)."',
					'".$this->link->myesc($max_days)."',
					'".$this->link->myesc($bookfrom)."',
					'".$this->link->myesc($bookto)."',
					'".$this->link->myesc($discounted)."',
					'".$this->link->myesc($id_adm)."',
					'".$this->link->myesc($update)."',
					'".$this->link->myesc($new)."')";

     $result = $this->link->execute($query);
     return $result;
	}

	public function update_discount_DB(	$id,
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
										$update){
     $query="UPDATE `".DB_PREFIX."discount` SET
						`fecha`='".$this->link->myesc($fecha)."',
						`reference`='".$this->link->myesc($ref)."',
						`pro_code`='".$this->link->myesc($pro_code)."',
						`pro_id`='".$this->link->myesc($pro_id)."',
						`pro_from`='".$this->link->myesc($pro_from)."',
						`pro_to`='".$this->link->myesc($pro_to)."',
						`pro_type`='".$this->link->myesc($pro_type)."',
						`pro_qty`='".$this->link->myesc($pro_qty)."',
						`min_days`='".$this->link->myesc($min_days)."',
						`max_days`='".$this->link->myesc($max_days)."',
						`tobookfrom`='".$this->link->myesc($bookfrom)."',
						`tobookto`='".$this->link->myesc($bookto)."',
						`discounted`='".$this->link->myesc($discounted)."',
						`id_adm`='".$this->link->myesc($id_adm)."',
						`updated`='".$this->link->myesc($update)."'
				   WHERE `id`='".$this->link->myesc($id)."' LIMIT 1";

     $result = $this->link->execute($query);
     return $result;
	}

	public function insert_discount_modified_DB(
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
											$id_adm){   //insert discount modified

    $query="INSERT INTO `".DB_PREFIX."discount_mod` ( 	`id`,
														`fecha`,
														`reference`,
														`pro_code`,
														`pro_id`,
														`pro_from`,
														`pro_to`,
														`pro_type`,
														`pro_qty`,
														`min_days`,
														`max_days`,
														`tobookfrom`,
														`tobookto`,
														`discounted`,
														`id_adm`)
 										VALUES ( NULL ,
 												'".$this->link->myesc($fecha)."',
									 			'".$this->link->myesc($ref)."',
									 			'".$this->link->myesc($pro_code)."',
									 			'".$this->link->myesc($pro_id)."',
									 			'".$this->link->myesc($pro_from)."',
									 			'".$this->link->myesc($pro_to)."',
									 			'".$this->link->myesc($pro_type)."',
									 			'".$this->link->myesc($pro_qty)."',
									 			'".$this->link->myesc($min_days)."',
									 			'".$this->link->myesc($max_days)."',
									 			'".$this->link->myesc($bookfrom)."',
									 			'".$this->link->myesc($bookto)."',
									 			'".$this->link->myesc($discounted)."',
									 			'".$this->link->myesc($id_adm)."')";

     $result = $this->link->execute($query);
     return $result;
	}
	//-----------END DISCOUNT FOR A BOOKING --------------------------

    public function insert_webpage($ref, $url, $fecha){   //insert promotion
    $query="INSERT INTO `".DB_PREFIX."webpages` ( `id`,
    											  `ref_book`,
												  `url`,
												  `date`)
 			VALUES ( NULL ,'".$this->link->myesc($ref)."','".$this->link->myesc($url)."','".$this->link->myesc($fecha)."')";

     $result = $this->link->execute($query);
     return $result;
	}

	//--------------- Referral details below--------------------------------------------------------------
	public function insert_referral_det($referral_id, $cell, $agency, $language, $question1, $answer1, $question2, $answer2){   //insert promotion
    $query="INSERT INTO `".DB_PREFIX."referral_details` ( `id`,
													`referral`,
													`cell`,
													`agency`,
													`language`,
													`question1`,
													`answer1`,
													`question2`,
													`answer2`)
 			VALUES ( NULL ,'".$this->link->myesc($referral_id)."','".$this->link->myesc($cell)."','".$this->link->myesc($agency)."','".$this->link->myesc($language)."','".$this->link->myesc($question1)."','".$this->link->myesc($answer1)."','".$this->link->myesc($question2)."','".$this->link->myesc($answer2)."')";

     $result = $this->link->execute($query);
     return $result;
	}
	public function update_referra_det($id, $referral_id, $cell, $agency, $language, $question1, $answer1, $question2, $answer2){       //update promotion
     $query="UPDATE `".DB_PREFIX."referral_details` SET
						`referral`='".$this->link->myesc($referral_id)."',
						`cell`='".$this->link->myesc($cell)."',
						`agency`='".$this->link->myesc($agency)."',
						`language`='".$this->link->myesc($language)."',
						`question1`='".$this->link->myesc($question1)."',
						`answer1`='".$this->link->myesc($answer1)."',
						`question2`='".$this->link->myesc($question2)."',
						`answer2`='".$this->link->myesc($answer2)."'
				   WHERE `id`='".$this->link->myesc($id)."' LIMIT 1";
     $result = $this->link->execute($query);
     return $result;
	}
	
	public function inRefLogo($referral_id, $cell, $agency, $language, $question1, $answer1, $question2, $answer2, $logo){   //insert promotion
    $query="INSERT INTO `".DB_PREFIX."referral_details` ( `id`,
													`referral`,
													`cell`,
													`agency`,
													`language`,
													`question1`,
													`answer1`,
													`question2`,
													`answer2`,
													`logo`)
 			VALUES ( NULL ,'".$this->link->myesc($referral_id)."','".$this->link->myesc($cell)."','".$this->link->myesc($agency)."','".$this->link->myesc($language)."','".$this->link->myesc($question1)."','".$this->link->myesc($answer1)."','".$this->link->myesc($question2)."','".$this->link->myesc($answer2)."','".$this->link->myesc($logo)."')";

     $result = $this->link->execute($query);
     return $result;
	}
	public function upRefLogo($id, $referral_id, $cell, $agency, $language, $question1, $answer1, $question2, $answer2, $logo){       //update promotion
     $query="UPDATE `".DB_PREFIX."referral_details` SET
						`referral`='".$this->link->myesc($referral_id)."',
						`cell`='".$this->link->myesc($cell)."',
						`agency`='".$this->link->myesc($agency)."',
						`language`='".$this->link->myesc($language)."',
						`question1`='".$this->link->myesc($question1)."',
						`answer1`='".$this->link->myesc($answer1)."',
						`question2`='".$this->link->myesc($question2)."',
						`answer2`='".$this->link->myesc($answer2)."',
						`logo`='".$this->link->myesc($logo)."'
				   WHERE `id`='".$this->link->myesc($id)."' LIMIT 1";
     $result = $this->link->execute($query);
     return $result;
	}

	public function pickup_check_referral($reference){       //update promotion
     $query="UPDATE `".DB_PREFIX."bookingreferred` SET
						`paid`='1'
				   WHERE `ref_book`='".$this->link->myesc($reference)."' AND `id_referal`<>'0' LIMIT 1";
     $result = $this->link->execute($query);
     return $result;
	}

	public function paid_check_referral($reference){       //update promotion
     $query="UPDATE `".DB_PREFIX."bookingreferred` SET
						`paid`='2'
				   WHERE `ref_book`='".$this->link->myesc($reference)."' AND `id_referal`<>'0' LIMIT 1";
     $result = $this->link->execute($query);
     return $result;
	}

	public function change_referral_pass($id,$new_pass) {

			$query="UPDATE `".DB_PREFIX."commission` SET
						`password`='".$this->link->myesc($new_pass)."'
					WHERE `id`='".$this->link->myesc($id)."' LIMIT 1";

			return $this->link->execute($query);

	}

		//---------------INSERTAR VEHICULO-------------------------------------------------------------------------------------------
	public function Insert_vehicules($reference, $make, $model, $placa, $color){
    $query="INSERT INTO `".DB_PREFIX."vehicle` ( `id`,
													`ref_book`,
													`make`,
													`model`,
													`lic_plate`,
													`color`)
 					VALUES ( NULL ,'".$this->link->myesc($reference)."','".$this->link->myesc($make)."','".$this->link->myesc($model)."','".$this->link->myesc($placa)."','".$this->link->myesc($color)."')";

     $result = $this->link->execute($query);
     return $result;
	}
   //--------------ACTUALIZAR VEHICULO---------------
	public function update_vehicules($id, $reference, $make, $model, $placa, $color){
     $query="UPDATE `".DB_PREFIX."vehicle` SET
						`ref_book`='".$this->link->myesc($reference)."',
						`make`='".$this->link->myesc($make)."',
						`model`='".$this->link->myesc($model)."',
						`lic_plate`='".$this->link->myesc($placa)."',
						`color`='".$this->link->myesc($color)."'
				   WHERE `id`='".$this->link->myesc($id)."' LIMIT 1";

     $result = $this->link->execute($query);
     return $result;
	}

	//--------actualizar usuario y contrase�a due�os--------------

	public function change_owner_pass($id,$new_pass) {

			$query="UPDATE `".DB_PREFIX."owners` SET
						`pass`='".$this->link->myesc($new_pass)."'
					WHERE `id`='".$this->link->myesc($id)."' LIMIT 1";

			return $this->link->execute($query);

	}

	public function change_owner_user($id,$username) {

			$query="UPDATE `".DB_PREFIX."owners` SET
						`user`='".$this->link->myesc($username)."'
					WHERE `id`='".$this->link->myesc($id)."' LIMIT 1";

			return $this->link->execute($query);

	}
   //--------actualizar usuario y contrase�a due�os--------------

   //------------------------------------------------------------------------------------------------
   public function in_clean($admin, $villa, $status, $nota){
   	$fecha=date("Y-m-d G:i:s");
    $query="INSERT INTO `".DB_PREFIX."clean_villas` (`id`,
													`id_adm`,
													`id_villa`,
													`status`,
													`nota`,
													`fecha`)
 					VALUES ( NULL ,'".$this->link->myesc($admin)."','".$this->link->myesc($villa)."','".$this->link->myesc($status)."','".$this->link->myesc($nota)."','".$this->link->myesc($fecha)."')";

     $result = $this->link->execute($query);
     return $result;
	}

	public function up_clean($id, $admin, $villa, $status, $nota) {
     $fecha=date("Y-m-d G:i:s");
			$query="UPDATE `".DB_PREFIX."clean_villas` SET
						`id_adm`='".$this->link->myesc($admin)."',
						`id_villa`='".$this->link->myesc($villa)."',
						`status`='".$this->link->myesc($status)."',
						`nota`='".$this->link->myesc($nota)."',
						`fecha`='".$this->link->myesc($fecha)."'
					WHERE `id`='".$this->link->myesc($id)."' LIMIT 1";

			return $this->link->execute($query);

	}

	//--------------- insertar excursion---------------
	public function insert_excursions($titulo, $desc, $precio_a, $precio_c, $link_t, $link, $pic){
     $query="INSERT INTO `".DB_PREFIX."excursions` (`id`,
												`title` ,
												`desc` ,
												`price_a` ,
												`price_c` ,
												`link_t`,
												`link`,
												`pic`)
 					VALUES ( NULL ,'".$this->link->myesc($titulo)."','".$this->link->myesc($desc)."','".$this->link->myesc($precio_a)."','".$this->link->myesc($precio_c)."','".$this->link->myesc($link_t)."','".$this->link->myesc($link)."','".$this->link->myesc($pic)."')";
     $result = $this->link->execute($query);
     return $result;
	}

	public function update_excursions($id, $titulo, $desc, $precio_a, $precio_c, $link_t, $link, $pic){
     $query="UPDATE `".DB_PREFIX."excursions` SET
     				`title`='".$this->link->myesc($titulo)."',
     				`desc`='".$this->link->myesc($desc)."',
     				`price_a`='".$this->link->myesc($precio_a)."',
     				`price_c`='".$this->link->myesc($precio_c)."',
     				`link_t`='".$this->link->myesc($link_t)."',
     				`link`='".$this->link->myesc($link)."',
     				`pic`='".$this->link->myesc($pic)."'
 			  WHERE `id`='".$this->link->myesc($id)."' LIMIT 1";
     $result = $this->link->execute($query);
     return $result;
	}

	//------------------------------------------------------------------------------------
	public function in_excur_booked($id_excursion, $id_reserva, $qty_adult, $qty_child, $precio_a, $precio_c, $total_excursion){
     $query="INSERT INTO `".DB_PREFIX."excursions_booked` (	`id`,
															`id_excursion` ,
															`id_reserve` ,
															`qty_a` ,
															`qty_c` ,
															`price_a`,
															`price_c`,
															`total`)
 							VALUES ( NULL ,
 									'".$this->link->myesc($id_excursion)."',
				 					'".$this->link->myesc($id_reserva)."',
				 					'".$this->link->myesc($qty_adult)."',
				 					'".$this->link->myesc($qty_child)."',
				 					'".$this->link->myesc($precio_a)."',
				 					'".$this->link->myesc($precio_c)."',
				 					'".$this->link->myesc($total_excursion)."')";
     $result = $this->link->execute($query);
     return $result;
	}

	public function in_excur_booked_mod($id_excursion, $id_reserva, $qty_adult, $qty_child, $precio_a, $precio_c, $total_excursion){
      $query="INSERT INTO `".DB_PREFIX."excursions_booked_mod` (`id`,
															`id_excursion` ,
															`id_reserve_mod` ,
															`qty_a` ,
															`qty_c` ,
															`price_a`,
															`price_c`,
															`total`)
 						VALUES ( NULL ,
 									'".$this->link->myesc($id_excursion)."',
				 					'".$this->link->myesc($id_reserva)."',
				 					'".$this->link->myesc($qty_adult)."',
				 					'".$this->link->myesc($qty_child)."',
				 					'".$this->link->myesc($precio_a)."',
				 					'".$this->link->myesc($precio_c)."',
				 					'".$this->link->myesc($total_excursion)."')";

     $result = $this->link->execute($query);
     return $result;
	}

	public function insertar_tripadvisor($ref){
     $query="INSERT INTO `".DB_PREFIX."tripadvisor` (`id`,
												`booking`,
												`request`)
 					VALUES ( NULL ,'".$this->link->myesc($ref)."','1')";
     $result = $this->link->execute($query);
     return $result;
	}

    //functions for the special events below
	public function insertar_event($name, $from, $to, $qty, $type, $increase, $active, $date){
     $query="INSERT INTO `".DB_PREFIX."special_events` (`id`,
     											`name`,
												`from_date`,
												`to_date`,
												`qty`,
												`type`,
												`increase`,
												`active`,
												`date`)
 					VALUES ( NULL ,'".$this->link->myesc($name)."','".$this->link->myesc($from)."','".$this->link->myesc($to)."','".$this->link->myesc($qty)."','".$this->link->myesc($type)."','".$this->link->myesc($increase)."','".$this->link->myesc($active)."','".$this->link->myesc($date)."')";

     $result = $this->link->execute($query);
     return $result;
	}

	public function edit_event($id, $name, $from, $to, $qty, $type, $increase, $active, $date){
     $query="UPDATE `".DB_PREFIX."special_events` SET
     			`name`='".$this->link->myesc($name)."',
				 `from_date`='".$this->link->myesc($from)."',
				 `to_date`='".$this->link->myesc($to)."',
				 `qty`='".$this->link->myesc($qty)."',
				 `type`='".$this->link->myesc($type)."',
				 `increase`='".$this->link->myesc($increase)."',
				 `active`='".$this->link->myesc($active)."',
				 `date`='".$this->link->myesc($date)."'
			WHERE `id`='".$this->link->myesc($id)."' LIMIT 1";
     $result = $this->link->execute($query);
     return $result;
	}

	public function insert_events_saved($fecha,$ref,$name,$from,$to,$qty,$type,$increase, $id_adm, $id_event){
    $query="INSERT INTO `".DB_PREFIX."events_saved` (`id`,
													`fecha`,
													`ref`,
													`name`,
													`from`,
													`to`,
													`qty`,
													`type`,
													`increase`,
													`id_adm`,
													`id_event`)
 					VALUES ( NULL ,'".$this->link->myesc($fecha)."','".$this->link->myesc($ref)."','".$this->link->myesc($name)."','".$this->link->myesc($from)."','".$this->link->myesc($to)."','".$this->link->myesc($qty)."','".$this->link->myesc($type)."','".$this->link->myesc($increase)."','".$this->link->myesc($id_adm)."','".$this->link->myesc($id_event)."')";

     $result = $this->link->execute($query);
     return $result;
	}

	public function insert_comments($ref,$note,$tipo,$deleted, $id_adm, $fecha, $complaint, $villa_id, $id_reserv_mod){
	//case of tipo:
	//1=normal (delatable, for everybody including the manager)
	//2=manager (deletable too, only will appear in other diferent color)
	//3=complaint (deletable, require complaint number, require villa number)
	//4=booking note ( NO deletable, require id reserva mod, [complaint 1->id_reserve_mod=checkin_id], [complaint 2->id_reserve_mod=checkout_id])
    $query="INSERT INTO `".DB_PREFIX."comments` (`id`,
												 `ref`,
												 `comment`,
												 `tipo`,
												 `deleted`,
												 `id_adm`,
												 `fecha`,
												 `complaint`,
												 `villa_id`,
												 `id_reserve_mod`)
 					VALUES ( NULL ,'".$this->link->myesc($ref)."','".$this->link->myesc($note)."','".$this->link->myesc($tipo)."','".$this->link->myesc($deleted)."','".$this->link->myesc($id_adm)."','".$this->link->myesc($fecha)."','".$this->link->myesc($complaint)."','".$this->link->myesc($villa_id)."','".$this->link->myesc($id_reserv_mod)."')";

     $result = $this->link->execute($query);
    return $this->link->getInsertId();
	}

	public function delete_comments($id){
    $query="UPDATE `".DB_PREFIX."comments` SET `deleted`='1' WHERE `id`='".$this->link->myesc($id)."' LIMIT 1";
     $result = $this->link->execute($query);
     return $result;
	}
    //---------------------INSERTAR LAS SECCIONES DE LOS USUARIOS------------------
	public function insert_user_access($user_id, $date_time, $in_out, $session, $ip){
     $query="INSERT INTO `".DB_PREFIX."users_access` (`id`,
												`id_user`,
												`date_time`,
												`in_out`,
												`session`,
												`ip`)
 					VALUES ( NULL ,'".$this->link->myesc($user_id)."','".$this->link->myesc($date_time)."','".$this->link->myesc($in_out)."','".$this->link->myesc($session)."','".$this->link->myesc($ip)."')";
     $result = $this->link->execute($query);
     return $result;
	}

	//-----------------------FLAT PRICING FOR LONG TERM BOOKING-----------------------------
	public function update_flat_disable($id){
    $query="UPDATE `".DB_PREFIX."flat_amount_long` SET `active`='0' WHERE `id`='".$this->link->myesc($id)."' LIMIT 1";
     $result = $this->link->execute($query);
     return $result;
	}

	public function insert_flat_pricing($date, $type, $amount, $ref, $id_adm, $active){
     $query="INSERT INTO `".DB_PREFIX."flat_amount_long` (`id`,
												`date`,
												`flat_type`,
												`flat_amount`,
												`ref`,
												`id_adm`,
												`active`)
 					VALUES ( NULL ,'".$this->link->myesc($date)."','".$this->link->myesc($type)."','".$this->link->myesc($amount)."','".$this->link->myesc($ref)."','".$this->link->myesc($id_adm)."','".$this->link->myesc($active)."')";
     $result = $this->link->execute($query);
     return $result;
	}

	//-----------------------PRICE SETTING FOR BOOKINGS-----------------------------
	public function update_priceSetting(	$id, 
											$id_adm, 
											$date, 
											$short_m_night, 
											$mid_m_night, 
											$long_m_night, 
											$short2bdr, 
											$short3bdr, 
											$short4bdr, 
											$short5bdr, 
											$short6bdr, 
											$mid2bdr, 
											$mid3bdr, 
											$mid4bdr, 
											$mid5bdr, 
											$mid6bdr){
    $query="UPDATE `".DB_PREFIX."price_settings` SET
			 `adm`='".$this->link->myesc($id_adm)."',
			 `fecha`='".$this->link->myesc($date)."',
			 `short_m_night`='".$this->link->myesc($short_m_night)."',
			 `mid_m_night`='".$this->link->myesc($mid_m_night)."',
			 `long_m_night`='".$this->link->myesc($long_m_night)."',
			 `short2bdr`='".$this->link->myesc($short2bdr)."',
			 `short3bdr`='".$this->link->myesc($short3bdr)."',
			 `short4bdr`='".$this->link->myesc($short4bdr)."',
			 `short5bdr`='".$this->link->myesc($short5bdr)."',
			 `short6bdr`='".$this->link->myesc($short6bdr)."',
			 `mid2bdr`='".$this->link->myesc($mid2bdr)."',
			 `mid3bdr`='".$this->link->myesc($mid3bdr)."',
			 `mid4bdr`='".$this->link->myesc($mid4bdr)."',
			 `mid5bdr`='".$this->link->myesc($mid5bdr)."',
			 `mid6bdr`='".$this->link->myesc($mid6bdr)."'
		 WHERE `id`='".$this->link->myesc($id)."' LIMIT 1";
     $result = $this->link->execute($query);
     return $result;
	}

	public function insert_priceSetting(	$id_adm, 
											$date, 
											$short_m_night, 
											$mid_m_night, 
											$long_m_night, 
											$short2bdr, 
											$short3bdr, 
											$short4bdr, 
											$short5bdr, 
											$short6bdr, 
											$mid2bdr, 
											$mid3bdr, 
											$mid4bdr, 
											$mid5bdr, 
											$mid6bdr, 
											$active){
     $query="INSERT INTO `".DB_PREFIX."price_settings` (`id`,
												`adm`,
												`fecha`,
												`short_m_night`,
												`mid_m_night`,
												`long_m_night`,
												`short2bdr`,
												`short3bdr`,
												`short4bdr`,
												`short5bdr`,
												`short6bdr`,
												`mid2bdr`,
												`mid3bdr`,
												`mid4bdr`,
												`mid5bdr`,
												`mid6bdr`,
												`active`)
 					VALUES ( NULL ,'".$this->link->myesc($id_adm)."',
		 					'".$this->link->myesc($date)."',
		 					'".$this->link->myesc($short_m_night)."',
		 					'".$this->link->myesc($mid_m_night)."',
		 					'".$this->link->myesc($long_m_night)."',
		 					'".$this->link->myesc($short2bdr)."',
		 					'".$this->link->myesc($short3bdr)."',
							'".$this->link->myesc($short4bdr)."',
							'".$this->link->myesc($short5bdr)."',
							'".$this->link->myesc($short6bdr)."',
							'".$this->link->myesc($mid2bdr)."',
							'".$this->link->myesc($mid3bdr)."',
							'".$this->link->myesc($mid4bdr)."',
							'".$this->link->myesc($mid5bdr)."',
							'".$this->link->myesc($mid6bdr)."',
		 					'".$this->link->myesc($active)."')";
     $result = $this->link->execute($query);
     return $result;
	}

	//----------------------- HS PRICE SETTING FOR VEHICLES-----------------------------
	public function upd_HScars($id, $f1, $t1, $id_adm, $date){
    $query="UPDATE `".DB_PREFIX."vehicle_HS` SET
	     `hs_from`='".$this->link->myesc($f1)."',
	     `hs_to`='".$this->link->myesc($t1)."',
	     `id_adm`='".$this->link->myesc($id_adm)."',
	     `date`='".$this->link->myesc($date)."'
     WHERE `id`='".$this->link->myesc($id)."' LIMIT 1";
     $result = $this->link->execute($query);
     return $result;
	}

	public function ins_HScars($f1, $t1, $id_adm, $date){
     $query="INSERT INTO `".DB_PREFIX."vehicle_HS` (`id`,
												`hs_from`,
												`hs_to`,
												`id_adm`,
												`date`)
 					VALUES ( NULL ,'".$this->link->myesc($f1)."',
		 					'".$this->link->myesc($t1)."',
		 					'".$this->link->myesc($id_adm)."',
		 					'".$this->link->myesc($date)."')";
     $result = $this->link->execute($query);
     return $result;
	}

    public function insert_type_serv($t, $p, $m, $nl, $l){

        $query="INSERT INTO `".DB_PREFIX."service_type` (
                                 `id`,
                                 `tipo`,
                                 `picture`,
                                 `message`,
                                 `name_link`,
                                 `link`
           						 )
           		VALUES (NULL,'".$this->link->myesc($t)."', '".$this->link->myesc($p)."', '".$this->link->myesc($m)."', '".$this->link->myesc($nl)."', '".$this->link->myesc($l)."')";

  		return $this->link->execute($query);
	}

	public function upd_type_serv($id, $t, $p, $m, $nl, $l){
    $query="UPDATE `".DB_PREFIX."service_type` SET
	     `tipo`='".$this->link->myesc($t)."',
	     `picture`='".$this->link->myesc($p)."',
	     `message`='".$this->link->myesc($m)."',
	     `name_link`='".$this->link->myesc($nl)."',
	     `link`='".$this->link->myesc($l)."'
     WHERE `id`='".$this->link->myesc($id)."' LIMIT 1";
     $result = $this->link->execute($query);
     return $result;
	}

	/*==========================================UPDATE GENERAL TOTAL AND ITEBIS FOR CLIENTS ADDING EXCURSIONS AND SERVICES=========================================*/
	public function upd_book_online($id, $tax, $gral_total){

           $query="UPDATE `".DB_PREFIX."reserves` SET
						`tax`='".$this->link->myesc($tax)."',
						`total`='".$this->link->myesc($gral_total)."'
				   WHERE `id`='".$this->link->myesc($id)."' LIMIT 1";

  		return $this->link->execute($query);
		}
	/*=============================================================================================================================================================*/
	public function insert_expedia($rcl_ref, $id_referral, $expedia_id, $expedia_amount){

        $query="INSERT INTO `".DB_PREFIX."expedia` (
                                 `id`,
                                 `rcl_ref`,
                                 `id_referral`,
                                 `exp_id`,
                                 `exp_amount`)
           		VALUES (NULL,'".$this->link->myesc($rcl_ref)."', '".$this->link->myesc($id_referral)."', '".$this->link->myesc($expedia_id)."', '".$this->link->myesc($expedia_amount)."')";

  		return $this->link->execute($query);
	}

	public function update_expedia($id, $rcl_ref, $id_referral, $expedia_id, $expedia_amount){
    $query="UPDATE `".DB_PREFIX."expedia` SET
	     `rcl_ref`='".$this->link->myesc($rcl_ref)."',
	     `id_referral`='".$this->link->myesc($id_referral)."',
	     `exp_id`='".$this->link->myesc($expedia_id)."',
	     `exp_amount`='".$this->link->myesc($expedia_amount)."'
     WHERE `id`='".$this->link->myesc($id)."' LIMIT 1";
     $result = $this->link->execute($query);
     return $result;
	}

	public function upd_reserv($id, $total){

       $query="UPDATE `".DB_PREFIX."reserves` SET `total`='".$this->link->myesc($total)."'  WHERE `id`='".$this->link->myesc($id)."' LIMIT 1";

  	return $this->link->execute($query);
	}
	/*=================================================insert data and update data for general tables===================================================================*/
     	public function insert_gral($info, $table) {
		   if (!is_array($info)) { die("insert member failed, info must be an array"); }
		      //build the query
		      $sql = "INSERT INTO ".DB_PREFIX.$table." (";
		      for ($i=0; $i<count($info); $i++) {
		         //we need to get the key in the info array, which represents the column in $table
			    # $sql .= key($this->link->myesc($info));
			   // $this->link->myesc(
			    $sql .= key($info);
		    //echo commas after each key except the last, then echo a closing parenthesis
		     if ($i < (count($info)-1)) {
		        $sql .= ", ";
		     } else $sql .= ") ";
		     //advance the array pointer to point to the next key
		        next($info);
		     }
		     //now lets reuse $info to get the values which represent the insert field values
		     reset($info);
		     $sql .= "VALUES (";
		     for ($j=0; $j<count($info); $j++) {
		        $sql .= "'".$this->link->myesc(current($info))."'";
		        if ($j < (count($info)-1)) {
		           $sql .= ", ";
		        } else $sql .= ") ";
		        next($info);
		     }

				$this->link->execute($sql);
		   return $this->link->getInsertId();
		 }

		//-----------------------------------------------------------------------------------------------------------------------
		public function update_gral($id, $info, $table) {
		   if (!is_array($info)) { die("insert member failed, info must be an array"); }
		      //build the query
		      $sql = "UPDATE ".DB_PREFIX.$table." SET ";
		     for ($i=0; $i<count($info); $i++) {
		         //we need to get the key in the info array, which represents the column in $table
		     $sql .= key($info)."='".$this->link->myesc(current($info))."'";
		    //echo commas after each key except the last, then echo a closing parenthesis
		     if ($i < (count($info)-1)) {
		        $sql .= ", ";
		     } else $sql .= " ";
		     //advance the array pointer to point to the next key
		        next($info);
		     }
		      $sql .= " WHERE id='".$id."' LIMIT 1";
		    return $this->link->execute($sql);
		}

		public function delOneService($id_service, $id_reserva){

			$sql="DELETE FROM `".DB_PREFIX."serv_reserv` WHERE `id_service`='".$id_service."' AND `id_reserve`='".$id_reserva."' LIMIT 1";

		return $this->link->execute($sql);
		}
		/*====================PAYPAL FUNCTIONS======================================================*/
		public function paypalDetails($tk, $data){
		 $query="INSERT INTO `pp_details_ec` (`id`,
											  `token` ,
											  `details`)
						VALUES ( NULL ,'".$this->link->myesc($tk)."','".$this->link->myesc($data)."')";
		 $result = $this->link->execute($query);
		 return $result;
		}
		public function paypalPayments($tk, $book, $data){
		 $query="INSERT INTO `pp_payments_ec` ( `id`,
												`token`,
												`booking`,
												`details`)
						VALUES ( NULL ,'".$this->link->myesc($tk)."','".$this->link->myesc($book)."','".$this->link->myesc($data)."')";
		 $result = $this->link->execute($query);
		 return $result;
		}
		public function savePaypalAmount($book, $amount, $transID){
		 $query="INSERT INTO `".DB_PREFIX."payments` (`id`,
												`ref`,
												`type`,
												`class`,
												`amount`,
												`transid`,
												`fecha`)
						VALUES ( NULL ,'".$this->link->myesc($book)."','3','1','".$this->link->myesc($amount)."','".$this->link->myesc($transID)."','".date("Y-m-d G:i:s")."')";
		 $result = $this->link->execute($query);
		 return $result;
		}
		public function checkTokenDetails($tk){
		 $query="SELECT * FROM `pp_details_ec` WHERE `token`='".$this->link->myesc($tk)."' LIMIT 1";
			return $this->link->query($query);
		}
		public function checkTokenPayment($tk){
		 $query="SELECT * FROM `pp_payments_ec` WHERE `token`='".$this->link->myesc($tk)."' LIMIT 1";
			return $this->link->query($query);
		}
		
		public function autoCancel($ref, $created, $duedate, $timetype, $timeframe, $status){
		$query="INSERT INTO `".DB_PREFIX."autocancel` (`id`,
												`ref`,
												`created`,
												`duedate`,
												`timetype`,
												`timeframe`,
												`status`)
 					VALUES ( NULL ,'".$this->link->myesc($ref)."','".$this->link->myesc($created)."','".$this->link->myesc($duedate)."','".$this->link->myesc($timetype)."','".$this->link->myesc($timeframe)."','".$this->link->myesc($status)."')";
		$result = $this->link->execute($query);
		return $result;
		}
		function insert($info, $table) {
		   if (!is_array($info)) { die("insert member failed, info must be an array"); }
		      $sql = "INSERT INTO ".DB_PREFIX.$table." (";
		      for ($i=0; $i<count($info); $i++) {
			    $sql .= key($info);
		     if ($i < (count($info)-1)) {
		        $sql .= ", ";
		     } else $sql .= ") ";
		        next($info);
		     }
		     reset($info);
		     $sql .= "VALUES (";
		     for ($j=0; $j<count($info); $j++) {
		        $sql .= "'".current($info)."'";
		        if ($j < (count($info)-1)) {
		           $sql .= ", ";
		        } else $sql .= ") ";
		        next($info);
		     }

				$this->link->execute($sql);
		   return $this->link->getInsertId();
		 }
        /*---------------------------------------------------------------------------------------------------*/
		 function insert_id($info, $table) {
		   if (!is_array($info)) { die("insert member failed, info must be an array"); }
		      //build the query
		      $sql = "INSERT INTO ".DB_PREFIX.$table." (";
		      for ($i=0; $i<count($info); $i++) {
			    $sql .= key($info);
		     if ($i < (count($info)-1)) {
		        $sql .= ", ";
		     } else $sql .= ") ";
		     //advance the array pointer to point to the next key
		        next($info);
		     }
		     //now lets reuse $info to get the values which represent the insert field values
		     reset($info);
		     $sql .= "VALUES (";
		     for ($j=0; $j<count($info); $j++) {
		        $sql .= "'".current($info)."'";
		        if ($j < (count($info)-1)) {
		           $sql .= ", ";
		        } else $sql .= ") ";
		        next($info);
		     }

			$result=$this->link->execute($sql);
		   return $this->link->getInsertId();
		 }

		 //-----------------------------------------------------------------------------------------------------------------------
		function update($id, $info, $table) {
		   if (!is_array($info)) { die("insert member failed, info must be an array"); }
		      //build the query
		      $sql = "UPDATE ".DB_PREFIX.$table." SET ";
		     for ($i=0; $i<count($info); $i++) {
		         //we need to get the key in the info array, which represents the column in $table
		     $sql .= key($info)."='".current($info)."'";
		    //echo commas after each key except the last, then echo a closing parenthesis
		     if ($i < (count($info)-1)) {
		        $sql .= ", ";
		     } else $sql .= " ";
		     //advance the array pointer to point to the next key
		        next($info);
		     }
		      $sql .= " WHERE id='".$id."' LIMIT 1";
		    return $this->link->execute($sql);
		}
	/*=======================================================End inserting data and updating data for general tables======================================================*/
	function removeSalesAgent($clientID) {
		$query="UPDATE `".DB_PREFIX."customers` SET `id_seller`='0' WHERE `id`='".$this->link->myesc($clientID)."' LIMIT 1";
		return $this->link->execute($query);
	}

 }
?>