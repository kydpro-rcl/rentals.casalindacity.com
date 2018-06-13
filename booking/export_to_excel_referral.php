<?php
require_once('inc/session.php');
header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=Clients_List.xls");
header("Pragma: no-cache");
header("Expires: 0");

if ($_SESSION['info']){
	//require_once('template/print_clients.php');
	require_once('init.php');

$data = new getQueries ();
if(!$_GET['o']){
$commisioners = $data->show_all ( 'commission', 'id' );
}else{
	switch($_GET['o']){
		case 1:
			$commisioners = $data->show_all ( 'commission', 'name' );
			break;
		case 2:
			$commisioners = $data->show_all ( 'commission', 'email' );
			break;
		case 3:
		    $commisioners = $data->show_all ( 'commission', 'url' );
			break;
		case 4:
		    $commisioners = $data->show_all ( 'commission', 'phone' );
			break;
		case 5:
			$commisioners = $data->show_all ( 'commission', 'active' );
			break;
		case 6:
			$commisioners = $data->show_all ( 'commission', 'tipo' );
			break;
		default:
			$commisioners = $data->show_all ( 'commission', 'id' );
	}
}

echo '<br />';
echo '<p class="header">Referal Agents</p>';
echo '<table align="center" cellpadding="2" cellspacing="2" border="0">';
	echo '<tr class="title">';
		echo '<td class=\'centro\' id="td"><a href="view-interm.php?o=1" alt="">NAME</a></td>';
		echo '<td class=\'centro\' id="td"><a href="view-interm.php?o=2" alt="">EMAIL</a></td>';
		echo '<td class=\'centro\' id="td"><a href="view-interm.php?o=3" alt="">URL</a></td>';
		echo '<td class=\'centro\' id="td"><a href="view-interm.php?o=4" alt="">PHONE</a></td>';
		echo '<td class=\'centro\' id="td">% SHORT</td>';
		echo '<td class=\'centro\' id="td">% LONG</td>';
		echo '<td class=\'centro\' id="td"><a href="view-interm.php?o=5" alt="">STATUS</a></td>';
		echo '<td class=\'centro\' id="td"><a href="view-interm.php?o=6" alt="">TYPE</a></td>';

	echo '</tr>';

$x = 0;
foreach ( $commisioners as $k ) {
	#echo $customers['4']['name'];

echo '<tr class="fila$x">';
		echo '<td class=\'derecha\' id=\'td\'>'.$k ['name'].'&nbsp;'.$k ['lastname'].'</td>';
		echo '<td id=\'td\'>'.$k ['email'].'</td>';
		echo '<td id=\'td\'>'.$k ['url'].'</td>';
		echo '<td id=\'td\'>'.$k ['phone'].'</td>';
		echo '<td id=\'td\'>'.($k ['percent'] *100).'</td>';
		echo '<td id=\'td\'>'.($k ['long_percent'] *100).'</td>';

	if ($k ['active'] == 1) {
		echo "<td class='centro' id='td'>Active</td>";
	} else {
		echo "<td class='centro rojo' id='td'>Disabled</td>";
	}

	if ($k ['tipo'] == 1) {
		echo "<td class='centro' id='td'>WebSite</td>";
	} else {
		echo "<td style='color:blue;' class='centro' id='td'>Referal Agent</td>";
	}

	if ($x==0){$x++;} elseif ($x==1){$x--;}
}



echo "</table>";

}else{
	 header('Location:login.php');
	die();
	 // echo ("<meta http-equiv=\"refresh\" content=\"0;url=../login.php\">");
  }



    echo "<div id=\"footer_main\">
       Please, Visit: <strong>http://www.CasaLindaCity.com</strong> Email: <strong>Reservations@CasaLindaCity.com</strong>
    </div>
</div>";
?>