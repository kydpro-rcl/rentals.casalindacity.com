<?php
error_reporting(E_ALL & ~E_NOTICE);// Report all errors except E_NOTICE
$_GET['v']='550';

if($_SERVER['REMOTE_ADDR']=='127.0.0.1'){/*local server*/
	$full_dir=$_SERVER["DOCUMENT_ROOT"]."/Norway06-04-2015/for_rent/tor_pics/photos/villa".$_GET['v']."/full/";
	$thumb_dir=$_SERVER["DOCUMENT_ROOT"]."/Norway06-04-2015/for_rent/tor_pics/photos/villa".$_GET['v']."/thumb/";
}else{
	$full_dir=$_SERVER["DOCUMENT_ROOT"]."/for_rent/tor_pics/photos/villa".$_GET['v']."/full/";
	$thumb_dir=$_SERVER["DOCUMENT_ROOT"]."/for_rent/tor_pics/photos/villa".$_GET['v']."/thumb/";
}

if (!file_exists($full_dir)) {/*create folder if it's not there*/
    mkdir($full_dir, 0777, true);//1200x900px max
}
if (!file_exists($thumb_dir)) { /*create folder if it's not there*/
    mkdir($thumb_dir, 0777, true);
}

define ("WIDTH_THUMB","150");//THUMBNAIL WIDTH
define ("HEIGHT_THUMB","100");//THUMBNAIL HEIGHT
define ("WIDTH_FULL","1200");//FULL WIDTH
define ("HEIGHT_FULL","900");//FULL HEIGHT

function getExtension($str) {
		$i = strrpos($str,".");
		if (!$i) { return ""; }
		$l = strlen($str) - $i;
		$ext = substr($str,$i+1,$l);
		return $ext;
}
// this is the function that will create the thumbnail image from the uploaded image
// the resize will be done considering the width and height defined, but without deforming the image
function resize_img($img_input,$output,$new_w,$new_h)	{
	//get image extension.
	$ext=getExtension($img_input);
	//creates the new image using the appropriate function from gd library
		if(!strcmp("jpg",$ext) || !strcmp("jpeg",$ext))
		$src_img=imagecreatefromjpeg($img_input);
		if(!strcmp("JPG",$ext) || !strcmp("JPEG",$ext))
		$src_img=imagecreatefromjpeg($img_input);
		if(!strcmp("png",$ext))
		$src_img=imagecreatefrompng($img_input);
		//gets the dimmensions of the image
		$old_x=imageSX($src_img);
		$old_y=imageSY($src_img);
		// next we will calculate the new dimmensions for the thumbnail image
		// the next steps will be taken:
		// 1. calculate the ratio by dividing the old dimmensions with the new ones
		// 2. if the ratio for the width is higher, the width will remain the one define in WIDTH variable
		// and the height will be calculated so the image ratio will not change
		// 3. otherwise we will use the height ratio for the image
		// as a result, only one of the dimmensions will be from the fixed ones
		$ratio1=$old_x/$new_w;
		$ratio2=$old_y/$new_h;
		if($ratio1>$ratio2) {
		$thumb_w=$new_w;
		$thumb_h=$old_y/$ratio1;
		}else {
		$thumb_h=$new_h;
		$thumb_w=$old_x/$ratio2;
		}
		// we create a new image with the new dimmensions
		$dst_img=ImageCreateTrueColor($thumb_w,$thumb_h);
		// resize the big image to the new created one
		imagecopyresampled($dst_img,$src_img,0,0,0,0,$thumb_w,$thumb_h,$old_x,$old_y);
		// output the created image to the file. Now we will have the thumbnail into the file named by $filename
		if(!strcmp("png",$ext))
		imagepng($dst_img,$output);
		else
		imagejpeg($dst_img,$output);
		//destroys source and destination images.
		imagedestroy($dst_img);
		imagedestroy($src_img);
}
	
if(isset($_FILES["myfile"]))
{
	$ret = array();

	$error =$_FILES["myfile"]["error"];
   {
    	if(!is_array($_FILES["myfile"]['name'])) //single file
    	{
            $RandomNum   = time();
            $ImageName      = str_replace(' ','-',strtolower($_FILES['myfile']['name']));
            $ImageType      = $_FILES['myfile']['type']; //"image/png", image/jpeg etc.
         
            $ImageExt = substr($ImageName, strrpos($ImageName, '.'));
            $ImageExt       = str_replace('.','',$ImageExt);
            $ImageName      = preg_replace("/\.[^.\s]{3,4}$/", "", $ImageName);
            $NewImageName = $ImageName.'-'.$RandomNum.'.'.$ImageExt;

       	 	move_uploaded_file($_FILES["myfile"]["tmp_name"],$full_dir. $NewImageName);
       	 	 //echo "<br> Error: ".$_FILES["myfile"]["error"];
				//CREATE A THUMBNAIL
				/*echo $full_dir.$NewImageName;
				echo "<br/>";
				echo $thumb_dir.$NewImageName;*/
				$in_files=$full_dir.$NewImageName;
				$out_files=$thumb_dir.$NewImageName;
				$thumb=resize_img($in_files,$out_files,WIDTH_THUMB,HEIGHT_THUMB);//make thte thumbnail
				 //RESIZE UPLOADED FILES
				$thumb=resize_img($source=$in_files,$in_files,WIDTH_FULL,HEIGHT_FULL);//make original smaller if it's bigger
				
	       	$ret[$fileName]= $full_dir.$NewImageName;
    	}
    	else
    	{
            $fileCount = count($_FILES["myfile"]['name']);
    		for($i=0; $i < $fileCount; $i++)
    		{
                $RandomNum   = time();
                $ImageName      = str_replace(' ','-',strtolower($_FILES['myfile']['name'][$i]));
                $ImageType      = $_FILES['myfile']['type'][$i]; //"image/png", image/jpeg etc.
                $ImageExt = substr($ImageName, strrpos($ImageName, '.'));
                $ImageExt       = str_replace('.','',$ImageExt);
                $ImageName      = preg_replace("/\.[^.\s]{3,4}$/", "", $ImageName);
                $NewImageName = $ImageName.'-'.$RandomNum.'.'.$ImageExt;
                $ret[$NewImageName]= $full_dir.$NewImageName;
    		    move_uploaded_file($_FILES["myfile"]["tmp_name"][$i],$full_dir.$NewImageName);
					//CREATE A THUMBNAIL
				$thumb=resize_img($source=$full_dir.$NewImageName,$output=$thumb_dir.$NewImageName,WIDTH_THUMB,HEIGHT_THUMB);
				 //RESIZE UPLOADED FILES
				$thumb=resize_img($source=$full_dir.$NewImageName,$full_dir.$NewImageName,WIDTH_FULL,HEIGHT_FULL);
	       	$ret[$fileName]= $full_dir.$NewImageName;
    		}
    	}
    }
    echo json_encode($ret);
}
?>