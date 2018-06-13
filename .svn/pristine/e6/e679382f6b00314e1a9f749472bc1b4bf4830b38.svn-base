<?php
include('inc/date-picker1.php');
include('menu_CSS/menu-admin.php');

$data= new getQueries ();

$promotion=$data->show_id('promotion', $_GET['oj']);

$pro=$promotion[0];
?>

<p class="header">Changing a Promotion</p>
<hr/>

<div style="width:600px; margin-left:auto; margin-right:auto; margin-top:45px;background-color:#a6b4ef;">
<form method="post" action="edit_promotion.php" >

    <fieldset><legend>Promtion Details</legend>
	<div style="float:left; width:50%;">
		
		
        <p id="fields" >
         <span style="font-size:10px; color:red;">*</span>Promotion code:<input type="text" name="promotion_code" value="<?=$pro['code']?>" size="10" />
          <br /><span id="error_s"><?=$_GET['error']['code']?></span>
        </p>
        <p id="fields" >
         <span style="font-size:10px; color:red;">*</span>Travel window from:<input type="text" name="desde" value="<?=$pro['desde']?>" size="10" id="datepicker" /><br/>
         <span id="error_s"><?=$_GET['error']['desde']?></span><span style="font-size:10px; color:gray;">YYYY-MM-DD</span>
        </p>
        <p id="fields" >
        <span style="font-size:10px; color:red;">*</span>Travel window to:<input type="text" name="hasta" value="<?=$pro['hasta']?>" size="10" id="datepicker1" /><br/>
         <span id="error_s"><?=$_GET['error']['hasta']?></span><span style="font-size:10px; color:gray;">YYYY-MM-DD</span>
        </p>
          <p id="fields" >
         <span style="font-size:10px; color:red;">*</span>Booking window from:<input type="text" name="bfrom" value="<?=$pro['bookingfrom']?>" size="10" id="datepicker2" /><br/>
         <span id="error_s"><?=$_GET['error']['bfrom']?></span><span style="font-size:10px; color:gray;">YYYY-MM-DD</span>
        </p>
        <p id="fields" >
        <span style="font-size:10px; color:red;">*</span>Booking window to:<input type="text" name="bto" value="<?=$pro['bookingto']?>" size="10" id="datepicker3" /><br/>
         <span id="error_s"><?=$_GET['error']['bto']?></span><span style="font-size:10px; color:gray;">YYYY-MM-DD</span>
        </p>
    </div>
    <div style="float:left; width:50%;">
		<p id="fields" >
		 <span style="font-size:10px; color:red;"></span>Promotion title: <input type="text" name="title" value="<?=$pro['title']?>"  />
		 <br /><span id="error_s"><?=$_GET['error']['percent']?></span>
        </p>
		
        <p id="fields" >
         Promotion type: 
		 <select name="pro_type">
			 <option value="1" <? if ($pro['tipo']==1) echo 'selected="selected"'; ?> >Percent</option>
			 <!--<option value="2" <? if ($pro['tipo']==2) echo 'selected="selected"'; ?>>Amount</option>-->
			 <option value="3" <? if ($pro['tipo']==3){ echo 'selected="selected"'; }?> >Nights</option>
		 </select>
        </p>
        <p id="fields" >
		 <span style="font-size:10px; color:red;"></span>Qty:<input type="text" name="monto_porc" value="<?=$pro['qty']?>" size="10" />
		 <br /><span id="error_s"><?=$_GET['error']['percent']?></span>
        </p>
        <p id="fields" >
        	Active: <select name="active" <? if ($pro['active']==1) echo 'selected="selected"';?>><option value="1">Yes</option> <option value="0" <? if ($pro['active']==0) echo "selected='selected'";?>>No</option></select>
        </p>

          <!--<fieldset><legend>Only if type is days</legend>-->
               <p id="fields" >
        		Min. Nights:<select name="mdays">
	        	<? for($i=2; $i<=50; $i++){?>
	        		<option value="<?=$i?>" <? if ($pro['min_days']==$i){ echo 'selected="selected"'; }?> ><?=$i?></option>
	        	<?}?>
        		</select>
	        	</p>
	        	 <p id="fields" >
	        	Max. Nights:<select name="maxdays">
	        		<? for($i=2; $i<=50; $i++){?>
	        			<option value="<?=$i?>" <? if ($pro['max_days']==$i){ echo 'selected="selected"'; }?> ><?=$i?></option>
	        		<?}?>
	        	</select>
	        	<br/><span id="error_s"><?=$_GET['error']['dias']?>
	       		</p>
 
		
        <p><span style="font-size:10px; color:white;">Required fields are marked with <span style="font-size:10px; color:red;">*</span></span></p>
    </div>
	</fieldset>
    <input type="hidden" name="id_pro" value="<?=$pro['id'];?>"/>
	<input class="book_but" type="submit" name="save" value="update"/>

</form>
</div>