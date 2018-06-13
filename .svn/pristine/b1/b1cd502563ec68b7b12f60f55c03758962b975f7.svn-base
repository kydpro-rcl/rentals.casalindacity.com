<?php
 if($_GET['v']){
	$data= new getQueries ();
	$villas=$data->show_id('villas', $_GET['id']);
    //get details for this villa

	$v=$villas[0];

	?>
	<p class="header" style="color:red">Photos Gallery for Villa No. <?=$_GET['v']?></p><hr />

    <iframe src="albums/browser.php?v=<?=$_GET['v']?>" width="100%" height="937" frameborder="0">
                 	 <p>Your browser does not support iframes.</p>
 </iframe>

  <?}?>