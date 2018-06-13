<h2>Welcome, <?=$_SESSION['owner']['name']." ".$_SESSION['owner']['lastname']?></h2>
<p style="clear:both;">&nbsp;</p>
<hr style="border:1px solid #f9a80b;" />
<?
/*echo "owner";
print_r($_SESSION['owner']);
$canbiar_signo=-1; *///I use this value to change the number sign (positive or negative) to the quantities
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
          if ($cantidad_villas>1){ //if this owner has more than one villa
          ?>
          <p style="text-align:right; text-transform:uppercase; font-weight:bold; color:#084482;">Choose villa number to show
          			<select name="id_villas" onchange="window.location='home.php?v='+this.value">
          			<? foreach ($villas_para_dueno AS $vi){?>
          				<option value="<?=$vi['id']?>" <? if($_GET['v']==$vi['id'] || $_POST['idvilla']==$vi['id']) echo 'selected="selected"';?>><?=$vi['no']?></option>
          			<?}?>
          			</select>
          			<!--//<input type="submit" name="go" value="go"/>//-->
          </p>
        <?
          }

        $link=new DATA();
        if(!$_GET['v']&&!$_POST['idvilla']){
	        $villa_actual_no=$villas_para_dueno[0]['no'];
	        $villa_actual_id=$villas_para_dueno[0]['id'];
           // $statements_for_this_villa=$link->search_uploaded($villa_actual_id, $mes=0, $year='all');
        }else{
        	if ($_GET['v']) $villa_actual_id=$_GET['v'];
        	if ($_POST['idvilla']) $villa_actual_id=$_POST['idvilla'];
        	//get details for villa id
        	$villa_selected=$db->show_id('villas', $villa_actual_id);
        	// see if villa[ id_owner]==session[id]
        	if ($villa_selected[0]['id_owner']!=$_SESSION['owner']['id']) die('Error:This owner do not own this villa');
        	//get villa number
             $villa_actual_no=$villa_selected[0]['no'];
        	//$statements_for_this_villa=$link->search_uploaded($villa_actual_id, $mes=0, $year='all');
        }

		if ($_POST){
			$statements_for_this_villa=$link->search_uploaded($_POST['idvilla'], $_POST['month'], $_POST['year']);		
		}elseif($_GET['s']!=''){
			switch($_GET['s']){
				case 1: $sort="fecha";
						break;
				case 2: $sort="month";
						break;
				case 3: $sort="year";
						break;
				/*case 4: $sort="balance";
						break;*/
				default: $sort="month";			
				}            
				$statements_for_this_villa=$link->search_uploaded_sort($villa_actual_id, $mes=0, $year='all', $sort);	
		}else{
			$statements_for_this_villa=$link->search_uploaded($villa_actual_id, $mes=0, $year=date('Y'));	
		}
       /*
        echo $_POST['idvilla']." villa";
        echo "<br/>";
        echo $_POST['month']." mes";
        echo "<br/>";
        echo $_POST['year']." ano";
        echo "<br/>";  */

        $year_balance=$link->get_lastet_year($villa_actual_id);//get the highest year for statement uploaded
        $balance_actual=$link->search_actual_balance($villa_actual_id, $year_balance['ano']);//get the highest month for the highest year for this villa id
		/*echo "<pre>";
		print_r($statements_for_this_villa);
		echo "</pre>"; */
		?>



			<h3 style="float:left;">Statement for Villa No. <?=$villa_actual_no?></h3>
           <?/* if ($balance_actual['balance']!=0){?>

           	 <? if($balance_actual['balance']<0){ $debe=""; }else{  $debe=" Due";     }  ?>


	         <div style="float:left; border: 1px solid #CBCBCB; background-color:#DDEDF9; height:40px; width:250px; padding:0; margin:0; margin-left:5px; margin-bottom:3px;"><p style="text-align:center;padding:0; margin:0; ">Actual Balance<?=$debe?> is:<br/>
	            <? if($balance_actual['balance']<0){	            	$debe="";  //poner deuda variable a vacio
	            	?>
	            	<span style="color:#76a741; font-size:16px; font-weight:bold;">
	            <?}else{	            	$debe="Due";  //variable de deber
	            	?>
	            	<span style="color:black; font-size:16px; font-weight:bold;">
	            <?}?>
	            	<? if($balance_actual['moneda']==1){?>US$ <?}else{?>RD$ <?}?>
	            	<?=number_format($balance_actual['balance']*$canbiar_signo,2)?>
	            	</span>
	            </p>
	   		 </div>
   		   <?}*/?>
<?php

?>
<?php

?>
   		  <div style="float:left; border: 1px solid #CBCBCB; height:40px; width:265px; padding:0; margin:0; margin-left:3px; margin-bottom:3px;">
   		     <form method="post" action="home.php">
				<p style="padding:3px; margin:3px; margin-top:7px;">
					<input type="hidden" name="idvilla" value="<?=$villa_actual_id?>"/>
					Month <select name="month">
							<? for($i=0; $i<=12; $i++){
								$i=str_pad($i, 2, "0", STR_PAD_LEFT);
							?>
							<option value="<?=$i?>" <? if ($i==$_POST['month']){ echo 'selected="selected"';}?> >
							<? if ($i==0){ echo "All"; }else{ echo dame_nombre_mes($i); } ?>
			                </option>
					        <? }?>
					      </select>
					Year <select name="year">
			        		<option value="all" <? if ($_POST['year']=='all'){ echo 'selected="selected"'; } ?> >All</option>
							<? for($i=2008; $i<=date('Y'); $i++){?>
							<option value="<?=$i?>" <? if ($i==$_POST['year']){ echo 'selected="selected"'; }?> <? if (!$_POST){ if($i==date('Y')){echo 'selected="selected"';} } ?> ><?=$i?></option>
					        <? }?>
					     </select>
					<input type="submit" name="go" value="Go"/>
				</p>
			</form>
   		  </div>


			<script type="text/javascript">
				$(document).ready(function(name) {
                <? foreach($statements_for_this_villa AS $k){ ?>
				$("#various<?=$k['id']?>").fancybox({
						'width'				: '75%',
						'height'			: '95%',
						'autoScale'			: true,
						'transitionIn'		: 'elastic',
						'transitionOut'		: 'elastic',
						'type'				: 'iframe'
					});
				<?}?>
				});
			</script>
			<table align="center" cellpadding="1" cellspacing="1" style="border: 1px solid green; " width="100%">
				 <tr style="text-align:center; font-weight:bold; background-color:#2A6EBB; color:#FFFFFF;">
				 	<td style="padding:5px;"><a href="home.php?s=1<? if($_GET['v']){?>&v=<?=$_GET['v']?><?}?>" style="color:white;">DATE UPLOADED</a></td>
				 	<td style="padding:5px;"><a href="home.php?s=2<? if($_GET['v']){?>&v=<?=$_GET['v']?><?}?>" style="color:white;">MONTH</a></td>
				 	<td style="padding:5px;"><a href="home.php?s=3<? if($_GET['v']){?>&v=<?=$_GET['v']?><?}?>" style="color:white;">YEAR</a></td>
				 	<td style="padding:5px;">STATEMENT</td>
				 	<td style="padding:5px;">ELECTRICITY</td>
					<td style="padding:5px;">SUB-DIVISION FEE</td>
					<td style="padding:5px;">SERVICES</td>
				 </tr>
          <? if($statements_for_this_villa){?>
              <? $rowclass = 0;
              foreach($statements_for_this_villa AS $k){ ?>
               <tr class="row<?= $rowclass ?>" <?if($balance_actual['month']==$k['month'] && $balance_actual['year']==$k['year']){?> style="font-weight:bold; background-color:#DDEDF9;" <?}?>>
                 <td align="right"><?=date("F j, Y, g:i a",strtotime($k['fecha']))?></td>
                 <td align="right"><?=dame_nombre_mes($k['month'])?></td>
                 <td align="center"><?=$k['year']?></td>
				 
				 <?php
					$estado_file="statements/villa$villa_actual_no/".$k['archivo'];
					$electricity_file="statements/villa$villa_actual_no/".$k['electricity'];
					$subdivition_file="statements/villa$villa_actual_no/".$k['subdivition'];
					$services_file="statements/villa$villa_actual_no/".$k['services'];
				?>
                 <td align="center">
				 <?php if (is_file($estado_file)) {?>
				 <a href="statements/villa<?=$villa_actual_no?>/<?=$k['archivo']?>" target="_blank" id="various<?=$k['id']?>" >View File</a>
				  <?php }?>
				 </td>
                 <td align="center">
				 <?php if (is_file($electricity_file)) {?>
				 <a href="statements/villa<?=$villa_actual_no?>/<?=$k['electricity']?>" target="_blank" id="various<?=$k['id']?>" >View Invoice</a>
				  <?php }?>
				 </td>
				 <td align="center">
				 <?php if (is_file($subdivition_file)) {?>
				 <a href="statements/villa<?=$villa_actual_no?>/<?=$k['subdivition']?>" target="_blank" id="various<?=$k['id']?>" >View Invoice</a>
				  <?php }?>
				 </td>
				 <td align="center">
				   <?php if (is_file($services_file)) {?>
				 <a href="statements/villa<?=$villa_actual_no?>/<?=$k['services']?>" target="_blank" id="various<?=$k['id']?>" >View Invoice</a>
				  <?php }?>
				 </td>
               </tr>
              <?
                 $rowclass = 1 - $rowclass;
              } ?>

          <?}else{
	         if(!$_POST){
			 	echo "<tr><td colspan=\"5\"><h3 style='color:#000000; text-align:center;/*background-color:yellow;*/'>Currently, there are no files uploaded for Villa No. $villa_actual_no</h3></td></tr>";
			 }else{			 	$mes_enviado=$_POST['month'];
			 	if($_POST['month']==0)   $mes_enviado="All";                echo "<tr><td colspan=\"5\"><h3 style='color:#000000; text-align:center;/*background-color:yellow;*/'>Your search (Month: ".$mes_enviado." Year: ".$_POST['year'].") did not find any results for Villa No. $villa_actual_no</h3></td></tr>";			 }

		  }?>

			 </table>

	<?}else{ ?>
	  <h3 style="color:red; background-color:yellow; padding:5px; margin:5px;">Dear Owner, you appear as if you do not have any villa in our system,<br/> please, contact us for further information</h3>
	<?}?>