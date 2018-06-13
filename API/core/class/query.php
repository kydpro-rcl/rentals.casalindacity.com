<?
 class Consultas extends Database2{
	 
	
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
	
	
 }
 
?>