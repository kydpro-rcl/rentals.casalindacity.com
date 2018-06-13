<?php
include('SimpleICS.php');
$cal = new SimpleICS();
// $cal->productString = '-//77hz/iFLYER API//';
$cal->addEvent(function($e) {
	$e->startDate = new DateTime("2015-04-06T10:00:00+09:00");
	$e->endDate = new DateTime("2015-04-06T18:30:00+09:00");
	$e->uri = 'http://url.to/my/event';
	$e->location = 'Tokyo, Event Location';
	$e->description = 'ICS Entertainment';
	$e->summary = 'Lorem ipsum dolor ics amet, lorem ipsum dolor ics amet, lorem ipsum dolor ics amet, lorem ipsum dolor ics amet';
});


$cal->addEvent(function($e) {
	$e->startDate = new DateTime("2015-04-06T10:00:00+09:00");
	$e->endDate = new DateTime("2015-04-06T18:30:00+09:00");
	$e->uri = 'http://url.to/my/event';
	$e->location = 'Tokyo, Event Location';
	$e->description = 'Evento 2';
	$e->summary = 'Lorem ipsum dolor ics amet, lorem ipsum dolor ics amet, lorem ipsum dolor ics amet, lorem ipsum dolor ics amet';
});


header('Content-Type: '.SimpleICS::MIME_TYPE);
//if (isset($_GET['download'])) {
	header('Content-Disposition: attachment; filename=event.ics');
//}
echo $cal->serialize();

?>