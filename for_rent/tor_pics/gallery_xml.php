<?php
 if ($_GET['no']){
	//---------------FUNCION PARA LEER LOS DIRETORIOS DEBAJO--------------------
	 function dirImages($dir) {
		$d = dir($dir); //Open Directory
		while (false!== ($file = $d->read())) //Reads Directory
		{
			$extension = substr($file, strrpos($file, '.')); // Gets the File Extension
			if($extension == ".jpg" || $extension == ".jpeg" || $extension == ".gif" || $extension == ".png" || $extension == ".JPG") // Extensions Allowed
			$images[$file] = $file; // Store in Array
		}
			$d->close(); // Close Directory
			@asort($images); // Sorts the Array
		return $images;
	 }
     $directorio='photos/villa'.$_GET['no'].'/full/';//DIRECTORIO FULL
	$thumbnail='photos/villa'.$_GET['no'].'/thumb/';//DIRECTORIO THUMBNAILS
	$fotos = dirImages($directorio);

	//----------------FUNCION PARA LEER LOS DIRECTORIOS MAS ARRIBA--------------------
   if ($fotos){
	header("Content-type: text/xml");
	echo '<?xml version="1.0"?>';


	echo "<gallery>";
		echo "<settings>";
				echo "<imagesFolder>$directorio</imagesFolder>";
				echo "<thumbnailsFolder>$thumbnail</thumbnailsFolder>";
				echo '<image scaleMode="fit"/>';
				echo '<thumbnail width="132" height="88" alpha="70"/>';
				echo '<colorScheme thumbsFrameColor="0xffffff" thumbsArrowsColor="0x000000" imageBGColor="0x000000" useShadow="true"/>';
				echo '<imageCaption position="bottom" bgAlpha="40" color="0xFFFFFF" bgColor="0x000000" fontName="Verdana" fontSize="12" visibleMode="onRollOver"/>';
				echo '<thumbCaption color="0xFFFFFF" bgColor="0x000000" bgAlpha="70" fontName="Arial" fontSize="9" visibleMode="never"/>';
				echo '<sounds onRollOver="" onClick=""/>';
				echo '<picasa user="" albumID=""/>';
		echo "</settings>";

	//===============================================================================================================
	echo "<items>";
	    foreach ($fotos as $key => $image){ // Display Images
			echo "<item source=\"$image\" thumb=\"$image\" description=\"$image\"/>";
		 }
	echo "</items>";
echo "</gallery>";

   }else{
	echo "No photos found for Villa ".$_GET['no'];
   }
 }else{
	echo "Missing villa number";
   }
?>