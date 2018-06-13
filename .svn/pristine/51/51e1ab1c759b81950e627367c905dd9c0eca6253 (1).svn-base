<?php
 class Consultas {
 		protected $link;

		  public function __construct(){
		  $this->link = new Database1;

		  }

		 function insert($info, $table) {
		   if (!is_array($info)) { die("insert member failed, info must be an array"); }
		      //build the query
		      $sql = "INSERT INTO ".DB_PREFIX1.$table." (";
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
		        $sql .= "'".current($info)."'";
		        if ($j < (count($info)-1)) {
		           $sql .= ", ";
		        } else $sql .= ") ";
		        next($info);
		     }

		   return $this->link->execute($sql);
		 }
        /*---------------------------------------------------------------------------------------------------*/
		 function insert_id($info, $table) {
		   if (!is_array($info)) { die("insert member failed, info must be an array"); }
		      //build the query
		      $sql = "INSERT INTO ".DB_PREFIX1.$table." (";
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
		      $sql = "UPDATE ".DB_PREFIX1.$table." SET ";
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

		public function make_def_done($id){
			$sql="UPDATE `".DB_PREFIX1."deficiencies` SET  `status`='2' WHERE id='".$id."' LIMIT 1";
		return $this->link->execute($sql);
		}

		public function consulta($table){
			$sql="SELECT * FROM `".DB_PREFIX1.$table."` ORDER BY `id` ASC ";
		return $this->link->query($sql);
		}

		public function consulta_v($table){
			$sql="SELECT * FROM `".DB_PREFIX1.$table."` ORDER BY `id_villa` ASC ";
		return $this->link->query($sql);
		}

		public function consulta_def(){
			$sql="SELECT * FROM `".DB_PREFIX1."deficiencies` ORDER BY `id_villa` ASC ";
		return $this->link->query($sql);
		}

		public function consulta_def_undone(){
			$sql="SELECT * FROM `".DB_PREFIX1."deficiencies` WHERE `status`='1' ORDER BY `id_villa` ASC ";
		return $this->link->query($sql);
		}
        public function consulta_def_done(){
			$sql="SELECT * FROM `".DB_PREFIX1."deficiencies` WHERE `status`='2' ORDER BY `id_villa` ASC ";
		return $this->link->query($sql);
		}

		public function consulta_user($table,$id_user){
			$sql="SELECT * FROM `".DB_PREFIX1.$table."` WHERE `user_id`='".$id_user."' ORDER BY `id` ASC ";
		return $this->link->query($sql);
		}

		public function consulta_activos($table){
			$sql="SELECT * FROM `".DB_PREFIX1.$table."` WHERE `active`=1 ORDER BY `id` ASC ";
		return $this->link->query($sql);
		}

		public function consulta_villas(){
			$sql="SELECT * FROM `".DB_PREFIX1."villa` WHERE `active`=1 ORDER BY (`no`+0) ASC ";
		return $this->link->query($sql);
		}

		public function borrar($id, $table){
			$sql="DELETE FROM `".DB_PREFIX1.$table."` WHERE `id`='".$id."' LIMIT 1";
		return $this->link->execute($sql);
		}

		public function get_one($table){
				$sql="SELECT * FROM `".DB_PREFIX1.$table."` LIMIT 1";
		        $result= $this->link->query($sql);
		return  $result[0];
		}

		public function get_id($id, $table){
				$sql="SELECT * FROM `".DB_PREFIX1.$table."` WHERE `id`='".$this->link->myesc($id)."' LIMIT 1";
		        $result= $this->link->query($sql);
		return  $result[0];
		}


   public function showTable_r($table, $field, $value, $operator){//$table -- for detail and will get any table.
    $table=$this->link->myesc($table); $field=$this->link->myesc($field); $value=$this->link->myesc($value);
	$sql="SELECT * FROM `".DB_PREFIX1.$table."` WHERE `".DB_PREFIX1.$table."`.`".$field."`".$operator."'".$value."' ORDER BY `".DB_PREFIX1.$table."`.`id` ASC";
	$result=$this->link->query($sql);

	return ($result);
   }

   public function SeeTable($table, $condition_sql, $order_field, $order_type){//$table -- for detail and will get any table.
    $table=$this->link->myesc($table);
	$sql="SELECT * FROM `".DB_PREFIX1.$table."` WHERE ".$condition_sql." ORDER BY ".$order_field." ".$order_type;
	$result=$this->link->query($sql);

	return ($result);
   }

    public function Maximo($table, $field){//$table -- for detail and will get any table.
    $table=$this->link->myesc($table);
	$sql="SELECT MAX(".$field.") AS ".$field." FROM `".DB_PREFIX1.$table."`";
	$result=$this->link->query($sql);

	return ($result);
   }

	public function checkUser($username,$password) {

		$query="SELECT *
					FROM `".DB_PREFIX1."users`
					WHERE `user`='".$this->link->myesc($username)."' AND `pass`='".$this->link->myesc($password)."'
					AND `active`=1 LIMIT 1
					";

       $authed=$this->link->query($query);
       foreach ($authed as $authed) //to avoid say array possition zero
	return($authed['id']);
	}

	public function getUserDetails($userid) {
			   //$this->link->myesc($userid);
		$query="SELECT *
					FROM `".DB_PREFIX1."users`
					WHERE id='".$this->link->myesc($userid)."'
					LIMIT 1
					";
		$userDetails=$this->link->query($query);      //$link->myesc($userid)
		foreach ($userDetails as $userDetails)
	return($userDetails);
	}
  }/*end class here*/
 //================================================================================================================
 function get_next_id($tablename){
  	$link = mysql_connect(SERVER1, USER1, PASS1);
  	//$link = mysql_connect( "localhost", "root", "7838332" );
	mysql_select_db(DB1);
	$next_increment = 0;
	$qShowStatus = "SHOW TABLE STATUS LIKE '".DB_PREFIX1.$tablename."'";
	$qShowStatusResult = mysql_query($qShowStatus) or die ( "Query failed: " . mysql_error() . "<br/>" . $qShowStatus );

	$row = mysql_fetch_assoc($qShowStatusResult);
	$next_increment = $row['Auto_increment'];
	mysql_close( $link );
	//echo "next increment number: [$next_increment]";

 	return $next_increment;
 }


?>