
<?php

function isValidURL($url)
{
return preg_match('|^http(s)?://[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i', $url);
}

//------------------------------------------------------------------------------------------------

   if ($_POST['url']){

		if(!isValidURL($_POST['url']))
		{
			$errMsg .= "* Please enter valid URL including http://<br>";
			
			echo $errMsg;
			echo "<a href=\"get_widget.php\" alt=\"\" >Go Back</a>";
			
		}else{	
		?>
            <iframe width="213" height="193" scrolling="no" src="https://www.casalindacity.com/for_rent/widget_200x193.php?url=<?=$_POST['url'];?>" frameborder="0"></iframe>
            
          <!--//  <iframe width="213" height="193" scrolling="no" src="http://jl.com/https.casalindacity/for_rent/widget_200x193.php?url=<?=$_POST['url'];?>" frameborder="0"></iframe>//-->
            <hr/>
             <p>Please, use the code below to put our widget in your Website.</p>
            <p align="center">HTML:<br><textarea cols="50" rows="5"><iframe width="213" height="193" scrolling="no" src="https://www.casalindacity.com/for_rent/widget_200x193.php??url=<?=$_POST['url'];?>" frameborder="0"></iframe></textarea></p>
            
		<?
		}
	}else{

echo "Error: We required a valid URL";
echo "<br><a href=\"get_widget.php\" alt=\"\" >Go Back</a>";
}
?>
