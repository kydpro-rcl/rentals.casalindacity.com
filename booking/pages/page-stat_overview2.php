<?php
require_once('pages/statistics_month_year.php');
require_once('pages/statistics_overview.php');
?>
<p style="font-size:10px;padding:0; margin:0;">&nbsp;</p>
<p style="font-size:10px;padding:0; margin:0;">RCL Booking System - Statistics Report for <? echo date('F', strtotime('2013-'.$this_month.'-01'))." ".$this_year;?> </p>
<p style="font-size:10px;padding:0; margin:0;">Printed by: <? echo ucfirst($_SESSION['info']['name'])." ".ucfirst($_SESSION['info']['lastname']) ?> on <?=formatear_fecha(date('Y-m-d'));?> <?=date('H:i:s');?>

