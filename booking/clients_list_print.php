<?php
require_once('inc/session.php');

if ($_SESSION['info']){
	require_once('template/print_clients.php');
	require_once('init.php');

$data= new getQueries ();
if (!$_GET['sort']){
$customers=$data->show_all('customers', 'id');
$total_records=$data->getAffectedRows();
}else{

 switch ($_GET['sort']){
 case "no":
 			$customers=$data->show_all('customers', 'id');
 			$total_records=$data->getAffectedRows();
 			break;
 case "status":
 			$customers=$data->show_all('customers', 'active');
 			$total_records=$data->getAffectedRows();
 			break;
 case "name":
 			$customers=$data->show_all('customers', 'name');
 			$total_records=$data->getAffectedRows();
 			break;
 case "email":
 			$customers=$data->show_all('customers', 'email');
 			$total_records=$data->getAffectedRows();
 			break;
 case "phone":
 			$customers=$data->show_all('customers', 'phone');
 			$total_records=$data->getAffectedRows();
 			break;
 case "country":
 			$customers=$data->show_all('customers', 'country');
 			$total_records=$data->getAffectedRows();
 			break;
 case "state":
 			$customers=$data->show_all('customers', 'state');
 			$total_records=$data->getAffectedRows();
 			break;
 default	:
 			$customers=$data->show_all('customers', 'id');
 			$total_records=$data->getAffectedRows();
 			break;
 }
}
?>
<div id="content" >
 <div id="header_main">
       	<p style="text-align:center; padding:0; margin:0;"><img  src="print_view/images/logo.png" alt="logo" /></p>
        <h1 style="text-align:center; padding:0; margin:0;">R.C.L Administracciones, SRL.</h1>
        <p style="text-align:center; padding:0; margin:0;">Sosua, Rep&uacute;blica Dominicana<br />
           Tel.: 809-571-1190 - Fax: 809-571-1490<br/>
           RNC: 1-05-04480-3</p>
</div>

<p class="header">Booking System - Report of clients</p>
 <p id="p_date">Printed by:<?=$_SESSION['info']['name']." ".$_SESSION['info']['lastname']?><br/>Date printed: <? echo date('Y-m-d G:i:s');?> </p>
<p style="font-size:10px; padding-left:15px;"><strong>Total customers found: <?=$total_records?></strong></p>
<p style="clear:both; text-align:right;"><input type="button" class="book_but" onclick="javascript:window.print()" value="Print" title="Print this page"> </p>
<hr />
<table  align="center" cellpadding="2" cellspacing="0" border="1">

	<tr class="title">
		<td class='centro' id="td">
			<?if (($_GET['sort']!="")&&($_GET['sort']!="no")){?>
            <a href="clients_list_print.php?sort=no" title="Sort by numbers">NO</a>
			<?}else{?>
			NO
			<?}?>
		</td>
		<td class='centro' id="td">
			<?if ($_GET['sort']!="status"){?>
            <a href="clients_list_print.php?sort=status" title="Sort by status">STATUS</a>
			<?}else{?>
			STATUS
			<?}?>
		</td>
		<td class='centro' id="td">
			<?if ($_GET['sort']!="name"){?>
            <a href="clients_list_print.php?sort=name" title="Sort by names">NAME</a>
			<?}else{?>
			NAME
			<?}?>
		</td>
		<td class='centro' id="td">
			<?if ($_GET['sort']!="email"){?>
            <a href="clients_list_print.php?sort=email" title="Sort by emails">EMAIL</a>
			<?}else{?>
			EMAIL
			<?}?>
		</td>
		<td class='centro' id="td">
			<?if ($_GET['sort']!="phone"){?>
            <a href="clients_list_print.php?sort=phone" title="Sort by phones">PHONE</a>
			<?}else{?>
			PHONE
			<?}?>
		</td>
		<td class='centro' id="td">
			<?if ($_GET['sort']!="country"){?>
            <a href="clients_list_print.php?sort=country" title="Sort by countries">COUNTRY</a>
			<?}else{?>
			COUNTRY
			<?}?>
		</td>
		<td class='centro' id="td">
			<?if ($_GET['sort']!="state"){?>
            <a href="clients_list_print.php?sort=state" title="Sort by cities">STATE</a>
			<?}else{?>
			STATE
			<?}?>
		</td>
	</tr>
<?php

$x=0;
foreach ($customers as $k){
#echo $customers['4']['name'];
echo "<tr class='fila$x'  >
<td id='td' class='derecha'>".$k['id']."</td>";

if ($k['active']==1){
	if ($k['classify_cust']==1){
		echo "<td class='centro' style='color:green;'  id='td'>Active</td>";
	}else{
		echo "<td class='centro' id='td'>Active</td>";
	}
}else{
	if ($k['classify_cust']==1){
		echo "<td class='centro' style='color:#d91be0;' id='td'>Disabled</td>";
	}else{
		echo "<td class='centro rojo' id='td'>Disabled</td>";
	}
}



echo "<td id='td'>".$k['name']." ".($k['lastname'])."</td>".
"<td id='td'>".$k['email']."</td>".
"<td id='td'>".$k['phone']."</td>";

//echo"<td id='td'>".$k['country']."</td><td id='td'>".$k['city']."</td></tr>";

 $paises=countryArray();
 $states=cities($k['country']);
 $provincia=$states[$k['state']];

	  echo "<td id='td'>".$paises[$k['country']]."</td>";

	 if ($provincia){
		echo "<td id='td'>".$provincia."</td></tr>";
	 }else{
	    echo  "<td id='td'>".$k['state']."</td></tr>";
	 }

 if ($x==0){$x++;} elseif ($x==1){$x--;}
}
//.utf8_encode($k['lastname'])
?>
</table>
<?
}else{
	 header('Location:login.php');
	die();
	 // echo ("<meta http-equiv=\"refresh\" content=\"0;url=../login.php\">");
  }
?>

<!--onclick="location.href='edit-booking.php?refnumb= -->
    <div id="footer_main">
       Please, Visit: <strong>http://www.CasaLindaCity.com</strong> Email: <strong>Reservations@CasaLindaCity.com</strong>
    </div>
</div><!--end content-->