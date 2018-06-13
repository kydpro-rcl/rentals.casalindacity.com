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
				echo "<frameSize>0</frameSize>";
				echo "<frameColor>0xFFFFFF</frameColor>";
				echo "<cornerRadius>15</cornerRadius>";
				echo "<backgroundColor>0xFFFFFF</backgroundColor>";
				echo "<initialState>Start Slideshow</initialState>";
				echo "<showCaption>Always</showCaption>";
				echo "<captionBackgroundAlpha>41</captionBackgroundAlpha>";
				echo "<captionBackgroundCornerRadius>6</captionBackgroundCornerRadius>";
				echo "<buttonsBackgroundAlpha>41</buttonsBackgroundAlpha>";
				echo "<buttonsBackgroundCornerRadius>6</buttonsBackgroundCornerRadius>";
				echo "<showButtons>Always</showButtons>";
				echo "<showAlbumsButton>true</showAlbumsButton>";
				echo "<showThumbnailsButton>true</showThumbnailsButton>";
				echo "<showSlideshowButton>true</showSlideshowButton>";
				echo "<showNavigationButton>true</showNavigationButton>";
				echo "<rotationDirection>Vertical CW</rotationDirection>";
				echo "<rotationDuration>500</rotationDuration>";
				echo "<panelBackgroundAlpha>43</panelBackgroundAlpha>";
				echo "<iconWidth>90</iconWidth>";
				echo "<iconHeight>55</iconHeight>";
				echo "<iconPadding>10</iconPadding>";
				echo "<useRotation>false</useRotation>";
				echo "<imageScaleMode>Crop</imageScaleMode>";
				echo "<overSound>sounds/over.mp3</overSound>";
				echo "<clickSound>sounds/click.mp3</clickSound>";
		echo "</settings>";
	  /*
		echo "<albums>";

			echo "<album icon='' thumbnailsFolder='photos/House01/thumb/' imagesFolder='photos/House01/full/' description='Villa 01'>";
				echo "<image name='House01_01.jpg' description='Pic 01' thumbnail='House01_01.jpg'/>";
				echo "<image name='House01_02.jpg' description='Pic 02' thumbnail='House01_02.jpg'/>";
				echo "<image name='House01_03.jpg' description='Pic 03' thumbnail='House01_03.jpg'/>";
				echo "<image name='House01_04.jpg' description='Pic 04' thumbnail='House01_04.jpg'/>";
				echo "<image name='House01_05.jpg' description='Pic 05' thumbnail='House01_05.jpg'/>";
				echo "<image name='House01_06.jpg' description='Pic 06' thumbnail='House01_06.jpg'/>";
				echo "<image name='House01_07.jpg' description='Pic 07' thumbnail='House01_07.jpg'/>";
				echo "<image name='House01_08.jpg' description='Pic 08' thumbnail='House01_08.jpg'/>";
				echo "<image name='House01_09.jpg' description='Pic 09' thumbnail='House01_09.jpg'/>";
				echo "<image name='House01_10.jpg' description='Pic 10' thumbnail='House01_10.jpg'/>";
				echo "<image name='House01_11.jpg' description='Pic 11' thumbnail='House01_11.jpg'/>";
				echo "<image name='House01_12.jpg' description='Pic 12' thumbnail='House01_12.jpg'/>";
				echo "<image name='House01_13.jpg' description='Pic 13' thumbnail='House01_13.jpg'/>";
			echo "</album>";
		echo "</albums>";
	echo "</gallery>"; */
	//===============================================================================================================
	echo "<albums>";


	   echo "<album icon='' thumbnailsFolder='$thumbnail' imagesFolder='$directorio' description='Villa'>";
	    foreach ($fotos as $key => $image){ // Display Images
		  echo "<image name='$image' description='$image' thumbnail='$image'/>";
		 }
	   echo "</album>";

	echo "</albums>";
echo "</gallery>";

   }else{
	echo "No photos found for Villa ".$_GET['no'];
   }
 }else{
	echo "Missing villa number";
   }
?>