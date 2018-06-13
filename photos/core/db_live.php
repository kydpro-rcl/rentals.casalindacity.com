<?php
class DB{
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
	
	function getHighestID(){
		$query = $this->db->query("SELECT * FROM ".$this->imgTbl." ORDER BY id DESC LIMIT 0, 1");
		if($query->num_rows > 0){
			while($row = $query->fetch_assoc()){
				$result[] = $row;
			}
		}else{
			$result = FALSE;
		}
		return $result[0]['id'];
	}
	
	function updateOrder($id_array, $villa_id){
		$count = 1;
		foreach ($id_array as $id){
			$update = $this->db->query("UPDATE ".$this->imgTbl." SET img_order = $count WHERE id = $id");
			$count ++;	
		}
		return TRUE;
	}
	
	function uploadPicture($filename, $order, $villa_id){
			$date=date("Y-m-d G:i:s");
			$update = $this->db->query("INSERT INTO ".$this->imgTbl." (`id`, `img_name`, `img_order`, `created`, `modified`, `status`, `active`, `villa_id`, `img_descrip`, `size_mb`, `width`, `height`) VALUES (NULL, '".$filename."', '".$order."', '".$date."', '', '1', '1', '".$villa_id."', '', '', '', '')");
		return TRUE;
	}
	
	function deletePicture($pic_id){
			$update = $this->db->query("DELETE FROM ".$this->imgTbl." WHERE `id` = '".$pic_id."' LIMIT 1");
		return TRUE;
	}
	
}
?>