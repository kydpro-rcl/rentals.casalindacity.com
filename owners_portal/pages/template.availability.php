
<h2>Welcome, <?=$_SESSION['owner']['name']." ".$_SESSION['owner']['lastname']?></h2>
<p style="clear:both;">&nbsp;</p>
<hr style="border:1px solid #f9a80b;" />
<?
//echo $_SESSION['owner']['id']; echo "<br/>";
$db= new getQueries();
$villas_para_dueno=$db->villas_for_owner($_SESSION['owner']['id']);  //pickup all the villas for this owner

	 if($villas_para_dueno){   //if this owner has any villa
			$cantidad_villas=0;
			foreach ($villas_para_dueno AS $vi){
				// echo $vi['no']."<br/>";
			    $cantidad_villas++;   //count villas
			}
			//echo $cantidad_villas;
        /*  if ($cantidad_villas>1){ //if this owner has more than one villa
          ?>
          <p style="text-align:right; text-transform:uppercase; font-weight:bold; color:blue;">Choose villa number to show
          			<select name="id_villas" onchange="window.location='availability.php?v='+this.value">
          			<? foreach ($villas_para_dueno AS $vi){?>
          				<option value="<?=$vi['id']?>" <? if($_GET['v']==$vi['id']) echo 'selected="selected"';?>><?=$vi['no']?></option>
          			<?}?>
          			</select>
          			<!--//<input type="submit" name="go" value="go"/>//-->
          </p>
        <?
          } */

        $link=new DATA();
        if(!$_GET['v']){
	        $villa_actual_no=$villas_para_dueno[0]['no'];
	        $villa_actual_id=$villas_para_dueno[0]['id'];
	        $info_villa_seleccionada=$villas_para_dueno[0];
            //$statements_for_this_villa=$link->search_uploaded($villa_actual_id, $mes=0, $year='all');
        }else{
        	$villa_actual_id=$_GET['v'];

        	//get details for villa id
        	$villa_selected=$db->show_id('villas', $villa_actual_id);
        	// see if villa[ id_owner]==session[id]
        	if ($villa_selected[0]['id_owner']!=$_SESSION['owner']['id']) die('Error:This owner do not own this villa');
        	//get villa number
             $villa_actual_no=$villa_selected[0]['no'];
             $info_villa_seleccionada=$villa_selected[0];
        	//$statements_for_this_villa=$link->search_uploaded($villa_actual_id, $mes=0, $year='all');
        }

        if($info_villa_seleccionada['able_r']==1){
        	//calendario para esta villa
        	?>
        	<!--//<p>&nbsp</p>//-->
        	<h3 style="color:#2A6EBB; text-transform:uppercase;"><img src="images/tinycalendar.png" style="float:left; padding-right:5px;" />Availability for <span style="color:#2e8131;">Villa No. <?  if ($cantidad_villas>1){ //if this owner has more than one villa
          ?>
          			<select name="id_villas" onchange="window.location='availability.php?v='+this.value">
          			<? foreach ($villas_para_dueno AS $vi){?>
          				<option value="<?=$vi['id']?>" <? if($_GET['v']==$vi['id']) echo 'selected="selected"';?>><?=$vi['no']?></option>
          			<?}?>
          			</select>
        <?
          }else{?><?=$villa_actual_no?><?}?></span> - if in the rental program</h3>
        	<!--//<p style="color:#2A6EBB"><u>Nota: .</u></p>//-->

        	<iframe align="middle" height="1076" width="750" src="../show_owner_availability/index.php?v=<?=$info_villa_seleccionada['id']?>" frameborder="0" align="right">
                    <font face="Arial, Helvetica, sans-serif" size="1">Sorry your browser does not support IFRAMES.</font>
             </iframe>

        	<?
        }else{
          //esta villa no se renta
         ?>
        <!--// <p>&nbsp</p>//-->
         <h3 style="color:#2A6EBB; text-transform:uppercase;"><img src="images/tinycalendar.png" style="float:left; padding-right:5px;" />Availability for <span style="color:#FF0000;">Villa No. <?  if ($cantidad_villas>1){ //if this owner has more than one villa
          ?>
          			<select name="id_villas" onchange="window.location='availability.php?v='+this.value">
          			<? foreach ($villas_para_dueno AS $vi){?>
          				<option value="<?=$vi['id']?>" <? if($_GET['v']==$vi['id']) echo 'selected="selected"';?>><?=$vi['no']?></option>
          			<?}?>
          			</select>
        <?
          }else{?><?=$villa_actual_no?><?}?></span> - if in the rental program</h3>
        	<!--//<p style="color:#2A6EBB"><u>Nota: .</u></p>//-->
        	<iframe align="middle" height="660" width="750" src="../show_owner_availability/no_rental_program.php?v=<?=$info_villa_seleccionada['id']?>" frameborder="0">
                    <font face="Arial, Helvetica, sans-serif" size="1">Sorry your browser does not support IFRAMES.</font>
             </iframe>
           <?
        }
		?>

	<?}else{ ?>
	  <h3 style="color:red; background-color:yellow; padding:5px; margin:5px;">Dear Owner, you appear as if you do not have any villa still in our system,<br/> please, contact us for further information</h3>
	<?}?>