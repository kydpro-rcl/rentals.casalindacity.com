<link type="text/css" href="../for_rent/datapicker-ui/css/ui-lightness/jquery-ui-1.8.16.custom.css" rel="stylesheet" />
		<script type="text/javascript" src="../for_rent/datapicker-ui/js/jquery-1.6.2.min.js"></script>
		<script type="text/javascript" src="../for_rent/datapicker-ui/js/jquery-ui-1.8.16.custom.min.js"></script>
	<script>
	/*$(function() {
		$( "#datepicker" ).datepicker({
			numberOfMonths: 1,
			showButtonPanel: true
		});
		$( "#datepicker2" ).datepicker({
			numberOfMonths: 1,
			showButtonPanel: true
		});
	});*/
	 <!--//
	$(function() {
		var dates = $( "#from, #to" ).datepicker({
			defaultDate: "+1w",
			changeMonth: false,
			numberOfMonths: 2,
			onSelect: function( selectedDate ) {
				var option = this.id == "from" ? "minDate" : "maxDate",
					instance = $( this ).data( "datepicker" ),
					date = $.datepicker.parseDate(
						instance.settings.dateFormat ||
						$.datepicker._defaults.dateFormat,
						selectedDate, instance.settings );
				dates.not( this ).datepicker( "option", option, date );
			}
		});
	});
	//-->
	</script>

<? include('menu_CSS/menu-admin.php');
   require_once('inc/functions2.php');
 $db= new getQueries ();
 $villas=$db->showTable_restrinted($v="villas",$cond="able_r=1",$order="no");
?>


<p class="header">Report of Complaints</p>

	<form method="post" action="report_complaints.php" >
	<!--//	<p style="font-size:10px; padding-left:15px;">Reference number:<input type="text" name="ref" value="<?=$_POST['ref']?>"/><input class="book_but" type="submit" name="go" value="go"/></p>  //-->
		<p style="font-size:10px; padding-left:15px;">
		Villa:
		<select name="villa_id">
			<option value="0">All</option>
			<? foreach($villas AS $v){?>
		     <option value="<?=$v['id']?>" <? if($_POST['villa_id']==$v['id']) echo 'selected="selected"';?>><?=$v['no']?></option>
		    <?}?>
		</select>

		<!--//Month:
		<select name="month">
			<option value="0">All</option>
			<?for($m=1; $m<=12; $m++){?>
		     <option value="<?=$m?>" <? if($_POST['month']==$m) echo 'selected="selected"';?>><?=dame_nombre_mes($m);?></option>
		    <?}?>
		</select>

		Year:
		<select name="year">
			<option value="0">All</option>
			<? for($y=2009; $y<=date('Y'); $y++){?>
		     <option value="<?=$y?>" <? if($_POST['year']==$y) echo 'selected="selected"';?>><?=$y?></option>
		    <?}?>
		</select>//-->
		From: <input id="from" type="text" name="start" value="<?=$_POST['start']?>" />
		To:<input id="to" type="text" name="end" value="<?=$_POST['end']?>" />
		<input class="book_but" type="submit" name="go" value="Show"/>
        </p>

	</form>
<hr />
<? /*if ($_POST){*/?>



	<?php
	$data= new getQueries ();
	//$_POST['ref']=str_pad($_POST['ref'], 9, "0", STR_PAD_LEFT);
	//if((!$_POST)||(($_POST['villa_id']=='0')&&($_POST['month']=='0')&&($_POST['year']=='0'))){
	if((!$_POST)||(($_POST['villa_id']=='0')&&($_POST['start']=='0')&&($_POST['end']=='0'))){
		$comp=$data->show_data($table='comments', $condition="tipo='3' AND deleted<>'1'", $order='id');
		$title="Total of complaints for the project";
	}else{       $title="Total of complaints for ";
	 if($_POST['villa_id']!='0'){       $sql=" AND villa_id='".$_POST['villa_id']."'";
       $villa=$data->villa($_POST['villa_id']);
       $title.=" Villa ".$villa[0]['no'];	 }else{	 	$title="Total of complaints for the project";
	 }

	 /*if($_POST['month']!='0'){
       $sql.=" AND MONTH(fecha)='".$_POST['month']."'";
       $title.=" - ".dame_nombre_mes($_POST['month']);
	 }  */

	 /*if($_POST['year']!='0'){
       $sql.=" AND YEAR(fecha)='".$_POST['year']."'";
       $title.=" - ".$_POST['year'];
	 }*/

	 if($_POST['start']!='0'){
       $sql.=" AND fecha>='".date('Y-m-d',strtotime($_POST['start']))."'";
       $title.=" From: ".date("d M Y",strtotime($_POST['start']));
	 }

	 if($_POST['end']!='0'){
       $sql.=" AND fecha<='".date('Y-m-d',strtotime($_POST['end']))."'";
       $title.=" To: ".date("d M Y",strtotime($_POST['end']));
	 }
		$comp=$data->show_data($table='comments', $condition="tipo='3' AND deleted<>'1'".$sql, $order='id');
	}
	$total_records=$data->getAffectedRows();//cantidad total de quejas
  if($comp){
    //$quejas=array();
    $quejas['internet']=array(); $quejas['no_water']=array(); $quejas['hot_water']=array();
    $quejas['tv_cable']=array();$quejas['AC']=array();$quejas['Insects']=array();
    $quejas['safe']=array(); $quejas['lights']=array(); $quejas['doors_keys']=array();
    $quejas['maid_service']=array();$quejas['pool_garden']=array(); $quejas['furniture']=array();
    $quejas['jacuzzi']=array(); $quejas['others']=array();

	foreach($comp AS $co){       switch($co['complaint']){       	  case 1:
       	  		array_push($quejas['internet'],$co);
       	  		break;
       	  case 2:
       	  		array_push($quejas['no_water'],$co);
       	  		break;
       	  case 3:
       	  		array_push($quejas['hot_water'],$co);
       	  		break;
       	  case 4:
       	  		array_push($quejas['tv_cable'],$co);
       	  		break;
       	  case 5:
       	  		array_push($quejas['AC'],$co);
       	  		break;
       	  case 6:
       	  		array_push($quejas['Insects'],$co);
       	  		break;
       	  case 7:
       	  		array_push($quejas['safe'],$co);
       	  		break;
       	  case 8:
       	  		array_push($quejas['lights'],$co);
       	  		break;
       	  case 9:
       	  		array_push($quejas['doors_keys'],$co);
       	  		break;
       	  case 10:
       	  		array_push($quejas['maid_service'],$co);
       	  		break;
       	  case 11:
       	  		array_push($quejas['pool_garden'],$co);
       	  		break;
       	  case 13:
       	  		array_push($quejas['furniture'],$co);
       	  		break;
       	  case 14:
       	  		array_push($quejas['jacuzzi'],$co);
       	  		break;
       	  case 12:
       	  		array_push($quejas['others'],$co);
       	  		break;       }	}

	$complaints_arr=array(
						'Internet'=>count($quejas['internet']),
						'No_water'=>count($quejas['no_water']),
						'Hot_water'=>count($quejas['hot_water']),
						'Tv_cable'=>count($quejas['tv_cable']),
						'AC'=>count($quejas['AC']),
						'Insects'=>count($quejas['Insects']),
						'Safe'=>count($quejas['safe']),
						'Lights'=>count($quejas['lights']),
						'Doors_keys'=>count($quejas['doors_keys']),
						'Maid_service'=>count($quejas['maid_service']),
						'Pool_gard'=>count($quejas['pool_garden']),
						'Furniture'=>count($quejas['furniture']),
						'Jacuzzi'=>count($quejas['jacuzzi']),
						'Others'=>count($quejas['others']));
  }

   /*  echo "<pre>";
     print_r($quejas);
     echo "</pre>";*/
     /*$internet_qty=count($quejas['internet']);
	 echo  "Internet ".$internet_qty; */
	?>

	<? if (!empty($complaints_arr)){?>
	 <!--//<img src="chart.php?<?=http_build_query($complaints_arr)?>"/>//-->
	 	<? /*$cont=count($complaints_arr);*/
	 	/*echo $cont; */ ?>

	 	<? create_chart($array=$complaints_arr, $title, $subtitle="Residencial Casa Linda", $total=$total_records.' Total Complaints ('.date("d M Y - g:i:s A").")"); /*draw the graph here*/?>
        <!--//<p>Total Complaints <?=$total_records?></p>//-->
        <?/*?>
		<table  align="center" cellpadding="2" cellspacing="2" border="0" width="50%">
			<tr class="title">
				<td class="centro" id="td">COMPLAINTS</td>
				<td class="centro" id="td" style="text-align:right"># OF COMPLAINTS PER ITEM</td>
			</tr>
		<?  $x=0;
		foreach ($complaints_arr as $k => $v){
		?>
		<tr class="fila<?=$x?>"  onmouseover="this.style.backgroundColor='#87a2fa';" onmouseout="this.style.backgroundColor=''" >
			<td id='td'><?=$k?></td>
			<td id='td' style="text-align:right"><?=$v?></td>
		</tr>
		<?

		if ($x==0){$x++;} elseif ($x==1){$x--;}
		}

		?>
		</table>
		<?*/?>

	<? }else{
	 //echo "<h2>No complaint was found</h2>";

	 $complaints_arr=array(
						'Internet'=>0,
						'No_water'=>0,
						'Hot_water'=>0,
						'Tv_cable'=>0,
						'AC'=>0,
						'Insects'=>0,
						'Safe'=>0,
						'Lights'=>0,
						'Doors_keys'=>0,
						'Maid_service'=>0,
						'Pool_gard'=>0,
						'Furniture'=>0,
						'Jacuzzi'=>0,
						'Others'=>0);

		create_chart($array=$complaints_arr, $title, $subtitle="Residencial Casa Linda", $total='0 Total Complaints ('.date("d M Y - g:i:s A").")"); /*draw the graph here*/

	 }?>
<?/* }*/?>