<?php
include("class/pData.class.php");
include("class/pDraw.class.php");
include("class/pImage.class.php");

$myData = new pData();
$myData->addPoints(array("17%","43%","44%","20%","36%","40%","21%","15%"),"Serie1");
$myData->setSerieDescription("Serie1","Villa 04");
$myData->setSerieOnAxis("Serie1",0);

$myData->addPoints(array("January","February","March","April","May","June","July","August"),"Absissa");
$myData->setAbscissa("Absissa");

$myData->setAxisPosition(0,AXIS_POSITION_LEFT);
$myData->setAxisName(0,"occupancy rate (date)");
$myData->setAxisUnit(0,"");

$myPicture = new pImage(900,430,$myData,TRUE);
$myPicture->drawRectangle(0,0,899,429,array("R"=>0,"G"=>0,"B"=>0));

$myPicture->setShadow(TRUE,array("X"=>1,"Y"=>1,"R"=>50,"G"=>50,"B"=>50,"Alpha"=>20));

$myPicture->setFontProperties(array("FontName"=>"fonts/GeosansLight.ttf","FontSize"=>18));
$TextSettings = array("Align"=>TEXT_ALIGN_MIDDLEMIDDLE
, "R"=>13, "G"=>56, "B"=>10);
$myPicture->drawText(450,25,"RCL Stastistics - Trends",$TextSettings);

$myPicture->setShadow(FALSE);
$myPicture->setGraphArea(50,50,975,390);
$myPicture->setFontProperties(array("R"=>0,"G"=>0,"B"=>0,"FontName"=>"fonts/GeosansLight.ttf","FontSize"=>11));

$Settings = array("Pos"=>SCALE_POS_LEFTRIGHT
, "Mode"=>SCALE_MODE_FLOATING
, "LabelingMethod"=>LABELING_ALL
, "GridR"=>255, "GridG"=>255, "GridB"=>255, "GridAlpha"=>50, "TickR"=>0, "TickG"=>0, "TickB"=>0, "TickAlpha"=>50, "LabelRotation"=>0, "CycleBackground"=>1, "DrawXLines"=>1, "DrawSubTicks"=>1, "SubTickR"=>255, "SubTickG"=>0, "SubTickB"=>0, "SubTickAlpha"=>50, "DrawYLines"=>ALL);
$myPicture->drawScale($Settings);

$myPicture->setShadow(TRUE,array("X"=>1,"Y"=>1,"R"=>50,"G"=>50,"B"=>50,"Alpha"=>10));

$Config = array("DisplayValues"=>1);
$myPicture->drawLineChart($Config);

$Config = array("FontR"=>0, "FontG"=>0, "FontB"=>0, "FontName"=>"fonts/GeosansLight.ttf", "FontSize"=>10, "Margin"=>6, "Alpha"=>30, "BoxSize"=>5, "Style"=>LEGEND_NOBORDER
, "Mode"=>LEGEND_HORIZONTAL
);
$myPicture->drawLegend(834,16,$Config);

$myPicture->stroke();
?>