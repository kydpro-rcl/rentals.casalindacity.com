<?php
// output headers so that the file is downloaded rather than displayed
$name=time();
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=data_'.$name.'.csv');

// create a file pointer connected to the output stream
$output = fopen('php://output', 'w');

// output the column headings
fputcsv($output, array('Column 1', 'Column 2', 'Column 3'));

// fetch the data

$rows = array('1','2','3');
$rows2 = array('4','5','6');
$rows3 = array(date('l jS \of F Y h:i:s A'), date('l jS \of F Y h:i:s A',$name), $name);

// loop over the rows, outputting them
fputcsv($output, $rows);
fputcsv($output, $rows2);
fputcsv($output, $rows3);

?>