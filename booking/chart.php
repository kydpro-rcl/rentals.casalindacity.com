<?php
/*echo realpath('inc/pChart2.1.3/fonts/GeosansLight.ttf');*/

if($_GET){
	require_once('init.php');
	include("inc/pChart2.1.3/class/pData.class.php");
	include("inc/pChart2.1.3/class/pDraw.class.php");
	include("inc/pChart2.1.3/class/pImage.class.php");

	//conseguir los 12 meses con sus a�os de 2 digitos
	//v=14&start=2012-02&end=2013-02

	#$valores=Occupancy_Rate_villa($idvilla=$_GET['v'], $start_month_year=$_GET['start'], $end_month_year=$_GET['end']);
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
          $rate_this_month_year=month_rate_villa($id_villa=$_GET['v'], $month=$mc, $year=$yc);
           //array_push($villa_rates, $rate_this_month_year.'%');
           array_push($villa_rates, $rate_this_month_year);
           $name_month=date('M', strtotime($yc.'-'.$mc.'-01'));
           array_push($villa_months, $name_month.' '.$yc);
		}
	}
    /*echo '<pre>';
	print_r($villa_months);
	echo '</pre>';
	echo '<pre>';
	print_r($villa_rates);
	echo '</pre>';*/
    $db=new getQueries ();
    $v=$db->villa($_GET['v']);

	/*$villa_months=$_GET['meses'];
	$villa_rates=$_GET['rates']; */

	$myData = new pData();
	#$myData->addPoints(array("17%","43%","44%","20%","36%","40%","21%","15%","36%","40%","21%","15%"),"Serie1");
	$myData->addPoints($villa_rates,"Serie1");


	$myData->setSerieDescription("Serie1","Villa ".$v[0]['no']);
	#$myData->setSerieDescription("Serie1",$valores['villa']);
	$myData->setSerieOnAxis("Serie1",0);

	#$myData->addPoints(array("December 13","December 13","December 13","December 13","December 13","December 13","December 13","December 13","December 13","December 13","December 13","August 13"),"Absissa");
	$myData->addPoints($villa_months,"Absissa");

	$myData->setAbscissa("Absissa");
    //$date=date('l jS \of F Y h:i:s A');
    $date=date('jS \of F Y h:i:s A');
	$myData->setAxisPosition(0,AXIS_POSITION_LEFT);
	$myData->setAxisName(0,"Occupancy Rate (".$date.")");
	$myData->setAxisUnit(0,"");

	$myPicture = new pImage(900,430,$myData,TRUE);
	$myPicture->drawRectangle(0,0,899,429,array("R"=>0,"G"=>0,"B"=>0));

	$myPicture->setShadow(TRUE,array("X"=>1,"Y"=>1,"R"=>50,"G"=>50,"B"=>50,"Alpha"=>20));

	$myPicture->setFontProperties(array("FontName"=>realpath("inc/pChart2.1.3/fonts/GeosansLight.ttf"),"FontSize"=>18));
	$TextSettings = array("Align"=>TEXT_ALIGN_MIDDLEMIDDLE
	, "R"=>13, "G"=>56, "B"=>10);
	$myPicture->drawText(450,25,"RCL Stastistics - Trends",$TextSettings);

	$myPicture->setShadow(FALSE);
	$myPicture->setGraphArea(50,50,875,390);
	$myPicture->setFontProperties(array("R"=>0,"G"=>0,"B"=>0,"FontName"=>realpath("/inc/pChart2.1.3/fonts/Bedizen.ttf"),"FontSize"=>9));

	$Settings = array("Pos"=>SCALE_POS_LEFTRIGHT
	, "Mode"=>SCALE_MODE_FLOATING
	, "LabelingMethod"=>LABELING_ALL
	, "GridR"=>255, "GridG"=>255, "GridB"=>255, "GridAlpha"=>50, "TickR"=>0, "TickG"=>0, "TickB"=>0, "TickAlpha"=>50, "LabelRotation"=>0, "CycleBackground"=>1, "DrawXLines"=>1, "DrawSubTicks"=>1, "SubTickR"=>255, "SubTickG"=>0, "SubTickB"=>0, "SubTickAlpha"=>50, "DrawYLines"=>ALL);
	$myPicture->drawScale($Settings);

	$myPicture->setShadow(TRUE,array("X"=>1,"Y"=>1,"R"=>50,"G"=>50,"B"=>50,"Alpha"=>10));

	$Config = array("DisplayValues"=>1);
	$myPicture->drawLineChart($Config);

	$Config = array("FontR"=>0, "FontG"=>0, "FontB"=>0, "FontName"=>realpath("inc/pChart2.1.3/fonts/GeosansLight.ttf"), "FontSize"=>10, "Margin"=>6, "Alpha"=>30, "BoxSize"=>5, "Style"=>LEGEND_NOBORDER
	, "Mode"=>LEGEND_HORIZONTAL
	);
	$myPicture->drawLegend(834,16,$Config);

	$myPicture->stroke();


}else{
 die('No value passed');
}
?>