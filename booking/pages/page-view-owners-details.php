<? include('menu_CSS/menu-villas.php');?>
<?php
$data= new getQueries ();
$owners=$data->show_id('owners', $_GET['id']);
//echo $_GET['id'];
$ow=$owners[0];
//echo $ow['name'];
?>
<p>&nbsp;</p>
<p class="header">Owner's details</p>
<hr>
<table style=" border-color:#999; border-style:solid; border-width: 1px;" align="center" cellpadding="2" cellspacing="2" border="0" width="90%"><tr >
<td ><div style=" width:150px; height:150px; border-color:#333; border-style:solid; border-width: 1px;" >
<? if ($ow['photo']!=''){?>
<img src="<?=$ow['photo']?>" width="150" height="150"  />
<? }else{ echo "<p style='text-align:center'>No Photo</p>"; }?>
</div></td> <td colspan="2">

    <table cellpadding="2" cellspacing="2" >
    <tr>
    <td bgcolor="#eff0f0" align="right" class="blue_light"><strong>Name:</strong> </td><td class="blue_dark"><?=$ow['name']?> <?=$ow['lastname']?></td>
	<td bgcolor="#eff0f0" align="right" class="blue_light"><strong>Ced/Passport:</strong></td>
	<td class="blue_dark"> <?=$ow['cedula']?> / <?=$ow['passport']?></td>
    </tr>
    <tr>
    <td bgcolor="#eff0f0" align="right" class="blue_light"><strong>E-Mail:</strong> </td><td class="blue_dark"><?=$ow['email']?></td><td bgcolor="#eff0f0" align="right" class="blue_light"> <strong>Phone:</strong></td><td class="blue_dark"> <?=$ow['phone']?></td>
    </tr>
    <tr>
    <td bgcolor="#eff0f0" align="right" class="blue_light"><strong>Username/password:</strong> </td>
	<td class="blue_dark"><?=$ow['user']?><? if ($_SESSION['info']['level']==1){?> / <?=$ow['pass']?> <?}?></td>
	<td bgcolor="#eff0f0" align="right" class="blue_light"> <strong>Company/RNC:</strong></td>
	
	<td class="blue_dark"> <?=$ow['company']?> / <?=$ow['RNC']?></td>
    </tr>
    <tr>
    <td bgcolor="#eff0f0" align="right" class="blue_light"><strong>2nd email:</strong> </td><td class="blue_dark"><?=$ow['cedula']?></td><td bgcolor="#eff0f0" align="right" class="blue_light"> <strong>2nd Name and Lastname:</strong></td><td class="blue_dark"> <?=$ow['passport']?></td>
    </tr>
    <tr>
    <td bgcolor="#eff0f0" align="right" class="blue_light"><strong>Language:</strong> </td><td class="blue_dark"><? $idiomas=languageArray();  echo $idiomas[$ow['language']];?> <? /*=$cl['language']*/?></td><td bgcolor="#eff0f0" align="right" class="blue_light"> <strong>Address:</strong></td><td class="blue_dark"> <?=$ow['address']?></td>
    </tr>
    </table>

</td></tr>
<tr><td class="blue_light"><strong>Owner ID:</strong> <span class="blue_dark"><?=$ow['id']?></span></td> <td class="blue_light"><strong>Status:</strong> <span class="blue_dark"><? if ($ow['active']==1){ echo "Active"; }else{ echo "Inative";}?></span></td><td class="blue_light"><strong>Country:</strong><span class="blue_dark"><? $paises=countryArray();  echo $paises[$ow['country']];?></span></td></tr>

<tr>
<td colspan="2" class="blue_light"><strong>Created on:</strong> <span class="blue_dark"> <?=$ow['date']?></span></td><td><strong>Own Villa (s):</strong> <span class="blue_dark"> <?
  $villas=$data->show_data('villas', "`id_owner`=".$ow['id'], 'id');
	 foreach( $villas as $vi){
		echo "(".$vi['no'].") ";
	  }

?></span></td></tr>
<tr><td colspan="2" class="blue_light">Contract Rent: <? if ($ow['contract_rent']!=''){?><a target="_blank" href="<?=$ow['contract_rent']?>">Click to View</a><?}else{?>Unavailable<?}?></td><td colspan="2" class="blue_light">Contract Service: <? if ($ow['contract_serv']!=''){?><a target="_blank" href="<?=$ow['contract_serv']?>">Click to View</a><?}else{?>Unavailable<?}?>
<p>Password: <?=$ow['pass']?></p>

</td></tr>
<tr>
<td colspan="3" class="blue_light"><strong>More Info:</strong> <span class="blue_dark"><?=$ow['info']?></span></td>
</tr>
<tr>
<td colspan="3" align="right">
<? if ($_SESSION['info']['services']==1){?>
	<input type="button" title="Change this customer" value="update" onclick="location.href='edit-owner-details.php?id=<?=$ow['id']?>'" class="book_but">
<?}?>
</td> </tr>
</table>
<br />
