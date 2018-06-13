<?php
//include database class
	//include_once 'core/db.php';
	class Basededatos2{
		//database configuration
		private $dbHost     = "localhost";
		private $dbUsername = "casalind_rcl2015";
		private $dbPassword = "7838332";
		private $dbName     = "casalind_casalindacity_reservations";
		private $imgTbl     = 'images';
		
		function __construct(){
			if(!isset($this->db)){
				// Connect to the database
				$conn = new mysqli($this->dbHost, $this->dbUsername, $this->dbPassword, $this->dbName);
				if($conn->connect_error){
					die("Failed to connect with MySQL: " . $conn->connect_error);
				}else{
					$this->db = $conn;
				}
			}
		}
		
		function getRows($villa_id){
			$query = $this->db->query("SELECT * FROM ".$this->imgTbl." WHERE villa_id = $villa_id  ORDER BY img_order ASC");
			if($query->num_rows > 0){
				while($row = $query->fetch_assoc()){
					$result[] = $row;
				}
			}else{
				$result = FALSE;
			}
			return $result;
		}
	}	
	function qty_pics($villaid){
		$db = new Basededatos2();
		//Fetch all images from database
		$imagesqty=$db->getRows($villaid);
		(!empty($imagesqty)) ? $images = count($imagesqty) : $images =0;
	
		return $images;
	}
?>