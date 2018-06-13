<?
 class getQueries extends Database{
	 
	public function get_season3_prices($startdate='2018-12-30', $pricelow='500', $priceshoulder='1500', $pricehigh='2000'){
	    $sql="SELECT * FROM `".DB_PREFIX."seasons3` WHERE  `active`='1' ORDER BY `id` DESC";
	 	$seasons=$this->query($sql);
		$ckin=$pieces = explode("-", $startdate);
		$startmonth=$ckin[1]; //$startday='';
		
		foreach($seasons AS $k){
			/*if((($startmonth>=$k['start_mont']) && ($startday>=$k['start_day']))&&(($startmonth<=$k['end_mont']) && ($startday<=$k['end_day']))){
				
			}*/
			if($k['start_mont']<=$k['end_mont']){
				if(($startmonth>=$k['start_mont']) && ($startmonth<=$k['end_mont'])){//if check-in date is between the month of seasons
					//take prices for this season
					switch($k['type']){
						case 1: $p['price']=$pricelow; $p['tipo']=$k['type']; $p['ckinsm']=$startmonth; $p['sms']=$k['start_mont']; $p['ems']=$k['end_mont']; break;
						case 2: $p['price']=$priceshoulder; $p['tipo']=$k['type']; $p['ckinsm']=$startmonth; $p['sms']=$k['start_mont']; $p['ems']=$k['end_mont']; break;
						case 3: $p['price']=$pricehigh; $p['tipo']=$k['type']; $p['ckinsm']=$startmonth; $p['sms']=$k['start_mont']; $p['ems']=$k['end_mont']; break;
					}
					break; //leave for each
				}
			}else{
				if((($startmonth>=$k['start_mont']) && ($startmonth<=12)) || (($startmonth>=1) && ($startmonth<=$k['end_mont']))){//if check-in date is between the month of seasons
					//take prices for this season
					switch($k['type']){
						case 1: $p['price']=$pricelow; $p['tipo']=$k['type']; $p['ckinsm']=$startmonth; $p['sms']=$k['start_mont']; $p['ems']=$k['end_mont']; break;
						case 2: $p['price']=$priceshoulder; $p['tipo']=$k['type']; $p['ckinsm']=$startmonth; $p['sms']=$k['start_mont']; $p['ems']=$k['end_mont']; break;
						case 3: $p['price']=$pricehigh; $p['tipo']=$k['type']; $p['ckinsm']=$startmonth; $p['sms']=$k['start_mont']; $p['ems']=$k['end_mont']; break;
					}
					break; //leave for each
				}
			}
		}
		
		return $p;
	}
	 
	public function shows_required_fee($beds){
	    $sql="SELECT * FROM `".DB_PREFIX."services` WHERE  `beds`='".$this->myesc($beds)."' AND `optional`='2'  ORDER BY `id` DESC";
	 	return $this->query($sql);
	}
	 
	public function tickets($status){
	    $sql="SELECT * FROM `".DB_PREFIX."reports` WHERE  `status`='".$this->myesc($status)."' ORDER BY `id` DESC LIMIT 100";
		$result=$this->query($sql);
	 	return ($result);
	}
	public function ticketsByDepart($status, $dep){
	    $sql="SELECT * FROM `".DB_PREFIX."reports` WHERE  `status`='".$this->myesc($status)."' AND  `department`='".$this->myesc($dep)."' ORDER BY `id` DESC LIMIT 100";
		$result=$this->query($sql);
	 	return ($result);
	}
	public function tickets1($status, $snr,$svilla,$sdep,$ssub,$ssta,$send){
		$extra_query="";
		if($snr!=''){
			$extra_query.=" AND `id`='".$snr."'";
		}
		if($svilla!=''){
			$extra_query.=" AND `villa_id`='".$svilla."'";
		}
		if($sdep!=''){
			$extra_query.=" AND `department`='".$sdep."'";
		}
		if($ssub!=''){
			$extra_query.=" AND `subject`='".$ssub."'";
		}
		if($ssta!=''){
			//$ssta=strtotime($ssta);
			//$extra_query.=" AND DATE_FORMAT(`date`, '%Y %m %d')>='".$ssta."'";
			$extra_query.=" AND `date`>=UNIX_TIMESTAMP('".$ssta."')";
		}
		if($send!=''){
			//$send=strtotime($send);
			//$extra_query.=" AND DATE_FORMAT(`date`, '%Y %m %d')<='".$send."'";
			$extra_query.=" AND `date`<=UNIX_TIMESTAMP('".$send."')";
		}
		
	    $sql="SELECT * FROM `".DB_PREFIX."reports` WHERE  `status`='".$this->myesc($status)."' $extra_query ORDER BY `id`";
		$result=$this->query($sql);
	 	return ($result);
	}
	public function ticketsByDepart1($status, $dep, $snr,$svilla,$sdep,$ssub,$ssta,$send){
		$extra_query="";
		if($snr!=''){
			$extra_query.=" AND `id`='".$snr."'";
		}
		if($svilla!=''){
			$extra_query.=" AND `villa_id`='".$svilla."'";
		}
		if($sdep!=''){
			$extra_query.=" AND `department`='".$sdep."'";
		}
		if($ssub!=''){
			$extra_query.=" AND `subject`='".$ssub."'";
		}
		if($ssta!=''){
			//$ssta=strtotime($ssta);
			//$extra_query.=" AND DATE_FORMAT(`date`, '%Y %m %d')>='".$ssta."'";
			$extra_query.=" AND `date`>=UNIX_TIMESTAMP('".$ssta."')";
		}
		if($send!=''){
			//$send=strtotime($send);
			//$extra_query.=" AND DATE_FORMAT(`date`, '%Y %m %d')<='".$send."'";
			$extra_query.=" AND `date`<=UNIX_TIMESTAMP('".$send."')";
		}
	    $sql="SELECT * FROM `".DB_PREFIX."reports` WHERE  `status`='".$this->myesc($status)."' AND  `department`='".$this->myesc($dep)."' $extra_query ORDER BY `id`";
		$result=$this->query($sql);
	 	return $result;
	}
	public function tickets2($status, $sort){
		switch($sort){
			case 1:
				$by="`id` DESC"; 
				break;
			case 2:
				$by="`villa_id` DESC";
				break;
			case 3:
				$by="`subject` DESC";
				break;
			case 4:
				$by="`details` ASC";
				break;
			case 5:
				$by="`department` ASC";
				break;
			case 6:
				$by="`priority` ASC";
				break;
			case 7:
				$by="`villastatus` ASC";
				break;
			case 8:
				$by="`date` DESC";
				break;
			case 9:
				$by="`userid` DESC";
				break;
			case 10:
				$by="`id` ASC"; 
				break;
			case 20:
				$by="`villa_id` ASC";
				break;
			case 30:
				$by="`subject` ASC";
				break;
			case 40:
				$by="`details` DESC";
				break;
			case 50:
				$by="`department` DESC";
				break;
			case 60:
				$by="`priority` DESC";
				break;
			case 70:
				$by="`villastatus` DESC";
				break;
			case 80:
				$by="`date` ASC";
				break;
			case 90:
				$by="`userid` ASC";
				break;
			default:
				$by="`id` DESC";
		}
	    $sql="SELECT * FROM `".DB_PREFIX."reports` WHERE  `status`='".$this->myesc($status)."' ORDER BY $by  LIMIT 100";
		$result=$this->query($sql);
	 	return ($result);
	}
	public function ticketsByDepart2($status, $dep, $sort){
		switch($sort){
			case 1:
				$by="`id` DESC"; 
				break;
			case 2:
				$by="`villa_id` DESC";
				break;
			case 3:
				$by="`subject` DESC";
				break;
			case 4:
				$by="`details` ASC";
				break;
			case 5:
				$by="`department` ASC";
				break;
			case 6:
				$by="`priority` ASC";
				break;
			case 7:
				$by="`villastatus` ASC";
				break;
			case 8:
				$by="`date` DESC";
				break;
			case 9:
				$by="`userid` DESC";
				break;
			case 10:
				$by="`id` ASC"; 
				break;
			case 20:
				$by="`villa_id` ASC";
				break;
			case 30:
				$by="`subject` ASC";
				break;
			case 40:
				$by="`details` DESC";
				break;
			case 50:
				$by="`department` DESC";
				break;
			case 60:
				$by="`priority` DESC";
				break;
			case 70:
				$by="`villastatus` DESC";
				break;
			case 80:
				$by="`date` ASC";
				break;
			case 90:
				$by="`userid` ASC";
				break;
			default:
				$by="`id` DESC";
		}
	    $sql="SELECT * FROM `".DB_PREFIX."reports` WHERE  `status`='".$this->myesc($status)."' AND  `department`='".$this->myesc($dep)."' ORDER BY $by  LIMIT 100";
		$result=$this->query($sql);
	 	return ($result);
	}
	public function ticketHistory($ticketno, $status){
	    $sql="SELECT * FROM `".DB_PREFIX."reporthistory` WHERE  `reportid`='".$this->myesc($ticketno)."' AND  `status`='".$this->myesc($status)."' ORDER BY `id` DESC LIMIT 1";
		$result=$this->query($sql);
	 	return $result[0];
	}
	public function singleTicket($ticketid){
	    $sql="SELECT * FROM `".DB_PREFIX."reports` WHERE  `id`='".$this->myesc($ticketid)."' ORDER BY `id` DESC LIMIT 1";
		$result=$this->query($sql);
	 	return ($result[0]);
	}
	public function usersDepartment($depart){
	    $sql="SELECT * FROM `".DB_PREFIX."users` WHERE  `report`='".$this->myesc($depart)."' AND `active`='1' ";
		$result=$this->query($sql);
	 	return ($result);
	}
	public function usersServices(){
	    $sql="SELECT * FROM `".DB_PREFIX."users` WHERE  `services`='1' AND `active`='1' ";
		$result=$this->query($sql);
	 	return ($result);
	}
	public function givemeUsername($id){
	    $sql="SELECT * FROM `".DB_PREFIX."users` WHERE  `id`='".$this->myesc($id)."' AND `active`='1' LIMIT 1 ";
		$result=$this->query($sql);
	 	return $result[0]['name'];
	}
	public function displayUserDetails($id){
	    $sql="SELECT * FROM `".DB_PREFIX."users` WHERE  `id`='".$this->myesc($id)."' AND `active`='1' LIMIT 1 ";
		$result=$this->query($sql);
	 	return $result[0];
	}
	public function villa_no($villa_id){
	    $sql="SELECT * FROM `".DB_PREFIX."villas` WHERE  `id`='".$this->myesc($villa_id)."' ";
		$result=$this->query($sql);
	 	return $result[0]['no'];
	}

 	public function seasons(){
	    $sql="SELECT * FROM `".DB_PREFIX."seasons` WHERE  `id`='1' LIMIT 1";
		$result=$this->query($sql);
	 	return ($result);
	}
	public function seasons3(){
	    $sql="SELECT * FROM `".DB_PREFIX."seasons3` WHERE  `active`='1' ORDER BY `id` ASC";
		$result=$this->query($sql);
	 	return ($result);
	}

//	========= START VILLAS FOR RENT ===================
    public function showTable_r($table, $field, $value, $operator){//$table -- for detail and will get any table.
    $table=$this->myesc($table); $field=$this->myesc($field); $value=$this->myesc($value);
	$sql="SELECT * FROM `".DB_PREFIX.$table."` WHERE `".DB_PREFIX.$table."`.`".$field."`".$operator."'".$value."' ORDER BY `".DB_PREFIX.$table."`.`id` ASC";
	$result=$this->query($sql);

	return ($result);
	}

	public function showTable_page_r($table, $order, $limit){//$table -- for detail and will get any table.
   // $this->myesc($table); $this->myesc($order); $this->myesc($limit); // not need scape data here
	//$villas = array();
	$sql="SELECT * FROM `".DB_PREFIX.$table."` WHERE `".DB_PREFIX.$table."`.`able_r`='1' ORDER BY `".DB_PREFIX.$table."`.`".$order."` ASC ".$limit;
	$result=$this->query($sql);

	return ($result);
	}

	public function showSearch_r($table, $order, $search, $by){//this will search as per criteria choosed.
    //$this->myesc($by); $this->myesc($object); $this->myesc($table); // data are better scaped below

	$sql="SELECT * FROM `".DB_PREFIX.$table."` WHERE `".DB_PREFIX.$table."`.`".$this->myesc($by)."`='".$this->myesc($search)."' AND `".DB_PREFIX.$table."`.`able_r`='1' AND `".DB_PREFIX.$table."`.`able_r`='1' ORDER BY `".DB_PREFIX.$table."`.`".$order."` ASC ";
	$result=$this->query($sql);

	return ($result);
	}

	public function showSearch_page_r($table, $order, $limit, $search, $by){//this will search as per criteria choosed.
   // $this->myesc($by); $this->myesc($object); $this->myesc($table);

	$sql="SELECT * FROM `".DB_PREFIX.$table."` WHERE `".DB_PREFIX.$table."`.`".$this->myesc($by)."`='".$this->myesc($search)."' AND `".DB_PREFIX.$table."`.`able_r`='1' ORDER BY `".DB_PREFIX.$table."`.`".$order."` ASC ".$limit;
	$result=$this->query($sql);

	return ($result);
	}
//=========== END VILLAS FOR RENT ===================

	public function showTable($table, $order){//$table -- for detail and will get any table.
    $this->myesc($table); $this->myesc($order);
	//$villas = array();
	$sql="SELECT * FROM `".DB_PREFIX.$table."` ORDER BY `".DB_PREFIX.$table."`.`".$order."` ASC LIMIT 0,30";
	$result=$this->query($sql);

	return ($result);
	}
	
	public function showTable_all($table, $order){//$table -- for detail and will get any table.
    $this->myesc($table); $this->myesc($order);
	//$villas = array();
	$sql="SELECT * FROM `".DB_PREFIX.$table."` ORDER BY `".DB_PREFIX.$table."`.`".$order."` ASC ";
	$result=$this->query($sql);

	return ($result);
	}

	public function showTable_restrinted($table, $condition, $order){//$table -- for detail and will get any table.
   // $table=$this->myesc($table); $order=$this->myesc($order); $condition=$this->myesc($condition);
	//$villas = array();
	//$sql="SELECT * FROM `".DB_PREFIX.$table."` WHERE `".DB_PREFIX.$table."`.".$condition." ORDER BY `".DB_PREFIX.$table."`.`".$order."` ASC LIMIT 0,30";
	$sql="SELECT * FROM `".DB_PREFIX.$table."` WHERE `".DB_PREFIX.$table."`.".$condition." ORDER BY( `".DB_PREFIX.$table."`.`".$order."`+0) ASC";//make integer string (string number+0)
	$result=$this->query($sql);

	return ($result);
	}

	public function show_data($table, $condition, $order){//$table -- for detail and will get any table.
    //$table=$this->myesc($table); $order=$this->myesc($order); //$condition=$this->myesc($condition);
	//$villas = array();
	$sql="SELECT * FROM `".DB_PREFIX.$table."` WHERE `".DB_PREFIX.$table."`.".$condition." ORDER BY `".DB_PREFIX.$table."`.`".$order."` ASC";
	$result=$this->query($sql);

	return ($result);
	}
	
	public function display_table($table, $condition, $order){
		$sql="SELECT * FROM `".DB_PREFIX.$table."` WHERE ".$condition." ORDER BY `".DB_PREFIX.$table."`.`".$order."` DESC";	
	return $this->query($sql);
	}
	
	public function invoicesUnpaid($ref){//$table -- for detail and will get any table.
		$sql="SELECT * FROM `".DB_PREFIX."ppinvoices` WHERE `ref`='".$this->myesc($ref)."' AND `status`<>'Paid' AND `status`<>'Canceled' ORDER BY `id` ASC";
		$result=$this->query($sql);
		return ($result);
	}

	public function villas_for_rent_online($beds){//$table -- for detail and will get any table.
	if($beds==10){
		$sql="SELECT * FROM `".DB_PREFIX."villas` WHERE `able_r`=1 AND `vonline`=0 ORDER BY `no` ASC";
	}else{
		$sql="SELECT * FROM `".DB_PREFIX."villas` WHERE `able_r`=1 AND `vonline`=0 AND `bed`=".$this->myesc($beds)." ORDER BY `no` ASC";
	}
	$result=$this->query($sql);

	return ($result);
	}
	public function villas_for_rent_online2($beds){//$table -- for detail and will get any table.
	if($beds==10){
		$sql="SELECT * FROM `".DB_PREFIX."villas` WHERE `able_r`=1 AND `vonline`=0 ORDER BY `bed` ASC";
	}else{
		$sql="SELECT * FROM `".DB_PREFIX."villas` WHERE `able_r`=1 AND `vonline`=0 AND `bed`=".$this->myesc($beds)." ORDER BY `bed` ASC";
	}
	$result=$this->query($sql);

	return ($result);
	}
	
	public function villas_8_ramdom_online(){//shows 8 villas for rental online randomly for features index page.
		$sql="SELECT * FROM `".DB_PREFIX."villas` WHERE `able_r`=1 AND `vonline`=0 ORDER BY rand() ASC LIMIT 8";
	return $result=$this->query($sql);
	}
	
	public function villas_3_ramdom_online($beds){//shows 8 villas for rental online randomly for features index page.
		$sql="SELECT * FROM `".DB_PREFIX."villas` WHERE `able_r`=1 AND `bed`='".$this->myesc($beds)."' AND `vonline`=0 ORDER BY rand() ASC LIMIT 3";
	return $result=$this->query($sql);
	}
	
	public function villa_1_ramdom_online($beds){//shows 8 villas for rental online randomly for features index page.
		$sql="SELECT * FROM `".DB_PREFIX."villas` WHERE `able_r`=1 AND `bed`='".$this->myesc($beds)."' AND `vonline`=0 ORDER BY rand() ASC LIMIT 1";
	return $result=$this->query($sql);
	}

	public function show_any_data($table, $field, $value, $operator){//$table -- for detail and will get any table.
    $table=$this->myesc($table); $field=$this->myesc($field); $value=$this->myesc($value);
	$sql="SELECT * FROM `".DB_PREFIX.$table."` WHERE `".DB_PREFIX.$table."`.`".$field."`".$operator."'".$value."' ORDER BY `".DB_PREFIX.$table."`.`id` DESC";
	$result=$this->query($sql);

	return ($result);
	}

	public function show_any_data_limit1($table, $field, $value, $operator){//$table -- for detail and will get any table.
    $table=$this->myesc($table); $field=$this->myesc($field); $value=$this->myesc($value);
	$sql="SELECT * FROM `".DB_PREFIX.$table."` WHERE `".DB_PREFIX.$table."`.`".$field."`".$operator."'".$value."' ORDER BY `".DB_PREFIX.$table."`.`id` DESC LIMIT 1";
	$result=$this->query($sql);

	return ($result);
	}

	public function show_active_limit1($table, $field, $value, $operator){//$table -- for detail and will get any table.
    $table=$this->myesc($table); $field=$this->myesc($field); $value=$this->myesc($value);
	$sql="SELECT * FROM `".DB_PREFIX.$table."` WHERE `".DB_PREFIX.$table."`.`".$field."`".$operator."'".$value."' AND `".DB_PREFIX.$table."`.`active`=1 LIMIT 1";
	$result=$this->query($sql);

	return ($result);
	}


	public function show_all($table, $order){//$table -- for detail and will get any table.
    $table=$this->myesc($table); $order=$this->myesc($order);
	//$villas = array();
	//$sql="SELECT * FROM `".DB_PREFIX.$table."` ORDER BY (`".DB_PREFIX.$table."`.`".$order."`+0) ASC";
	$sql="SELECT * FROM `".DB_PREFIX.$table."` ORDER BY `".DB_PREFIX.$table."`.`".$order."` ASC";
	$result=$this->query($sql);

	return ($result);
	}

	public function show_active_services(){//$table -- for detail and will get any table.
    $sql="SELECT * FROM `".DB_PREFIX."serv_add` WHERE `active`='1' ORDER BY `".DB_PREFIX."serv_add`.`type` ASC";
	$result=$this->query($sql);
	return ($result);
	}

	public function show_all_int($table, $order){//$table -- for detail and will get any table.
    $table=$this->myesc($table); $order=$this->myesc($order);
	//$villas = array();
	$sql="SELECT * FROM `".DB_PREFIX.$table."` ORDER BY (`".DB_PREFIX.$table."`.`".$order."`+0) ASC";
	//$sql="SELECT * FROM `".DB_PREFIX.$table."` ORDER BY `".DB_PREFIX.$table."`.`".$order."` ASC";
	$result=$this->query($sql);

	return ($result);
	}

	public function show_all_different_to($table, $id){//$table -- for detail and will get any table.
    $table=$this->myesc($table); $id=$this->myesc($id);
	//$villas = array();
	$sql="SELECT * FROM `".DB_PREFIX.$table."` WHERE `".DB_PREFIX.$table."`.`id`<>'".$id."' ORDER BY `".DB_PREFIX.$table."`.`id` DESC ";

	return $this->query($sql);
	}
	
	public function show_villas_active(){//$table -- for detail and will get any table.
		$id=$this->myesc($id);
		$sql="SELECT * FROM `".DB_PREFIX."villas` WHERE `".DB_PREFIX.$table."`.`active`<>'1' ORDER BY `".DB_PREFIX.$table."`.`id` DESC ";
	return $this->query($sql);
	}

	public function show_all_active($table, $order){//$table -- for detail and will get any table.
    $table=$this->myesc($table); $order=$this->myesc($order);
	//$villas = array();
	$sql="SELECT * FROM `".DB_PREFIX.$table."` WHERE `".DB_PREFIX.$table."`.`active`=1 ORDER BY `".DB_PREFIX.$table."`.`".$order."` ASC";
	$result=$this->query($sql);

	return ($result);
	}

	public function show_id_active($table, $id){//$table -- for detail and will get any table.
    $table=$this->myesc($table); $order=$this->myesc($order);
	//$villas = array();
	$sql="SELECT * FROM `".DB_PREFIX.$table."` WHERE `".DB_PREFIX.$table."`.`active`=1 AND `".DB_PREFIX.$table."`.`id`='".$this->myesc($id)."' LIMIT 1";
	$result=$this->query($sql);

	return ($result);
	}

	public function show_id($table, $id){//$table -- for detail and will get any table.
    $table=$this->myesc($table); $order=$this->myesc($order);
	//$villas = array();
	$sql="SELECT * FROM `".DB_PREFIX.$table."` WHERE `".DB_PREFIX.$table."`.`id`='".$this->myesc($id)."' LIMIT 1";
	$result=$this->query($sql);

	return ($result);
	}
	public function singleVilla4rent($id){//$table -- for detail and will get any table.
    $table=$this->myesc($table); $order=$this->myesc($order);
	//$villas = array();
	$sql="SELECT * FROM `".DB_PREFIX."villas` WHERE `".DB_PREFIX."villas`.`id`='".$this->myesc($id)."' AND `able_r`='1' AND `vonline`='0' LIMIT 1";
	$result=$this->query($sql);

	return ($result);
	}
	public function oneVilla4rent(){//$table -- for detail and will get any table.
    $table=$this->myesc($table); $order=$this->myesc($order);
	//$villas = array();
	$sql="SELECT * FROM `".DB_PREFIX."villas` WHERE `".DB_PREFIX."villas`.`able_r`='1' LIMIT 1";
	$result=$this->query($sql);

	return ($result);
	}

	public function show_a_date($table, $date){//$table -- for detail and will get any table.
    $this->myesc($table);
	//$villas = array();
	$sql="SELECT * FROM `".DB_PREFIX.$table."` WHERE `".DB_PREFIX.$table."`.`date` LIKE '".$this->myesc($date)."%' ORDER BY id DESC";
	$result=$this->query($sql);

	return ($result);
	}
	/*public function villas_for_rent(){//$table -- for detail and will get any table.
    $this->myesc($table); $this->myesc($order);
	//$villas = array();
	$sql="SELECT * FROM `".DB_PREFIX.$table."` WHERE `id`= ORDER BY `".DB_PREFIX.$table."`.`".$order."` ASC LIMIT 0,30";
	$result=$this->query($sql);

	return ($result);
	}*/

	public function show_client_mod($id_mod){//$table -- for detail and will get any table.
    //$sql="SELECT * FROM `".DB_PREFIX."customers_mod` WHERE `id_cust_mod`='".$this->myesc($id_mod)."' ORDER BY `date_mod` DESC";
    $sql="SELECT * FROM `".DB_PREFIX."customers_mod` WHERE `id_cust_mod`='".$this->myesc($id_mod)."' ORDER BY `id` DESC";
	$result=$this->query($sql);
	return ($result);
	}

	public function show_client($id_client){//$table -- for detail and will get any table.
    //$sql="SELECT * FROM `".DB_PREFIX."customers_mod` WHERE `id_cust_mod`='".$this->myesc($id_mod)."' ORDER BY `date_mod` DESC";
    $sql="SELECT * FROM `".DB_PREFIX."customers` WHERE `id`='".$this->myesc($id_client)."' ORDER BY `id` DESC LIMIT 1";
	$result=$this->query($sql);
	/*foreach($result as $result)*/
	return ($result);
	}
	
	public function services($type){  //show a villa where selected id.

	$sql="SELECT * FROM `".DB_PREFIX."serv_add` WHERE `type`='".$this->myesc($type)."' AND `active`='1' ORDER BY `price` ASC";
	$result=$this->query($sql);

	return ($result);
	}

	public function cosulta_servicio($id, $type){  //show a villa where selected id.

	$sql="SELECT * FROM `".DB_PREFIX."serv_add` WHERE `id`='".$this->myesc($id)."' AND `type`='".$this->myesc($type)."' AND `active`='1' ORDER BY `id` DESC LIMIT 1";
	$result=$this->query($sql);
    foreach($result AS $result)
	return ($result);
	}

	public function servicio_reservado_id($id, $id_reserva){  //show a villa where selected id.

	$sql="SELECT * FROM `".DB_PREFIX."serv_reserv` WHERE `id_service`='".$this->myesc($id)."' AND `id_reserve`='".$this->myesc($id_reserva)."' ORDER BY `id` DESC LIMIT 1";
	 $result=$this->query($sql);
     foreach($result AS $result)
	return ($result);
	}

	public function services_all($type){  //show a villa where selected id.

	$sql="SELECT * FROM `".DB_PREFIX."serv_add` WHERE `type`='".$this->myesc($type)."' ORDER BY `name` ASC";
	$result=$this->query($sql);

	return ($result);
	}

	/*public function services_reserved($reserve){  //show a villa where selected id.
    $sql="SELECT sr.id_service AS serviceid,
    			 sr.qty AS qty,
    			 sr.price AS price,
    			 sr.comment AS note,
    			 s.name AS name,
    			 s.description AS descrip,
    			 s.type AS type,
    			 s.id	AS id

     FROM `".DB_PREFIX."serv_reserv` AS `sr`
     LEFT JOIN `".DB_PREFIX."serv_add` AS `s`
     ON  `sr`.`id_service`=`s`.`id`

    WHERE `sr`.`id_reserve`='".$this->myesc($reserve)."' ORDER BY `sr`.`id` ASC";
	$result=$this->query($sql);

	return ($result);
	}*/
	
	public function services_reserved($reserve){  //show a villa where selected id.
		$sql="SELECT * FROM `".DB_PREFIX."serv_reserv`	WHERE `id_reserve`='".$this->myesc($reserve)."' ORDER BY `id` ASC";
		$result=$this->query($sql);

		return ($result);
	}

	public function services_reserved_long($reserve){  //show services for a long term rental.
    $sql="SELECT * FROM `".DB_PREFIX."serv_long` WHERE `id_reserve`='".$this->myesc($reserve)."' ORDER BY `id` ASC";
	$result=$this->query($sql);

	return ($result);
	}

	public function payments_date($reserve){  //show services for a long term rental.
    $sql="SELECT * FROM `".DB_PREFIX."long_pay` WHERE `id_reserve`='".$this->myesc($reserve)."' ORDER BY `id` ASC";
	$result=$this->query($sql);

	return ($result);
	}

	public function det_services($id_service, $reserveid){
    $sql="SELECT * FROM `".DB_PREFIX."serv_reserv` WHERE `id_service`='".$this->myesc($id_service)."'  AND `id_reserve`='".$this->myesc($reserveid)."' LIMIT 1";
	$result=$this->query($sql);

	return ($result);
	}

	public function people($reserve){  //show a villa where selected id.
   	$sql="SELECT * FROM `".DB_PREFIX."people` WHERE `id_reserve`='".$this->myesc($reserve)."' ORDER BY `id` ASC";
	$result=$this->query($sql);

	return ($result);
	}

	public function additional_service($id,$type){  //show a villa where selected id.
    $this->myesc($id);$this->myesc($type);
	$sql="SELECT * FROM `".DB_PREFIX."serv_add` WHERE `type`='".$type."' AND `id`=".$id." LIMIT 1";
	$result=$this->query($sql);
    foreach($result as $result)
	return ($result);
	}

	public function villa($id){  //show a villa where selected id.
    $id=$this->myesc($id);
	$sql="SELECT * FROM `".DB_PREFIX."villas` WHERE `id`='".$id."' LIMIT 1";
	$result=$this->query($sql);
    return ($result);
	}

 	public function villa_forent($id){  //show a villa where selected id.
    $id=$this->myesc($id);
	$sql="SELECT * FROM `".DB_PREFIX."villas` WHERE `id`='".$id."' and `able_r`='1' LIMIT 1";
	$result=$this->query($sql);
    return ($result);
	}

	public function showTable_page($table, $order, $limit){//$table -- for detail and will get any table.
   // $this->myesc($table); $this->myesc($order); $this->myesc($limit); // not need scape data here
	//$villas = array();
	$sql="SELECT * FROM `".DB_PREFIX.$table."` ORDER BY `".DB_PREFIX.$table."`.`".$order."` ASC ".$limit;
	$result=$this->query($sql);

	return ($result);
	}

	public function showSearch($table, $order, $search, $by){//this will search as per criteria choosed.
    //$this->myesc($by); $this->myesc($object); $this->myesc($table); // data are better scaped below

	$sql="SELECT * FROM `".DB_PREFIX.$table."` WHERE `".DB_PREFIX.$table."`.`".$this->myesc($by)."`='".$this->myesc($search)."' ORDER BY `".DB_PREFIX.$table."`.`".$order."` ASC ";
	$result=$this->query($sql);

	return ($result);
	}

	public function showSearch_like($table, $order, $search, $by){//this will search as per criteria choosed.
    //$this->myesc($by); $this->myesc($object); $this->myesc($table); // data are better scaped below

	$sql="SELECT * FROM `".DB_PREFIX.$table."` WHERE `".DB_PREFIX.$table."`.`".$this->myesc($by)."` LIKE '%".$this->myesc($search)."%' ORDER BY `".DB_PREFIX.$table."`.`".$order."` ASC ";
	$result=$this->query($sql);

	return ($result);
	}
	
	public function search_villas_online($query, $field){//this will search as per criteria choosed.
		//$this->myesc($by); $this->myesc($object); $this->myesc($table); // data are better scaped below
		$sql="SELECT * FROM `".DB_PREFIX."villas` WHERE `".DB_PREFIX."villas`.`".$this->myesc($field)."` LIKE '%".$this->myesc($query)."%' AND `able_r`='1' AND `vonline`='0' ORDER BY `".DB_PREFIX."villas`.`id` ASC ";
		$result=$this->query($sql);
		return ($result);
	}


	public function showSearch_mayor($table, $order, $search, $by){//this will search as per criteria choosed.
    //$this->myesc($by); $this->myesc($object); $this->myesc($table); // data are better scaped below

	$sql="SELECT * FROM `".DB_PREFIX.$table."` WHERE `".DB_PREFIX.$table."`.`".$this->myesc($by)."`>'".$this->myesc($search)."' ORDER BY `".DB_PREFIX.$table."`.`".$order."` ASC ";
	$result=$this->query($sql);

	return ($result);
	}

	public function showSearch_menor($table, $order, $search, $by){//this will search as per criteria choosed.
    //$this->myesc($by); $this->myesc($object); $this->myesc($table); // data are better scaped below

	$sql="SELECT * FROM `".DB_PREFIX.$table."` WHERE `".DB_PREFIX.$table."`.`".$this->myesc($by)."`<'".$this->myesc($search)."' ORDER BY `".DB_PREFIX.$table."`.`".$order."` ASC ";
	$result=$this->query($sql);

	return ($result);
	}

	public function showSearch_page($table, $order, $limit, $search, $by){//this will search as per criteria choosed.
   // $this->myesc($by); $this->myesc($object); $this->myesc($table);

	$sql="SELECT * FROM `".DB_PREFIX.$table."` WHERE `".DB_PREFIX.$table."`.`".$this->myesc($by)."`='".$this->myesc($search)."' ORDER BY `".DB_PREFIX.$table."`.`".$order."` ASC ".$limit;
	$result=$this->query($sql);

	return ($result);
	}

	public function owners(){//get all owners
	$sql="SELECT * FROM `".DB_PREFIX."owners` WHERE `active`=1 ORDER BY `".DB_PREFIX."owners`.`name` ASC";
   //	$sql="SELECT * FROM `".DB_PREFIX.$table."` ORDER BY `".DB_PREFIX.$table."`.`".$order."` ASC LIMIT 0,30";
	$result=$this->query($sql);

	return ($result);
	}

	public function customers(){//get all owners
	$sql="SELECT * FROM `".DB_PREFIX."customers` WHERE `active`=1 ORDER BY `".DB_PREFIX."customers`.`name` ASC";
	//$sql="SELECT * FROM `".DB_PREFIX."users` WHERE `type`=5 AND `active`=1 ORDER BY `".DB_PREFIX."users`.`id` ASC LIMIT 0,30";

	$result=$this->query($sql);
	//foreach ($result as $result)
	return ($result);
	}

 	public function customers_from_to($desde, $hasta){//get all clients from to
	$sql="SELECT * FROM `".DB_PREFIX."customers` WHERE `active`=1 AND `id`>='".$desde."' AND `id`<='".$hasta."' ORDER BY `".DB_PREFIX."customers`.`name` ASC";

	return $this->query($sql);
	}

	public function customers_vip(){//get all owners
	$sql="SELECT * FROM `".DB_PREFIX."customers` WHERE `active`=1 AND `classify_cust`=1 ORDER BY `".DB_PREFIX."customers`.`name` ASC";
	//$sql="SELECT * FROM `".DB_PREFIX."users` WHERE `type`=5 AND `active`=1 ORDER BY `".DB_PREFIX."users`.`id` ASC LIMIT 0,30";

	$result=$this->query($sql);
	//foreach ($result as $result)
	return ($result);
	}

	public function owners_details($id){  //choose details for a user.

	$sql="SELECT * FROM `".DB_PREFIX."owners` WHERE `id`='".$this->myesc($id)."' LIMIT 1";
	$result=$this->query($sql);
	
	return ($result);
	}

	public function customer($id){  //select a customer as an id or no.
   // $this->myesc($id);
	$sql="SELECT * FROM `".DB_PREFIX."customers` WHERE `id`='".$this->myesc($id)."' LIMIT 1";

	$result=$this->query($sql);
    foreach($result as $result) //with this not need to say array position number ( $customer[0]['id'] instead $customer ['id'] )
	return ($result);
	}

	public function intermediario($id){  //show a intermediario.
    $id=$this->myesc($id);
	$sql="SELECT * FROM `".DB_PREFIX."commission` WHERE `id`='".$id."' LIMIT 1";

	$result=$this->query($sql);
    foreach($result as $result) //with this not need to say array position number
	return ($result);
	}

	public function search($by, $object, $table, $order){//this will search as per criteria choosed.
    $by=$this->myesc($by); $object=$this->myesc($object); $table=$this->myesc($table);

	$sql="SELECT * FROM `".DB_PREFIX.$table."` ORDER BY `".DB_PREFIX.$table."`.`".$order."` ASC LIMIT 0,30";
	$result=$this->query($sql);

	return ($result);
	}

	public function see_occupancy($villa_id){//this will search as per criteria choosed.
	//$sql="SELECT * FROM `".DB_PREFIX."occupancy` AS `busy` LEFT JOIN `".DB_PREFIX."reserves` AS `booked` ON `busy`.`id`=`booked`.`id_occupancy` WHERE `busy`.`id_villa`=".$this->myesc($villa_id)." AND `busy`.`active`=1 AND `booked`.`status`<>4 LIMIT 1";
	$sql="SELECT busy.id AS busyid,
                 busy.starting AS start,
                 busy.ending AS end,
                 busy.type AS type,
                 busy.id_villa AS villa,
                 busy.id_adm AS adm,
                 busy.comment AS note,
                 busy.date AS date,
                 busy.id_update AS upd,
                 booked.id AS reserveid,
                 booked.ref AS ref,
                 booked.id_client AS client,
                 booked.adults AS adults,
                 booked.children AS kids,
                 booked.id_interm AS interm,
                 booked.qty_nights AS nights,
                 booked.price_per_night AS ppn,
                 booked.commision AS apc,
                 booked.amount AS subtotal,
                 booked.tax AS itbis,
                 booked.services_amount AS aps,
                 booked.deposit AS dep,
                 booked.total AS total,
                 booked.status AS status,
                 booked.comment AS rc
	      FROM `".DB_PREFIX."occupancy` AS `busy`

	      LEFT JOIN `".DB_PREFIX."reserves` AS `booked`
	      ON `busy`.`id`=`booked`.`id_occupancy`

	      WHERE `busy`.`id_villa`='".$this->myesc($villa_id)."' AND `busy`.`active`=1 ORDER BY busy.starting ASC";  // LIMIT 1  //LIMIT 0,30
	$result=$this->query($sql);
   // AND `booked`.`status`<>4
	return ($result);
	}

    public function see_occupancy_no_zero($villa_id){//this will search as per criteria choosed.
	//$sql="SELECT * FROM `".DB_PREFIX."occupancy` AS `busy` LEFT JOIN `".DB_PREFIX."reserves` AS `booked` ON `busy`.`id`=`booked`.`id_occupancy` WHERE `busy`.`id_villa`=".$this->myesc($villa_id)." AND `busy`.`active`=1 AND `booked`.`status`<>4 LIMIT 1";
	$sql="SELECT busy.id AS busyid,
                 busy.starting AS start,
                 busy.ending AS end,
                 busy.type AS type,
                 busy.id_villa AS villa,
                 busy.id_adm AS adm,
                 busy.comment AS note,
                 busy.date AS date,
                 busy.id_update AS upd,
                 booked.id AS reserveid,
                 booked.ref AS ref,
                 booked.id_client AS client,
                 booked.adults AS adults,
                 booked.children AS kids,
                 booked.id_interm AS interm,
                 booked.qty_nights AS nights,
                 booked.price_per_night AS ppn,
                 booked.commision AS apc,
                 booked.amount AS subtotal,
                 booked.tax AS itbis,
                 booked.services_amount AS aps,
                 booked.deposit AS dep,
                 booked.total AS total,
                 booked.status AS status,
                 booked.comment AS rc
	      FROM `".DB_PREFIX."occupancy` AS `busy`

	      LEFT JOIN `".DB_PREFIX."reserves` AS `booked`
	      ON `busy`.`id`=`booked`.`id_occupancy`

	      WHERE `busy`.`id_villa`='".$this->myesc($villa_id)."' AND `busy`.`active`=1 AND `booked`.`status`<>0 ORDER BY busy.starting ASC ";  // LIMIT 1 //LIMIT 0,30
	$result=$this->query($sql);
   	return ($result);
	}
//==========================MAKE THE CALENDAR FASTER============================================================
	public function see_occupancy_no_zero2($villa_id, $inicio_mes, $fin_mes){//this will search only bookings between this month.
	 $sql="SELECT busy.id AS busyid,
                 busy.starting AS start,
                 busy.ending AS end,
                 busy.type AS type,
                 busy.id_villa AS villa,
                 busy.id_adm AS adm,
                 busy.comment AS note,
                 busy.date AS date,
                 busy.id_update AS upd,
                 booked.id AS reserveid,
                 booked.ref AS ref,
                 booked.id_client AS client,
                 booked.adults AS adults,
                 booked.children AS kids,
                 booked.id_interm AS interm,
                 booked.qty_nights AS nights,
                 booked.price_per_night AS ppn,
                 booked.commision AS apc,
                 booked.amount AS subtotal,
                 booked.tax AS itbis,
                 booked.services_amount AS aps,
                 booked.deposit AS dep,
                 booked.total AS total,
                 booked.status AS status,
                 booked.comment AS rc
	      FROM `".DB_PREFIX."occupancy` AS `busy`

	      LEFT JOIN `".DB_PREFIX."reserves` AS `booked`
	      ON `busy`.`id`=`booked`.`id_occupancy`

	      WHERE `busy`.`id_villa`='".$this->myesc($villa_id)."' AND `busy`.`starting`<='".$this->myesc($fin_mes)."' AND `busy`.`ending`>='".$this->myesc($inicio_mes)."' AND `busy`.`active`=1 AND `booked`.`status`<>0 ORDER BY busy.starting ASC ";  // LIMIT 1 //LIMIT 0,30
	$result=$this->query($sql);
   	return ($result);
	}

	public function see_occupancy_no_zero2_NoTemp($villa_id, $inicio_mes, $fin_mes){//this will search only bookings between this month.
	 $sql="SELECT busy.id AS busyid,
                 busy.starting AS start,
                 busy.ending AS end,
                 busy.type AS type,
                 busy.id_villa AS villa,
                 busy.id_adm AS adm,
                 busy.comment AS note,
                 busy.date AS date,
                 busy.id_update AS upd,
                 booked.id AS reserveid,
                 booked.ref AS ref,
                 booked.id_client AS client,
                 booked.adults AS adults,
                 booked.children AS kids,
                 booked.id_interm AS interm,
                 booked.qty_nights AS nights,
                 booked.price_per_night AS ppn,
                 booked.commision AS apc,
                 booked.amount AS subtotal,
                 booked.tax AS itbis,
                 booked.services_amount AS aps,
                 booked.deposit AS dep,
                 booked.total AS total,
                 booked.status AS status,
				  booked.online AS source,
                 booked.comment AS rc
	      FROM `".DB_PREFIX."occupancy` AS `busy`

	      LEFT JOIN `".DB_PREFIX."reserves` AS `booked`
	      ON `busy`.`id`=`booked`.`id_occupancy`

	      WHERE `busy`.`id_villa`='".$this->myesc($villa_id)."' AND `busy`.`starting`<='".$this->myesc($fin_mes)."' AND `busy`.`ending`>='".$this->myesc($inicio_mes)."' AND `busy`.`active`=1 AND `booked`.`status`<>0 AND `booked`.`status`<>50 ORDER BY busy.starting ASC ";  // LIMIT 1 //LIMIT 0,30
	$result=$this->query($sql);
   	return ($result);
	}
//==========================END MAKE THE CALENDAR FASTER============================================================
	public function see_occupancy_filtred($villa_id, $mes, $year){//this will search as per criteria choosed.

	$sql="SELECT busy.id AS busyid,
                 busy.starting AS start,
                 busy.ending AS end,
                 busy.type AS type,
                 busy.id_villa AS villa,
                 busy.id_adm AS adm,
                 busy.comment AS note,
                 busy.date AS date,
                 busy.id_update AS upd,
                 booked.id AS reserveid,
                 booked.ref AS ref,
                 booked.id_client AS client,
                 booked.adults AS adults,
                 booked.children AS kids,
                 booked.id_interm AS interm,
                 booked.qty_nights AS nights,
                 booked.price_per_night AS ppn,
                 booked.commision AS apc,
                 booked.amount AS subtotal,
                 booked.tax AS itbis,
                 booked.services_amount AS aps,
                 booked.deposit AS dep,
                 booked.total AS total,
                 booked.status AS status,
                 booked.comment AS rc
	      FROM `".DB_PREFIX."occupancy` AS `busy`

	      LEFT JOIN `".DB_PREFIX."reserves` AS `booked`
	      ON `busy`.`id`=`booked`.`id_occupancy`

	      WHERE `busy`.`id_villa`='".$this->myesc($villa_id)."' AND `busy`.`mm`='".$this->myesc($mes)."' AND `busy`.`yyyy`='".$this->myesc($year)."' AND `busy`.`active`=1 AND `booked`.`status`<>4 ORDER BY busy.starting ASC ";  // LIMIT 1 //LIMIT 0,30
	$result=$this->query($sql);
   // foreach($result as $result);
	return ($result);
	}

	public function see_occupancy_online($mes, $year, $beds){//this will help to show availabity online

	$sql="SELECT o.id AS busyid,
                 o.starting AS start,
                 o.ending AS end,
                 o.id_villa AS villa_id,
                 o.date AS date,
                 r.id AS reserveid,
                 r.ref AS ref,
                 r.id_client AS client,
                 r.qty_nights AS nights,
                 r.status AS status,
				 v.no AS villa_number,
				 v.type AS villa_type,
				 v.bed AS bedrooms,
				 v.ac AS air_conditioners,
				 v.bath AS bathrooms,
				 v.capacity AS max_persons,
				 v.p_low AS price_low_season,
				 v.p_high AS price_high_season
	      FROM `".DB_PREFIX."occupancy` AS `o`
	      LEFT JOIN `".DB_PREFIX."reserves` AS `r`
	      ON `o`.`id`=`r`.`id_occupancy`
		  LEFT JOIN `".DB_PREFIX."villas` AS `v`
	      ON `o`.`id_villa`=`v`.`id`
	      WHERE `o`.`mm`='".$this->myesc($mes)."' AND `o`.`yyyy`='".$this->myesc($year)."' AND `o`.`active`=1 AND `r`.`status`<>0 AND `r`.`status`<>4 AND `r`.`status`<>11 AND `r`.`status`<>14 AND `r`.`status`<>18 AND `r`.`status`<>21 AND `r`.`status`<>25 AND `v`.`able_r`=1 AND `v`.`bed`='".$this->myesc($beds)."' ORDER BY v.no ASC";
	return $result=$this->query($sql);
	}

	public function see_occupancy_online_2($starting, $ending, $beds){//this will help to show availabity online

	$sql="SELECT o.id AS busyid,
                 o.starting AS start,
                 o.ending AS end,
                 o.id_villa AS villa_id,
                 o.date AS date,
                 r.id AS reserveid,
                 r.ref AS ref,
                 r.id_client AS client,
                 r.qty_nights AS nights,
                 r.status AS status,
				 v.no AS villa_number,
				 v.type AS villa_type,
				 v.bed AS bedrooms,
				 v.ac AS air_conditioners,
				 v.bath AS bathrooms,
				 v.capacity AS max_persons,
				 v.p_low AS price_low_season,
				 v.p_high AS price_high_season
	      FROM `".DB_PREFIX."occupancy` AS `o`
	      LEFT JOIN `".DB_PREFIX."reserves` AS `r`
	      ON `o`.`id`=`r`.`id_occupancy`
		  LEFT JOIN `".DB_PREFIX."villas` AS `v`
	      ON `o`.`id_villa`=`v`.`id`
	      WHERE `o`.`starting`<'".$this->myesc($ending)."' AND `o`.`ending`>'".$this->myesc($starting)."' AND `r`.`status`<>0 AND `r`.`status`<>50 AND `v`.`able_r`=1 AND `v`.`bed`='".$this->myesc($beds)."' AND `v`.`vonline`='0' ORDER BY v.no ASC";
	return $result=$this->query($sql);
	}
	public function seeOccupancyReferrals($starting, $ending, $beds){//this will help to show availabity online

	$sql="SELECT o.id AS busyid,
                 o.starting AS start,
                 o.ending AS end,
                 o.id_villa AS villa_id,
                 o.date AS date,
                 r.id AS reserveid,
                 r.ref AS ref,
                 r.id_client AS client,
                 r.qty_nights AS nights,
                 r.status AS status,
				 v.no AS villa_number,
				 v.type AS villa_type,
				 v.bed AS bedrooms,
				 v.ac AS air_conditioners,
				 v.bath AS bathrooms,
				 v.capacity AS max_persons,
				 v.p_low AS price_low_season,
				 v.p_high AS price_high_season
	      FROM `".DB_PREFIX."occupancy` AS `o`
	      LEFT JOIN `".DB_PREFIX."reserves` AS `r`
	      ON `o`.`id`=`r`.`id_occupancy`
		  LEFT JOIN `".DB_PREFIX."villas` AS `v`
	      ON `o`.`id_villa`=`v`.`id`
	      WHERE `o`.`starting`<'".$this->myesc($ending)."' AND `o`.`ending`>'".$this->myesc($starting)."' AND `r`.`status`<>0 AND `r`.`status`<>50 AND `v`.`able_r`=1 AND `v`.`bed`='".$this->myesc($beds)."'  AND `v`.`wish_referal`<>'1' ORDER BY v.no ASC";
	return $result=$this->query($sql);
	}
	
	public function see_occupancy_online_3($starting, $ending, $id_villa){//this will help to show availabity online

	$sql="SELECT o.id AS busyid,
                 o.starting AS start,
                 o.ending AS end,
                 o.id_villa AS villa_id,
                 o.date AS date,
                 r.id AS reserveid,
                 r.ref AS ref,
                 r.id_client AS client,
                 r.qty_nights AS nights,
                 r.status AS status,
				 v.no AS villa_number,
				 v.type AS villa_type,
				 v.bed AS bedrooms,
				 v.ac AS air_conditioners,
				 v.bath AS bathrooms,
				 v.capacity AS max_persons,
				 v.p_low AS price_low_season,
				 v.p_high AS price_high_season
	      FROM `".DB_PREFIX."occupancy` AS `o`
	      LEFT JOIN `".DB_PREFIX."reserves` AS `r`
	      ON `o`.`id`=`r`.`id_occupancy`
		  LEFT JOIN `".DB_PREFIX."villas` AS `v`
	      ON `o`.`id_villa`=`v`.`id`
	      WHERE `o`.`starting`<'".$this->myesc($ending)."' AND `o`.`ending`>'".$this->myesc($starting)."' AND `r`.`status`<>0 AND `r`.`status`<>50 AND `v`.`id`='".$this->myesc($id_villa)."' AND `v`.`able_r`=1 AND `v`.`vonline`='0' ORDER BY v.id ASC";
	return $result=$this->query($sql);
	}

	public function see_occupancy_filtred_no_zero($villa_id, $mes, $year){//this will search as per criteria choosed.

	$sql="SELECT busy.id AS busyid,
                 busy.starting AS start,
                 busy.ending AS end,
                 busy.type AS type,
                 busy.id_villa AS villa,
                 busy.id_adm AS adm,
                 busy.comment AS note,
                 busy.date AS date,
                 busy.id_update AS upd,
                 booked.id AS reserveid,
                 booked.ref AS ref,
                 booked.id_client AS client,
                 booked.adults AS adults,
                 booked.children AS kids,
                 booked.id_interm AS interm,
                 booked.qty_nights AS nights,
                 booked.price_per_night AS ppn,
                 booked.commision AS apc,
                 booked.amount AS subtotal,
                 booked.tax AS itbis,
                 booked.services_amount AS aps,
                 booked.deposit AS dep,
                 booked.total AS total,
                 booked.status AS status,
                 booked.comment AS rc
	      FROM `".DB_PREFIX."occupancy` AS `busy`

	      LEFT JOIN `".DB_PREFIX."reserves` AS `booked`
	      ON `busy`.`id`=`booked`.`id_occupancy`

	      WHERE `busy`.`id_villa`='".$this->myesc($villa_id)."' AND `busy`.`mm`='".$this->myesc($mes)."' AND `booked`.`status`<>'0' AND `busy`.`yyyy`='".$this->myesc($year)."' AND `busy`.`active`=1 AND `booked`.`status`<>4 ORDER BY busy.starting ASC";  // LIMIT 1 // LIMIT 0,30
	$result=$this->query($sql);
   // foreach($result as $result);
	return ($result);
	}
	
	public function status_ocupa2($id_villa, $fecha){//this will help to show availabity online

			$sql="SELECT o.id AS busyid,
                 o.starting AS start,
                 o.ending AS end,
                 o.id_villa AS villa_id,
                 o.date AS date,
                 r.id AS reserveid,
                 r.ref AS ref,
                 r.id_client AS client,
                 r.qty_nights AS nights,
                 r.status AS status,
				 v.no AS villa_number,
				 v.type AS villa_type,
				 v.bed AS bedrooms,
				 v.ac AS air_conditioners,
				 v.bath AS bathrooms,
				 v.capacity AS max_persons,
				 v.p_low AS price_low_season,
				 v.p_high AS price_high_season
			  FROM `".DB_PREFIX."occupancy` AS `o`
			  LEFT JOIN `".DB_PREFIX."reserves` AS `r`
			  ON `o`.`id`=`r`.`id_occupancy`
			  LEFT JOIN `".DB_PREFIX."villas` AS `v`
			  ON `o`.`id_villa`=`v`.`id`
			  WHERE `o`.`starting`<='".$this->myesc($fecha)."' AND `o`.`ending`>'".$this->myesc($fecha)."' AND `r`.`status`<>0 AND `r`.`status`<>50 AND `v`.`able_r`=1 AND `o`.`id_villa`='".$this->myesc($id_villa)."' ORDER BY v.no ASC";
			  
			$result=$this->query($sql);
	
	return $result[0]['status'];
	}
	

	public function see_occupancy_for_a_period($villa_id, $starting_date, $ending_date){//this will search as per criteria choosed.

	$sql="SELECT busy.id AS busyid,
                 busy.starting AS start,
                 busy.ending AS end,
                 busy.type AS type,
                 busy.id_villa AS villa,
                 busy.id_adm AS adm,
                 busy.comment AS note,
                 busy.date AS date,
                 busy.id_update AS upd,
                 booked.id AS reserveid,
                 booked.ref AS ref,
                 booked.id_client AS client,
                 booked.adults AS adults,
                 booked.children AS kids,
                 booked.id_interm AS interm,
                 booked.qty_nights AS nights,
                 booked.price_per_night AS ppn,
                 booked.commision AS apc,
                 booked.amount AS subtotal,
                 booked.tax AS itbis,
                 booked.services_amount AS aps,
                 booked.deposit AS dep,
                 booked.total AS total,
                 booked.status AS status,
                 booked.comment AS rc
	      FROM `".DB_PREFIX."occupancy` AS `busy`

	      LEFT JOIN `".DB_PREFIX."reserves` AS `booked`
	      ON `busy`.`id`=`booked`.`id_occupancy`

	      WHERE `busy`.`id_villa`='".$this->myesc($villa_id)."' AND `busy`.`starting`<'".$this->myesc($ending_date)."' AND `booked`.`status`<>'0' AND `booked`.`status`<>'50' AND `busy`.`ending`>'".$this->myesc($starting_date)."' AND `busy`.`active`=1 ORDER BY busy.starting ASC";  // LIMIT 1 // LIMIT 0,30
	$result=$this->query($sql);
   // foreach($result as $result);
	return ($result);
	}



	public function busy_availability_noID($villa_id, $mes, $year, $reservaid){//this will search as per criteria choosed. LONG TERM RENTAL IS USING THIS NOW JULY 11-2012   // ALSO USING THIS WHEN EDITING ANY BOOKING

	$sql="SELECT busy.id AS busyid,
                 busy.starting AS start,
                 busy.ending AS end,
                 busy.type AS type,
                 busy.id_villa AS villa,
                 busy.id_adm AS adm,
                 busy.comment AS note,
                 busy.date AS date,
                 busy.id_update AS upd,
                 booked.id AS reserveid,
                 booked.ref AS ref,
                 booked.id_client AS client,
                 booked.adults AS adults,
                 booked.children AS kids,
                 booked.id_interm AS interm,
                 booked.qty_nights AS nights,
                 booked.price_per_night AS ppn,
                 booked.commision AS apc,
                 booked.amount AS subtotal,
                 booked.tax AS itbis,
                 booked.services_amount AS aps,
                 booked.deposit AS dep,
                 booked.total AS total,
                 booked.status AS status,
                 booked.comment AS rc
	      FROM `".DB_PREFIX."occupancy` AS `busy`

	      LEFT JOIN `".DB_PREFIX."reserves` AS `booked`
	      ON `busy`.`id`=`booked`.`id_occupancy`

	      WHERE `busy`.`id_villa`='".$this->myesc($villa_id)."' AND `busy`.`mm`>='1' AND `booked`.`status`<>'0' AND `booked`.`status`<>'50' AND `busy`.`yyyy`>='".$this->myesc($year)."' AND `busy`.`active`=1 AND `booked`.`id`<>'".$this->myesc($reservaid)."' ORDER BY busy.starting ASC";  // LIMIT 1 //LIMIT 0,30
	     // '".$this->myesc($mes)."'
	$result=$this->query($sql);
   // foreach($result as $result);
	return ($result);
	}

		public function see_occupancy_id($id){//this will search as per criteria choosed.
		$sql="SELECT busy.id AS busyid,
					 busy.starting AS start,
					 busy.ending AS end,
					 busy.type AS type,
					 busy.id_villa AS villa,
					 busy.id_adm AS adm,
					 busy.comment AS note,
					 busy.date AS date,
					 busy.id_update AS upd,
					 booked.id AS reserveid,
					 booked.ref AS ref,
					 booked.id_client AS client,
					 booked.adults AS adults,
					 booked.children AS kids,
					 booked.vehicles AS vehicles,
					 booked.id_interm AS interm,
					 booked.qty_nights AS nights,
					 booked.nightsHS AS NHS,
					 booked.nightsLS AS NLS,
					 booked.price_per_night AS ppn,
					 booked.priceHS AS PHS,
					 booked.commision AS apc,
					 booked.amount AS subtotal,
					 booked.tax AS itbis,
					 booked.services_amount AS aps,
					 booked.deposit AS dep,
					 booked.total AS total,
					 booked.status AS status,
					 booked.comment AS rc,
					 booked.pagos_qty AS PAYM,
					 booked.pagos_monto AS PMV,
					 booked.price_long AS PL,
					 booked.extra_nights AS EN,
					 booked.online AS line
			  FROM `".DB_PREFIX."occupancy` AS `busy`

			  LEFT JOIN `".DB_PREFIX."reserves` AS `booked`
			  ON `busy`.`id`=`booked`.`id_occupancy`

			  WHERE `busy`.`id`='".$this->myesc($id)."' AND `busy`.`active`=1 LIMIT 1";  // LIMIT 1
		$result=$this->query($sql);
   // foreach($result as $result);
	return ($result);
	}

	public function see_occupancy_ref($ref){//this will search as per criteria choosed.

		$sql="SELECT busy.id AS busyid,
					 busy.starting AS start,
					 busy.ending AS end,                                             -
					 busy.type AS type,
					 busy.id_villa AS villa,
					 busy.id_adm AS adm,
					 busy.comment AS note,
					 busy.date AS date,
					 busy.id_update AS upd,
					 booked.id AS reserveid,
					 booked.ref AS ref,
					 booked.id_client AS client,
					 booked.adults AS adults,
					 booked.children AS kids,
					 booked.vehicles AS vehicles,
					 booked.id_interm AS interm,
					 booked.qty_nights AS nights,
					 booked.nightsHS AS NHS,
					 booked.nightsLS AS NLS,
					 booked.price_per_night AS ppn,
					 booked.priceHS AS PHS,
					 booked.commision AS apc,
					 booked.amount AS subtotal,
					 booked.tax AS itbis,
					 booked.services_amount AS aps,
					 booked.deposit AS dep,
					 booked.total AS total,
					 booked.status AS status,
					 booked.comment AS rc,
					 booked.pagos_qty AS PAYM,
					 booked.pagos_monto AS PMV,
					 booked.price_long AS PL,
					 booked.extra_nights AS EN,
					 booked.online AS line
			  FROM `".DB_PREFIX."occupancy` AS `busy`

			  LEFT JOIN `".DB_PREFIX."reserves` AS `booked`
			  ON `busy`.`id`=`booked`.`id_occupancy`

			  WHERE `booked`.`ref`='".$this->myesc($ref)."' AND `busy`.`active`=1 LIMIT 1";  // LIMIT 1
		$result=$this->query($sql);
	return ($result);
	}


	public function see_occupancy_ref_no_zero($ref){//this will search as per criteria choosed. and no invalid

		$sql="SELECT busy.id AS busyid,
					 busy.starting AS start,
					 busy.ending AS end,
					 busy.type AS type,
					 busy.id_villa AS villa,
					 busy.id_adm AS adm,
					 busy.comment AS note,
					 busy.date AS date,
					 busy.id_update AS upd,
					 booked.id AS reserveid,
					 booked.ref AS ref,
					 booked.id_client AS client,
					 booked.adults AS adults,
					 booked.children AS kids,
					 booked.id_interm AS interm,
					 booked.qty_nights AS nights,
					 booked.nightsHS AS NHS,
					 booked.nightsLS AS NLS,
					 booked.price_per_night AS ppn,
					 booked.priceHS AS PHS,
					 booked.commision AS apc,
					 booked.amount AS subtotal,
					 booked.tax AS itbis,
					 booked.services_amount AS aps,
					 booked.deposit AS dep,
					 booked.total AS total,
					 booked.status AS status,
					 booked.comment AS rc,
					 booked.online AS line
			  FROM `".DB_PREFIX."occupancy` AS `busy`

			  LEFT JOIN `".DB_PREFIX."reserves` AS `booked`
			  ON `busy`.`id`=`booked`.`id_occupancy`

			  WHERE `booked`.`ref`='".$this->myesc($ref)."' AND `busy`.`active`='1'  AND `booked`.`status`<>'0' AND `booked`.`status`<>'50' LIMIT 1";  // LIMIT 1
			  // WHERE `booked`.`ref`='".$this->myesc($ref)."' AND `busy`.`active`='1'  AND `booked`.`status`<>'0' AND `booked`.`status`<>'1' AND `booked`.`status`<>'4' LIMIT 1";  // LIMIT 1
		$result=$this->query($sql);
	return ($result);
	}

	public function occupancy_customer($customerid){//this will search as per criteria choosed.

		$sql="SELECT busy.id AS busyid,
					 busy.starting AS start,
					 busy.ending AS end,
					 busy.id_villa AS villa,
					 booked.id AS reserveid,
					 booked.ref AS ref,
					 booked.qty_nights AS nights,
					 booked.price_per_night AS ppn,
					 booked.status AS status,
					 booked.comment AS note
			  FROM `".DB_PREFIX."occupancy` AS `busy`

			  LEFT JOIN `".DB_PREFIX."reserves` AS `booked`
			  ON `busy`.`id`=`booked`.`id_occupancy`

			  WHERE `booked`.`id_client`='".$this->myesc($customerid)."' AND `busy`.`active`=1 ORDER BY busy.starting DESC";  // LIMIT 1
		$result=$this->query($sql);
	return ($result);
	}



	public function occupancy_customer_3($customerid){//this will search as per criteria choosed.

		$sql="SELECT busy.id AS busyid,
					 busy.starting AS start,
					 busy.ending AS end,
					 busy.id_villa AS villa,
					 booked.id AS reserveid,
					 booked.ref AS ref,
					 booked.qty_nights AS nights,
					 booked.price_per_night AS ppn,
					 booked.status AS status,
					 booked.comment AS note
			  FROM `".DB_PREFIX."occupancy` AS `busy`

			  LEFT JOIN `".DB_PREFIX."reserves` AS `booked`
			  ON `busy`.`id`=`booked`.`id_occupancy`

			  WHERE `booked`.`id_client`='".$this->myesc($customerid)."' AND `busy`.`active`=1 ORDER BY busy.starting DESC LIMIT 3";  // LIMIT 1
		$result=$this->query($sql);
	return ($result);
	}


	public function checkEmail($email) {

			$query="SELECT *
					FROM `".DB_PREFIX."customers`
					WHERE `email`='".$this->myesc($email)."' LIMIT 1";

			return $this->query($query);

	}

		public function checkCedula($cedula) {

			$query="SELECT *
					FROM `".DB_PREFIX."customers`
					WHERE `cedula`='".$this->myesc($cedula)."' LIMIT 1";

			return $this->query($query);

		}

		public function checkPassport($passport) {

			$query="SELECT *
					FROM `".DB_PREFIX."customers`
					WHERE `passport`='".$this->myesc($passport)."' LIMIT 1";

			return $this->query($query);

		}

		public function checkEmail_others($email, $id) {

			$query="SELECT *
					FROM `".DB_PREFIX."customers`
					WHERE `email`='".$this->myesc($email)."' AND `id`<>'".$this->myesc($id)."' LIMIT 1";

			return $this->query($query);

		}

		public function checkEmail_others_intable($email, $id, $table) {

			$query="SELECT *
					FROM `".DB_PREFIX.$table."`
					WHERE `email`='".$this->myesc($email)."' AND `id`<>'".$this->myesc($id)."' LIMIT 1";

			return $this->query($query);

		}

		public function checkCedula_others($cedula, $id) {

			$query="SELECT *
					FROM `".DB_PREFIX."customers`
					WHERE `cedula`='".$this->myesc($cedula)."'  AND `id`<>'".$this->myesc($id)."' LIMIT 1";

			return $this->query($query);

		}

		public function checkPassport_others($passport, $id) {

			$query="SELECT *
					FROM `".DB_PREFIX."customers`
					WHERE `passport`='".$this->myesc($passport)."'  AND `id`<>'".$this->myesc($id)."' LIMIT 1";

			return $this->query($query);

		}

		public function highest_invoice_registered() {

			$query="SELECT id
					FROM `".DB_PREFIX."invoice` ORDER BY id DESC LIMIT 1";

			return $this->query($query);

		}

		public function highest_re_sheet_registered() {

			$query="SELECT id
					FROM `".DB_PREFIX."register_sheets` ORDER BY id DESC LIMIT 1";

			return $this->query($query);

		}

		public function check_in_today() {

			$query="SELECT busy.id AS busyid,
					 busy.starting AS start,
					 busy.ending AS end,
					 busy.id_villa AS villa,
					 booked.id AS reserveid,
					 booked.ref AS ref,
					 booked.qty_nights AS nights,
					 booked.price_per_night AS ppn,
					 booked.status AS status,
					 booked.id_client AS client,
					 booked.adults AS adults,
					 booked.children AS kids,
					 booked.comment AS note
			  FROM `".DB_PREFIX."occupancy` AS `busy`

			  LEFT JOIN `".DB_PREFIX."reserves` AS `booked`
			  ON `busy`.`id`=`booked`.`id_occupancy`

			  WHERE `busy`.`starting`='".$this->myesc(date('Y-m-d'))."' AND `busy`.`active`=1 AND `booked`.`status`<>0 AND `booked`.`status`<>1 AND `booked`.`status`<>4 AND `booked`.`status`<>5 AND `booked`.`status`<>6 AND `booked`.`status`<>7 AND `booked`.`status`<>8 AND `booked`.`status`<>11 AND `booked`.`status`<>14 AND `booked`.`status`<>15 AND `booked`.`status`<>18 AND `booked`.`status`<>21 AND `booked`.`status`<>25 AND `booked`.`status`<>22 AND `booked`.`status`<>26 AND `booked`.`status`<>29 AND `booked`.`status`<>30 ORDER BY busy.id ASC";
             // WHERE `busy`.`starting`='".$this->myesc(date('Y-m-d'))."' AND `busy`.`active`=1 AND `booked`.`status`=2 OR `booked`.`status`=3  OR `booked`.`status`=6 ORDER BY busy.id ASC";
			return $this->query($query);

		}

		public function check_out_today() {

			$query="SELECT busy.id AS busyid,
					 busy.starting AS start,
					 busy.ending AS end,
					 busy.id_villa AS villa,
					 booked.id AS reserveid,
					 booked.ref AS ref,
					 booked.qty_nights AS nights,
					 booked.price_per_night AS ppn,
					 booked.status AS status,
					 booked.id_client AS client,
					 booked.adults AS adults,
					 booked.children AS kids,
					 booked.comment AS note
			  FROM `".DB_PREFIX."occupancy` AS `busy`

			  LEFT JOIN `".DB_PREFIX."reserves` AS `booked`
			  ON `busy`.`id`=`booked`.`id_occupancy`

			  WHERE `busy`.`ending`='".$this->myesc(date('Y-m-d'))."' AND `busy`.`active`=1 AND `booked`.`status`<>'0' AND `booked`.`status`<>'5' AND `booked`.`status`<>'2' AND `booked`.`status`<>'3' AND `booked`.`status`<>'4' AND `booked`.`status`<>'9' AND `booked`.`status`<>'10' AND `booked`.`status`<>'11' AND `booked`.`status`<>'12' AND `booked`.`status`<>'13' AND `booked`.`status`<>'14' AND `booked`.`status`<>'16' AND `booked`.`status`<>'17' AND `booked`.`status`<>'18' AND `booked`.`status`<>'19' AND `booked`.`status`<>'20' AND `booked`.`status`<>'21' AND `booked`.`status`<>'23' AND `booked`.`status`<>'24' AND `booked`.`status`<>'25' AND `booked`.`status`<>'27' AND `booked`.`status`<>'28' AND `booked`.`status`<>'29' AND `booked`.`status`<>'31' AND `booked`.`status`<>'32' AND `booked`.`status`<>'33' AND `booked`.`status`<>'35' AND `booked`.`status`<>'36' AND `booked`.`status`<>'37' AND `booked`.`status`<>'33' ORDER BY busy.id ASC";
				//`booked`.`status`<>4 AND `booked`.`status`='1' (different to checkedout and checkedin)only must be checked in do not matter more
			return $this->query($query);

		}

		public function arriving_date($date) {
			$query="SELECT busy.id AS busyid,
					 busy.starting AS start,
					 busy.ending AS end,
					 busy.id_villa AS villa,
					 booked.id AS reserveid,
					 booked.ref AS ref,
					 booked.qty_nights AS nights,
					 booked.price_per_night AS ppn,
					 booked.status AS status,
					 booked.id_client AS client,
					 booked.adults AS adults,
					 booked.children AS kids,
					 booked.comment AS note
			  FROM `".DB_PREFIX."occupancy` AS `busy`
			  LEFT JOIN `".DB_PREFIX."reserves` AS `booked`
			  ON `busy`.`id`=`booked`.`id_occupancy`
			  WHERE `busy`.`starting`='".$this->myesc(date('Y-m-d',strtotime($date)))."' AND `busy`.`active`=1 AND `booked`.`status`<>0 AND `booked`.`status`<>5 ORDER BY busy.id ASC";
             // WHERE `busy`.`starting`='".$this->myesc(date('Y-m-d'))."' AND `busy`.`active`=1 AND `booked`.`status`=2 OR `booked`.`status`=3  OR `booked`.`status`=6 ORDER BY busy.id ASC";
			return $this->query($query);
		}
		
		public function arriving_date_paid($date) {
			$query="SELECT busy.id AS busyid,
					 busy.starting AS start,
					 busy.ending AS end,
					 busy.id_villa AS villa,
					 booked.id AS reserveid,
					 booked.ref AS ref,
					 booked.qty_nights AS nights,
					 booked.price_per_night AS ppn,
					 booked.status AS status,
					 booked.id_client AS client,
					 booked.adults AS adults,
					 booked.children AS kids,
					 booked.comment AS note
			  FROM `".DB_PREFIX."occupancy` AS `busy`
			  LEFT JOIN `".DB_PREFIX."reserves` AS `booked`
			  ON `busy`.`id`=`booked`.`id_occupancy`
			  WHERE `busy`.`starting`='".$this->myesc(date('Y-m-d',strtotime($date)))."' AND `busy`.`active`=1 AND `booked`.`status`<>0 AND `booked`.`status`<>5  AND `booked`.`status`<>3 AND `booked`.`status`<>7 AND `booked`.`status`<>10 AND `booked`.`status`<>13 AND `booked`.`status`<>17 AND `booked`.`status`<>19 AND `booked`.`status`<>20 AND `booked`.`status`<>21 AND `booked`.`status`<>22 AND `booked`.`status`<>23 AND `booked`.`status`<>24 AND `booked`.`status`<>25 ORDER BY busy.id ASC";
             // WHERE `busy`.`starting`='".$this->myesc(date('Y-m-d'))."' AND `busy`.`active`=1 AND `booked`.`status`=2 OR `booked`.`status`=3  OR `booked`.`status`=6 ORDER BY busy.id ASC";
			return $this->query($query);
		}
		
		public function departuring_date_paid($date) {
			$query="SELECT busy.id AS busyid,
					 busy.starting AS start,
					 busy.ending AS end,
					 busy.id_villa AS villa,
					 booked.id AS reserveid,
					 booked.ref AS ref,
					 booked.qty_nights AS nights,
					 booked.price_per_night AS ppn,
					 booked.status AS status,
					 booked.id_client AS client,
					 booked.adults AS adults,
					 booked.children AS kids,
					 booked.comment AS note
			  FROM `".DB_PREFIX."occupancy` AS `busy`
			  LEFT JOIN `".DB_PREFIX."reserves` AS `booked`
			  ON `busy`.`id`=`booked`.`id_occupancy`
			  WHERE `busy`.`ending`='".$this->myesc(date('Y-m-d',strtotime($date)))."' AND `busy`.`active`=1 AND `booked`.`status`<>'0' AND `booked`.`status`<>'5' AND `booked`.`status`<>3 AND `booked`.`status`<>7 AND `booked`.`status`<>10 AND `booked`.`status`<>13 AND `booked`.`status`<>17 AND `booked`.`status`<>19 AND `booked`.`status`<>20 AND `booked`.`status`<>21 AND `booked`.`status`<>22 AND `booked`.`status`<>23 AND `booked`.`status`<>24 AND `booked`.`status`<>25 ORDER BY busy.id ASC";
				//`booked`.`status`<>4 AND `booked`.`status`='1' (different to checkedout and checkedin)only must be checked in do not matter more
			return $this->query($query);
		}
		
		public function inhouse_date_paid($date) {
			$query="SELECT busy.id AS busyid,
					 busy.starting AS start,
					 busy.ending AS end,
					 busy.id_villa AS villa,
					 booked.id AS reserveid,
					 booked.ref AS ref,
					 booked.qty_nights AS nights,
					 booked.price_per_night AS ppn,
					 booked.status AS status,
					 booked.id_client AS client,
					 booked.adults AS adults,
					 booked.children AS kids,
					 booked.comment AS note
			  FROM `".DB_PREFIX."occupancy` AS `busy`
			  LEFT JOIN `".DB_PREFIX."reserves` AS `booked`
			  ON `busy`.`id`=`booked`.`id_occupancy`
			  WHERE `busy`.`ending`>'".$this->myesc(date('Y-m-d',strtotime($date)))."' AND `busy`.`starting`<'".$this->myesc(date('Y-m-d',strtotime($date)))."' AND `busy`.`active`=1 AND `booked`.`status`<>'0' AND `booked`.`status`<>'5' AND `booked`.`status`<>3 AND `booked`.`status`<>7 AND `booked`.`status`<>10 AND `booked`.`status`<>13 AND `booked`.`status`<>17 AND `booked`.`status`<>19 AND `booked`.`status`<>20 AND `booked`.`status`<>21 AND `booked`.`status`<>22 AND `booked`.`status`<>23 AND `booked`.`status`<>24 AND `booked`.`status`<>25 ORDER BY busy.id ASC";
				//`booked`.`status`<>4 AND `booked`.`status`='1' (different to checkedout and checkedin)only must be checked in do not matter more
			return $this->query($query);
		}
		
	public function inhouse_villas_paid($date, $beds){
		
		switch($beds){
			case 10:
					$sql="SELECT o.id AS busyid,
							 o.starting AS start,
							 o.ending AS end,
							 o.id_villa AS villa_id,
							 o.date AS date,
							 r.id AS reserveid,
							 r.ref AS ref,
							 r.id_client AS client,
							 r.qty_nights AS nights,
							 r.status AS status,
							 v.no AS villa_number,
							 v.type AS villa_type,
							 v.bed AS bedrooms,
							 v.ac AS air_conditioners,
							 v.bath AS bathrooms,
							 v.capacity AS max_persons,
							 v.p_low AS price_low_season,
							 v.p_high AS price_high_season
					  FROM `".DB_PREFIX."occupancy` AS `o`
					  LEFT JOIN `".DB_PREFIX."reserves` AS `r`
					  ON `o`.`id`=`r`.`id_occupancy`
					  LEFT JOIN `".DB_PREFIX."villas` AS `v`
					  ON `o`.`id_villa`=`v`.`id`
					  WHERE `o`.`starting`<'".$this->myesc($date)."' AND `o`.`ending`>'".$this->myesc($date)."' AND `r`.`status`<>0 AND `r`.`status`<>5 AND `r`.`status`<>50 AND `r`.`status`<>3 AND `r`.`status`<>7 AND `r`.`status`<>10 AND `r`.`status`<>13 AND `r`.`status`<>17 AND `r`.`status`<>19 AND `r`.`status`<>20 AND `r`.`status`<>21 AND `r`.`status`<>22 AND `r`.`status`<>23 AND `r`.`status`<>24 AND `r`.`status`<>25 AND `v`.`able_r`=1  ORDER BY v.no ASC";
					break;
			case 2:
					$sql="SELECT o.id AS busyid,
							 o.starting AS start,
							 o.ending AS end,
							 o.id_villa AS villa_id,
							 o.date AS date,
							 r.id AS reserveid,
							 r.ref AS ref,
							 r.id_client AS client,
							 r.qty_nights AS nights,
							 r.status AS status,
							 v.no AS villa_number,
							 v.type AS villa_type,
							 v.bed AS bedrooms,
							 v.ac AS air_conditioners,
							 v.bath AS bathrooms,
							 v.capacity AS max_persons,
							 v.p_low AS price_low_season,
							 v.p_high AS price_high_season
					  FROM `".DB_PREFIX."occupancy` AS `o`
					  LEFT JOIN `".DB_PREFIX."reserves` AS `r`
					  ON `o`.`id`=`r`.`id_occupancy`
					  LEFT JOIN `".DB_PREFIX."villas` AS `v`
					  ON `o`.`id_villa`=`v`.`id`
					  WHERE `o`.`starting`<='".$this->myesc($date)."' AND `o`.`ending`>'".$this->myesc($date)."' AND `v`.`bed`='".$this->myesc($beds)."' AND `v`.`bed`='".$this->myesc($beds)."' AND `r`.`status`<>0 AND `r`.`status`<>5 AND `r`.`status`<>50 AND `r`.`status`<>3 AND `r`.`status`<>7 AND `r`.`status`<>10 AND `r`.`status`<>13 AND `r`.`status`<>17 AND `r`.`status`<>19 AND `r`.`status`<>20 AND `r`.`status`<>21 AND `r`.`status`<>22 AND `r`.`status`<>23 AND `r`.`status`<>24 AND `r`.`status`<>25 AND `v`.`able_r`=1  ORDER BY v.no ASC";
					break;
			case 3:
					$sql="SELECT o.id AS busyid,
							 o.starting AS start,
							 o.ending AS end,
							 o.id_villa AS villa_id,
							 o.date AS date,
							 r.id AS reserveid,
							 r.ref AS ref,
							 r.id_client AS client,
							 r.qty_nights AS nights,
							 r.status AS status,
							 v.no AS villa_number,
							 v.type AS villa_type,
							 v.bed AS bedrooms,
							 v.ac AS air_conditioners,
							 v.bath AS bathrooms,
							 v.capacity AS max_persons,
							 v.p_low AS price_low_season,
							 v.p_high AS price_high_season
					  FROM `".DB_PREFIX."occupancy` AS `o`
					  LEFT JOIN `".DB_PREFIX."reserves` AS `r`
					  ON `o`.`id`=`r`.`id_occupancy`
					  LEFT JOIN `".DB_PREFIX."villas` AS `v`
					  ON `o`.`id_villa`=`v`.`id`
					  WHERE `o`.`starting`<='".$this->myesc($date)."' AND `o`.`ending`>'".$this->myesc($date)."' AND `v`.`bed`='".$this->myesc($beds)."' AND `v`.`bed`='".$this->myesc($beds)."' AND `r`.`status`<>0 AND `r`.`status`<>5 AND `r`.`status`<>50 AND `r`.`status`<>3 AND `r`.`status`<>7 AND `r`.`status`<>10 AND `r`.`status`<>13 AND `r`.`status`<>17 AND `r`.`status`<>19 AND `r`.`status`<>20 AND `r`.`status`<>21 AND `r`.`status`<>22 AND `r`.`status`<>23 AND `r`.`status`<>24 AND `r`.`status`<>25 AND `v`.`able_r`=1  ORDER BY v.no ASC";
					break;
			case 4:
					$sql="SELECT o.id AS busyid,
							 o.starting AS start,
							 o.ending AS end,
							 o.id_villa AS villa_id,
							 o.date AS date,
							 r.id AS reserveid,
							 r.ref AS ref,
							 r.id_client AS client,
							 r.qty_nights AS nights,
							 r.status AS status,
							 v.no AS villa_number,
							 v.type AS villa_type,
							 v.bed AS bedrooms,
							 v.ac AS air_conditioners,
							 v.bath AS bathrooms,
							 v.capacity AS max_persons,
							 v.p_low AS price_low_season,
							 v.p_high AS price_high_season
					  FROM `".DB_PREFIX."occupancy` AS `o`
					  LEFT JOIN `".DB_PREFIX."reserves` AS `r`
					  ON `o`.`id`=`r`.`id_occupancy`
					  LEFT JOIN `".DB_PREFIX."villas` AS `v`
					  ON `o`.`id_villa`=`v`.`id`
					  WHERE `o`.`starting`<='".$this->myesc($date)."' AND `o`.`ending`>'".$this->myesc($date)."' AND `v`.`bed`='".$this->myesc($beds)."' AND `v`.`bed`='".$this->myesc($beds)."' AND `r`.`status`<>0 AND `r`.`status`<>5 AND `r`.`status`<>50 AND `r`.`status`<>3 AND `r`.`status`<>7 AND `r`.`status`<>10 AND `r`.`status`<>13 AND `r`.`status`<>17 AND `r`.`status`<>19 AND `r`.`status`<>20 AND `r`.`status`<>21 AND `r`.`status`<>22 AND `r`.`status`<>23 AND `r`.`status`<>24 AND `r`.`status`<>25 AND `v`.`able_r`=1  ORDER BY v.no ASC";
					break;
			case 5:
					$sql="SELECT o.id AS busyid,
							 o.starting AS start,
							 o.ending AS end,
							 o.id_villa AS villa_id,
							 o.date AS date,
							 r.id AS reserveid,
							 r.ref AS ref,
							 r.id_client AS client,
							 r.qty_nights AS nights,
							 r.status AS status,
							 v.no AS villa_number,
							 v.type AS villa_type,
							 v.bed AS bedrooms,
							 v.ac AS air_conditioners,
							 v.bath AS bathrooms,
							 v.capacity AS max_persons,
							 v.p_low AS price_low_season,
							 v.p_high AS price_high_season
					  FROM `".DB_PREFIX."occupancy` AS `o`
					  LEFT JOIN `".DB_PREFIX."reserves` AS `r`
					  ON `o`.`id`=`r`.`id_occupancy`
					  LEFT JOIN `".DB_PREFIX."villas` AS `v`
					  ON `o`.`id_villa`=`v`.`id`
					  WHERE `o`.`starting`<='".$this->myesc($date)."' AND `o`.`ending`>'".$this->myesc($date)."' AND `v`.`bed`='".$this->myesc($beds)."' AND `v`.`bed`='".$this->myesc($beds)."' AND `r`.`status`<>0 AND `r`.`status`<>5 AND `r`.`status`<>50 AND `r`.`status`<>3 AND `r`.`status`<>7 AND `r`.`status`<>10 AND `r`.`status`<>13 AND `r`.`status`<>17 AND `r`.`status`<>19 AND `r`.`status`<>20 AND `r`.`status`<>21 AND `r`.`status`<>22 AND `r`.`status`<>23 AND `r`.`status`<>24 AND `r`.`status`<>25 AND `v`.`able_r`=1  ORDER BY v.no ASC";
					break;
			case 6:
					$sql="SELECT o.id AS busyid,
							 o.starting AS start,
							 o.ending AS end,
							 o.id_villa AS villa_id,
							 o.date AS date,
							 r.id AS reserveid,
							 r.ref AS ref,
							 r.id_client AS client,
							 r.qty_nights AS nights,
							 r.status AS status,
							 v.no AS villa_number,
							 v.type AS villa_type,
							 v.bed AS bedrooms,
							 v.ac AS air_conditioners,
							 v.bath AS bathrooms,
							 v.capacity AS max_persons,
							 v.p_low AS price_low_season,
							 v.p_high AS price_high_season
					  FROM `".DB_PREFIX."occupancy` AS `o`
					  LEFT JOIN `".DB_PREFIX."reserves` AS `r`
					  ON `o`.`id`=`r`.`id_occupancy`
					  LEFT JOIN `".DB_PREFIX."villas` AS `v`
					  ON `o`.`id_villa`=`v`.`id`
					  WHERE `o`.`starting`<='".$this->myesc($date)."' AND `o`.`ending`>'".$this->myesc($date)."' AND `v`.`bed`='".$this->myesc($beds)."' AND `r`.`status`<>0 AND `r`.`status`<>5 AND `r`.`status`<>50 AND `r`.`status`<>3 AND `r`.`status`<>7 AND `r`.`status`<>10 AND `r`.`status`<>13 AND `r`.`status`<>17 AND `r`.`status`<>19 AND `r`.`status`<>20 AND `r`.`status`<>21 AND `r`.`status`<>22 AND `r`.`status`<>23 AND `r`.`status`<>24 AND `r`.`status`<>25 AND `v`.`able_r`=1  ORDER BY v.no ASC";
					break;
			default:
					$sql="SELECT o.id AS busyid,
							 o.starting AS start,
							 o.ending AS end,
							 o.id_villa AS villa_id,
							 o.date AS date,
							 r.id AS reserveid,
							 r.ref AS ref,
							 r.id_client AS client,
							 r.qty_nights AS nights,
							 r.status AS status,
							 v.no AS villa_number,
							 v.type AS villa_type,
							 v.bed AS bedrooms,
							 v.ac AS air_conditioners,
							 v.bath AS bathrooms,
							 v.capacity AS max_persons,
							 v.p_low AS price_low_season,
							 v.p_high AS price_high_season
					  FROM `".DB_PREFIX."occupancy` AS `o`
					  LEFT JOIN `".DB_PREFIX."reserves` AS `r`
					  ON `o`.`id`=`r`.`id_occupancy`
					  LEFT JOIN `".DB_PREFIX."villas` AS `v`
					  ON `o`.`id_villa`=`v`.`id`
					  WHERE `o`.`starting`<'".$this->myesc($date)."' AND `o`.`ending`>'".$this->myesc($date)."' AND `r`.`status`<>0 AND `r`.`status`<>5 AND `r`.`status`<>50 AND `r`.`status`<>3 AND `r`.`status`<>7 AND `r`.`status`<>10 AND `r`.`status`<>13 AND `r`.`status`<>17 AND `r`.`status`<>19 AND `r`.`status`<>20 AND `r`.`status`<>21 AND `r`.`status`<>22 AND `r`.`status`<>23 AND `r`.`status`<>24 AND `r`.`status`<>25 AND `v`.`able_r`=1  ORDER BY v.no ASC";
		}
		return $this->query($sql);
	}
	
	public function weeklyList_all_unpaid($date) {
		$query="SELECT busy.id AS busyid,
				 busy.starting AS start,
				 busy.ending AS end,
				 busy.id_villa AS villa,
				 booked.id AS reserveid,
				 booked.ref AS ref,
				 booked.qty_nights AS nights,
				 booked.price_per_night AS ppn,
				 booked.status AS status,
				 booked.id_client AS client,
				 booked.adults AS adults,
				 booked.children AS kids,
				 booked.comment AS note
		  FROM `".DB_PREFIX."occupancy` AS `busy`
		  LEFT JOIN `".DB_PREFIX."reserves` AS `booked`
		  ON `busy`.`id`=`booked`.`id_occupancy`
		  WHERE `busy`.`ending`>='".$this->myesc(date('Y-m-d',strtotime($date)))."' AND `busy`.`starting`<='".$this->myesc(date('Y-m-d',strtotime($date)))."' AND `busy`.`active`=1 AND `booked`.`status`<>'0' AND `booked`.`status`<>'5' AND `booked`.`status`<>1 AND `booked`.`status`<>2 AND `booked`.`status`<>4 AND `booked`.`status`<>6 AND `booked`.`status`<>8 AND `booked`.`status`<>9 AND `booked`.`status`<>11 AND `booked`.`status`<>12 AND `booked`.`status`<>14 AND `booked`.`status`<>15 AND `booked`.`status`<>16 AND `booked`.`status`<>18 ORDER BY busy.id ASC";
			//`booked`.`status`<>4 AND `booked`.`status`='1' (different to checkedout and checkedin)only must be checked in do not matter more
		return $this->query($query);
	}
		
		
		
		public function arriving_dateft($date, $datet) {
			$query="SELECT busy.id AS busyid,
					 busy.starting AS start,
					 busy.ending AS end,
					 busy.id_villa AS villa,
					 booked.id AS reserveid,
					 booked.ref AS ref,
					 booked.qty_nights AS nights,
					 booked.price_per_night AS ppn,
					 booked.status AS status,
					 booked.id_client AS client,
					 booked.adults AS adults,
					 booked.children AS kids,
					 booked.comment AS note
			  FROM `".DB_PREFIX."occupancy` AS `busy`
			  LEFT JOIN `".DB_PREFIX."reserves` AS `booked`
			  ON `busy`.`id`=`booked`.`id_occupancy`
			  WHERE `busy`.`starting`>'".$this->myesc(date('Y-m-d',strtotime($date)))."' AND `busy`.`starting`<'".$this->myesc(date('Y-m-d',strtotime($datet)))."' AND `busy`.`active`=1 AND `booked`.`status`<>0 AND `booked`.`status`<>5 ORDER BY busy.id ASC";
             // WHERE `busy`.`starting`='".$this->myesc(date('Y-m-d'))."' AND `busy`.`active`=1 AND `booked`.`status`=2 OR `booked`.`status`=3  OR `booked`.`status`=6 ORDER BY busy.id ASC";
			return $this->query($query);
		}

		public function departuring_date($date) {
			$query="SELECT busy.id AS busyid,
					 busy.starting AS start,
					 busy.ending AS end,
					 busy.id_villa AS villa,
					 booked.id AS reserveid,
					 booked.ref AS ref,
					 booked.qty_nights AS nights,
					 booked.price_per_night AS ppn,
					 booked.status AS status,
					 booked.id_client AS client,
					 booked.adults AS adults,
					 booked.children AS kids,
					 booked.comment AS note
			  FROM `".DB_PREFIX."occupancy` AS `busy`
			  LEFT JOIN `".DB_PREFIX."reserves` AS `booked`
			  ON `busy`.`id`=`booked`.`id_occupancy`
			  WHERE `busy`.`ending`='".$this->myesc(date('Y-m-d',strtotime($date)))."' AND `busy`.`active`=1 AND `booked`.`status`<>'0' AND `booked`.`status`<>'5' ORDER BY busy.id ASC";
				//`booked`.`status`<>4 AND `booked`.`status`='1' (different to checkedout and checkedin)only must be checked in do not matter more
			return $this->query($query);
		}	
		
		public function inhouse_date($date) {
			$query="SELECT busy.id AS busyid,
					 busy.starting AS start,
					 busy.ending AS end,
					 busy.id_villa AS villa,
					 booked.id AS reserveid,
					 booked.ref AS ref,
					 booked.qty_nights AS nights,
					 booked.price_per_night AS ppn,
					 booked.status AS status,
					 booked.id_client AS client,
					 booked.adults AS adults,
					 booked.children AS kids,
					 booked.comment AS note
			  FROM `".DB_PREFIX."occupancy` AS `busy`
			  LEFT JOIN `".DB_PREFIX."reserves` AS `booked`
			  ON `busy`.`id`=`booked`.`id_occupancy`
			  WHERE `busy`.`ending`>'".$this->myesc(date('Y-m-d',strtotime($date)))."' AND `busy`.`starting`<'".$this->myesc(date('Y-m-d',strtotime($date)))."' AND `busy`.`active`=1 AND `booked`.`status`<>'0' AND `booked`.`status`<>'5' ORDER BY busy.id ASC";
				//`booked`.`status`<>4 AND `booked`.`status`='1' (different to checkedout and checkedin)only must be checked in do not matter more
			return $this->query($query);
		}

		public function bookings_of_the_day($date) {
			$query="SELECT busy.id AS busyid,
					 busy.starting AS start,
					 busy.ending AS end,
					 busy.id_villa AS villa,
					 booked.id AS reserveid,
					 booked.ref AS ref,
					 booked.qty_nights AS nights,
					 booked.price_per_night AS ppn,
					 booked.status AS status,
					 booked.id_client AS client,
					 booked.adults AS adults,
					 booked.children AS kids,
					 booked.comment AS note
			  FROM `".DB_PREFIX."occupancy` AS `busy`
			  LEFT JOIN `".DB_PREFIX."reserves` AS `booked`
			  ON `busy`.`id`=`booked`.`id_occupancy`
			  WHERE `busy`.`ending`>='".$this->myesc(date('Y-m-d',strtotime($date)))."' AND `busy`.`starting`<='".$this->myesc(date('Y-m-d',strtotime($date)))."' AND `busy`.`active`=1 AND `booked`.`status`<>'0' AND `booked`.`status`<>'5' ORDER BY busy.id ASC";
				//`booked`.`status`<>4 AND `booked`.`status`='1' (different to checkedout and checkedin)only must be checked in do not matter more
			return $this->query($query);
		}			
		
		
		public function checkEmail_table($email, $table) {
			$query="SELECT *
					FROM `".DB_PREFIX.$table."`
					WHERE `email`='".$this->myesc($email)."' LIMIT 1";
			return $this->query($query);
		}

		public function check_username_table($user, $table) {
			$query="SELECT *
					FROM `".DB_PREFIX.$table."`
					WHERE `user`='".$this->myesc($user)."' LIMIT 1";
			return $this->query($query);
		}

		public function checkEmail_others_table($email, $table, $id) {

			$query="SELECT *
					FROM `".DB_PREFIX.$table."`
					WHERE `email`='".$this->myesc($email)."' AND `id`<>'".$this->myesc($id)."' LIMIT 1";

			return $this->query($query);

		}

		public function check_username_others_table($user, $table, $id) {

			$query="SELECT *
					FROM `".DB_PREFIX.$table."`
					WHERE `user`='".$this->myesc($user)."' AND `id`<>'".$this->myesc($id)."' LIMIT 1";

			return $this->query($query);

		}

		public function show_cancelled($ref){

	    $sql="SELECT * FROM `".DB_PREFIX."cancelled_books` WHERE `ref`='".$this->myesc($ref)."' LIMIT 1";

		return $this->query($sql);
		}

		public function check_in($date) {

			$query="SELECT busy.id AS busyid,
					 busy.starting AS start,
					 busy.ending AS end,
					 busy.id_villa AS villa,
					 booked.id AS reserveid,
					 booked.ref AS ref,
					 booked.qty_nights AS nights,
					 booked.price_per_night AS ppn,
					 booked.status AS status,
					 booked.id_client AS client,
					 booked.adults AS adults,
					 booked.children AS kids,
					 booked.comment AS note
			  FROM `".DB_PREFIX."occupancy` AS `busy`

			  LEFT JOIN `".DB_PREFIX."reserves` AS `booked`
			  ON `busy`.`id`=`booked`.`id_occupancy`

			  WHERE `busy`.`starting`='".$this->myesc($date)."' AND `busy`.`active`=1 AND `booked`.`status`<>0 AND `booked`.`status`<>1 AND `booked`.`status`<>4  AND `booked`.`status`<>5 AND `booked`.`status`<>8 AND `booked`.`status`<>7 ORDER BY busy.id ASC";

			return $this->query($query);

		}

		public function check_out($date) {

			$query="SELECT busy.id AS busyid,
					 busy.starting AS start,
					 busy.ending AS end,
					 busy.id_villa AS villa,
					 booked.id AS reserveid,
					 booked.ref AS ref,
					 booked.qty_nights AS nights,
					 booked.price_per_night AS ppn,
					 booked.status AS status,
					 booked.id_client AS client,
					 booked.adults AS adults,
					 booked.children AS kids,
					 booked.comment AS note
			  FROM `".DB_PREFIX."occupancy` AS `busy`

			  LEFT JOIN `".DB_PREFIX."reserves` AS `booked`
			  ON `busy`.`id`=`booked`.`id_occupancy`

			  WHERE `busy`.`ending`='".$this->myesc($date)."' AND `busy`.`active`=1 AND `booked`.`status`='1' ORDER BY busy.id ASC";
				//`booked`.`status`<>4 AND `booked`.`status`='1' (different to checkedout and checkedin)only must be checked in do not matter more
			return $this->query($query);

		}

		public function see_occupancy_mod_ref($ref){//this will search as per criteria choosed.

		$sql="SELECT busy.id AS busyid,
					 busy.starting AS start,
					 busy.ending AS end,
					 busy.type AS type,
					 busy.id_villa AS villa,
					 busy.id_adm AS adm,
					 busy.comment AS note,
					 busy.date AS date,
					 booked.id AS reserveid,
					 booked.ref AS ref,
					 booked.id_client AS client,
					 booked.adults AS adults,
					 booked.children AS kids,
					 booked.vehicles AS vehicles,
					 booked.id_interm AS interm,
					 booked.qty_nights AS nights,
					 booked.nightsHS AS NHS,
					 booked.nightsLS AS NLS,
					 booked.price_nights AS ppn,
					 booked.priceHS AS PHS,
					 booked.commision AS apc,
					 booked.amount AS subtotal,
					 booked.tax AS itbis,
					 booked.serv_amount AS aps,
					 booked.deposit AS dep,
					 booked.total AS total,
					 booked.status AS status,
					 booked.comment AS rc
			  FROM `".DB_PREFIX."occupancy_mod` AS `busy`

			  LEFT JOIN `".DB_PREFIX."reserves_mod` AS `booked`
			  ON `busy`.`id`=`booked`.`id_occ_mod`

			  WHERE `booked`.`ref`='".$this->myesc($ref)."' AND `busy`.`active`=1 ORDER BY busy.id DESC";
		$result=$this->query($sql);
		return ($result);
		}
		//***************************bookings for a referal***************************************************
		public function bookings_referal($id_referal){//this will search as per criteria choosed.

		$sql="SELECT busy.id AS busyid,
					 busy.starting AS start,
					 busy.ending AS end,
					 busy.type AS type,
					 busy.id_villa AS villa,
					 busy.id_adm AS adm,
					 busy.comment AS note,
					 busy.date AS date,
					 booked.id AS reserveid,
					 booked.ref AS ref,
					 booked.id_client AS client,
					 booked.adults AS adults,
					 booked.children AS kids,
					 booked.id_interm AS interm,
					 booked.qty_nights AS nights,
					 booked.nightsHS AS NHS,
					 booked.nightsLS AS NLS,
					 booked.price_per_night AS ppn,
					 booked.priceHS AS PHS,
					 booked.commision AS apc,
					 booked.amount AS subtotal,
					 booked.tax AS itbis,
					 booked.services_amount AS aps,
					 booked.deposit AS dep,
					 booked.total AS total,
					 booked.status AS status,
					 booked.comment AS rc,
					 referred.id_referal AS id_referal
			  FROM `".DB_PREFIX."occupancy` AS `busy`

			  LEFT JOIN `".DB_PREFIX."reserves` AS `booked`
			  ON `busy`.`id`=`booked`.`id_occupancy`

			   LEFT JOIN `".DB_PREFIX."bookingreferred` AS `referred`
			  ON `booked`.`ref`=`referred`.`ref_book`

			  WHERE `referred`.`id_referal`='".$this->myesc($id_referal)."' ORDER BY busy.id DESC";
		$result=$this->query($sql);
		return ($result);
		}
       //*******************************************************************************************************
	   	public function bookings_referal_last3months($id_referal){//this will search as per criteria choosed.
		$hace_tres_meses=date('Y-m-d', strtotime("-3 months"));
		$sql="SELECT busy.id AS busyid,
					 busy.starting AS start,
					 busy.ending AS end,
					 busy.type AS type,
					 busy.id_villa AS villa,
					 busy.id_adm AS adm,
					 busy.comment AS note,
					 busy.date AS date,
					 booked.id AS reserveid,
					 booked.ref AS ref,
					 booked.id_client AS client,
					 booked.adults AS adults,
					 booked.children AS kids,
					 booked.id_interm AS interm,
					 booked.qty_nights AS nights,
					 booked.nightsHS AS NHS,
					 booked.nightsLS AS NLS,
					 booked.price_per_night AS ppn,
					 booked.priceHS AS PHS,
					 booked.commision AS apc,
					 booked.amount AS subtotal,
					 booked.tax AS itbis,
					 booked.services_amount AS aps,
					 booked.deposit AS dep,
					 booked.total AS total,
					 booked.status AS status,
					 booked.comment AS rc,
					 referred.id_referal AS id_referal
			  FROM `".DB_PREFIX."occupancy` AS `busy`

			  LEFT JOIN `".DB_PREFIX."reserves` AS `booked`
			  ON `busy`.`id`=`booked`.`id_occupancy`

			   LEFT JOIN `".DB_PREFIX."bookingreferred` AS `referred`
			  ON `booked`.`ref`=`referred`.`ref_book`

			  WHERE `referred`.`id_referal`='".$this->myesc($id_referal)."' AND DATE_FORMAT(`busy`.`date`, '%Y-%m-%d')>='".$hace_tres_meses."' ORDER BY busy.id DESC";
		$result=$this->query($sql);
		return ($result);
		}
		public function see_occupancy_mod_id($id){//this will search as per criteria choosed.

		$sql="SELECT busy.id AS busyid,
					 busy.starting AS start,
					 busy.ending AS end,
					 busy.type AS type,
					 busy.id_villa AS villa,
					 busy.id_adm AS adm,
					 busy.comment AS note,
					 busy.date AS date,
					 booked.id AS reserveid,
					 booked.ref AS ref,
					 booked.id_client AS client,
					 booked.adults AS adults,
					 booked.children AS kids,
					 booked.id_interm AS interm,
					 booked.qty_nights AS nights,
					 booked.nightsHS AS NHS,
					 booked.nightsLS AS NLS,
					 booked.price_nights AS ppn,
					 booked.priceHS AS PHS,
					 booked.commision AS apc,
					 booked.amount AS subtotal,
					 booked.tax AS itbis,
					 booked.serv_amount AS aps,
					 booked.deposit AS dep,
					 booked.total AS total,
					 booked.status AS status,
					 booked.comment AS rc
			  FROM `".DB_PREFIX."occupancy_mod` AS `busy`

			  LEFT JOIN `".DB_PREFIX."reserves_mod` AS `booked`
			  ON `busy`.`id`=`booked`.`id_occ_mod`

			  WHERE `busy`.`id`='".$this->myesc($id)."' AND `busy`.`active`=1 LIMIT 1";  // LIMIT 1
		$result=$this->query($sql);

		return ($result);
		}

	public function services_reserved_mod($reserve){
   	 $sql="SELECT sr.id_service AS serviceid,
    			 sr.qty AS qty,
    			 sr.price AS price,
    			 sr.comment AS note,
    			 s.name AS name,
    			 s.description AS descrip,
    			 s.type AS type,
    			 s.id	AS id

     FROM `".DB_PREFIX."serv_reserv_mod` AS `sr`
     LEFT JOIN `".DB_PREFIX."serv_add` AS `s`
     ON  `sr`.`id_service`=`s`.`id`

     WHERE `sr`.`id_res_mod`='".$this->myesc($reserve)."' ORDER BY `sr`.`id` ASC";
	 $result=$this->query($sql);

	return ($result);
	}

	public function people_mod($reserve){
	   	$sql="SELECT * FROM `".DB_PREFIX."people_mod` WHERE `id_res_mod`='".$this->myesc($reserve)."' ORDER BY `id` ASC";
		$result=$this->query($sql);

		return ($result);
	}

	public function excrusion_reserved_mod($reserve){
   	 $sql="SELECT er.id_excursion AS id_excursion,
    			 er.qty_a AS qty_a,
    			 er.qty_c AS qty_c,
    			 er.price_a AS price_a,
    			 er.price_c AS price_c,
    			 er.total AS total,
    			 e.title AS title,
    			 e.desc AS descrip

     FROM `".DB_PREFIX."excursions_booked_mod` AS `er`
     LEFT JOIN `".DB_PREFIX."excursions` AS `e`
     ON  `er`.`id_excursion`=`e`.`id`

     WHERE `er`.`id_reserve_mod`='".$this->myesc($reserve)."' ORDER BY `er`.`id_excursion` ASC";
	 $result=$this->query($sql);

	return ($result);
	}

	public function occupancyvilladate($villaid, $date){//this will search as per criteria choosed.

		$sql="SELECT busy.id AS busyid,
					 busy.starting AS start,
					 busy.ending AS end,
					 busy.type AS type,
					 busy.id_villa AS villa,
					 busy.id_adm AS adm,
					 busy.comment AS note,
					 busy.date AS date,
					 busy.id_update AS upd,
					 booked.id AS reserveid,
					 booked.ref AS ref,
					 booked.id_client AS client,
					 booked.adults AS adults,
					 booked.children AS kids,
					 booked.id_interm AS interm,
					 booked.qty_nights AS nights,
					 booked.nightsHS AS NHS,
					 booked.nightsLS AS NLS,
					 booked.price_per_night AS ppn,
					 booked.priceHS AS PHS,
					 booked.commision AS apc,
					 booked.amount AS subtotal,
					 booked.tax AS itbis,
					 booked.services_amount AS aps,
					 booked.deposit AS dep,
					 booked.total AS total,
					 booked.status AS status,
					 booked.comment AS rc
			  FROM `".DB_PREFIX."occupancy` AS `busy`

			  LEFT JOIN `".DB_PREFIX."reserves` AS `booked`
			  ON `busy`.`id`=`booked`.`id_occupancy`

			  WHERE `busy`.`starting`<='".$this->myesc($date)."' AND `busy`.`ending`>'".$this->myesc($date)."' AND `busy`.`active`=1 AND `busy`.`id_villa`='".$this->myesc($villaid)."' LIMIT 1";
		$result=$this->query($sql);
	return $result[0];
	}
	public function occratesaved($date){
		$sql="SELECT * FROM `".DB_PREFIX."dailyocc` WHERE `fecha`='".$this->myesc($date)."' LIMIT 1";
		$result=$this->query($sql);
	return $result[0];
	}
	
	public function see_occupancy_date($date){//this will search as per criteria choosed.

		$sql="SELECT busy.id AS busyid,
					 busy.starting AS start,
					 busy.ending AS end,
					 busy.type AS type,
					 busy.id_villa AS villa,
					 busy.id_adm AS adm,
					 busy.comment AS note,
					 busy.date AS date,
					 busy.id_update AS upd,
					 booked.id AS reserveid,
					 booked.ref AS ref,
					 booked.id_client AS client,
					 booked.adults AS adults,
					 booked.children AS kids,
					 booked.id_interm AS interm,
					 booked.qty_nights AS nights,
					 booked.nightsHS AS NHS,
					 booked.nightsLS AS NLS,
					 booked.price_per_night AS ppn,
					 booked.priceHS AS PHS,
					 booked.commision AS apc,
					 booked.amount AS subtotal,
					 booked.tax AS itbis,
					 booked.services_amount AS aps,
					 booked.deposit AS dep,
					 booked.total AS total,
					 booked.status AS status,
					 booked.online AS line,
					 booked.comment AS rc
			  FROM `".DB_PREFIX."occupancy` AS `busy`

			  LEFT JOIN `".DB_PREFIX."reserves` AS `booked`
			  ON `busy`.`id`=`booked`.`id_occupancy`

			  WHERE `busy`.`date` LIKE '".$this->myesc($date)."%' AND `busy`.`active`=1 ORDER BY busy.id DESC";
		$result=$this->query($sql);
	return ($result);
	}
	
	public function see_occupancy_date_s($date, $s){//this will search as per criteria choosed.
		  switch($s){
			  case 0:  $source='AND booked.online=0'; break;//staff
			  case 1:  $source='AND booked.online=1'; break;//online
			  case 2:  $source='AND booked.online<>0 AND booked.online<>1 AND booked.online<>3 AND booked.online<>7 AND booked.online<>12'; break;//Referrals
			  case 3:  $source='AND booked.online=3'; break;//Booking Engline
			  case 7:  $source='AND booked.online=7'; break;//API
			  case 12: $source='AND booked.online=12'; break;//HA
		  }

		$sql="SELECT busy.id AS busyid,
					 busy.starting AS start,
					 busy.ending AS end,
					 busy.type AS type,
					 busy.id_villa AS villa,
					 busy.id_adm AS adm,
					 busy.comment AS note,
					 busy.date AS date,
					 busy.id_update AS upd,
					 booked.id AS reserveid,
					 booked.ref AS ref,
					 booked.id_client AS client,
					 booked.adults AS adults,
					 booked.children AS kids,
					 booked.id_interm AS interm,
					 booked.qty_nights AS nights,
					 booked.nightsHS AS NHS,
					 booked.nightsLS AS NLS,
					 booked.price_per_night AS ppn,
					 booked.priceHS AS PHS,
					 booked.commision AS apc,
					 booked.amount AS subtotal,
					 booked.tax AS itbis,
					 booked.services_amount AS aps,
					 booked.deposit AS dep,
					 booked.total AS total,
					 booked.status AS status,
					 booked.online AS line,
					 booked.comment AS rc
			  FROM `".DB_PREFIX."occupancy` AS `busy`

			  LEFT JOIN `".DB_PREFIX."reserves` AS `booked`
			  ON `busy`.`id`=`booked`.`id_occupancy`

			  WHERE `busy`.`date` LIKE '".$this->myesc($date)."%' AND `busy`.`active`=1 $source ORDER BY busy.id DESC";
		$result=$this->query($sql);
	return ($result);
	}

	public function see_occupancy_mod_date($date){//this will search as per criteria choosed.

		$sql="SELECT busy.id AS busyid,
					 busy.starting AS start,
					 busy.ending AS end,
					 busy.type AS type,
					 busy.id_villa AS villa,
					 busy.id_adm AS adm,
					 busy.comment AS note,
					 busy.date AS date,
					 booked.id AS reserveid,
					 booked.ref AS ref,
					 booked.id_client AS client,
					 booked.adults AS adults,
					 booked.children AS kids,
					 booked.id_interm AS interm,
					 booked.qty_nights AS nights,
					 booked.nightsHS AS NHS,
					 booked.nightsLS AS NLS,
					 booked.price_nights AS ppn,
					 booked.priceHS AS PHS,
					 booked.commision AS apc,
					 booked.amount AS subtotal,
					 booked.tax AS itbis,
					 booked.serv_amount AS aps,
					 booked.deposit AS dep,
					 booked.total AS total,
					 booked.status AS status,
					 booked.comment AS rc
			  FROM `".DB_PREFIX."occupancy_mod` AS `busy`

			  LEFT JOIN `".DB_PREFIX."reserves_mod` AS `booked`
			  ON `busy`.`id`=`booked`.`id_occ_mod`

			  WHERE `busy`.`date` LIKE '".$this->myesc($date)."%' AND `busy`.`active`=1 ORDER BY busy.id DESC";
		$result=$this->query($sql);
		return ($result);
	}

	// --------------------- SENDING EMAILS TO OWNERS -----------------------
	public function send_email_owners($type, $language){

		if (($language=="")&&($type==2)){ //all languages and renting pool
         $sql="SELECT o.id AS id,
					 o.name AS name,
					 o.lastname AS lname,
					 o.email AS email,
					 o.language AS lang,
					 o.id AS adm,
					 v.no AS villa
			  FROM `".DB_PREFIX."owners` AS `o`
			  LEFT JOIN `".DB_PREFIX."villas` AS `v`
			  ON `o`.`id`=`v`.`id_owner`
			  WHERE `v`.`able_r`='1' AND `o`.`active`=1 ORDER BY o.id DESC";
		}
		if (($language=="")&&($type==3)){ //all languages and NOT renting pool
         $sql="SELECT o.id AS id,
					 o.name AS name,
					 o.lastname AS lname,
					 o.email AS email,
					 o.language AS lang,
					 o.id AS adm,
					 v.no AS villa
			  FROM `".DB_PREFIX."owners` AS `o`
			  LEFT JOIN `".DB_PREFIX."villas` AS `v`
			  ON `o`.`id`=`v`.`id_owner`
			  WHERE `v`.`able_r`='0' AND `o`.`active`=1 ORDER BY o.id DESC";
		}
		if (($language=="")&&($type==1)){ //all languages and all owners
         $sql="SELECT * FROM `".DB_PREFIX."owners` WHERE `".DB_PREFIX."owners`.`active`='1' ORDER BY `".DB_PREFIX."owners`.`id` DESC";
		}

		return $this->query($sql);
	}

	//***************************bookings for a referal***************************************************
		public function bookings_url($url){//this will search as per criteria choosed.

		$sql="SELECT busy.id AS busyid,
					 busy.starting AS start,
					 busy.ending AS end,                                             -
					 busy.type AS type,
					 busy.id_villa AS villa,
					 busy.id_adm AS adm,
					 busy.comment AS note,
					 busy.date AS date,
					 booked.id AS reserveid,
					 booked.ref AS ref,
					 booked.id_client AS client,
					 booked.adults AS adults,
					 booked.children AS kids,
					 booked.id_interm AS interm,
					 booked.qty_nights AS nights,
					 booked.nightsHS AS NHS,
					 booked.nightsLS AS NLS,
					 booked.price_per_night AS ppn,
					 booked.priceHS AS PHS,
					 booked.commision AS apc,
					 booked.amount AS subtotal,
					 booked.tax AS itbis,
					 booked.services_amount AS aps,
					 booked.deposit AS dep,
					 booked.total AS total,
					 booked.status AS status,
					 booked.comment AS rc,
					 website.url AS url
			  FROM `".DB_PREFIX."occupancy` AS `busy`

			  LEFT JOIN `".DB_PREFIX."reserves` AS `booked`
			  ON `busy`.`id`=`booked`.`id_occupancy`

			   LEFT JOIN `".DB_PREFIX."webpages` AS `website`
			  ON `booked`.`ref`=`website`.`ref_book`

			  WHERE `website`.`url`='".$this->myesc($url)."' ORDER BY busy.id DESC";
		$result=$this->query($sql);
		return ($result);
		}
       //*******************************************************************************************************


       //***************************bookings for a referal from to***************************************************
		public function bookings_referal_dates($id_referal, $sql, $Sortby){//this will search as per criteria choosed.

		$sql="SELECT busy.id AS busyid,
					 busy.starting AS start,
					 busy.ending AS end,
					 busy.type AS type,
					 busy.id_villa AS villa,
					 busy.id_adm AS adm,
					 busy.comment AS note,
					 busy.date AS date,
					 booked.id AS reserveid,
					 booked.ref AS ref,
					 booked.id_client AS client,
					 booked.adults AS adults,
					 booked.children AS kids,
					 booked.id_interm AS interm,
					 booked.qty_nights AS nights,
					 booked.nightsHS AS NHS,
					 booked.nightsLS AS NLS,
					 booked.price_per_night AS ppn,
					 booked.priceHS AS PHS,
					 booked.commision AS apc,
					 booked.amount AS subtotal,
					 booked.tax AS itbis,
					 booked.services_amount AS aps,
					 booked.deposit AS dep,
					 booked.total AS total,
					 booked.status AS status,
					 booked.comment AS rc,
					 referred.id_referal AS id_referal
			  FROM `".DB_PREFIX."occupancy` AS `busy`

			  LEFT JOIN `".DB_PREFIX."reserves` AS `booked`
			  ON `busy`.`id`=`booked`.`id_occupancy`

			   LEFT JOIN `".DB_PREFIX."bookingreferred` AS `referred`
			  ON `booked`.`ref`=`referred`.`ref_book`

			  WHERE `referred`.`id_referal`='".$this->myesc($id_referal)."' AND `referred`.`id_referal`='".$this->myesc($id_referal)."' AND `referred`.`id_referal`='".$this->myesc($id_referal)."' ORDER BY busy.id DESC";
		$result=$this->query($sql);
		return ($result);
		}
       //*******************************************************************************************************

        //***************************bookings for a referal from to***************************************************
		public function bookings_referal_overview($id_referal, $sql, $sort){//this will search as per criteria choosed.

		$sql="SELECT busy.id AS busyid,
					 busy.starting AS start,
					 busy.ending AS end,
					 busy.type AS type,
					 busy.id_villa AS villa,
					 busy.id_adm AS adm,
					 busy.comment AS note,
					 busy.date AS date,
					 booked.id AS reserveid,
					 booked.ref AS ref,
					 booked.id_client AS client,
					 booked.adults AS adults,
					 booked.children AS kids,
					 booked.id_interm AS interm,
					 booked.qty_nights AS nights,
					 booked.nightsHS AS NHS,
					 booked.nightsLS AS NLS,
					 booked.price_per_night AS ppn,
					 booked.priceHS AS PHS,
					 booked.commision AS apc,
					 booked.amount AS subtotal,
					 booked.tax AS itbis,
					 booked.services_amount AS aps,
					 booked.deposit AS dep,
					 booked.total AS total,
					 booked.status AS status,
					 booked.comment AS rc,
					 booked.pagos_qty AS PAYM,
					 booked.pagos_monto AS PMV,
					 booked.price_long AS PL,
					 booked.extra_nights AS EN,
					 booked.online AS line,
					 referred.id_referal AS id_referal,
					 referred.paid AS paid
			  FROM `".DB_PREFIX."occupancy` AS `busy`

			  LEFT JOIN `".DB_PREFIX."reserves` AS `booked`
			  ON `busy`.`id`=`booked`.`id_occupancy`

			   LEFT JOIN `".DB_PREFIX."bookingreferred` AS `referred`
			  ON `booked`.`ref`=`referred`.`ref_book`

			  WHERE `referred`.`id_referal`='".$this->myesc($id_referal)."' ".$this->myesc($sql)." ORDER BY ".$this->myesc($sort)." DESC";
		$result=$this->query($sql);
		return ($result);
		}
       //*******************************************************************************************************
       public function bookings_referal_overview_15($id_referal, $sql, $sort){//this will search as per criteria choosed.

		$sql="SELECT busy.id AS busyid,
					 busy.starting AS start,
					 busy.ending AS end,
					 busy.type AS type,
					 busy.id_villa AS villa,
					 busy.id_adm AS adm,
					 busy.comment AS note,
					 busy.date AS date,
					 booked.id AS reserveid,
					 booked.ref AS ref,
					 booked.id_client AS client,
					 booked.adults AS adults,
					 booked.children AS kids,
					 booked.id_interm AS interm,
					 booked.qty_nights AS nights,
					 booked.nightsHS AS NHS,
					 booked.nightsLS AS NLS,
					 booked.price_per_night AS ppn,
					 booked.priceHS AS PHS,
					 booked.commision AS apc,
					 booked.amount AS subtotal,
					 booked.tax AS itbis,
					 booked.services_amount AS aps,
					 booked.deposit AS dep,
					 booked.total AS total,
					 booked.status AS status,
					 booked.comment AS rc,
					 booked.pagos_qty AS PAYM,
					 booked.pagos_monto AS PMV,
					 booked.price_long AS PL,
					 booked.extra_nights AS EN,
					 booked.online AS line,
					 referred.id_referal AS id_referal,
					 referred.paid AS paid
			  FROM `".DB_PREFIX."occupancy` AS `busy`

			  LEFT JOIN `".DB_PREFIX."reserves` AS `booked`
			  ON `busy`.`id`=`booked`.`id_occupancy`

			   LEFT JOIN `".DB_PREFIX."bookingreferred` AS `referred`
			  ON `booked`.`ref`=`referred`.`ref_book`

			  WHERE `referred`.`id_referal`='".$this->myesc($id_referal)."' ".$this->myesc($sql)." ORDER BY ".$this->myesc($sort)." DESC LIMIT 10";
		$result=$this->query($sql);
		return ($result);
		}
       //*******************************************************************************************************
		public function bookings_referral_status($referralid, $status){//gets all bokings with referal and ck out short term, unpaid

			if($referralid!=0){
				$sql_referralid="AND `referred`.`id_referal`='$referralid'";
			}else{
				$sql_referralid="AND `referred`.`id_referal`<>'0'";
			}
			$sql="SELECT busy.id AS busyid,
						 busy.starting AS start,
						 busy.ending AS end,
						 busy.type AS type,
						 busy.id_villa AS villa,
						 busy.id_adm AS adm,
						 busy.comment AS note,
						 busy.date AS date,
						 booked.id AS reserveid,
						 booked.ref AS ref,
						 booked.id_client AS client,
						 booked.adults AS adults,
						 booked.children AS kids,
						 booked.id_interm AS interm,
						 booked.qty_nights AS nights,
						 booked.nightsHS AS NHS,
						 booked.nightsLS AS NLS,
						 booked.price_per_night AS ppn,
						 booked.priceHS AS PHS,
						 booked.commision AS apc,
						 booked.amount AS subtotal,
						 booked.tax AS itbis,
						 booked.services_amount AS aps,
						 booked.deposit AS dep,
						 booked.total AS total,
						 booked.status AS status,
						 booked.comment AS rc,
						 referred.id_referal AS id_referal,
						 referred.paid AS paid
				  FROM `".DB_PREFIX."occupancy` AS `busy`

				  LEFT JOIN `".DB_PREFIX."reserves` AS `booked`
				  ON `busy`.`id`=`booked`.`id_occupancy`

				   LEFT JOIN `".DB_PREFIX."bookingreferred` AS `referred`
				  ON `booked`.`ref`=`referred`.`ref_book`

				  WHERE `booked`.`status`='4' AND `referred`.`paid`='$status' $sql_referralid  ORDER BY busy.id DESC";
		$result=$this->query($sql);
		return ($result);
		}
		
		public function bookings_referral_status_ft($referralid, $status, $from, $to){//gets all bokings with referal and ck out short term, unpaid

			if($referralid!=0){
				$sql_referralid="AND `referred`.`id_referal`='$referralid'";
			}else{
				$sql_referralid="AND `referred`.`id_referal`<>'0'";
			}
			
			$dates_filter="AND busy.starting>='".$this->myesc($from)."' AND busy.starting<='".$this->myesc($to)."'";
			
			$sql="SELECT busy.id AS busyid,
						 busy.starting AS start,
						 busy.ending AS end,
						 busy.type AS type,
						 busy.id_villa AS villa,
						 busy.id_adm AS adm,
						 busy.comment AS note,
						 busy.date AS date,
						 booked.id AS reserveid,
						 booked.ref AS ref,
						 booked.id_client AS client,
						 booked.adults AS adults,
						 booked.children AS kids,
						 booked.id_interm AS interm,
						 booked.qty_nights AS nights,
						 booked.nightsHS AS NHS,
						 booked.nightsLS AS NLS,
						 booked.price_per_night AS ppn,
						 booked.priceHS AS PHS,
						 booked.commision AS apc,
						 booked.amount AS subtotal,
						 booked.tax AS itbis,
						 booked.services_amount AS aps,
						 booked.deposit AS dep,
						 booked.total AS total,
						 booked.status AS status,
						 booked.comment AS rc,
						 referred.id_referal AS id_referal,
						 referred.paid AS paid
				  FROM `".DB_PREFIX."occupancy` AS `busy`

				  LEFT JOIN `".DB_PREFIX."reserves` AS `booked`
				  ON `busy`.`id`=`booked`.`id_occupancy`

				   LEFT JOIN `".DB_PREFIX."bookingreferred` AS `referred`
				  ON `booked`.`ref`=`referred`.`ref_book`

				  WHERE `booked`.`status`='4' AND `referred`.`paid`='$status' $sql_referralid  $dates_filter ORDER BY busy.id DESC";
		$result=$this->query($sql);
		return ($result);
		}
       //*************************** UNPAID ***************************************************
		public function bookings_referral_unpaid(){//gets all bokings with referal and ck out short term, unpaid

		$sql="SELECT busy.id AS busyid,
					 busy.starting AS start,
					 busy.ending AS end,
					 busy.type AS type,
					 busy.id_villa AS villa,
					 busy.id_adm AS adm,
					 busy.comment AS note,
					 busy.date AS date,
					 booked.id AS reserveid,
					 booked.ref AS ref,
					 booked.id_client AS client,
					 booked.adults AS adults,
					 booked.children AS kids,
					 booked.id_interm AS interm,
					 booked.qty_nights AS nights,
					 booked.nightsHS AS NHS,
					 booked.nightsLS AS NLS,
					 booked.price_per_night AS ppn,
					 booked.priceHS AS PHS,
					 booked.commision AS apc,
					 booked.amount AS subtotal,
					 booked.tax AS itbis,
					 booked.services_amount AS aps,
					 booked.deposit AS dep,
					 booked.total AS total,
					 booked.status AS status,
					 booked.comment AS rc,
					 referred.id_referal AS id_referal,
					 referred.paid AS paid
			  FROM `".DB_PREFIX."occupancy` AS `busy`

			  LEFT JOIN `".DB_PREFIX."reserves` AS `booked`
			  ON `busy`.`id`=`booked`.`id_occupancy`

			   LEFT JOIN `".DB_PREFIX."bookingreferred` AS `referred`
			  ON `booked`.`ref`=`referred`.`ref_book`

			  WHERE `booked`.`status`='4' AND `referred`.`paid`='0' AND `referred`.`id_referal`<>'0'  ORDER BY busy.id DESC";
		$result=$this->query($sql);
		return ($result);
		}
       //*******************************************************************************************************

        //*************************** READY TO PICKUP ***************************************************
		public function bookings_referral_ready_pickup(){//gets all bokings with referal and ck out short term, unpaid

		 $sql="SELECT busy.id AS busyid,
					 busy.starting AS start,
					 busy.ending AS end,
					 busy.type AS type,
					 busy.id_villa AS villa,
					 busy.id_adm AS adm,
					 busy.comment AS note,
					 busy.date AS date,
					 booked.id AS reserveid,
					 booked.ref AS ref,
					 booked.id_client AS client,
					 booked.adults AS adults,
					 booked.children AS kids,
					 booked.id_interm AS interm,
					 booked.qty_nights AS nights,
					 booked.nightsHS AS NHS,
					 booked.nightsLS AS NLS,
					 booked.price_per_night AS ppn,
					 booked.priceHS AS PHS,
					 booked.commision AS apc,
					 booked.amount AS subtotal,
					 booked.tax AS itbis,
					 booked.services_amount AS aps,
					 booked.deposit AS dep,
					 booked.total AS total,
					 booked.status AS status,
					 booked.comment AS rc,
					 referred.id_referal AS id_referal,
					 referred.paid AS paid
			  FROM `".DB_PREFIX."occupancy` AS `busy`

			  LEFT JOIN `".DB_PREFIX."reserves` AS `booked`
			  ON `busy`.`id`=`booked`.`id_occupancy`

			   LEFT JOIN `".DB_PREFIX."bookingreferred` AS `referred`
			  ON `booked`.`ref`=`referred`.`ref_book`

			  WHERE `booked`.`status`='4' AND `referred`.`paid`='1' AND `referred`.`id_referal`<>'0'  ORDER BY busy.id DESC";
		$result=$this->query($sql);
		return ($result);
		}
       //*******************************************************************************************************

       //*************************** PAID ***************************************************
		public function bookings_referral_paid(){//gets all bokings with referal and ck out short term, unpaid

		$sql="SELECT busy.id AS busyid,
					 busy.starting AS start,
					 busy.ending AS end,
					 busy.type AS type,
					 busy.id_villa AS villa,
					 busy.id_adm AS adm,
					 busy.comment AS note,
					 busy.date AS date,
					 booked.id AS reserveid,
					 booked.ref AS ref,
					 booked.id_client AS client,
					 booked.adults AS adults,
					 booked.children AS kids,
					 booked.id_interm AS interm,
					 booked.qty_nights AS nights,
					 booked.nightsHS AS NHS,
					 booked.nightsLS AS NLS,
					 booked.price_per_night AS ppn,
					 booked.priceHS AS PHS,
					 booked.commision AS apc,
					 booked.amount AS subtotal,
					 booked.tax AS itbis,
					 booked.services_amount AS aps,
					 booked.deposit AS dep,
					 booked.total AS total,
					 booked.status AS status,
					 booked.comment AS rc,
					 referred.id_referal AS id_referal,
					 referred.paid AS paid
			  FROM `".DB_PREFIX."occupancy` AS `busy`

			  LEFT JOIN `".DB_PREFIX."reserves` AS `booked`
			  ON `busy`.`id`=`booked`.`id_occupancy`

			   LEFT JOIN `".DB_PREFIX."bookingreferred` AS `referred`
			  ON `booked`.`ref`=`referred`.`ref_book`

			  WHERE `booked`.`status`='4' AND `referred`.`paid`='2' AND `referred`.`id_referal`<>'0'  ORDER BY busy.id DESC";
		$result=$this->query($sql);
		return ($result);
		}
       //*******************************************************************************************************
	 //*************************** READY TO PICKUP ***************************************************
			public function referral_commission_state($id_referral, $from_records, $to_records, $status_comission=1){//gets all bokings with referal and ck out short term, unpaid
				if($id_referral!=0){
					$sql_referral_id="AND `referred`.`id_referal`='$id_referral'";
				}else{
					$sql_referral_id="AND `referred`.`id_referal`<>'0'";
				}
			 $sql="SELECT busy.id AS busyid,
						 busy.starting AS start,
						 busy.ending AS end,
						 busy.type AS type,
						 busy.id_villa AS villa,
						 busy.id_adm AS adm,
						 busy.comment AS note,
						 busy.date AS date,
						 booked.id AS reserveid,
						 booked.ref AS ref,
						 booked.id_client AS client,
						 booked.adults AS adults,
						 booked.children AS kids,
						 booked.id_interm AS interm,
						 booked.qty_nights AS nights,
						 booked.nightsHS AS NHS,
						 booked.nightsLS AS NLS,
						 booked.price_per_night AS ppn,
						 booked.priceHS AS PHS,
						 booked.commision AS apc,
						 booked.amount AS subtotal,
						 booked.tax AS itbis,
						 booked.services_amount AS aps,
						 booked.deposit AS dep,
						 booked.total AS total,
						 booked.status AS status,
						 booked.comment AS rc,
						 referred.id_referal AS id_referal,
						 referred.paid AS paid
				  FROM `".DB_PREFIX."occupancy` AS `busy`

				  LEFT JOIN `".DB_PREFIX."reserves` AS `booked`
				  ON `busy`.`id`=`booked`.`id_occupancy`

				   LEFT JOIN `".DB_PREFIX."bookingreferred` AS `referred`
				  ON `booked`.`ref`=`referred`.`ref_book`

				  WHERE  `booked`.`status`='4' AND `referred`.`paid`='".$status_comission."' ".$sql_referral_id." ORDER BY busy.id DESC LIMIT $from_records , $to_records";
			$result=$this->query($sql);
			return ($result);
			}
			
			public function referral_commission_state_ft($id_referral, $from_records, $to_records, $status_comission=1, $from, $to){//gets all bokings with referal and ck out short term, unpaid
				if($id_referral!=0){
					$sql_referral_id="AND `referred`.`id_referal`='$id_referral'";
				}else{
					$sql_referral_id="AND `referred`.`id_referal`<>'0'";
				}
				
			$dates_filter="AND busy.starting>='".$this->myesc($from)."' AND busy.starting<='".$this->myesc($to)."'";
			
			 $sql="SELECT busy.id AS busyid,
						 busy.starting AS start,
						 busy.ending AS end,
						 busy.type AS type,
						 busy.id_villa AS villa,
						 busy.id_adm AS adm,
						 busy.comment AS note,
						 busy.date AS date,
						 booked.id AS reserveid,
						 booked.ref AS ref,
						 booked.id_client AS client,
						 booked.adults AS adults,
						 booked.children AS kids,
						 booked.id_interm AS interm,
						 booked.qty_nights AS nights,
						 booked.nightsHS AS NHS,
						 booked.nightsLS AS NLS,
						 booked.price_per_night AS ppn,
						 booked.priceHS AS PHS,
						 booked.commision AS apc,
						 booked.amount AS subtotal,
						 booked.tax AS itbis,
						 booked.services_amount AS aps,
						 booked.deposit AS dep,
						 booked.total AS total,
						 booked.status AS status,
						 booked.comment AS rc,
						 referred.id_referal AS id_referal,
						 referred.paid AS paid
				  FROM `".DB_PREFIX."occupancy` AS `busy`

				  LEFT JOIN `".DB_PREFIX."reserves` AS `booked`
				  ON `busy`.`id`=`booked`.`id_occupancy`

				   LEFT JOIN `".DB_PREFIX."bookingreferred` AS `referred`
				  ON `booked`.`ref`=`referred`.`ref_book`

				  WHERE  `booked`.`status`='4' AND `referred`.`paid`='".$status_comission."' ".$sql_referral_id." $dates_filter ORDER BY busy.id DESC LIMIT $from_records , $to_records";
			$result=$this->query($sql);
			return ($result);
			}
		   //*******************************************************************************************************
		 //*************************** READY TO PICKUP ***************************************************
			public function referral_commission_state1($id_referral, $from_records, $to_records, $status_comission=1){//gets all bokings with referal and ck out short term, unpaid
				if($id_referral!=0){
					$sql_referral_id="AND `referred`.`id_referal`='$id_referral'";
				}else{
					$sql_referral_id="AND `referred`.`id_referal`<>'0'";
				}
			 $sql="SELECT busy.id AS busyid,
						 busy.starting AS start,
						 busy.ending AS end,
						 busy.type AS type,
						 busy.id_villa AS villa,
						 busy.id_adm AS adm,
						 busy.comment AS note,
						 busy.date AS date,
						 booked.id AS reserveid,
						 booked.ref AS ref,
						 booked.id_client AS client,
						 booked.adults AS adults,
						 booked.children AS kids,
						 booked.id_interm AS interm,
						 booked.qty_nights AS nights,
						 booked.nightsHS AS NHS,
						 booked.nightsLS AS NLS,
						 booked.price_per_night AS ppn,
						 booked.priceHS AS PHS,
						 booked.commision AS apc,
						 booked.amount AS subtotal,
						 booked.tax AS itbis,
						 booked.services_amount AS aps,
						 booked.deposit AS dep,
						 booked.total AS total,
						 booked.status AS status,
						 booked.comment AS rc,
						 booked.pagos_qty AS pq,
						 booked.pagos_monto AS pm,
						 booked.price_long AS pl,
						 booked.extra_nights AS en,
						 referred.id_referal AS id_referal,
						 referred.paid AS paid
				  FROM `".DB_PREFIX."occupancy` AS `busy`

				  LEFT JOIN `".DB_PREFIX."reserves` AS `booked`
				  ON `busy`.`id`=`booked`.`id_occupancy`

				   LEFT JOIN `".DB_PREFIX."bookingreferred` AS `referred`
				  ON `booked`.`ref`=`referred`.`ref_book`

				  WHERE  `booked`.`status`='11' AND `referred`.`paid`='".$status_comission."' ".$sql_referral_id." ORDER BY busy.id DESC LIMIT $from_records , $to_records";
			$result=$this->query($sql);
			return ($result);
			}
			
			public function referral_commission_state1_ft($id_referral, $from_records, $to_records, $status_comission=1, $from, $to){//gets all bokings with referal and ck out short term, unpaid
				if($id_referral!=0){
					$sql_referral_id="AND `referred`.`id_referal`='$id_referral'";
				}else{
					$sql_referral_id="AND `referred`.`id_referal`<>'0'";
				}
				
			 $dates_filter="AND busy.starting>='".$this->myesc($from)."' AND busy.starting<='".$this->myesc($to)."'";
			 
			 $sql="SELECT busy.id AS busyid,
						 busy.starting AS start,
						 busy.ending AS end,
						 busy.type AS type,
						 busy.id_villa AS villa,
						 busy.id_adm AS adm,
						 busy.comment AS note,
						 busy.date AS date,
						 booked.id AS reserveid,
						 booked.ref AS ref,
						 booked.id_client AS client,
						 booked.adults AS adults,
						 booked.children AS kids,
						 booked.id_interm AS interm,
						 booked.qty_nights AS nights,
						 booked.nightsHS AS NHS,
						 booked.nightsLS AS NLS,
						 booked.price_per_night AS ppn,
						 booked.priceHS AS PHS,
						 booked.commision AS apc,
						 booked.amount AS subtotal,
						 booked.tax AS itbis,
						 booked.services_amount AS aps,
						 booked.deposit AS dep,
						 booked.total AS total,
						 booked.status AS status,
						 booked.comment AS rc,
						 booked.pagos_qty AS pq,
						 booked.pagos_monto AS pm,
						 booked.price_long AS pl,
						 booked.extra_nights AS en,
						 referred.id_referal AS id_referal,
						 referred.paid AS paid
				  FROM `".DB_PREFIX."occupancy` AS `busy`

				  LEFT JOIN `".DB_PREFIX."reserves` AS `booked`
				  ON `busy`.`id`=`booked`.`id_occupancy`

				   LEFT JOIN `".DB_PREFIX."bookingreferred` AS `referred`
				  ON `booked`.`ref`=`referred`.`ref_book`

				  WHERE  `booked`.`status`='11' AND `referred`.`paid`='".$status_comission."' ".$sql_referral_id." $dates_filter ORDER BY busy.id DESC LIMIT $from_records , $to_records";
			$result=$this->query($sql);
			return ($result);
			}
		   //*******************************************************************************************************
     public function availability_flipkey($villa_id){//show availability flipkey
	 $sql="SELECT busy.id AS busyid,
                 busy.starting AS start,
                 busy.ending AS end,
                 busy.type AS type,
                 busy.id_villa AS villa,
                 busy.id_adm AS adm,
                 busy.comment AS note,
                 busy.date AS date,
                 busy.id_update AS upd,
                 booked.id AS reserveid,
                 booked.ref AS ref,
                 booked.id_client AS client,
                 booked.adults AS adults,
                 booked.children AS kids,
                 booked.id_interm AS interm,
                 booked.qty_nights AS nights,
                 booked.price_per_night AS ppn,
                 booked.commision AS apc,
                 booked.amount AS subtotal,
                 booked.tax AS itbis,
                 booked.services_amount AS aps,
                 booked.deposit AS dep,
                 booked.total AS total,
                 booked.status AS status,
                 booked.comment AS rc
	      FROM `".DB_PREFIX."occupancy` AS `busy`

	      LEFT JOIN `".DB_PREFIX."reserves` AS `booked`
	      ON `busy`.`id`=`booked`.`id_occupancy`

	      WHERE `busy`.`id_villa`='".$this->myesc($villa_id)."' AND `busy`.`ending`>='".date('Y-m-d')."' AND `busy`.`active`=1 AND `booked`.`status`<>0 ORDER BY busy.starting ASC ";  // LIMIT 1 //LIMIT 0,30
	$result=$this->query($sql);
   	return ($result);
	}

    public function all_villas(){//get all the villas
	$sql="SELECT * FROM `".DB_PREFIX."villas` ORDER BY (`".DB_PREFIX."villas`.`no`+0) ASC";
	$result=$this->query($sql);
	return ($result);
	}

	public function villas_for_owner($idowner){  //shows all the villas that own an owner.
    $sql="SELECT * FROM `".DB_PREFIX."villas` WHERE `id_owner`='".$this->myesc($idowner)."' ORDER BY `id` ASC";
	$result=$this->query($sql);

	return ($result);
	}
   //---------------------------------------------------------------------------------------------------------

	public function clean($idvila){  //shows all the villas that own an owner.
    	$sql="SELECT * FROM `".DB_PREFIX."clean_villas` WHERE `id_villa`='".$this->myesc($idvila)."' LIMIT 1";
		$result=$this->query($sql);
	    foreach($result AS $result)
	return ($result);
	}

	public function excrusiones_reserved($reserve){  //show a villa where selected id.
    $sql="SELECT eb.id_excursion AS id_excursion,
    			 eb.id_reserve AS id_reserve,
    			 eb.qty_a AS qty_a,
    			 eb.qty_c AS qty_c,
    			 eb.price_a AS price_a,
    			 eb.price_c AS price_c,
    			 eb.total AS total,
    			 e.title AS	title

     FROM `".DB_PREFIX."excursions_booked` AS `eb`
     LEFT JOIN `".DB_PREFIX."excursions` AS `e`
     ON  `eb`.`id_excursion`=`e`.`id`

    WHERE `eb`.`id_reserve`='".$this->myesc($reserve)."' ORDER BY `eb`.`id` ASC";
	$result=$this->query($sql);

	return ($result);
	}
    //===================BELOW FUNCTION TO GET SPECIAL EVENTS=======================================
	public function active_event($star_date, $end_date){//this will gets special events active on booking dates

	$sql="SELECT *  FROM `".DB_PREFIX."special_events` WHERE `to_date`>='".$this->myesc($star_date)."' AND `from_date`<='".$this->myesc($end_date)."' AND `active`='1' ORDER BY id ASC";

	$result=$this->query($sql);
	return ($result);
	}

	//------------search guest names or lastname into a booking and bring up main client details (first name and last name)

      public function guest_search_reserveid($reservaid){//this will search as per criteria choosed.

		$sql="SELECT busy.starting AS start,
					 busy.ending AS end,
					 busy.id_villa AS villa,
					 booked.ref AS ref,
					 villas.no AS villa_no,
					 client.name AS name,
					 client.lastname AS lastname

			  FROM `".DB_PREFIX."occupancy` AS `busy`
			  LEFT JOIN `".DB_PREFIX."reserves` AS `booked`
			  ON `busy`.`id`=`booked`.`id_occupancy`
			  LEFT JOIN `".DB_PREFIX."customers` AS `client`
			  ON `booked`.`id_client`=`client`.`id`
			  LEFT JOIN `".DB_PREFIX."villas` AS `villas`
			  ON `busy`.`id_villa`=`villas`.`id`

			  WHERE `booked`.`id`='".$this->myesc($reservaid)."' LIMIT 1";
		$result=$this->query($sql);
		foreach ($result AS $result)
		return ($result);
	  }

	  //=====================DETERMINE WHEN A VILLA IS BUSY CREATING A BOOKING OR CHANGING A BOOKING=======================================
    public function availability_new_booking($id_villa, $start_date, $end_date){//this will help to show availabity when creating a booking

	$sql="SELECT o.id AS busyid,
                 o.starting AS start,
                 o.ending AS end,
                 o.id_villa AS villa_id,
                 o.date AS date,
                 r.id AS reserveid,
                 r.ref AS ref,
                 r.id_client AS client,
                 r.qty_nights AS nights,
                 r.status AS status

	      FROM `".DB_PREFIX."occupancy` AS `o`
	      LEFT JOIN `".DB_PREFIX."reserves` AS `r`
	      ON `o`.`id`=`r`.`id_occupancy`
	      WHERE `o`.`starting`<'".$this->myesc($end_date)."' AND `o`.`ending`>'".$this->myesc($start_date)."' AND `r`.`status`<>0 AND `r`.`status`<>50 AND `o`.`id_villa`='".$this->myesc($id_villa)."' ORDER BY r.id ASC";
	return $result=$this->query($sql);
	}

	public function availability_edit_booking($id_villa, $start_date, $end_date, $id_this_reserve){//this will help to show availabity when changing a booking

	$sql="SELECT o.id AS busyid,
                 o.starting AS start,
                 o.ending AS end,
                 o.id_villa AS villa_id,
                 o.date AS date,
                 r.id AS reserveid,
                 r.ref AS ref,
                 r.id_client AS client,
                 r.qty_nights AS nights,
                 r.status AS status
	      FROM `".DB_PREFIX."occupancy` AS `o`
	      LEFT JOIN `".DB_PREFIX."reserves` AS `r`
	      ON `o`.`id`=`r`.`id_occupancy`
	      WHERE `o`.`starting`<'".$this->myesc($end_date)."' AND `o`.`ending`>'".$this->myesc($start_date)."' AND `r`.`status`<>0  AND `r`.`status`<>50 AND `o`.`id_villa`='".$this->myesc($id_villa)."' AND `r`.`id`<>'".$this->myesc($id_this_reserve)."' ORDER BY r.id ASC";
	return $result=$this->query($sql);
	}
       /*

       public function busy_availability_noID($villa_id, $mes, $year, $reservaid){//this will search as per criteria choosed. LONG TERM RENTAL IS USING THIS NOW JULY 11-2012   // ALSO USING THIS WHEN EDITING ANY BOOKING

	$sql="SELECT busy.id AS busyid,
                 busy.starting AS start,
                 busy.ending AS end,
                 busy.type AS type,
                 busy.id_villa AS villa,
                 busy.id_adm AS adm,
                 busy.comment AS note,
                 busy.date AS date,
                 busy.id_update AS upd,
                 booked.id AS reserveid,
                 booked.ref AS ref,
                 booked.id_client AS client,
                 booked.adults AS adults,
                 booked.children AS kids,
                 booked.id_interm AS interm,
                 booked.qty_nights AS nights,
                 booked.price_per_night AS ppn,
                 booked.commision AS apc,
                 booked.amount AS subtotal,
                 booked.tax AS itbis,
                 booked.services_amount AS aps,
                 booked.deposit AS dep,
                 booked.total AS total,
                 booked.status AS status,
                 booked.comment AS rc
	      FROM `".DB_PREFIX."occupancy` AS `busy`

	      LEFT JOIN `".DB_PREFIX."reserves` AS `booked`
	      ON `busy`.`id`=`booked`.`id_occupancy`

	      WHERE `busy`.`id_villa`='".$this->myesc($villa_id)."' AND `busy`.`mm`>='1' AND `booked`.`status`<>'0' AND `busy`.`yyyy`>='".$this->myesc($year)."' AND `busy`.`active`=1 AND `booked`.`id`<>'".$this->myesc($reservaid)."' ORDER BY busy.starting ASC";  // LIMIT 1 //LIMIT 0,30
	     // '".$this->myesc($mes)."'
	$result=$this->query($sql);
   // foreach($result as $result);
	return ($result);
	}*/
	//===============================================================================================================
    public function show1_active($table){//show one active record of a table
		 $table=$this->myesc($table);
		 $sql="SELECT * FROM `".DB_PREFIX.$table."` WHERE `".DB_PREFIX.$table."`.`active`=1 LIMIT 1";
		 $result=$this->query($sql);
		 foreach($result AS $result)
	 return ($result);
	}
	/*========================================availability in the building system=========================================================*/
	public function bookings_construction($villa_id, $date){//this will search as per criteria choosed.

	$sql="SELECT busy.id AS busyid,
                 busy.starting AS start,
                 busy.ending AS end,
                 busy.type AS type,
                 busy.id_villa AS villa,
                 busy.id_adm AS adm,
                 busy.comment AS note,
                 busy.date AS date,
                 busy.id_update AS upd,
                 booked.id AS reserveid,
                 booked.ref AS ref,
                 booked.id_client AS client,
                 booked.adults AS adults,
                 booked.children AS kids,
                 booked.id_interm AS interm,
                 booked.qty_nights AS nights,
                 booked.price_per_night AS ppn,
                 booked.commision AS apc,
                 booked.amount AS subtotal,
                 booked.tax AS itbis,
                 booked.services_amount AS aps,
                 booked.deposit AS dep,
                 booked.total AS total,
                 booked.status AS status,
                 booked.comment AS rc
	      FROM `".DB_PREFIX."occupancy` AS `busy`

	      LEFT JOIN `".DB_PREFIX."reserves` AS `booked`
	      ON `busy`.`id`=`booked`.`id_occupancy`

	      WHERE `busy`.`id_villa`='".$this->myesc($villa_id)."' AND `busy`.`starting`<='".$this->myesc($date)."' AND `booked`.`status`<>'0' AND `busy`.`ending`>='".$this->myesc($date)."' AND `busy`.`active`=1 ORDER BY busy.starting ASC";  // LIMIT 1 // LIMIT 0,30
	$result=$this->query($sql);
   // foreach($result as $result);
	return ($result);
	}
   /*=====================availability in the building system======================================================*/

   public function booking_per_months($month, $year){//this will search as per criteria choosed.

		$sql="SELECT busy.id AS busyid,
					 busy.starting AS start,
					 busy.ending AS end,                                             -
					 busy.type AS type,
					 busy.id_villa AS villa,
					 busy.id_adm AS adm,
					 busy.comment AS note,
					 busy.date AS date,
					 busy.id_update AS upd,
					 booked.id AS reserveid,
					 booked.ref AS ref,
					 booked.id_client AS client,
					 booked.adults AS adults,
					 booked.children AS kids,
					 booked.vehicles AS vehicles,
					 booked.id_interm AS interm,
					 booked.qty_nights AS nights,
					 booked.nightsHS AS NHS,
					 booked.nightsLS AS NLS,
					 booked.price_per_night AS ppn,
					 booked.priceHS AS PHS,
					 booked.commision AS apc,
					 booked.amount AS subtotal,
					 booked.tax AS itbis,
					 booked.services_amount AS aps,
					 booked.deposit AS dep,
					 booked.total AS total,
					 booked.status AS status,
					 booked.comment AS rc,
					 booked.pagos_qty AS PAYM,
					 booked.pagos_monto AS PMV,
					 booked.price_long AS PL,
					 booked.extra_nights AS EN,
					 booked.online AS line,
					 disct.pro_code AS code,
					 disct.discounted AS discounted
			  FROM `".DB_PREFIX."occupancy` AS `busy`

			  LEFT JOIN `".DB_PREFIX."reserves` AS `booked`
			  ON `busy`.`id`=`booked`.`id_occupancy`
			  
			    LEFT JOIN `".DB_PREFIX."discount` AS `disct`
			  ON `booked`.`ref`=`disct`.`reference`

			  WHERE `busy`.`mm`='".$this->myesc($month)."' AND `busy`.`yyyy`='".$this->myesc($year)."' AND `busy`.`active`=1 ";
		$result=$this->query($sql);
	return ($result);
	}
	
	public function booking_per_months_type($month, $year, $type){//this will search as per criteria choosed.

		$sql="SELECT busy.id AS busyid,
					 busy.starting AS start,
					 busy.ending AS end,                                             -
					 busy.type AS type,
					 busy.id_villa AS villa,
					 busy.id_adm AS adm,
					 busy.comment AS note,
					 busy.date AS date,
					 busy.id_update AS upd,
					 booked.id AS reserveid,
					 booked.ref AS ref,
					 booked.id_client AS client,
					 booked.adults AS adults,
					 booked.children AS kids,
					 booked.vehicles AS vehicles,
					 booked.id_interm AS interm,
					 booked.qty_nights AS nights,
					 booked.nightsHS AS NHS,
					 booked.nightsLS AS NLS,
					 booked.price_per_night AS ppn,
					 booked.priceHS AS PHS,
					 booked.commision AS apc,
					 booked.amount AS subtotal,
					 booked.tax AS itbis,
					 booked.services_amount AS aps,
					 booked.deposit AS dep,
					 booked.total AS total,
					 booked.status AS status,
					 booked.comment AS rc,
					 booked.pagos_qty AS PAYM,
					 booked.pagos_monto AS PMV,
					 booked.price_long AS PL,
					 booked.extra_nights AS EN,
					 booked.online AS line,
					 disct.pro_code AS code,
					 disct.discounted AS discounted
			  FROM `".DB_PREFIX."occupancy` AS `busy`

			  LEFT JOIN `".DB_PREFIX."reserves` AS `booked`
			  ON `busy`.`id`=`booked`.`id_occupancy`
			  
			    LEFT JOIN `".DB_PREFIX."discount` AS `disct`
			  ON `booked`.`ref`=`disct`.`reference`

			  WHERE MONTH(`busy`.`date`)='".$this->myesc($month)."' AND YEAR(`busy`.`date`)='".$this->myesc($year)."' AND `booked`.`online`='".$this->myesc($type)."' AND `busy`.`active`=1 ";
		$result=$this->query($sql);
	return ($result);
	}
	
	public function booking_per_villas($month, $year, $villaid){//this will search as per criteria choosed.

		$sql="SELECT busy.id AS busyid,
					 busy.starting AS start,
					 busy.ending AS end,                                             -
					 busy.type AS type,
					 busy.id_villa AS villa,
					 busy.id_adm AS adm,
					 busy.comment AS note,
					 busy.date AS date,
					 busy.id_update AS upd,
					 booked.id AS reserveid,
					 booked.ref AS ref,
					 booked.id_client AS client,
					 booked.adults AS adults,
					 booked.children AS kids,
					 booked.vehicles AS vehicles,
					 booked.id_interm AS interm,
					 booked.qty_nights AS nights,
					 booked.nightsHS AS NHS,
					 booked.nightsLS AS NLS,
					 booked.price_per_night AS ppn,
					 booked.priceHS AS PHS,
					 booked.commision AS apc,
					 booked.amount AS subtotal,
					 booked.tax AS itbis,
					 booked.services_amount AS aps,
					 booked.deposit AS dep,
					 booked.total AS total,
					 booked.status AS status,
					 booked.comment AS rc,
					 booked.pagos_qty AS PAYM,
					 booked.pagos_monto AS PMV,
					 booked.price_long AS PL,
					 booked.extra_nights AS EN,
					 booked.online AS line
			  FROM `".DB_PREFIX."occupancy` AS `busy`

			  LEFT JOIN `".DB_PREFIX."reserves` AS `booked`
			  ON `busy`.`id`=`booked`.`id_occupancy`

			  WHERE `busy`.`mm`='".$this->myesc($month)."' AND `busy`.`yyyy`='".$this->myesc($year)."' AND `busy`.`id_villa`='".$this->myesc($villaid)."' AND `busy`.`active`=1 ";
		$result=$this->query($sql);
	return ($result);
	}
	
	public function booking_per_months_cancelled($month, $year, $villa){//this will search as per criteria choosed.
		if($villa!=0){
			//show all the villas
			$villa_sql=" AND `busy`.`id_villa`='".$this->myesc($villa)."' ";
		}else{
			//show this villa id
			$villa_sql="";
		}
		
		$sql="SELECT busy.id AS busyid,
					 busy.starting AS start,
					 busy.ending AS end,                                             -
					 busy.type AS type,
					 busy.id_villa AS villa,
					 busy.id_adm AS adm,
					 busy.comment AS note,
					 busy.date AS date,
					 busy.id_update AS upd,
					 booked.id AS reserveid,
					 booked.ref AS ref,
					 booked.id_client AS client,
					 booked.adults AS adults,
					 booked.children AS kids,
					 booked.vehicles AS vehicles,
					 booked.id_interm AS interm,
					 booked.qty_nights AS nights,
					 booked.nightsHS AS NHS,
					 booked.nightsLS AS NLS,
					 booked.price_per_night AS ppn,
					 booked.priceHS AS PHS,
					 booked.commision AS apc,
					 booked.amount AS subtotal,
					 booked.tax AS itbis,
					 booked.services_amount AS aps,
					 booked.deposit AS dep,
					 booked.total AS total,
					 booked.status AS status,
					 booked.comment AS rc,
					 booked.pagos_qty AS PAYM,
					 booked.pagos_monto AS PMV,
					 booked.price_long AS PL,
					 booked.extra_nights AS EN,
					 booked.online AS line
			  FROM `".DB_PREFIX."occupancy` AS `busy`

			  LEFT JOIN `".DB_PREFIX."reserves` AS `booked`
			  ON `busy`.`id`=`booked`.`id_occupancy`

			  WHERE `busy`.`mm`='".$this->myesc($month)."' $villa_sql AND `busy`.`yyyy`='".$this->myesc($year)."' AND `booked`.`status`='0' AND `busy`.`active`=1 ";
		$result=$this->query($sql);
	return ($result);
	}
	
	public function booking_per_monthspp($month, $year){//this will search as per criteria choosed.

		$sql="SELECT busy.id AS busyid,
					 busy.starting AS start,
					 busy.ending AS end,                                             -
					 busy.type AS type,
					 busy.id_villa AS villa,
					 busy.id_adm AS adm,
					 busy.comment AS note,
					 busy.date AS date,
					 busy.id_update AS upd,
					 booked.id AS reserveid,
					 booked.ref AS ref,
					 booked.id_client AS client,
					 booked.adults AS adults,
					 booked.children AS kids,
					 booked.vehicles AS vehicles,
					 booked.id_interm AS interm,
					 booked.qty_nights AS nights,
					 booked.nightsHS AS NHS,
					 booked.nightsLS AS NLS,
					 booked.price_per_night AS ppn,
					 booked.priceHS AS PHS,
					 booked.commision AS apc,
					 booked.amount AS subtotal,
					 booked.tax AS itbis,
					 booked.services_amount AS aps,
					 booked.deposit AS dep,
					 booked.total AS total,
					 booked.status AS status,
					 booked.comment AS rc,
					 booked.pagos_qty AS PAYM,
					 booked.pagos_monto AS PMV,
					 booked.price_long AS PL,
					 booked.extra_nights AS EN,
					 booked.online AS line
			  FROM `".DB_PREFIX."occupancy` AS `busy`

			  LEFT JOIN `".DB_PREFIX."reserves` AS `booked`
			  ON `busy`.`id`=`booked`.`id_occupancy`

			  WHERE `busy`.`mm`='".$this->myesc($month)."' AND `busy`.`yyyy`='".$this->myesc($year)."' AND `busy`.`active`=1 AND `booked`.`online`<>3 AND `booked`.`status`<>3 AND `booked`.`status`<>7 AND `booked`.`status`<>19 AND `booked`.`status`<>20 AND `booked`.`status`<>21 AND `booked`.`status`<>26 AND `booked`.`status`<>27 AND `booked`.`status`<>28 AND `booked`.`status`<>29 AND `booked`.`status`<>30 AND `booked`.`status`<>31 AND `booked`.`status`<>32 AND `booked`.`status`<>33 AND `booked`.`status`<>50 AND `booked`.`status`<>22 AND `booked`.`status`<>23 AND `booked`.`status`<>24 AND `booked`.`status`<>25";
		$result=$this->query($sql);
	return ($result);
	}
	
	public function booking_per_promo($code){//this will search as per criteria choosed.

		$sql="SELECT busy.id AS busyid,
					 busy.starting AS start,
					 busy.ending AS end,                                             -
					 busy.type AS type,
					 busy.id_villa AS villa,
					 busy.id_adm AS adm,
					 busy.comment AS note,
					 busy.date AS date,
					 busy.id_update AS upd,
					 booked.id AS reserveid,
					 booked.ref AS ref,
					 booked.id_client AS client,
					 booked.adults AS adults,
					 booked.children AS kids,
					 booked.vehicles AS vehicles,
					 booked.id_interm AS interm,
					 booked.qty_nights AS nights,
					 booked.nightsHS AS NHS,
					 booked.nightsLS AS NLS,
					 booked.price_per_night AS ppn,
					 booked.priceHS AS PHS,
					 booked.commision AS apc,
					 booked.amount AS subtotal,
					 booked.tax AS itbis,
					 booked.services_amount AS aps,
					 booked.deposit AS dep,
					 booked.total AS total,
					 booked.status AS status,
					 booked.comment AS rc,
					 booked.pagos_qty AS PAYM,
					 booked.pagos_monto AS PMV,
					 booked.price_long AS PL,
					 booked.extra_nights AS EN,
					 booked.online AS line,
					 disct.pro_code AS code
			  FROM `".DB_PREFIX."occupancy` AS `busy`

			  LEFT JOIN `".DB_PREFIX."reserves` AS `booked`
			  ON `busy`.`id`=`booked`.`id_occupancy`
			  
			  LEFT JOIN `".DB_PREFIX."discount` AS `disct`
			  ON `booked`.`ref`=`disct`.`reference`

			  WHERE `disct`.`pro_code`='".$this->myesc($code)."' AND `busy`.`active`=1 ";
		$result=$this->query($sql);
	return ($result);
	}

	 public function booking_per_months_referral($month, $year, $id_referral){//this will search as per criteria choosed.

		$sql="SELECT busy.id AS busyid,
					 busy.starting AS start,
					 busy.ending AS end,                                             -
					 busy.type AS type,
					 busy.id_villa AS villa,
					 busy.id_adm AS adm,
					 busy.comment AS note,
					 busy.date AS date,
					 busy.id_update AS upd,
					 booked.id AS reserveid,
					 booked.ref AS ref,
					 booked.id_client AS client,
					 booked.adults AS adults,
					 booked.children AS kids,
					 booked.vehicles AS vehicles,
					 booked.qty_nights AS nights,
					 booked.nightsHS AS NHS,
					 booked.nightsLS AS NLS,
					 booked.price_per_night AS ppn,
					 booked.priceHS AS PHS,
					 booked.commision AS apc,
					 booked.amount AS subtotal,
					 booked.tax AS itbis,
					 booked.services_amount AS aps,
					 booked.deposit AS dep,
					 booked.total AS total,
					 booked.status AS status,
					 booked.comment AS rc,
					 booked.pagos_qty AS PAYM,
					 booked.pagos_monto AS PMV,
					 booked.price_long AS PL,
					 booked.extra_nights AS EN,
					 booked.online AS line,
					 referral.id_referal AS id_referral
			  FROM `".DB_PREFIX."occupancy` AS `busy`

			  LEFT JOIN `".DB_PREFIX."reserves` AS `booked`
			  ON `busy`.`id`=`booked`.`id_occupancy`

			  LEFT JOIN `".DB_PREFIX."bookingreferred` AS `referral`
			  ON `booked`.`ref`=`referral`.`ref_book`

				  WHERE MONTH(`busy`.`starting`)='".$this->myesc($month)."' AND YEAR(`busy`.`starting`)='".$this->myesc($year)."' AND `referral`.`id_referal`='".$this->myesc($id_referral)."'";
		$result=$this->query($sql);
		//MONTH(`busy`.`date`)='".$this->myesc($month)."' AND
		//`busy`.`date` LIKE '".$this->myesc($year)."%' AND
	return ($result);
	}

	public function bookings_with_rentalcars($month, $year){//this will search as per criteria choosed.

		$sql="SELECT busy.id AS busyid,
					 busy.starting AS start,
					 busy.ending AS end,                                             -
					 busy.type AS type,
					 busy.id_villa AS villa,
					 busy.id_adm AS adm,
					 busy.comment AS note,
					 busy.date AS date,
					 busy.id_update AS upd,
					 booked.id AS reserveid,
					 booked.ref AS ref,
					 booked.id_client AS client,
					 booked.adults AS adults,
					 booked.children AS kids,
					 booked.vehicles AS vehicles,
					 booked.qty_nights AS nights,
					 booked.nightsHS AS NHS,
					 booked.nightsLS AS NLS,
					 booked.price_per_night AS ppn,
					 booked.priceHS AS PHS,
					 booked.commision AS apc,
					 booked.amount AS subtotal,
					 booked.tax AS itbis,
					 booked.services_amount AS aps,
					 booked.deposit AS dep,
					 booked.total AS total,
					 booked.status AS status,
					 booked.comment AS rc,
					 booked.pagos_qty AS PAYM,
					 booked.pagos_monto AS PMV,
					 booked.price_long AS PL,
					 booked.extra_nights AS EN,
					 booked.online AS line,
					 cars.id_car AS id_car,
					 cars.id_car AS id_car,
					 cars.qty_days AS qty_days,
					 cars.taxes AS car_taxes,
					 cars.price AS car_price
			  FROM `".DB_PREFIX."occupancy` AS `busy`

			  LEFT JOIN `".DB_PREFIX."reserves` AS `booked`
			  ON `busy`.`id`=`booked`.`id_occupancy`

			  LEFT JOIN `".DB_PREFIX."cars_rented` AS `cars`
			  ON `cars`.`ref`=`booked`.`ref`

			  WHERE MONTH(`busy`.`starting`)='".$this->myesc($month)."' AND YEAR(`busy`.`starting`)='".$this->myesc($year)."' AND `cars`.`ref`=`booked`.`ref` ";
		$result=$this->query($sql);
		//MONTH(`busy`.`date`)='".$this->myesc($month)."' AND
		//`busy`.`date` LIKE '".$this->myesc($year)."%' AND
	return ($result);
	}

	public function checkbook_client($cliente_id, $ref){//this will search as per criteria choosed.

		$sql="SELECT busy.id AS busyid,
					 busy.starting AS start,
					 busy.ending AS end,                                             -
					 busy.type AS type,
					 busy.id_villa AS villa,
					 busy.id_adm AS adm,
					 busy.comment AS note,
					 busy.date AS date,
					 busy.id_update AS upd,
					 booked.id AS reserveid,
					 booked.ref AS ref,
					 booked.id_client AS client,
					 booked.adults AS adults,
					 booked.children AS kids,
					 booked.vehicles AS vehicles,
					 booked.id_interm AS interm,
					 booked.qty_nights AS nights,
					 booked.nightsHS AS NHS,
					 booked.nightsLS AS NLS,
					 booked.price_per_night AS ppn,
					 booked.priceHS AS PHS,
					 booked.commision AS apc,
					 booked.amount AS subtotal,
					 booked.tax AS itbis,
					 booked.services_amount AS aps,
					 booked.deposit AS dep,
					 booked.total AS total,
					 booked.status AS status,
					 booked.comment AS rc,
					 booked.pagos_qty AS PAYM,
					 booked.pagos_monto AS PMV,
					 booked.price_long AS PL,
					 booked.extra_nights AS EN,
					 booked.online AS line
			  FROM `".DB_PREFIX."occupancy` AS `busy`

			  LEFT JOIN `".DB_PREFIX."reserves` AS `booked`
			  ON `busy`.`id`=`booked`.`id_occupancy`

			  WHERE `booked`.`ref`='".$this->myesc($ref)."' AND `booked`.`id_client`='".$this->myesc($cliente_id)."' AND `busy`.`active`=1 LIMIT 1";  // LIMIT 1
		$result=$this->query($sql);
	return ($result);
	}
	 /*=================================STASTISTICS INFO =====================================================================================*/
	public function c_bookings($villa_id, $inicio_mes, $fin_mes){//this will search only bookings between this month.
	 $sql="SELECT busy.id AS busyid,
                 busy.starting AS start,
                 busy.ending AS end,
                 busy.type AS type,
                 busy.id_villa AS villa,
                 busy.id_adm AS adm,
                 busy.comment AS note,
                 busy.date AS date,
                 busy.id_update AS upd,
                 booked.id AS reserveid,
                 booked.ref AS ref,
                 booked.id_client AS client,
                 booked.adults AS adults,
                 booked.children AS kids,
                 booked.id_interm AS interm,
                 booked.qty_nights AS nights,
                 booked.price_per_night AS ppn,
                 booked.commision AS apc,
                 booked.amount AS subtotal,
                 booked.tax AS itbis,
                 booked.services_amount AS aps,
                 booked.deposit AS dep,
                 booked.total AS total,
                 booked.status AS status,
                 booked.comment AS rc
	      FROM `".DB_PREFIX."occupancy` AS `busy`

	      LEFT JOIN `".DB_PREFIX."reserves` AS `booked`
	      ON `busy`.`id`=`booked`.`id_occupancy`

	      WHERE `busy`.`id_villa`='".$this->myesc($villa_id)."' AND `busy`.`starting`<='".$this->myesc($fin_mes)."' AND `busy`.`ending`>'".$this->myesc($inicio_mes)."' AND `busy`.`active`=1 AND `booked`.`status`<>0 ORDER BY busy.starting ASC ";  // LIMIT 1 //LIMIT 0,30
	$result=$this->query($sql);
   	return ($result);
	}
	public function getAgCl($conditions){
    $condition=$this->myesc($conditions);
	$sql="SELECT * FROM `".DB_PREFIX."clients_referred` WHERE ".$conditions." ORDER BY `id` DESC LIMIT 1";//make integer string (string number+0)
	$result=$this->query($sql);

	return ($result);
	}
	
    public function showsAllBookings(){//this will search only bookings between this month.
	 $sql="SELECT busy.id AS busyid,
                 busy.starting AS start,
                 busy.ending AS end,
                 busy.type AS type,
                 busy.id_villa AS villa,
                 busy.id_adm AS adm,
                 busy.comment AS note,
                 busy.date AS date,
                 busy.id_update AS upd,
                 booked.id AS reserveid,
                 booked.ref AS ref,
                 booked.id_client AS client,
                 booked.adults AS adults,
                 booked.children AS kids,
                 booked.id_interm AS interm,
                 booked.qty_nights AS nights,
                 booked.price_per_night AS ppn,
                 booked.commision AS apc,
                 booked.amount AS subtotal,
                 booked.tax AS itbis,
                 booked.services_amount AS aps,
                 booked.deposit AS dep,
                 booked.total AS total,
                 booked.status AS status,
                 booked.comment AS rc
	      FROM `".DB_PREFIX."occupancy` AS `busy`
	      LEFT JOIN `".DB_PREFIX."reserves` AS `booked`
	      ON `busy`.`id`=`booked`.`id_occupancy`
	      WHERE `busy`.`active`='1' LIMIT 0,1";// ORDER BY `booked`.`id_occupancy` DESC
	$result=$this->query($sql);
   	return ($result);
	}
	
	public function amountGral($ref){/*get total amount of ref by type (payment, refund, security deposit, refund security deposit)*/
	    $sql="SELECT * FROM `".DB_PREFIX."payments` WHERE  `ref`='".$ref."' ";
		$result=$this->query($sql);
	 	return $result;
	}
	public function amountRef($ref,$tipo){/*get total amount of ref by type (payment, refund, security deposit, refund security deposit)*/
	    $sql="SELECT * FROM `".DB_PREFIX."payments` WHERE  `ref`='".$ref."' AND  `class`='".$tipo."'";
		$result=$this->query($sql);
		$montoTotal=0;
		foreach($result AS $k){
			$montoTotal+=$k['amount'];
		}
	 	return ($montoTotal);
	}
	public function amountRefB($ref,$tipo, $by){/*get total amount of ref by type (payment, refund, security deposit, refund security deposit)*/
	    $sql="SELECT * FROM `".DB_PREFIX."payments` WHERE  `ref`='".$ref."' AND  `class`='".$tipo."' AND  `type`='".$by."'";
		$result=$this->query($sql);
		$montoTotal=0;
		foreach($result AS $k){
			$montoTotal+=$k['amount'];
		}
	 	return ($montoTotal);
	}
	
	public function getUnpaidShorTerm($status=3){//by default get booking unconfirmed
	 $sql="SELECT busy.id AS busyid,
                 busy.starting AS start,
                 busy.ending AS end,
                 busy.type AS type,
                 busy.id_villa AS villa,
                 busy.id_adm AS adm,
                 busy.comment AS note,
                 busy.date AS date,
                 busy.id_update AS upd,
                 booked.id AS reserveid,
                 booked.ref AS ref,
                 booked.id_client AS client,
                 booked.adults AS adults,
                 booked.children AS kids,
                 booked.id_interm AS interm,
                 booked.qty_nights AS nights,
				 booked.nightsHS AS nightsHS,
				 booked.nightsLS AS nightsLS,
                 booked.price_per_night AS priceLS,
				 booked.priceHS AS priceHS,
				 bookref.id_referal AS agentid,
                 booked.commision AS apc,
                 booked.amount AS subtotal,
                 booked.tax AS itbis,
                 booked.services_amount AS aps,
                 booked.deposit AS dep,
                 booked.total AS total,
                 booked.status AS status,
				 booked.online AS source,
                 booked.comment AS rc,
                 agent.name AS aname,
                 agent.lastname AS alastn,
                 agent.tipo AS atipo
	      FROM `".DB_PREFIX."occupancy` AS `busy`

	      LEFT JOIN `".DB_PREFIX."reserves` AS `booked`
	      ON `busy`.`id`=`booked`.`id_occupancy`

	      LEFT JOIN `".DB_PREFIX."bookingreferred` AS `bookref`
	      ON `booked`.`ref`=`bookref`.`ref_book`

	      LEFT JOIN `".DB_PREFIX."commission` AS `agent`
	      ON `bookref`.`id_referal`=`agent`.`id`

	      WHERE `busy`.`starting`>='".$this->myesc(date('Y-m-d'))."' AND `booked`.`online`<>'3' AND `booked`.`online`<>'4' AND `busy`.`active`=1 AND `booked`.`status`='".$this->myesc($status)."'  GROUP BY busy.id";  // LIMIT 1 //LIMIT 0,30  AND `booked`.`status`=2
	$result=$this->query($sql);
   	return ($result);
	}
	
	public function booking_by_sosurce($month, $year, $status=2){//this will search as per criteria choosed.
		//switch($source){
			/*case 1://Booking Engines
				$source_sql="AND booked.online=1";
				break;
			case 2://Referrals
				$source_sql="AND booked.online=2";
				break;
			case 3://Direct Bookings
				$source_sql="AND booked.online=0";
				break;
			default:
				$source_sql="AND booked.online=0";*/
				
			$source_status="AND booked.status=$status";
		//}
		$sql="SELECT busy.id AS busyid,
					 busy.starting AS start,
					 busy.ending AS end,                                             -
					 busy.type AS type,
					 busy.id_villa AS villa,
					 busy.id_adm AS adm,
					 busy.comment AS note,
					 busy.date AS date,
					 busy.id_update AS upd,
					 booked.id AS reserveid,
					 booked.ref AS ref,
					 booked.id_client AS client,
					 booked.adults AS adults,
					 booked.children AS kids,
					 booked.vehicles AS vehicles,
					 booked.id_interm AS interm,
					 booked.qty_nights AS nights,
					 booked.nightsHS AS NHS,
					 booked.nightsLS AS NLS,
					 booked.price_per_night AS ppn,
					 booked.priceHS AS PHS,
					 booked.commision AS apc,
					 booked.amount AS subtotal,
					 booked.tax AS itbis,
					 booked.services_amount AS aps,
					 booked.deposit AS dep,
					 booked.total AS total,
					 booked.status AS status,
					 booked.comment AS rc,
					 booked.pagos_qty AS PAYM,
					 booked.pagos_monto AS PMV,
					 booked.price_long AS PL,
					 booked.extra_nights AS EN,
					 booked.online AS line
			  FROM `".DB_PREFIX."occupancy` AS `busy`

			  LEFT JOIN `".DB_PREFIX."reserves` AS `booked`
			  ON `busy`.`id`=`booked`.`id_occupancy`

			  WHERE `busy`.`mm`='".$this->myesc($month)."' AND `busy`.`yyyy`='".$this->myesc($year)."' $source_sql $source_status AND `busy`.`active`=1 ";
		$result=$this->query($sql);
	return ($result);
	}
	
	public function seeOccupancyOwnersPortal($starting, $ending, $idOwner){//this will help to show availabity online

	$sql="SELECT o.id AS busyid,
                 o.starting AS start,
                 o.ending AS end,
                 o.id_villa AS villa_id,
                 o.date AS date,
                 r.id AS reserveid,
                 r.ref AS ref,
                 r.id_client AS client,
                 r.qty_nights AS nights,
                 r.status AS status,
				 v.no AS villa_number,
				 v.type AS villa_type,
				 v.bed AS bedrooms,
				 v.ac AS air_conditioners,
				 v.bath AS bathrooms,
				 v.capacity AS max_persons,
				 v.p_low AS price_low_season,
				 v.p_high AS price_high_season
	      FROM `".DB_PREFIX."occupancy` AS `o`
	      LEFT JOIN `".DB_PREFIX."reserves` AS `r`
	      ON `o`.`id`=`r`.`id_occupancy`
		  LEFT JOIN `".DB_PREFIX."villas` AS `v`
	      ON `o`.`id_villa`=`v`.`id`
	      WHERE `o`.`starting`<'".$this->myesc($ending)."' AND `o`.`ending`>'".$this->myesc($starting)."' AND `r`.`status`<>0 AND `r`.`status`<>50 AND `v`.`able_r`=1 AND `v`.`id_owner`='".$this->myesc($idOwner)."' ORDER BY v.no ASC";
	return $result=$this->query($sql);
	}
	
	public function villas_for_owner_in_pool($idowner){  //shows all the villas that own an owner.
		$sql="SELECT * FROM `".DB_PREFIX."villas` WHERE `id_owner`='".$this->myesc($idowner)."' AND `able_r`='1' ORDER BY `id` ASC";
		$result=$this->query($sql);
	return ($result);
	}
	
	
	
	
	
	
	public function inhouse_villas($date, $beds){
		
		switch($beds){
			case 10:
					$sql="SELECT o.id AS busyid,
							 o.starting AS start,
							 o.ending AS end,
							 o.id_villa AS villa_id,
							 o.date AS date,
							 r.id AS reserveid,
							 r.ref AS ref,
							 r.id_client AS client,
							 r.qty_nights AS nights,
							 r.status AS status,
							 v.no AS villa_number,
							 v.type AS villa_type,
							 v.bed AS bedrooms,
							 v.ac AS air_conditioners,
							 v.bath AS bathrooms,
							 v.capacity AS max_persons,
							 v.p_low AS price_low_season,
							 v.p_high AS price_high_season
					  FROM `".DB_PREFIX."occupancy` AS `o`
					  LEFT JOIN `".DB_PREFIX."reserves` AS `r`
					  ON `o`.`id`=`r`.`id_occupancy`
					  LEFT JOIN `".DB_PREFIX."villas` AS `v`
					  ON `o`.`id_villa`=`v`.`id`
					  WHERE `o`.`starting`<='".$this->myesc($date)."' AND `o`.`ending`>'".$this->myesc($date)."' AND `r`.`status`<>0 AND `r`.`status`<>5 AND `r`.`status`<>50 AND `v`.`able_r`=1  ORDER BY v.no ASC";
					break;
			case 2:
					$sql="SELECT o.id AS busyid,
							 o.starting AS start,
							 o.ending AS end,
							 o.id_villa AS villa_id,
							 o.date AS date,
							 r.id AS reserveid,
							 r.ref AS ref,
							 r.id_client AS client,
							 r.qty_nights AS nights,
							 r.status AS status,
							 v.no AS villa_number,
							 v.type AS villa_type,
							 v.bed AS bedrooms,
							 v.ac AS air_conditioners,
							 v.bath AS bathrooms,
							 v.capacity AS max_persons,
							 v.p_low AS price_low_season,
							 v.p_high AS price_high_season
					  FROM `".DB_PREFIX."occupancy` AS `o`
					  LEFT JOIN `".DB_PREFIX."reserves` AS `r`
					  ON `o`.`id`=`r`.`id_occupancy`
					  LEFT JOIN `".DB_PREFIX."villas` AS `v`
					  ON `o`.`id_villa`=`v`.`id`
					  WHERE `o`.`starting`<='".$this->myesc($date)."' AND `o`.`ending`>'".$this->myesc($date)."' AND `v`.`bed`='".$this->myesc($beds)."' AND `r`.`status`<>0 AND `r`.`status`<>5 AND `r`.`status`<>50 AND `v`.`able_r`=1  ORDER BY v.no ASC";
					break;
			case 3:
					$sql="SELECT o.id AS busyid,
							 o.starting AS start,
							 o.ending AS end,
							 o.id_villa AS villa_id,
							 o.date AS date,
							 r.id AS reserveid,
							 r.ref AS ref,
							 r.id_client AS client,
							 r.qty_nights AS nights,
							 r.status AS status,
							 v.no AS villa_number,
							 v.type AS villa_type,
							 v.bed AS bedrooms,
							 v.ac AS air_conditioners,
							 v.bath AS bathrooms,
							 v.capacity AS max_persons,
							 v.p_low AS price_low_season,
							 v.p_high AS price_high_season
					  FROM `".DB_PREFIX."occupancy` AS `o`
					  LEFT JOIN `".DB_PREFIX."reserves` AS `r`
					  ON `o`.`id`=`r`.`id_occupancy`
					  LEFT JOIN `".DB_PREFIX."villas` AS `v`
					  ON `o`.`id_villa`=`v`.`id`
					  WHERE `o`.`starting`<='".$this->myesc($date)."' AND `o`.`ending`>'".$this->myesc($date)."' AND `v`.`bed`='".$this->myesc($beds)."' AND `r`.`status`<>0 AND `r`.`status`<>5 AND `r`.`status`<>50 AND `v`.`able_r`=1  ORDER BY v.no ASC";
					break;
			case 4:
					$sql="SELECT o.id AS busyid,
							 o.starting AS start,
							 o.ending AS end,
							 o.id_villa AS villa_id,
							 o.date AS date,
							 r.id AS reserveid,
							 r.ref AS ref,
							 r.id_client AS client,
							 r.qty_nights AS nights,
							 r.status AS status,
							 v.no AS villa_number,
							 v.type AS villa_type,
							 v.bed AS bedrooms,
							 v.ac AS air_conditioners,
							 v.bath AS bathrooms,
							 v.capacity AS max_persons,
							 v.p_low AS price_low_season,
							 v.p_high AS price_high_season
					  FROM `".DB_PREFIX."occupancy` AS `o`
					  LEFT JOIN `".DB_PREFIX."reserves` AS `r`
					  ON `o`.`id`=`r`.`id_occupancy`
					  LEFT JOIN `".DB_PREFIX."villas` AS `v`
					  ON `o`.`id_villa`=`v`.`id`
					  WHERE `o`.`starting`<='".$this->myesc($date)."' AND `o`.`ending`>'".$this->myesc($date)."' AND `v`.`bed`='".$this->myesc($beds)."' AND `r`.`status`<>0 AND `r`.`status`<>5 AND `r`.`status`<>50 AND `v`.`able_r`=1  ORDER BY v.no ASC";
					break;
			case 5:
					$sql="SELECT o.id AS busyid,
							 o.starting AS start,
							 o.ending AS end,
							 o.id_villa AS villa_id,
							 o.date AS date,
							 r.id AS reserveid,
							 r.ref AS ref,
							 r.id_client AS client,
							 r.qty_nights AS nights,
							 r.status AS status,
							 v.no AS villa_number,
							 v.type AS villa_type,
							 v.bed AS bedrooms,
							 v.ac AS air_conditioners,
							 v.bath AS bathrooms,
							 v.capacity AS max_persons,
							 v.p_low AS price_low_season,
							 v.p_high AS price_high_season
					  FROM `".DB_PREFIX."occupancy` AS `o`
					  LEFT JOIN `".DB_PREFIX."reserves` AS `r`
					  ON `o`.`id`=`r`.`id_occupancy`
					  LEFT JOIN `".DB_PREFIX."villas` AS `v`
					  ON `o`.`id_villa`=`v`.`id`
					  WHERE `o`.`starting`<='".$this->myesc($date)."' AND `o`.`ending`>'".$this->myesc($date)."' AND `v`.`bed`='".$this->myesc($beds)."' AND `r`.`status`<>0 AND `r`.`status`<>5 AND `r`.`status`<>50 AND `v`.`able_r`=1  ORDER BY v.no ASC";
					break;
			case 6:
					$sql="SELECT o.id AS busyid,
							 o.starting AS start,
							 o.ending AS end,
							 o.id_villa AS villa_id,
							 o.date AS date,
							 r.id AS reserveid,
							 r.ref AS ref,
							 r.id_client AS client,
							 r.qty_nights AS nights,
							 r.status AS status,
							 v.no AS villa_number,
							 v.type AS villa_type,
							 v.bed AS bedrooms,
							 v.ac AS air_conditioners,
							 v.bath AS bathrooms,
							 v.capacity AS max_persons,
							 v.p_low AS price_low_season,
							 v.p_high AS price_high_season
					  FROM `".DB_PREFIX."occupancy` AS `o`
					  LEFT JOIN `".DB_PREFIX."reserves` AS `r`
					  ON `o`.`id`=`r`.`id_occupancy`
					  LEFT JOIN `".DB_PREFIX."villas` AS `v`
					  ON `o`.`id_villa`=`v`.`id`
					  WHERE `o`.`starting`<='".$this->myesc($date)."' AND `o`.`ending`>'".$this->myesc($date)."' AND `v`.`bed`='".$this->myesc($beds)."' AND `r`.`status`<>0 AND `r`.`status`<>5 AND `r`.`status`<>50 AND `v`.`able_r`=1  ORDER BY v.no ASC";
					break;
			default:
					$sql="SELECT o.id AS busyid,
							 o.starting AS start,
							 o.ending AS end,
							 o.id_villa AS villa_id,
							 o.date AS date,
							 r.id AS reserveid,
							 r.ref AS ref,
							 r.id_client AS client,
							 r.qty_nights AS nights,
							 r.status AS status,
							 v.no AS villa_number,
							 v.type AS villa_type,
							 v.bed AS bedrooms,
							 v.ac AS air_conditioners,
							 v.bath AS bathrooms,
							 v.capacity AS max_persons,
							 v.p_low AS price_low_season,
							 v.p_high AS price_high_season
					  FROM `".DB_PREFIX."occupancy` AS `o`
					  LEFT JOIN `".DB_PREFIX."reserves` AS `r`
					  ON `o`.`id`=`r`.`id_occupancy`
					  LEFT JOIN `".DB_PREFIX."villas` AS `v`
					  ON `o`.`id_villa`=`v`.`id`
					  WHERE `o`.`starting`<='".$this->myesc($date)."' AND `o`.`ending`>'".$this->myesc($date)."' AND `r`.`status`<>0 AND `r`.`status`<>5 AND `r`.`status`<>50 AND `v`.`able_r`=1  ORDER BY v.no ASC";
		}
		return $this->query($sql);
	}
	
	
	public function arriving_status($date, $status) {
			$query="SELECT busy.id AS busyid,
					 busy.starting AS start,
					 busy.ending AS end,
					 busy.id_villa AS villa,
					 booked.id AS reserveid,
					 booked.ref AS ref,
					 booked.qty_nights AS nights,
					 booked.price_per_night AS ppn,
					 booked.status AS status,
					 booked.id_client AS client,
					 booked.adults AS adults,
					 booked.children AS kids,
					 booked.comment AS note
			  FROM `".DB_PREFIX."occupancy` AS `busy`
			  LEFT JOIN `".DB_PREFIX."reserves` AS `booked`
			  ON `busy`.`id`=`booked`.`id_occupancy`
			  WHERE `busy`.`starting`='".$this->myesc(date('Y-m-d',strtotime($date)))."' AND `busy`.`active`=1 AND `booked`.`status`='".$this->myesc($status)."' ORDER BY busy.id ASC";
             // WHERE `busy`.`starting`='".$this->myesc(date('Y-m-d'))."' AND `busy`.`active`=1 AND `booked`.`status`=2 OR `booked`.`status`=3  OR `booked`.`status`=6 ORDER BY busy.id ASC";
			return $this->query($query);
		}
		
		
	public function departuring_status($date, $status) {
			$query="SELECT busy.id AS busyid,
					 busy.starting AS start,
					 busy.ending AS end,
					 busy.id_villa AS villa,
					 booked.id AS reserveid,
					 booked.ref AS ref,
					 booked.qty_nights AS nights,
					 booked.price_per_night AS ppn,
					 booked.status AS status,
					 booked.id_client AS client,
					 booked.adults AS adults,
					 booked.children AS kids,
					 booked.comment AS note
			  FROM `".DB_PREFIX."occupancy` AS `busy`
			  LEFT JOIN `".DB_PREFIX."reserves` AS `booked`
			  ON `busy`.`id`=`booked`.`id_occupancy`
			  WHERE `busy`.`ending`='".$this->myesc(date('Y-m-d',strtotime($date)))."' AND `busy`.`active`=1 AND `booked`.`status`='".$this->myesc($status)."' ORDER BY busy.id ASC";
				//`booked`.`status`<>4 AND `booked`.`status`='1' (different to checkedout and checkedin)only must be checked in do not matter more
			return $this->query($query);
		}	
		
	public function inhouse_status($date, $status){
		
		/*$sql="SELECT o.id AS busyid,
				 o.starting AS start,
				 o.ending AS end,
				 o.id_villa AS villa_id,
				 o.date AS date,
				 r.id AS reserveid,
				 r.ref AS ref,
				 r.id_client AS client,
				 r.qty_nights AS nights,
				 r.status AS status,
				 v.no AS villa_number,
				 v.type AS villa_type,
				 v.bed AS bedrooms,
				 v.ac AS air_conditioners,
				 v.bath AS bathrooms,
				 v.capacity AS max_persons,
				 v.p_low AS price_low_season,
				 v.p_high AS price_high_season
		  FROM `".DB_PREFIX."occupancy` AS `o`
		  LEFT JOIN `".DB_PREFIX."reserves` AS `r`
		  ON `o`.`id`=`r`.`id_occupancy`
		  LEFT JOIN `".DB_PREFIX."villas` AS `v`
		  ON `o`.`id_villa`=`v`.`id`
		  WHERE `o`.`starting`<='".$this->myesc($date)."' AND `o`.`ending`>='".$this->myesc($date)."' AND `r`.`status`='".$this->myesc($status)."' AND `v`.`able_r`=1  ORDER BY v.no ASC";*/
		
		$sql="SELECT o.id AS busyid,
				 o.starting AS start,
				 o.ending AS end,
				 o.id_villa AS villa,
				 o.date AS date,
				 r.id AS reserveid,
				 r.ref AS ref,
				 r.id_client AS client,
				 r.qty_nights AS nights,
				 r.status AS status,
				 v.no AS villa_number,
				 v.type AS villa_type,
				 v.bed AS bedrooms,
				 v.ac AS air_conditioners,
				 v.bath AS bathrooms,
				 v.capacity AS max_persons,
				 v.p_low AS price_low_season,
				 v.p_high AS price_high_season
		  FROM `".DB_PREFIX."occupancy` AS `o`
		  LEFT JOIN `".DB_PREFIX."reserves` AS `r`
		  ON `o`.`id`=`r`.`id_occupancy`
		  LEFT JOIN `".DB_PREFIX."villas` AS `v`
		  ON `o`.`id_villa`=`v`.`id`
		  WHERE `o`.`starting`<'".$this->myesc($date)."' AND `o`.`ending`>'".$this->myesc($date)."' AND `r`.`status`='".$this->myesc($status)."' AND `v`.`able_r`=1  ORDER BY v.no ASC";	  
		return $this->query($sql);
	}
		
		
	public function inhouse_ckout($date, $beds){
		
		switch($beds){
			case 10:
					$sql="SELECT o.id AS busyid,
							 o.starting AS start,
							 o.ending AS end,
							 o.id_villa AS villa_id,
							 o.date AS date,
							 r.id AS reserveid,
							 r.ref AS ref,
							 r.id_client AS client,
							 r.qty_nights AS nights,
							 r.status AS status,
							 v.no AS villa_number,
							 v.type AS villa_type,
							 v.bed AS bedrooms,
							 v.ac AS air_conditioners,
							 v.bath AS bathrooms,
							 v.capacity AS max_persons,
							 v.p_low AS price_low_season,
							 v.p_high AS price_high_season
					  FROM `".DB_PREFIX."occupancy` AS `o`
					  LEFT JOIN `".DB_PREFIX."reserves` AS `r`
					  ON `o`.`id`=`r`.`id_occupancy`
					  LEFT JOIN `".DB_PREFIX."villas` AS `v`
					  ON `o`.`id_villa`=`v`.`id`
					  WHERE `o`.`starting`<='".$this->myesc($date)."' AND `o`.`ending`='".$this->myesc($date)."' AND `r`.`status`<>0 AND `r`.`status`<>5 AND `r`.`status`<>50 AND `v`.`able_r`=1  ORDER BY v.no ASC";
					break;
			case 2:
					$sql="SELECT o.id AS busyid,
							 o.starting AS start,
							 o.ending AS end,
							 o.id_villa AS villa_id,
							 o.date AS date,
							 r.id AS reserveid,
							 r.ref AS ref,
							 r.id_client AS client,
							 r.qty_nights AS nights,
							 r.status AS status,
							 v.no AS villa_number,
							 v.type AS villa_type,
							 v.bed AS bedrooms,
							 v.ac AS air_conditioners,
							 v.bath AS bathrooms,
							 v.capacity AS max_persons,
							 v.p_low AS price_low_season,
							 v.p_high AS price_high_season
					  FROM `".DB_PREFIX."occupancy` AS `o`
					  LEFT JOIN `".DB_PREFIX."reserves` AS `r`
					  ON `o`.`id`=`r`.`id_occupancy`
					  LEFT JOIN `".DB_PREFIX."villas` AS `v`
					  ON `o`.`id_villa`=`v`.`id`
					  WHERE `o`.`starting`<='".$this->myesc($date)."' AND `o`.`ending`='".$this->myesc($date)."' AND `v`.`bed`='".$this->myesc($beds)."' AND `r`.`status`<>0 AND `r`.`status`<>5 AND `r`.`status`<>50 AND `v`.`able_r`=1  ORDER BY v.no ASC";
					break;
			case 3:
					$sql="SELECT o.id AS busyid,
							 o.starting AS start,
							 o.ending AS end,
							 o.id_villa AS villa_id,
							 o.date AS date,
							 r.id AS reserveid,
							 r.ref AS ref,
							 r.id_client AS client,
							 r.qty_nights AS nights,
							 r.status AS status,
							 v.no AS villa_number,
							 v.type AS villa_type,
							 v.bed AS bedrooms,
							 v.ac AS air_conditioners,
							 v.bath AS bathrooms,
							 v.capacity AS max_persons,
							 v.p_low AS price_low_season,
							 v.p_high AS price_high_season
					  FROM `".DB_PREFIX."occupancy` AS `o`
					  LEFT JOIN `".DB_PREFIX."reserves` AS `r`
					  ON `o`.`id`=`r`.`id_occupancy`
					  LEFT JOIN `".DB_PREFIX."villas` AS `v`
					  ON `o`.`id_villa`=`v`.`id`
					  WHERE `o`.`starting`<='".$this->myesc($date)."' AND `o`.`ending`='".$this->myesc($date)."' AND `v`.`bed`='".$this->myesc($beds)."' AND `r`.`status`<>0 AND `r`.`status`<>5 AND `r`.`status`<>50 AND `v`.`able_r`=1  ORDER BY v.no ASC";
					break;
			case 4:
					$sql="SELECT o.id AS busyid,
							 o.starting AS start,
							 o.ending AS end,
							 o.id_villa AS villa_id,
							 o.date AS date,
							 r.id AS reserveid,
							 r.ref AS ref,
							 r.id_client AS client,
							 r.qty_nights AS nights,
							 r.status AS status,
							 v.no AS villa_number,
							 v.type AS villa_type,
							 v.bed AS bedrooms,
							 v.ac AS air_conditioners,
							 v.bath AS bathrooms,
							 v.capacity AS max_persons,
							 v.p_low AS price_low_season,
							 v.p_high AS price_high_season
					  FROM `".DB_PREFIX."occupancy` AS `o`
					  LEFT JOIN `".DB_PREFIX."reserves` AS `r`
					  ON `o`.`id`=`r`.`id_occupancy`
					  LEFT JOIN `".DB_PREFIX."villas` AS `v`
					  ON `o`.`id_villa`=`v`.`id`
					  WHERE `o`.`starting`<='".$this->myesc($date)."' AND `o`.`ending`='".$this->myesc($date)."' AND `v`.`bed`='".$this->myesc($beds)."' AND `r`.`status`<>0 AND `r`.`status`<>5 AND `r`.`status`<>50 AND `v`.`able_r`=1  ORDER BY v.no ASC";
					break;
			case 5:
					$sql="SELECT o.id AS busyid,
							 o.starting AS start,
							 o.ending AS end,
							 o.id_villa AS villa_id,
							 o.date AS date,
							 r.id AS reserveid,
							 r.ref AS ref,
							 r.id_client AS client,
							 r.qty_nights AS nights,
							 r.status AS status,
							 v.no AS villa_number,
							 v.type AS villa_type,
							 v.bed AS bedrooms,
							 v.ac AS air_conditioners,
							 v.bath AS bathrooms,
							 v.capacity AS max_persons,
							 v.p_low AS price_low_season,
							 v.p_high AS price_high_season
					  FROM `".DB_PREFIX."occupancy` AS `o`
					  LEFT JOIN `".DB_PREFIX."reserves` AS `r`
					  ON `o`.`id`=`r`.`id_occupancy`
					  LEFT JOIN `".DB_PREFIX."villas` AS `v`
					  ON `o`.`id_villa`=`v`.`id`
					  WHERE `o`.`starting`<='".$this->myesc($date)."' AND `o`.`ending`='".$this->myesc($date)."' AND `v`.`bed`='".$this->myesc($beds)."' AND `r`.`status`<>0 AND `r`.`status`<>5 AND `r`.`status`<>50 AND `v`.`able_r`=1  ORDER BY v.no ASC";
					break;
			case 6:
					$sql="SELECT o.id AS busyid,
							 o.starting AS start,
							 o.ending AS end,
							 o.id_villa AS villa_id,
							 o.date AS date,
							 r.id AS reserveid,
							 r.ref AS ref,
							 r.id_client AS client,
							 r.qty_nights AS nights,
							 r.status AS status,
							 v.no AS villa_number,
							 v.type AS villa_type,
							 v.bed AS bedrooms,
							 v.ac AS air_conditioners,
							 v.bath AS bathrooms,
							 v.capacity AS max_persons,
							 v.p_low AS price_low_season,
							 v.p_high AS price_high_season
					  FROM `".DB_PREFIX."occupancy` AS `o`
					  LEFT JOIN `".DB_PREFIX."reserves` AS `r`
					  ON `o`.`id`=`r`.`id_occupancy`
					  LEFT JOIN `".DB_PREFIX."villas` AS `v`
					  ON `o`.`id_villa`=`v`.`id`
					  WHERE `o`.`starting`<='".$this->myesc($date)."' AND `o`.`ending`='".$this->myesc($date)."' AND `v`.`bed`='".$this->myesc($beds)."' AND `r`.`status`<>0 AND `r`.`status`<>5 AND `r`.`status`<>50 AND `v`.`able_r`=1  ORDER BY v.no ASC";
					break;
			default:
					$sql="SELECT o.id AS busyid,
							 o.starting AS start,
							 o.ending AS end,
							 o.id_villa AS villa_id,
							 o.date AS date,
							 r.id AS reserveid,
							 r.ref AS ref,
							 r.id_client AS client,
							 r.qty_nights AS nights,
							 r.status AS status,
							 v.no AS villa_number,
							 v.type AS villa_type,
							 v.bed AS bedrooms,
							 v.ac AS air_conditioners,
							 v.bath AS bathrooms,
							 v.capacity AS max_persons,
							 v.p_low AS price_low_season,
							 v.p_high AS price_high_season
					  FROM `".DB_PREFIX."occupancy` AS `o`
					  LEFT JOIN `".DB_PREFIX."reserves` AS `r`
					  ON `o`.`id`=`r`.`id_occupancy`
					  LEFT JOIN `".DB_PREFIX."villas` AS `v`
					  ON `o`.`id_villa`=`v`.`id`
					  WHERE `o`.`starting`<='".$this->myesc($date)."' AND `o`.`ending`='".$this->myesc($date)."' AND `r`.`status`<>0 AND `r`.`status`<>5 AND `r`.`status`<>50 AND `v`.`able_r`=1  ORDER BY v.no ASC";
		}
		return $this->query($sql);
	}
	
	
	public function inhouse_arrivals($date, $beds){
		
		switch($beds){
			case 10:
					$sql="SELECT o.id AS busyid,
							 o.starting AS start,
							 o.ending AS end,
							 o.id_villa AS villa_id,
							 o.date AS date,
							 r.id AS reserveid,
							 r.ref AS ref,
							 r.id_client AS client,
							 r.qty_nights AS nights,
							 r.status AS status,
							 v.no AS villa_number,
							 v.type AS villa_type,
							 v.bed AS bedrooms,
							 v.ac AS air_conditioners,
							 v.bath AS bathrooms,
							 v.capacity AS max_persons,
							 v.p_low AS price_low_season,
							 v.p_high AS price_high_season
					  FROM `".DB_PREFIX."occupancy` AS `o`
					  LEFT JOIN `".DB_PREFIX."reserves` AS `r`
					  ON `o`.`id`=`r`.`id_occupancy`
					  LEFT JOIN `".DB_PREFIX."villas` AS `v`
					  ON `o`.`id_villa`=`v`.`id`
					  WHERE `o`.`starting`='".$this->myesc($date)."' AND `o`.`ending`>'".$this->myesc($date)."' AND `r`.`status`<>0 AND `r`.`status`<>5 AND `r`.`status`<>50 AND `v`.`able_r`=1  ORDER BY v.no ASC";
					break;
			case 2:
					$sql="SELECT o.id AS busyid,
							 o.starting AS start,
							 o.ending AS end,
							 o.id_villa AS villa_id,
							 o.date AS date,
							 r.id AS reserveid,
							 r.ref AS ref,
							 r.id_client AS client,
							 r.qty_nights AS nights,
							 r.status AS status,
							 v.no AS villa_number,
							 v.type AS villa_type,
							 v.bed AS bedrooms,
							 v.ac AS air_conditioners,
							 v.bath AS bathrooms,
							 v.capacity AS max_persons,
							 v.p_low AS price_low_season,
							 v.p_high AS price_high_season
					  FROM `".DB_PREFIX."occupancy` AS `o`
					  LEFT JOIN `".DB_PREFIX."reserves` AS `r`
					  ON `o`.`id`=`r`.`id_occupancy`
					  LEFT JOIN `".DB_PREFIX."villas` AS `v`
					  ON `o`.`id_villa`=`v`.`id`
					  WHERE `o`.`starting`='".$this->myesc($date)."' AND `o`.`ending`>'".$this->myesc($date)."' AND `v`.`bed`='".$this->myesc($beds)."' AND `r`.`status`<>0 AND `r`.`status`<>5 AND `r`.`status`<>50 AND `v`.`able_r`=1  ORDER BY v.no ASC";
					break;
			case 3:
					$sql="SELECT o.id AS busyid,
							 o.starting AS start,
							 o.ending AS end,
							 o.id_villa AS villa_id,
							 o.date AS date,
							 r.id AS reserveid,
							 r.ref AS ref,
							 r.id_client AS client,
							 r.qty_nights AS nights,
							 r.status AS status,
							 v.no AS villa_number,
							 v.type AS villa_type,
							 v.bed AS bedrooms,
							 v.ac AS air_conditioners,
							 v.bath AS bathrooms,
							 v.capacity AS max_persons,
							 v.p_low AS price_low_season,
							 v.p_high AS price_high_season
					  FROM `".DB_PREFIX."occupancy` AS `o`
					  LEFT JOIN `".DB_PREFIX."reserves` AS `r`
					  ON `o`.`id`=`r`.`id_occupancy`
					  LEFT JOIN `".DB_PREFIX."villas` AS `v`
					  ON `o`.`id_villa`=`v`.`id`
					  WHERE `o`.`starting`='".$this->myesc($date)."' AND `o`.`ending`>'".$this->myesc($date)."' AND `v`.`bed`='".$this->myesc($beds)."' AND `r`.`status`<>0 AND `r`.`status`<>5 AND `r`.`status`<>50 AND `v`.`able_r`=1  ORDER BY v.no ASC";
					break;
			case 4:
					$sql="SELECT o.id AS busyid,
							 o.starting AS start,
							 o.ending AS end,
							 o.id_villa AS villa_id,
							 o.date AS date,
							 r.id AS reserveid,
							 r.ref AS ref,
							 r.id_client AS client,
							 r.qty_nights AS nights,
							 r.status AS status,
							 v.no AS villa_number,
							 v.type AS villa_type,
							 v.bed AS bedrooms,
							 v.ac AS air_conditioners,
							 v.bath AS bathrooms,
							 v.capacity AS max_persons,
							 v.p_low AS price_low_season,
							 v.p_high AS price_high_season
					  FROM `".DB_PREFIX."occupancy` AS `o`
					  LEFT JOIN `".DB_PREFIX."reserves` AS `r`
					  ON `o`.`id`=`r`.`id_occupancy`
					  LEFT JOIN `".DB_PREFIX."villas` AS `v`
					  ON `o`.`id_villa`=`v`.`id`
					  WHERE `o`.`starting`='".$this->myesc($date)."' AND `o`.`ending`>'".$this->myesc($date)."' AND `v`.`bed`='".$this->myesc($beds)."' AND `r`.`status`<>0 AND `r`.`status`<>5 AND `r`.`status`<>50 AND `v`.`able_r`=1  ORDER BY v.no ASC";
					break;
			case 5:
					$sql="SELECT o.id AS busyid,
							 o.starting AS start,
							 o.ending AS end,
							 o.id_villa AS villa_id,
							 o.date AS date,
							 r.id AS reserveid,
							 r.ref AS ref,
							 r.id_client AS client,
							 r.qty_nights AS nights,
							 r.status AS status,
							 v.no AS villa_number,
							 v.type AS villa_type,
							 v.bed AS bedrooms,
							 v.ac AS air_conditioners,
							 v.bath AS bathrooms,
							 v.capacity AS max_persons,
							 v.p_low AS price_low_season,
							 v.p_high AS price_high_season
					  FROM `".DB_PREFIX."occupancy` AS `o`
					  LEFT JOIN `".DB_PREFIX."reserves` AS `r`
					  ON `o`.`id`=`r`.`id_occupancy`
					  LEFT JOIN `".DB_PREFIX."villas` AS `v`
					  ON `o`.`id_villa`=`v`.`id`
					  WHERE `o`.`starting`='".$this->myesc($date)."' AND `o`.`ending`>'".$this->myesc($date)."' AND `v`.`bed`='".$this->myesc($beds)."' AND `r`.`status`<>0 AND `r`.`status`<>5 AND `r`.`status`<>50 AND `v`.`able_r`=1  ORDER BY v.no ASC";
					break;
			case 6:
					$sql="SELECT o.id AS busyid,
							 o.starting AS start,
							 o.ending AS end,
							 o.id_villa AS villa_id,
							 o.date AS date,
							 r.id AS reserveid,
							 r.ref AS ref,
							 r.id_client AS client,
							 r.qty_nights AS nights,
							 r.status AS status,
							 v.no AS villa_number,
							 v.type AS villa_type,
							 v.bed AS bedrooms,
							 v.ac AS air_conditioners,
							 v.bath AS bathrooms,
							 v.capacity AS max_persons,
							 v.p_low AS price_low_season,
							 v.p_high AS price_high_season
					  FROM `".DB_PREFIX."occupancy` AS `o`
					  LEFT JOIN `".DB_PREFIX."reserves` AS `r`
					  ON `o`.`id`=`r`.`id_occupancy`
					  LEFT JOIN `".DB_PREFIX."villas` AS `v`
					  ON `o`.`id_villa`=`v`.`id`
					  WHERE `o`.`starting`='".$this->myesc($date)."' AND `o`.`ending`>'".$this->myesc($date)."' AND `v`.`bed`='".$this->myesc($beds)."' AND `r`.`status`<>0 AND `r`.`status`<>5 AND `r`.`status`<>50 AND `v`.`able_r`=1  ORDER BY v.no ASC";
					break;
			default:
					$sql="SELECT o.id AS busyid,
							 o.starting AS start,
							 o.ending AS end,
							 o.id_villa AS villa_id,
							 o.date AS date,
							 r.id AS reserveid,
							 r.ref AS ref,
							 r.id_client AS client,
							 r.qty_nights AS nights,
							 r.status AS status,
							 v.no AS villa_number,
							 v.type AS villa_type,
							 v.bed AS bedrooms,
							 v.ac AS air_conditioners,
							 v.bath AS bathrooms,
							 v.capacity AS max_persons,
							 v.p_low AS price_low_season,
							 v.p_high AS price_high_season
					  FROM `".DB_PREFIX."occupancy` AS `o`
					  LEFT JOIN `".DB_PREFIX."reserves` AS `r`
					  ON `o`.`id`=`r`.`id_occupancy`
					  LEFT JOIN `".DB_PREFIX."villas` AS `v`
					  ON `o`.`id_villa`=`v`.`id`
					  WHERE `o`.`starting`='".$this->myesc($date)."' AND `o`.`ending`>'".$this->myesc($date)."' AND `r`.`status`<>0 AND `r`.`status`<>5 AND `r`.`status`<>50 AND `v`.`able_r`=1  ORDER BY v.no ASC";
		}
		return $this->query($sql);
	}
	
	
	public function inhouse_stayover($date, $beds){
		
		switch($beds){
			case 10:
					$sql="SELECT o.id AS busyid,
							 o.starting AS start,
							 o.ending AS end,
							 o.id_villa AS villa_id,
							 o.date AS date,
							 r.id AS reserveid,
							 r.ref AS ref,
							 r.id_client AS client,
							 r.qty_nights AS nights,
							 r.status AS status,
							 v.no AS villa_number,
							 v.type AS villa_type,
							 v.bed AS bedrooms,
							 v.ac AS air_conditioners,
							 v.bath AS bathrooms,
							 v.capacity AS max_persons,
							 v.p_low AS price_low_season,
							 v.p_high AS price_high_season
					  FROM `".DB_PREFIX."occupancy` AS `o`
					  LEFT JOIN `".DB_PREFIX."reserves` AS `r`
					  ON `o`.`id`=`r`.`id_occupancy`
					  LEFT JOIN `".DB_PREFIX."villas` AS `v`
					  ON `o`.`id_villa`=`v`.`id`
					  WHERE `o`.`starting`<'".$this->myesc($date)."' AND `o`.`ending`>'".$this->myesc($date)."' AND `r`.`status`<>0 AND `r`.`status`<>5 AND `r`.`status`<>50 AND `v`.`able_r`=1  ORDER BY v.no ASC";
					break;
			case 2:
					$sql="SELECT o.id AS busyid,
							 o.starting AS start,
							 o.ending AS end,
							 o.id_villa AS villa_id,
							 o.date AS date,
							 r.id AS reserveid,
							 r.ref AS ref,
							 r.id_client AS client,
							 r.qty_nights AS nights,
							 r.status AS status,
							 v.no AS villa_number,
							 v.type AS villa_type,
							 v.bed AS bedrooms,
							 v.ac AS air_conditioners,
							 v.bath AS bathrooms,
							 v.capacity AS max_persons,
							 v.p_low AS price_low_season,
							 v.p_high AS price_high_season
					  FROM `".DB_PREFIX."occupancy` AS `o`
					  LEFT JOIN `".DB_PREFIX."reserves` AS `r`
					  ON `o`.`id`=`r`.`id_occupancy`
					  LEFT JOIN `".DB_PREFIX."villas` AS `v`
					  ON `o`.`id_villa`=`v`.`id`
					  WHERE `o`.`starting`<'".$this->myesc($date)."' AND `o`.`ending`>'".$this->myesc($date)."' AND `v`.`bed`='".$this->myesc($beds)."' AND `r`.`status`<>0 AND `r`.`status`<>5 AND `r`.`status`<>50 AND `v`.`able_r`=1  ORDER BY v.no ASC";
					break;
			case 3:
					$sql="SELECT o.id AS busyid,
							 o.starting AS start,
							 o.ending AS end,
							 o.id_villa AS villa_id,
							 o.date AS date,
							 r.id AS reserveid,
							 r.ref AS ref,
							 r.id_client AS client,
							 r.qty_nights AS nights,
							 r.status AS status,
							 v.no AS villa_number,
							 v.type AS villa_type,
							 v.bed AS bedrooms,
							 v.ac AS air_conditioners,
							 v.bath AS bathrooms,
							 v.capacity AS max_persons,
							 v.p_low AS price_low_season,
							 v.p_high AS price_high_season
					  FROM `".DB_PREFIX."occupancy` AS `o`
					  LEFT JOIN `".DB_PREFIX."reserves` AS `r`
					  ON `o`.`id`=`r`.`id_occupancy`
					  LEFT JOIN `".DB_PREFIX."villas` AS `v`
					  ON `o`.`id_villa`=`v`.`id`
					  WHERE `o`.`starting`<'".$this->myesc($date)."' AND `o`.`ending`>'".$this->myesc($date)."' AND `v`.`bed`='".$this->myesc($beds)."' AND `r`.`status`<>0 AND `r`.`status`<>5 AND `r`.`status`<>50 AND `v`.`able_r`=1  ORDER BY v.no ASC";
					break;
			case 4:
					$sql="SELECT o.id AS busyid,
							 o.starting AS start,
							 o.ending AS end,
							 o.id_villa AS villa_id,
							 o.date AS date,
							 r.id AS reserveid,
							 r.ref AS ref,
							 r.id_client AS client,
							 r.qty_nights AS nights,
							 r.status AS status,
							 v.no AS villa_number,
							 v.type AS villa_type,
							 v.bed AS bedrooms,
							 v.ac AS air_conditioners,
							 v.bath AS bathrooms,
							 v.capacity AS max_persons,
							 v.p_low AS price_low_season,
							 v.p_high AS price_high_season
					  FROM `".DB_PREFIX."occupancy` AS `o`
					  LEFT JOIN `".DB_PREFIX."reserves` AS `r`
					  ON `o`.`id`=`r`.`id_occupancy`
					  LEFT JOIN `".DB_PREFIX."villas` AS `v`
					  ON `o`.`id_villa`=`v`.`id`
					  WHERE `o`.`starting`<'".$this->myesc($date)."' AND `o`.`ending`>'".$this->myesc($date)."' AND `v`.`bed`='".$this->myesc($beds)."' AND `r`.`status`<>0 AND `r`.`status`<>5 AND `r`.`status`<>50 AND `v`.`able_r`=1  ORDER BY v.no ASC";
					break;
			case 5:
					$sql="SELECT o.id AS busyid,
							 o.starting AS start,
							 o.ending AS end,
							 o.id_villa AS villa_id,
							 o.date AS date,
							 r.id AS reserveid,
							 r.ref AS ref,
							 r.id_client AS client,
							 r.qty_nights AS nights,
							 r.status AS status,
							 v.no AS villa_number,
							 v.type AS villa_type,
							 v.bed AS bedrooms,
							 v.ac AS air_conditioners,
							 v.bath AS bathrooms,
							 v.capacity AS max_persons,
							 v.p_low AS price_low_season,
							 v.p_high AS price_high_season
					  FROM `".DB_PREFIX."occupancy` AS `o`
					  LEFT JOIN `".DB_PREFIX."reserves` AS `r`
					  ON `o`.`id`=`r`.`id_occupancy`
					  LEFT JOIN `".DB_PREFIX."villas` AS `v`
					  ON `o`.`id_villa`=`v`.`id`
					  WHERE `o`.`starting`<'".$this->myesc($date)."' AND `o`.`ending`>'".$this->myesc($date)."' AND `v`.`bed`='".$this->myesc($beds)."' AND `r`.`status`<>0 AND `r`.`status`<>5 AND `r`.`status`<>50 AND `v`.`able_r`=1  ORDER BY v.no ASC";
					break;
			case 6:
					$sql="SELECT o.id AS busyid,
							 o.starting AS start,
							 o.ending AS end,
							 o.id_villa AS villa_id,
							 o.date AS date,
							 r.id AS reserveid,
							 r.ref AS ref,
							 r.id_client AS client,
							 r.qty_nights AS nights,
							 r.status AS status,
							 v.no AS villa_number,
							 v.type AS villa_type,
							 v.bed AS bedrooms,
							 v.ac AS air_conditioners,
							 v.bath AS bathrooms,
							 v.capacity AS max_persons,
							 v.p_low AS price_low_season,
							 v.p_high AS price_high_season
					  FROM `".DB_PREFIX."occupancy` AS `o`
					  LEFT JOIN `".DB_PREFIX."reserves` AS `r`
					  ON `o`.`id`=`r`.`id_occupancy`
					  LEFT JOIN `".DB_PREFIX."villas` AS `v`
					  ON `o`.`id_villa`=`v`.`id`
					  WHERE `o`.`starting`<'".$this->myesc($date)."' AND `o`.`ending`>'".$this->myesc($date)."' AND `v`.`bed`='".$this->myesc($beds)."' AND `r`.`status`<>0 AND `r`.`status`<>5 AND `r`.`status`<>50 AND `v`.`able_r`=1  ORDER BY v.no ASC";
					break;
			default:
					$sql="SELECT o.id AS busyid,
							 o.starting AS start,
							 o.ending AS end,
							 o.id_villa AS villa_id,
							 o.date AS date,
							 r.id AS reserveid,
							 r.ref AS ref,
							 r.id_client AS client,
							 r.qty_nights AS nights,
							 r.status AS status,
							 v.no AS villa_number,
							 v.type AS villa_type,
							 v.bed AS bedrooms,
							 v.ac AS air_conditioners,
							 v.bath AS bathrooms,
							 v.capacity AS max_persons,
							 v.p_low AS price_low_season,
							 v.p_high AS price_high_season
					  FROM `".DB_PREFIX."occupancy` AS `o`
					  LEFT JOIN `".DB_PREFIX."reserves` AS `r`
					  ON `o`.`id`=`r`.`id_occupancy`
					  LEFT JOIN `".DB_PREFIX."villas` AS `v`
					  ON `o`.`id_villa`=`v`.`id`
					  WHERE `o`.`starting`<'".$this->myesc($date)."' AND `o`.`ending`>'".$this->myesc($date)."' AND `r`.`status`<>0 AND `r`.`status`<>5 AND `r`.`status`<>50 AND `v`.`able_r`=1  ORDER BY v.no ASC";
		}
		return $this->query($sql);
	}
	
	public function electricity_housekeeping_fee($villa_id, $start_date, $end_date){//this will search as per criteria choosed.		  
		  $sql="SELECT o.id AS busyid,
							 o.starting AS start,
							 o.ending AS end,
							 o.id_villa AS villa_id,
							 o.date AS date,
							 r.id AS reserveid,
							 r.ref AS ref,
							 r.id_client AS client,
							 r.qty_nights AS nights,
							 r.status AS status,
							 v.no AS villa_number,
							 v.type AS villa_type,
							 v.bed AS bedrooms,
							 v.ac AS air_conditioners,
							 v.bath AS bathrooms,
							 v.capacity AS max_persons,
							 v.p_low AS price_low_season,
							 v.p_high AS price_high_season
					  FROM `".DB_PREFIX."occupancy` AS `o`
					  LEFT JOIN `".DB_PREFIX."reserves` AS `r`
					  ON `o`.`id`=`r`.`id_occupancy`
					  LEFT JOIN `".DB_PREFIX."villas` AS `v`
					  ON `o`.`id_villa`=`v`.`id`
					  WHERE `o`.`starting`>='".$this->myesc($start_date)."' AND `o`.`starting`<='".$this->myesc($end_date)."' AND `o`.`id_villa`='".$this->myesc($villa_id)."' AND `r`.`status`<>0 AND `r`.`status`<>5 AND `r`.`status`<>7 AND `r`.`status`<>8 AND `r`.`status`<>9 AND `r`.`status`<>10 AND `r`.`status`<>11 AND `r`.`status`<>15 AND `r`.`status`<>16 AND `r`.`status`<>17 AND `r`.`status`<>18 AND `r`.`status`<>19 AND `r`.`status`<>20 AND `r`.`status`<>21 AND `r`.`status`<>22 AND `r`.`status`<>23 AND `r`.`status`<>24 AND `r`.`status`<>25 AND `r`.`status`<>26 AND `r`.`status`<>27 AND `r`.`status`<>28 AND `r`.`status`<>29 AND `r`.`status`<>30 AND `r`.`status`<>31 AND `r`.`status`<>32 AND `r`.`status`<>33 AND `r`.`status`<>34 AND `r`.`status`<>35 AND `r`.`status`<>36 AND `r`.`status`<>37 AND `r`.`status`<>50 AND `v`.`able_r`=1  ORDER BY v.no ASC";
	$result=$this->query($sql);
   	return ($result);
	}
	
	public function renters_insurance_coverage($villa_id, $start_date, $end_date){//this will search as per criteria choosed.		  
		  $sql="SELECT o.id AS busyid,
							 o.starting AS start,
							 o.ending AS end,
							 o.id_villa AS villa_id,
							 o.date AS date,
							 r.id AS reserveid,
							 r.ref AS ref,
							 r.id_client AS client,
							 r.qty_nights AS nights,
							 r.status AS status,
							 v.no AS villa_number,
							 v.type AS villa_type,
							 v.bed AS bedrooms,
							 v.ac AS air_conditioners,
							 v.bath AS bathrooms,
							 v.capacity AS max_persons,
							 v.p_low AS price_low_season,
							 v.p_high AS price_high_season
					  FROM `".DB_PREFIX."occupancy` AS `o`
					  LEFT JOIN `".DB_PREFIX."reserves` AS `r`
					  ON `o`.`id`=`r`.`id_occupancy`
					  LEFT JOIN `".DB_PREFIX."villas` AS `v`
					  ON `o`.`id_villa`=`v`.`id`
					  WHERE `o`.`starting`>='".$this->myesc($start_date)."' AND `o`.`starting`<='".$this->myesc($end_date)."' AND `o`.`date`>='2017-04-01' AND `o`.`id_villa`='".$this->myesc($villa_id)."' AND `r`.`status`<>0 AND `r`.`status`<>5 AND `r`.`status`<>7 AND `r`.`status`<>8 AND `r`.`status`<>9 AND `r`.`status`<>10 AND `r`.`status`<>11 AND `r`.`status`<>15 AND `r`.`status`<>16 AND `r`.`status`<>17 AND `r`.`status`<>18 AND `r`.`status`<>19 AND `r`.`status`<>20 AND `r`.`status`<>21 AND `r`.`status`<>22 AND `r`.`status`<>23 AND `r`.`status`<>24 AND `r`.`status`<>25 AND `r`.`status`<>26 AND `r`.`status`<>27 AND `r`.`status`<>28 AND `r`.`status`<>29 AND `r`.`status`<>30 AND `r`.`status`<>31 AND `r`.`status`<>32 AND `r`.`status`<>33 AND `r`.`status`<>34 AND `r`.`status`<>35 AND `r`.`status`<>36 AND `r`.`status`<>37 AND `r`.`status`<>50 AND `v`.`able_r`=1  ORDER BY v.no ASC";
	$result=$this->query($sql);
   	return ($result);
	}
	
	public function display_rentals($beds,$start,$end){//MOSTRAR SOLO LOS HUESPEDES POR ESTE TIPO Y NO BORRADOS
		//$table='guests';
		//$this->myesc($table); 
		//$sql="SELECT * FROM `".DB_PREFIX.$table."` WHERE `".DB_PREFIX.$table."`.`tipo`='".$this->myesc($tipo)."' AND `".DB_PREFIX.$table."`.`deleted`='0' ORDER BY `".DB_PREFIX.$table."`.`id` DESC LIMIT $start , $end";
		//$result=$this->query($sql);
		
		if($beds==10){
			$sql="SELECT * FROM `".DB_PREFIX."villas` WHERE `able_r`=1 AND `vonline`=0 ORDER BY `no` ASC LIMIT $start , $end";
		}else{
			$sql="SELECT * FROM `".DB_PREFIX."villas` WHERE `able_r`=1 AND `vonline`=0 AND `bed`=".$this->myesc($beds)." ORDER BY `no` ASC LIMIT $start , $end";
		}
		$result=$this->query($sql);
	return ($result);
	}
	/*public function display_guests_count($tipo){//MOSTRAR contador de huespedes por tipos Y NO BORRADOS
		$table='guests';
		$this->myesc($table); $this->myesc($order);
		$sql="SELECT * FROM `".DB_PREFIX.$table."` WHERE `".DB_PREFIX.$table."`.`tipo`='".$this->myesc($tipo)."' AND `".DB_PREFIX.$table."`.`deleted`='0'";
		$result=$this->query($sql);
	return count($result);
	}*/
	/*public function villas_for_rent_online($beds){//$table -- for detail and will get any table.
		if($beds==10){
			$sql="SELECT * FROM `".DB_PREFIX."villas` WHERE `able_r`=1 AND `vonline`=0 ORDER BY `no` ASC";
		}else{
			$sql="SELECT * FROM `".DB_PREFIX."villas` WHERE `able_r`=1 AND `vonline`=0 AND `bed`=".$this->myesc($beds)." ORDER BY `no` ASC";
		}
		$result=$this->query($sql);
	return ($result);
	}*/
	public function services_contracted($villaid){//$table -- for detail and will get any table.
		$sql="SELECT * FROM `".DB_PREFIX."villa_services_contracted` WHERE `".DB_PREFIX."villa_services_contracted`.`villa_id`='".$this->myesc($villaid)."' LIMIT 1";
		$result=$this->query($sql);
		foreach($result AS $result)
		return ($result);
	}
	public function services_contracted_villas(){//$table -- for detail and will get any table.
		$sql="SELECT * FROM `".DB_PREFIX."villas` WHERE `".DB_PREFIX."villas`.`is_villa`='0' ORDER BY `no` ASC";
		$result=$this->query($sql);
		return ($result);
	}
	public function emaint($type){//$table -- for detail and will get any table.
		$sql="SELECT * FROM `".DB_PREFIX."emaint` WHERE `".DB_PREFIX."emaint`.`type`='".$this->myesc($type)."' ORDER BY `id` DESC LIMIT 300";
		$result=$this->query($sql);
		return ($result);
	}
	public function emaintvilla($no){//$table -- for detail and will get any table.
		$sql="SELECT * FROM `".DB_PREFIX."emaint` WHERE `".DB_PREFIX."emaint`.`villa` LIKE '".$this->myesc($no)."' ORDER BY `id` DESC";
		$result=$this->query($sql);
		return ($result);
	}
	public function location($villaid){//$table -- for detail and will get any table.
		$sql="SELECT * FROM `".DB_PREFIX."villas_location` WHERE `".DB_PREFIX."villas_location`.`villaid`='".$this->myesc($villaid)."' LIMIT 1";
		$result=$this->query($sql);
		foreach($result AS $result)
		return ($result);
	}
	
	public function tbuy($ref){
	    $sql="SELECT * FROM `".DB_PREFIX."trynbuy` WHERE `ref`='".$this->myesc($ref)."' LIMIT 1";
		$result=$this->query($sql);
	 	return $result[0];
	}
	
	  /* public function booking_unpaid($days){//this will search as per criteria choosed.
		$hoy=time();
		$hoy_menos15=$hoy-(86400*$days);//24 hours time quantities of days
		$fecha_comparar=date('Y-m-d',$hoy_menos15);
		$a_partir_de=date('Y-m-d', strtotime('2017-01-01'));
		
		$sql="SELECT busy.id AS busyid,
					 busy.starting AS start,
					 busy.ending AS end,                                             -
					 busy.type AS type,
					 busy.id_villa AS villa,
					 busy.id_adm AS adm,
					 busy.comment AS note,
					 busy.date AS date,
					 busy.id_update AS upd,
					 booked.id AS reserveid,
					 booked.ref AS ref,
					 booked.id_client AS client,
					 booked.adults AS adults,
					 booked.children AS kids,
					 booked.vehicles AS vehicles,
					 booked.id_interm AS interm,
					 booked.qty_nights AS nights,
					 booked.nightsHS AS NHS,
					 booked.nightsLS AS NLS,
					 booked.price_per_night AS ppn,
					 booked.priceHS AS PHS,
					 booked.commision AS apc,
					 booked.amount AS subtotal,
					 booked.tax AS itbis,
					 booked.services_amount AS aps,
					 booked.deposit AS dep,
					 booked.total AS total,
					 booked.status AS status,
					 booked.comment AS rc,
					 booked.pagos_qty AS PAYM,
					 booked.pagos_monto AS PMV,
					 booked.price_long AS PL,
					 booked.extra_nights AS EN,
					 booked.online AS line
			  FROM `".DB_PREFIX."occupancy` AS `busy`
			  LEFT JOIN `".DB_PREFIX."reserves` AS `booked`
			  ON `busy`.`id`=`booked`.`id_occupancy`
			  WHERE  `busy`.`date`>='".$a_partir_de." 00:00:00' AND `busy`.`date`<='".$this->myesc($fecha_comparar)."' AND `booked`.`status`<>'5' AND `booked`.`status`<>'0' AND `booked`.`deposit`='0' AND NOT EXISTS (SELECT * FROM `".DB_PREFIX."payments` WHERE `booked`.`ref` = `".DB_PREFIX."payments`.`ref`) LIMIT 100";
	return ($result);
	}*/
	public function booking_unpaid($days){//this will search as per criteria choosed.
		$hoy=time();
		$hoy_menos15=$hoy-(86400*$days);//24 hours time quantities of days
		$fecha_comparar=date('Y-m-d',$hoy_menos15);
		//$a_partir_de=date('Y-m-d', strtotime('2017-01-01'));
		
		$sql="SELECT busy.id AS busyid,
					 busy.starting AS start,
					 busy.ending AS end,                                             -
					 busy.type AS type,
					 busy.id_villa AS villa,
					 busy.id_adm AS adm,
					 busy.comment AS note,
					 busy.date AS date,
					 busy.id_update AS upd,
					 booked.id AS reserveid,
					 booked.ref AS ref,
					 booked.id_client AS client,
					 booked.adults AS adults,
					 booked.children AS kids,
					 booked.vehicles AS vehicles,
					 booked.id_interm AS interm,
					 booked.qty_nights AS nights,
					 booked.nightsHS AS NHS,
					 booked.nightsLS AS NLS,
					 booked.price_per_night AS ppn,
					 booked.priceHS AS PHS,
					 booked.commision AS apc,
					 booked.amount AS subtotal,
					 booked.tax AS itbis,
					 booked.services_amount AS aps,
					 booked.deposit AS dep,
					 booked.total AS total,
					 booked.status AS status,
					 booked.comment AS rc,
					 booked.pagos_qty AS PAYM,
					 booked.pagos_monto AS PMV,
					 booked.price_long AS PL,
					 booked.extra_nights AS EN,
					 booked.online AS line,
					 booked.id AS reservaid,
					 booked.paid AS paid
			  FROM `".DB_PREFIX."occupancy` AS `busy`
			  LEFT JOIN `".DB_PREFIX."reserves` AS `booked`
			  ON `busy`.`id`=`booked`.`id_occupancy`
			  WHERE DATE(`busy`.`date`)>='2017-01-01' AND DATE(`busy`.`date`)<='".$fecha_comparar."' AND `booked`.`status`<>'5' AND `booked`.`status`<>'0' AND `booked`.`status`<>'7' AND `booked`.`status`<>'19' AND `booked`.`status`<>'20' AND `booked`.`status`<>'21' AND `booked`.`status`<>'22' AND `booked`.`status`<>'23' AND `booked`.`status`<>'24' AND `booked`.`status`<>'25' AND `booked`.`deposit`='0' AND `booked`.`paid`='0' ORDER BY busy.starting ASC LIMIT 300";
		$result=$this->query($sql);
		
	return ($result);
	}
 }
 
?>