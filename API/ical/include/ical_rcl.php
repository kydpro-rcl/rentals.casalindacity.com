<?php

function ical_header(){
	$head="BEGIN:VCALENDAR\r\n";
	$head.="VERSION:2.0\r\n";
	$head.="PRODID:-//hacksw/handcal//NONSGML v1.0//EN\r\n";
	$head.="METHOD:PUBLISH\r\n";
	$head.="CALSCALE:GREGORIAN\r\n";
	
	return $head;
}

function ical_event($ini,$ter,$v_id){
	$event="BEGIN:VEVENT\r\n";
	$event.="UID:".uniqid()."\r\n";
	$event.="DTSTART:$ini\r\n";
	$event.="DTEND:$ter\r\n";
	$event.="DTSTAMP:".date('Ymd\THis\Z')."\r\n";
	$event.="LOCATION:Sosua Dominican Republic\r\n";
	$event.="DESCRIPTION:Property id$v_id\r\n";
	$event.="URL;VALUE=URI:http://rentals.casalindacity.com\r\n";
	$event.="SUMMARY:Not available\r\n";
	$event.="END:VEVENT\r\n";
	return $event;
}

function ical_footer(){
	$foot="END:VCALENDAR\r\n";
	return $foot;
}