<? include('menu_CSS/menu-admin.php');?>

<p class="header">Search Invoices</p>

	<form method="post" action="search-invoices.php" >
		<p style="font-size:10px; padding-left:15px;">Reference number:<input type="text" name="ref" value="<?=$_POST['ref']?>"/><input class="book_but" type="submit" name="go" value="go"/></p>

	</form>
<hr />
<? if ($_POST){?>



	<?php
	$data= new getQueries ();
	$_POST['ref']=str_pad($_POST['ref'], 9, "0", STR_PAD_LEFT);
	$invoices=$data->show_any_data('invoice', 'ref', $_POST['ref'], '=');
	$total_records=$data->getAffectedRows();?>

	<? if (!empty($invoices)){?>
		<table  align="center" cellpadding="2" cellspacing="2" border="0"><tr class="title"><tr class="title"><td class='centro' id="td">REFERENCE</td><td class='centro' id="td">FILE</td><td class='centro' id="td">PRINTED BY</td><td class='centro' id="td">DATE</td><td class='centro' id="td">INVOICE NO.</td><td class='centro' id="td">TYPE</td></tr>

		<?
		$x=0;
		$link= new DB();
		foreach ($invoices as $k){
		#echo $customers['4']['name'];
		echo "<tr class='fila$x'  onmouseover=\"this.style.backgroundColor='#87a2fa'; \"onmouseout=\"this.style.backgroundColor=''\" >
		<td id='td'>".$k['ref']."</td>".
		"<td id='td'><a href=\"".$k['src']."\" alt=\"".$k['src']."\" title=\"".$k['src']."\" target=\"_blank\">click to view</a></td>";

		 $made=$link->getUserDetails($k['id_adm']);

		echo "<td>".$made[0]['name']."</td>";

		echo "<td>".$k['date']."</td>";

		echo "<td>".$k['fact_no']."</td>";


			if ($k['type']==1){
				echo "<td class='centro' style='color:green;'  id='td'>check in</td>";
			}elseif($k['type']==2){
				echo "<td class='centro' id='td'>check out</td>";
			}

		if ($x==0){$x++;} elseif ($x==1){$x--;}
		}

		?>
		</table>

	<? }else{ echo "<h2>No invoice found</h2>";}?>
<? }?>