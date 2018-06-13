<?php
$data= new getQueries ();
$customers=$data->customer($_GET['id']);
$cl=$customers;
$vip=$data->show_data('vip', "id_client=".$_GET['id'], 'id');
?>
<p>&nbsp;</p>
<p class="header">Customer's details</p>
	             <hr>
<table style=" border-color:#999; border-style:solid; border-width: 1px;" align="center" cellpadding="2" cellspacing="2" border="0" width="90%"><tr >
<td ><div style=" width:150px; height:150px; border-color:#333; border-style:solid; border-width: 1px;" >
<? if ($cl['photo']!=''){?>
<img src="<?=$cl['photo']?>" width="150" height="150"  />
<? }else{ echo "<p style='text-align:center'>No Photo</p>"; }?>
</div></td> <td colspan="2">

    <table cellpadding="2" cellspacing="2" border="0">
    <tr>
    <td bgcolor="#eff0f0" align="right" class="blue_light"><strong>Name:</strong> </td><td class="blue_dark"><?=ucfirst($cl['name'])?></td><td bgcolor="#eff0f0" align="right" class="blue_light"><strong>Last Name:</strong></td><td class="blue_dark"> <?=ucfirst($cl['lastname'])?></td>
    <td rowspan="5" align="center"><span class="blue_light">PASSWORD:</span><br/><? if (empty($cl['pass'])){ echo "<span class=\"blue_dark\" style='color:red;'>Empty</span>"; }else{ echo "<span class=\"blue_dark\" style='color:red;'>".$cl['pass']."</span>"; } ?></td>
    </tr>
    <tr>
    <td bgcolor="#eff0f0" align="right" class="blue_light"><strong>E-Mail:</strong> </td><td class="blue_dark"><?=$cl['email']?></td><td bgcolor="#eff0f0" align="right" class="blue_light"> <strong>Phone:</strong></td><td class="blue_dark"> <?=$cl['phone']?> <? if ($cl['phone2']!=''){echo "/ ".$cl['phone2'];}?></td>
    </tr>
    <tr>
    <td bgcolor="#eff0f0" align="right" class="blue_light"><strong>Fax:</strong> </td><td class="blue_dark"><?=$cl['fax']?></td><td bgcolor="#eff0f0" align="right" class="blue_light"> <strong>Zip:</strong></td><td class="blue_dark"> <?=$cl['zip']?></td>
    </tr>
    <tr>
    <td bgcolor="#eff0f0" align="right" class="blue_light"><strong>Cedula:</strong> </td><td class="blue_dark"><?=$cl['cedula']?></td><td bgcolor="#eff0f0" align="right" class="blue_light"> <strong>Passport:</strong></td><td class="blue_dark"> <?=$cl['passport']?></td>
    </tr>
    <tr>
    <td bgcolor="#eff0f0" align="right" class="blue_light"><strong>Language:</strong> </td><td class="blue_dark"><? $idiomas=languageArray();  echo $idiomas[$cl['language']];?> <? /*=$cl['language']*/?></td><td bgcolor="#eff0f0" align="right" class="blue_light"> <strong>Address:</strong></td><td class="blue_dark"> <?=$cl['address']?></td>
    </tr>
    </table>

</td></tr>
<tr><td class="blue_light"><strong>Customer No:</strong> <span class="blue_dark"><?=$cl['id']?></span></td> <td class="blue_light"><strong>Status:</strong> <span class="blue_dark"><? if ($cl['active']==1){ echo "Active"; }else{ echo "Inative";}?></span> <? if ($vip[0]['date']){ echo "<span style='color:green;' >VIP from: ".$vip[0]['date']."</span>"; }?></td><td class="blue_light"><strong>Country:</strong><span class="blue_dark"><? $paises=countryArray();  echo $paises[$cl['country']];$states=cities($cl['country']); $provincia=$states[$cl['state']]; ?>
 <? if ($provincia){?>
	<br/>
	<?
	 echo $provincia;
	 if($cl['city']!="") echo ", ".$cl['city'];
 }else{  if ($cl['state']!="") echo  $cl['state'];
  if (($cl['state']!="")&&($cl['state']!="")) echo  ", ";
  if ($cl['state']!="") echo  $cl['city']; }
?>

</span></td></tr>

<tr>
<td class="blue_light"><strong>Updated:</strong><span class="blue_dark"> <? if ($cl['id_update']!=0){ ?> <span style='color:#8807e3'><strong> <? if ($_SESSION['info']['level']=='1') { ?> <a href="#" onclick="location.href='view-client_mod.php?id=<?=$cl['id']?>'"><? }?>YES <? if ($_SESSION['info']['level']=='1') { ?> </a> <? }?></strong></span><? }else{ echo "NO";}?> </span></td><td class="blue_light"><strong>Created on:</strong><span class="blue_dark"> <?=$cl['date']?></span></td><td class="blue_light"> <strong>Made by:</strong>
<span class="blue_dark"><? $users=new subDB(); $user=$users->userDetails($cl['id_adm']); echo $user['name'];?></span> </td></tr>
<? if ($cl['info']!=""){?>
	<tr>
	<td colspan="3" class="blue_light"><strong>More Info:</strong> <span class="blue_dark"><?=$cl['info']?></span></td>
	</tr>
<?}?>
<? if (($cl['ename']!="")&&($cl['ephone']!="")){?>
	<tr>
	<td colspan="3" class="blue_light"><strong>Emergency Contact:</strong> <span class="blue_dark"><?=ucfirst($cl['ename'])?> / <?=$cl['ephone']?></span></td>
	</tr>
<?}?>
<? if ($_SESSION['info']['level']<=3){?>
	<tr>
	<td colspan="3" align="right"><input type="button" title="Change this customer" value="update" onclick="location.href='edit-clients.php?no=<?=$cl['id']?>'" class="book_but"></td>
	</tr>
<?}?>
</table>
<br />
<? if ($_GET['all']==1){
	$booked=$data->occupancy_customer($_GET['id']);
   }else{
    $booked=$data->occupancy_customer_3($_GET['id']);
   }
/*foreach ($booked as $b){
	echo $b['start']."<br>";
	}*/
?>
<? if (!empty($booked)){?>
    <table align="center" cellpadding="2" cellspacing="2"><tr><td colspan="7" align="center" width="85%" class="blue_light"><!--<p>--><strong>LAST BOOKINGS MADE</strong><!--</p>--></td></tr>
    <tr bgcolor="#a6cdf4"><td align="center" class="blue_dark"><strong>Villa</strong></td><td align="center" class="blue_dark"><strong>From</strong></td><td  align="center" class="blue_dark"><strong>To</strong></td><td align="center" class="blue_dark"><strong>Price</strong></td><td  align="center" class="blue_dark"><strong>Comment</strong></td><td align="center" class="blue_dark"><strong>Ref.</strong></td><td  class="blue_dark" align="center"><strong>Status</strong></td></tr>
    <? foreach ($booked as $b){?>
    <tr  bgcolor="#CCCCCC" onclick="reserva('reserva_details.php?id=<?=$b['busyid']?>','Details for Selection', 530, 800)" title="Click to see Reservation" onmouseover="this.style.backgroundColor='#87a2fa'; this.style.cursor='hand';this.style.cursor='pointer';" onmouseout="this.style.backgroundColor=''" ><td style="font-size:9px" ><? $villa=$data->villa($b['villa']); echo $villa[0]['no'];?></td><td  style="font-size:11px" ><?=formatear_fecha($b['start'])?></td><td style="font-size:11px"  ><?=formatear_fecha($b['end'])?></td><td style="font-size:11px"  ><?=$b['ppn']?></td><td style="font-size:11px" ><?=$b['note']?></td><td  style="font-size:11px" ><?=$b['ref']?></td><td  style="font-size:11px" ><? switch ($b['status']){
            case 0:
				echo "<span style='color:red'>Cancelled</span>";
				break;
            case 1:
                echo "<span class='verde'>Checked&nbsp;in</span>";
                break;
            case 2:
                echo "<span class='azul2'>Confirmed</span>";
                break;
            case 3:
                echo "<span class='morado'>Transit</span>";
                break;
            case 4:
                echo "<span class='azul'>Checked&nbsp;out</span>";
                break;
            case 6:
         		echo "<span class='r_vip'>VIP Rental</span>";
	       		break;
	        case 8:
         		echo "<span class='r_long'>Long Term Rental</span>";
	       		break;
            default:
                echo "<span class='negro'>Unavailabe</span>";
                break;
           }?></td></tr>
    <? }?>
    </table>
    <? if ($_GET['all']!=1){?> <p class="derecha" style="padding:3px 50px 0px 0px;"><input type="button" class="book_but" style="color:#FFF" href="#" onclick="location.href='view-clients-details.php?id=<?=$_GET['id']?>&all=1'" title="See all the bookings" value="See all"> </p> <? }?>

<? }else{ ?>
<p style="text-align:center" class="blue_dark">This customer does not has bookings.</p>
<? }?>
