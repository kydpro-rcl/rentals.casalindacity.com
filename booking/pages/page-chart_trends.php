<?php
include('menu_CSS/menu-admin.php');
?>

<?
//$_GET['start']='2012-05';
$_GET['start']=($_GET['y']-1).'-'.$_GET['m'];
//$_GET['end']='2013-05';
$_GET['end']=$_GET['y'].'-'.$_GET['m'];
  /*
echo $_GET['start'];
echo "<br/>";
echo $_GET['end'];
  */
 $start=explode('-',$_GET['start']);
	$end=explode('-',$_GET['end']);
	$year1=$start[0];
	$year2=$end[0];
	$month1=$start[1];
	$month2=$end[1];

      $villa_rates=array();
      $villa_months=array();
	for($i=$year1;$i<=$year2; $i++){
		if($i==$year1){$pm=$month1;}else{$pm='01';}
		if($i==$year2){$um=$month2;}else{$um='12';}

		for($m=$pm; $m<=$um; $m++){
          $yc=$i; $mc=$m;
          $rate_this_month_year=month_rate_villa($id_villa=$_GET['id'], $month=$mc, $year=$yc);
           array_push($villa_rates, $rate_this_month_year.'%');
           $name_month=date('M', strtotime($yc.'-'.$mc.'-01'));
           array_push($villa_months, $name_month.' '.$yc);
		}
	}

	$db=new getQueries ();
    $v=$db->villa($_GET['id']);

    /*echo '<pre>';
    print_r($villa_months);
    echo '</pre>';
    echo '<pre>';
    print_r($villa_rates);
    echo '</pre>';*/
?>

<img src="chart.php?v=<?=$_GET['id']?>&start=<?=$_GET['start']?>&end=<?=$_GET['end']?>" alt="" />

<p>&nbsp;</p>
<h2>Villa No.<?=$v[0]['no']?></h2>
<table border='1' cellspacing="0" cellpadding="2">
	<tr>
	<? foreach($villa_months AS $k=>$v){?>     <td><?=$v?></td>
    <?}?>
    </tr>
    <tr>
	<? foreach($villa_rates AS $k=>$v){?>
     <td><?=$v?></td>
    <?}?>
    </tr>
</table>
<?
//Delete 	32=31
 //echo month_rate_villa($id_villa='32', $month='04', $year='2013');
?>
<!--//<p>&nbsp;</p>
<p><a href="PDF_statistics.php?m=<?=$this_month?>&y=<?=$this_year?>"><img src="images/export_to_pdf.png" alt="Export to PDF" width="150px" height="75px" /></a></p>//-->