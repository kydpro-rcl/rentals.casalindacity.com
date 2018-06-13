<?php
ini_set('memory_limit', '-1');//It will take unlimited memory usage of server

require_once("inc/dompdf/dompdf_config.inc.php");

ob_start();
require_once(dirname(__FILE__)."/stat_overview.php");
$dompdf = new DOMPDF();

$orientation = "landscape";
$paper='letter';
$dompdf->set_paper($paper, $orientation);

$dompdf->load_html(ob_get_clean());
$dompdf->render();
$dompdf->stream("file.pdf");

?>