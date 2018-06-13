<?
 class Basededatos {

 	  //public $link;

     protected $link;

		  public function __construct(){
		  $this->link = new Database2;

		  }


	 	 public function checkUser($username,$password) {

			$query="SELECT *
					FROM `api_users`
					WHERE `username`='".$this->link->myesc($username)."' AND `password`='".$this->link->myesc($password)."'
					AND `active`=1 LIMIT 1
					";

			return $this->link->query($query);

		}

		public function checkToken($token) {
			$query="SELECT *
					FROM `api_users`
					WHERE `md5pass`='".$this->link->myesc($token)."' AND `active`=1 LIMIT 1
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


		function insert($info, $table) {
		   if (!is_array($info)) { die("insert member failed, info must be an array"); }
		      $sql = "INSERT INTO ".$table." (";
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
		      $sql = "INSERT INTO ".$table." (";
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
		      $sql = "UPDATE ".$table." SET ";
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

 }
?>