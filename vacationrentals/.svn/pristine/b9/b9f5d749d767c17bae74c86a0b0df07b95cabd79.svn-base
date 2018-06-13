<?php
function draw_resp($page){
	require_once(HEADERRESP);
	require_once("pages/page-".$page.".php");
	require_once(FOOTERRESP);
}

function get_paging_info($tot_rows,$pp,$curr_page){
    $pages = ceil($tot_rows / $pp); // calc pages
    $data = array(); // start out array
    $data['si']        = ($curr_page * $pp) - $pp; // what row to start at
    $data['pages']     = $pages;                   // add the pages
    $data['curr_page'] = $curr_page;               // Whats the current page
    return $data; //return the paging data
}
?>