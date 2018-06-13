<?php
require_once('inc/session.php');

?>

<?php
if ($_SESSION['info']){
require_once('template/head.php');
require_once('init.php');
$data= new getQueries ();
$customer_mod=$data->show_id('customers_mod', $_GET['id']);
$cl=$customer_mod[0];
?>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p class="header">Modification detail</p>
	             <hr>
<table style=" border-color:#999; border-style:solid; border-width: 1px;" align="center" cellpadding="2" cellspacing="2" border="0"><tr >
<td ><div style=" width:150px; height:150px; border-color:#333; border-style:solid; border-width: 1px;" >
<? if ($cl['photo']!=''){?>
<img src="<?=$cl['photo']?>" width="150" height="150"  />
<? }else{ echo "<p style='text-align:center'>No Photo</p>"; }?>
</div></td> <td colspan="2">

    <table cellpadding="2" cellspacing="2">
    <tr>
    <td bgcolor="#eff0f0" align="right"><strong>Name:</strong> </td><td><?=$cl['name']?></td><td bgcolor="#eff0f0" align="right"><strong>Last Name:</strong></td><td> <?=$cl['lastname']?></td>
    </tr>
    <tr>
    <td bgcolor="#eff0f0" align="right"><strong>E-Mail:</strong> </td><td><?=$cl['email']?></td><td bgcolor="#eff0f0" align="right"> <strong>Phone:</strong></td><td> <?=$cl['phone']?> <? if ($cl['phone2']!=''){echo "/ ".$cl['phone2'];}?></td>
    </tr>
    <tr>
    <td bgcolor="#eff0f0" align="right"><strong>Fax:</strong> </td><td><?=$cl['fax']?></td><td bgcolor="#eff0f0" align="right"> <strong>Zip:</strong></td><td> <?=$cl['zip']?></td>
    </tr>
    <tr>
    <td bgcolor="#eff0f0" align="right"><strong>Cedula:</strong> </td><td><?=$cl['cedula']?></td><td bgcolor="#eff0f0" align="right"> <strong>Passport:</strong></td><td> <?=$cl['passport']?></td>
    </tr>
    <tr>
    <td bgcolor="#eff0f0" align="right"><strong>Language:</strong> </td><td ><? $idiomas=languageArray();  echo $idiomas[$cl['language']];?> <? /*=$cl['language']*/?></td><td bgcolor="#eff0f0" align="right"> <strong>Address:</strong></td><td> <?=$cl['address']?></td>
    </tr>
    </table>

</td></tr>
<tr><td><strong>Modification No:</strong> <?=$cl['id']?></td> <td><strong>Status:</strong> <? if ($cl['active']==1){ echo "Active"; }else{ echo "Inative";}?></td><td><strong>Country:</strong><? $paises=countryArray();  echo $paises[$cl['country']];?></td></tr>

<tr>
<td colspan="2"><strong>Modified on:</strong> <?=$cl['date_mod']?></td><td> <strong>Modified by:</strong>
<? $users=new subDB(); $user=$users->userDetails($cl['id_adm_mod']); echo $user['name'];?> </td></tr>

<? if ($cl['info']!=""){?>
	<tr>
	<td colspan="3"><strong>More Info:</strong> <?=$cl['info']?></td>
	</tr>
 <?}?>
 <? if (($cl['ename']!="")&&($cl['ephone']!="")){?>
	<tr>
	<td colspan="3"><strong>Emergency Contact:</strong> <?=$cl['ename']?> / <?=$cl['ephone']?> </td>
	</tr>
 <?}?>
</table>
<br />

<?

}else{
	 header('Location:login.php');
	die();
	 // echo ("<meta http-equiv=\"refresh\" content=\"0;url=../login.php\">");
  }?>