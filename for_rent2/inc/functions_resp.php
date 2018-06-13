<?php
function draw_resp($page){
	require_once(HEADERRESP);
	require_once("pages/page-".$page.".php");
	require_once(FOOTERRESP);
}

?>