<?
//$link->connector(SERVER,USER,PASS,DB);

 class DATA {
     protected $link;

		  public function __construct(){
		  $this->link = new BasedeDatos;

		  }

		  public function insert_statement($id_villa, $fecha, $mes, $ano, $tipoarch, $statement, $electricity, $subdivision, $services, $adm){
		  	$id_villa=$this->link->myesc($id_villa);
		  	$fecha=$this->link->myesc($fecha);
		  	$mes=$this->link->myesc($mes);
		  	$ano=$this->link->myesc($ano);
		  	$tipoarch=$this->link->myesc($tipoarch);
		  	$statement=$this->link->myesc($statement);
		  	$electricity=$this->link->myesc($electricity);
		  	$subdivision=$this->link->myesc($subdivision);
			$services=$this->link->myesc($services);
		  	$adm=$this->link->myesc($adm);

            $query="INSERT INTO `".DB_PREFIX1."statements` (`id` ,
															`id_villa` ,
															`fecha` ,
															`month` ,
															`year` ,
															`filetype` ,
															`archivo` ,
															`electricity` ,
															`subdivition` ,
															`services` ,
															`id_admin`)
 					VALUES ( NULL ,'".$id_villa."','".$fecha."','".$mes."','".$ano."','".$tipoarch."','".$statement."','".$electricity."','".$subdivision."','".$services."','".$adm."')";
           return  $this->link->execute($query);
		  }


		public function update_statement($id, $id_villa, $fecha, $mes, $ano, $tipoarch, $statement, $electricity, $subdivision, $services, $adm) {

           $id_villa=$this->link->myesc($id_villa);
		  	$fecha=$this->link->myesc($fecha);
		  	$mes=$this->link->myesc($mes);
		  	$ano=$this->link->myesc($ano);
		  	$tipoarch=$this->link->myesc($tipoarch);
		  	$statement=$this->link->myesc($statement);
		  	$electricity=$this->link->myesc($electricity);
		  	$subdivision=$this->link->myesc($subdivision);
			$services=$this->link->myesc($services);
		  	$adm=$this->link->myesc($adm);

				$query="UPDATE `".DB_PREFIX1."statements` SET
								`id_villa`='".$id_villa."',
	                             `fecha`='".$fecha."',
	                             `month`='".$mes."',
	                             `year`='".$ano."',
	                             `filetype`='".$tipoarch."',
	                             `archivo`='".$statement."',
	                             `electricity`='".$electricity."',
	                             `subdivition`='".$subdivision."',
								 `services`='".$services."',
	                             `id_admin`='".$adm."'
		 					WHERE `id`='".$this->link->myesc($id)."' LIMIT 1";
				return $this->link->execute($query);
		}
		
		public function delete_single_file($id, $file) {
		
         switch($file){
			 case 1: //estado
				$query="UPDATE `".DB_PREFIX1."statements` SET `archivo`='' WHERE `id`='".$this->link->myesc($id)."' LIMIT 1";
				break;
			 case 2: //electricidad
				$query="UPDATE `".DB_PREFIX1."statements` SET `electricity`='' WHERE `id`='".$this->link->myesc($id)."' LIMIT 1";
				break;
			 case 3: //sub-division
				$query="UPDATE `".DB_PREFIX1."statements` SET `subdivition`='' WHERE `id`='".$this->link->myesc($id)."' LIMIT 1";
				break;
			 case 4: //services
				$query="UPDATE `".DB_PREFIX1."statements` SET `services`='' WHERE `id`='".$this->link->myesc($id)."' LIMIT 1";
				break;
			 default:
				$query="UPDATE `".DB_PREFIX1."statements` SET `archivo`='', `electricity`='', `subdivition`='', `services`='' WHERE `id`='".$this->link->myesc($id)."' LIMIT 1";
		 }
				return $this->link->execute($query);
		}

		public function borrar($id, $table){
			$sql="DELETE FROM `".DB_PREFIX1.$table."` WHERE `id`='".$id."' LIMIT 1";
		return $this->link->execute($sql);
		}
		public function borrar_todos($table, $campo, $valor){
			$sql="DELETE FROM `".DB_PREFIX1.$table."` WHERE `".$campo."`='".$valor."'";
		return $this->link->execute($sql);
		}
	///======================= ONLY QUERIES BELOW ====================================================================================================
		public function check_uploaded($villa, $mes, $year) {
			$query="SELECT * FROM `".DB_PREFIX1."statements` WHERE `id_villa`='".$this->link->myesc($villa)."' AND `month`='".$this->link->myesc($mes)."' AND `year`='".$this->link->myesc($year)."' ORDER BY `id` ASC";
		 return $this->link->query($query);
		}

		public function check_uploaded_noid($id, $villa, $mes, $year) {
			$query="SELECT * FROM `".DB_PREFIX1."statements` WHERE `id_villa`='".$this->link->myesc($villa)."' AND `month`='".$this->link->myesc($mes)."' AND `year`='".$this->link->myesc($year)."'  AND `id`<>'".$this->link->myesc($id)."' ORDER BY `id` ASC";
		 return $this->link->query($query);
		}

		public function uploaded_mes_ano($mes, $year) {
			$query="SELECT * FROM `".DB_PREFIX1."statements` WHERE `month`='".$this->link->myesc($mes)."' AND `year`='".$this->link->myesc($year)."' ORDER BY `id` ASC";
		 return $this->link->query($query);
		}
       /*
		public function all_uploaded(){

			$query="SELECT * FROM `".DB_PREFIX1."statements` ORDER BY `id` ASC";
		 return $this->link->query($query);
		}
             */
		//-----------------search statements-----------------------------------------
		public function search_uploaded($villa, $mes, $year) {
             $consulta='';
  			 if($villa!='all'){
               $consulta="WHERE `id_villa`='".$this->link->myesc($villa)."' ";
             }
             if($mes!=0){
                if ($consulta!=''){
                	$consulta.="AND `month`='".$this->link->myesc($mes)."' ";
                }else{
                    $consulta="WHERE `month`='".$this->link->myesc($mes)."' ";
                }
             }
             if($year!='all'){
                if ($consulta!=''){
                	$consulta.="AND `year`='".$this->link->myesc($year)."' ";
                }else{
                    $consulta="WHERE `year`='".$this->link->myesc($year)."' ";
                }
             }
			$query="SELECT * FROM `".DB_PREFIX1."statements` ".$consulta." ORDER BY `month` ASC";
		 return $this->link->query($query);
		}
		//------------get detail for and id statement---------------
		public function statement_id($id) {

			$query="SELECT * FROM `".DB_PREFIX1."statements` WHERE `id`='".$this->link->myesc($id)."' LIMIT 1";
		    $result=$this->link->query($query);
		    foreach($result AS $result)

		 return $result;
		}

		public function search_actual_balance($villaid, $year) {
         //  CAST(`pic_number` AS SIGNED)
		//$query="SELECT * FROM `".DB_PREFIX1."statements` WHERE `id_villa`='".$this->link->myesc($villaid)."' AND `year`=(SELECT MAX(`year`)) AND `month`=(SELECT MAX(CAST(`month` AS SIGNED))) ";

		//$query="SELECT * FROM `".DB_PREFIX1."statements` WHERE `id_villa`='".$this->link->myesc($villaid)."' AND `year`=(SELECT MAX(`year`) FROM `".DB_PREFIX1."statements`) ORDER BY CAST(`month` AS SIGNED) DESC LIMIT 1";
		$query="SELECT * FROM `".DB_PREFIX1."statements` WHERE `id_villa`='".$this->link->myesc($villaid)."' AND `year`='".$this->link->myesc($year)."' ORDER BY CAST(`month` AS SIGNED) DESC LIMIT 1";

		// $query="SELECT MAX(`year`) AS ano FROM `".DB_PREFIX1."statements` WHERE `id_villa`='".$this->link->myesc($villaid)."'";

		 $result=$this->link->query($query);
		 foreach($result AS $result)
		 return $result;
		}

		public function get_lastet_year($villaid) {  //to get the last year of any statement uploaded

		 $query="SELECT MAX(`year`) AS ano FROM `".DB_PREFIX1."statements` WHERE `id_villa`='".$this->link->myesc($villaid)."'";

		 $result=$this->link->query($query);
		 foreach($result AS $result)
		 return $result;
		}

		//-----------------search statements-----------------------------------------
		public function search_uploaded_sort($villa, $mes, $year, $sort) {
             $consulta='';
  			 if($villa!='all'){
               $consulta="WHERE `id_villa`='".$this->link->myesc($villa)."' ";
             }
             if($mes!=0){
                if ($consulta!=''){
                	$consulta.="AND `month`='".$this->link->myesc($mes)."' ";
                }else{
                    $consulta="WHERE `month`='".$this->link->myesc($mes)."' ";
                }
             }
             if($year!='all'){
                if ($consulta!=''){
                	$consulta.="AND `year`='".$this->link->myesc($year)."' ";
                }else{
                    $consulta="WHERE `year`='".$this->link->myesc($year)."' ";
                }
             }
			$query="SELECT * FROM `".DB_PREFIX1."statements` ".$consulta." ORDER BY `".$this->link->myesc($sort)."` ASC";
		 return $this->link->query($query);
		}
		//------------get detail for and id statement---------------

		//================================================================================================================================
		 public function insert_news($fecha, $mes, $thumb, $link, $adm){

		  	$fecha=$this->link->myesc($fecha);
		  	$mes=$this->link->myesc($mes);
		  	$ano=$this->link->myesc($thumb);
		  	$tipoarch=$this->link->myesc($link);
		  	$adm=$this->link->myesc($adm);

            $query="INSERT INTO `".DB_PREFIX1."statements` (`id` ,
															`fecha` ,
															`mes` ,
															`thumb` ,
															`link` ,
															`id_admin`)
 					VALUES ( NULL ,'".$fecha."','".$mes."','".$thumb."','".$link."','".$adm."')";
           return  $this->link->execute($query);
		  }

		public function insert_msg($fecha, $fr_name, $fr_email, $villa, $to, $subject, $msg, $ip){

		  	$fecha=$this->link->myesc($fecha);
		  	$fr_name=$this->link->myesc($fr_name);
		  	$fr_email=$this->link->myesc($fr_email);
		  	$villa=$this->link->myesc($villa);
		  	$to=$this->link->myesc($to);
		  	$subject=$this->link->myesc($subject);
		  	$msg=$this->link->myesc($msg);
		  	$ip=$this->link->myesc($ip);

            $query="INSERT INTO `".DB_PREFIX1."contact` (`id` ,
															`fecha` ,
															`from_name` ,
															`from_email` ,
															`villa` ,
															`to` ,
															`subject`,
															`msg`,
															`from_ip`)
 					VALUES ( NULL ,'".$fecha."','".$fr_name."','".$fr_email."','".$villa."','".$to."','".$subject."','".$msg."','".$ip."')";
           return  $this->link->execute($query);
		  }
 }
?>