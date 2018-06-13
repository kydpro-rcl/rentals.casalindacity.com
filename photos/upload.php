<?php
//include database class
include_once 'core/db.php';
include_once 'core/functions.php';
$db = new DB();


session_start();
$villa_id=$_SESSION['villaid'];

$order=$db->getHighestID();
$order+=1;
//echo $order; die();

//$uploadDir = 'uploads';
$uploadDir = $villa_id;
$uploadDir_thumb = $villa_id.'/thumb/';
$uploadDir_ha = $villa_id.'/ha/';
if(!is_dir($uploadDir)) 
{
//mkdir('/test1/test2', 0777, true);
mkdir($uploadDir, 0765, true);
//chmod('/test1/test2', 0777);
}
if(!is_dir($uploadDir_thumb)) 
{
mkdir($uploadDir_thumb, 0765, true);
}
if(!is_dir($uploadDir_ha)) 
{
mkdir($uploadDir_ha, 0765, true);
}
if (!empty($_FILES)) {
 $tmpFile = $_FILES['file']['tmp_name'];
 $filename = $uploadDir.'/'.time().'-'. $_FILES['file']['name'];
 $newfilename=time().'-'. $_FILES['file']['name'];
 $db->uploadPicture($newfilename, $order, $villa_id );
 move_uploaded_file($tmpFile,$filename);
 
//================cambiar tamaño al archivo subido y crear thumbnail==================================
define ("WIDTH","150");//THUMBNAIL WIDTH
define ("HEIGHT","100");//THUMBNAIL HEIGHT
			//$newname=$newfilename;
			//$NewImageName = $RandomNum.$name;
			$thumb_name = $newfilename;
			$from_img=$filename;
			//CREATE A THUMBNAIL
			$thumb_name_full=$uploadDir_thumb.$thumb_name;
			$thumb=make_thumb($from_img,$thumb_name_full,WIDTH,HEIGHT);
			//RESIZE UPLOADED FILES
			$ha_name_full=$uploadDir_ha.$newfilename;
			$full=make_thumb($archivo_entrada=$from_img,$ha_name_full,$width='2272',$height='1704');//resize original to create HA required
 //================cambiar tamaño al archivo subido y crear thumbnail==================================
}
?>