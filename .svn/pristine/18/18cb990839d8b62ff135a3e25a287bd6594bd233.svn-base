<?php
require_once('inc/session.php');
header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=Owners_List.xls");
header("Pragma: no-cache");
header("Expires: 0");

if ($_SESSION['info']){
		require_once('init.php');
		$data= new getQueries ();
		if($_GET['sort']){
		 $owners=$data->show_all('owners', $_GET['sort']);

		}else{
		$owners=$data->show_all('owners', 'name');
		}

	 if ($_SESSION['info']['level']<=3){
		echo "<p class=\"header\">Click on a owner for its details</p>";
		//echo "<a href=\"export_to_excel_owners.php?sort=".$_GET['sort']."\">Export to Excel</a>";
		echo "<hr />";
	 }else{
	   echo "<p class=\"header\">Owners</p><hr />";
	}
	echo "<table align=\"center\" cellpadding=\"2\" cellspacing=\"2\" border=\"0\"><tr class=\"title\"><td class='centro' id=\"td\"><a href=\"view-owners.php?sort=name\">NAME</a></td><td class='centro' id=\"td\"><a href=\"view-owners.php?sort=name\">LASTNAME</a></td>";
	 if ($_SESSION['info']['level']<=3){
	 	echo "<td class='centro' id=\"td\"><a href=\"view-owners.php?sort=email\">EMAIL</a></td>";
		echo "<td class='centro' id=\"td\" ><a href=\"view-owners.php?sort=phone\">PHONE</a></td>";
		echo "<td class='centro' id=\"td\"><a href=\"view-owners.php?sort=country\">COUNTRY</a></td>";
		echo "<td class='centro' id=\"td\"><a href=\"view-owners.php?sort=language\">LANGUAGE</a></td>";
	 }
	  echo "<td class='centro' id=\"td\"><a href=\"view-owners.php?sort=language\">VILLA (S)</a></td>";
	  if ($_SESSION['info']['level']<=3){
		echo "<td class='centro' id=\"td\"><a href=\"view-owners.php?sort=active\">STATUS</a></td></tr>";
	 }

	$x=0;
	foreach ($owners as $k){
	#echo $customers['4']['name'];

	echo "<tr class=\"fila$x\"";  if ($_SESSION['info']['level']<=3){ echo "onmouseover=\"this.style.backgroundColor='#87a2fa'; this.style.cursor='hand';this.style.cursor='pointer';\" onmouseout=\"this.style.backgroundColor=''\" onclick=\"location.href='view-owners-details.php?id=".$k['id']."'\""; } echo ">";
	echo "<td class='derecha' id='td'>"; echo $k['name']; echo "</td>";
	echo "<td class='derecha' id='td'>"; echo  utf8_encode($k['lastname']); echo "</td>";
		 if ($_SESSION['info']['level']<=3){
			echo "<td id='td'>".$k['email']."</td>";
			echo "<td id='td'>".$k['phone']."</td>";
			echo "<td id='td'>".$k['country']."</td>";
			echo "<td id='td'>".$k['language']."</td>";
		}

		$villas=$data->show_data('villas', "`id_owner`=".$k['id'], 'id');

		echo "<td id='td'>";
		 foreach( $villas as $vi){
				echo $vi['no'].",";
		 }
		echo "</td>";

		 if ($_SESSION['info']['level']<=3){

		 if ($k['active']==1){echo "<td class='centro' id='td'>Active</td>";}else{echo "<td class='centro rojo' id='td'>Disabled</td>"; }
		 }
		 if ($x==0){$x++;} elseif ($x==1){$x--;}
	}

		echo "</table>";
 }
		?>