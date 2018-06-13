<form name="search" method="post" action="index.php">
Search<input type="text" name="stuff" value="<?=$_POST['stuff']?>" style="text-align:right">
by <select name="by">
  <option value="p_low" <? if ($_POST['by']=="p_low") echo "selected='selected'"; ?> >Max. prices</option>
  <option value="bed" <? if ($_POST['by']=="bed") echo "selected='selected'"; ?> >bedrooms</option>
  <option value="bath" <? if ($_POST['by']=="bath") echo "selected='selected'"; ?> >bathrooms</option>
  <option value="capacity" <? if ($_POST['by']=="capacity") echo "selected='selected'"; ?> >Max. people</option>
</select> <input type="submit" name="search" value="Go">
</form>
<hr/>
<?require_once('init.php');
$v="villas";   $id="id";
$db = new getQueries;
$rows_per_page=5;


if ($_GET['page'])
	$screen=($_GET['page']-1);


if (!isset($screen))
  $screen = 0;

$start = $screen * $rows_per_page;


$limit="LIMIT $start, $rows_per_page";

//$sql="SELECT * FROM ".DB_PREFIX."villas` ORDER BY `".DB_PREFIX."villas`.`id` ASC LIMIT 0,30";

//$result=$db->showTable($v,$id);

if (($_POST['search'])&&($_POST['stuff']!='')||($_GET['search'])&&($_GET['by'])){//echo "Que busca";
// exit();
 (empty($_POST['search'])) ? $search1=$_GET['search'] : $search1=$_POST['stuff'];
 (!$_GET['by']) ? $by=$_POST['by'] : $by=$_GET['by'];
// $search=$_POST['stuff'];
// $by=$_POST['by'];
if (($by!="p_low")&&($by!="bed")&&($by!="bath")&&($by!="capacity")){
//die('Access restrinted...');
unset($result);
}else{
	$result=$db->showSearch_r($v,$id,$search1,$by);//query
	$total_records=$db->getAffectedRows();
	$result=$db->showSearch_page_r($v,$id,$limit,$search1,$by);//query
  }}else{ $result1=$db->showTable_r($v, 'able_r', '1', '=');
//$result1=$db->showTable($v,$id);//query
$total_records=$db->getAffectedRows();

$result=$db->showTable_page_r($v,$id,$limit);//query
//$result=$db->showTable_page($v,$id,$limit);//query
}
if (empty($result)){echo "<p style='color:red; text-align:center; font-weight:bold;'>We sorry, No Result Found.<hr/></p>";
//die();}else{
	$pages=ceil($total_records/$rows_per_page);
	$row=$db->getAffectedRows();
	  ?>
	<!-- <table border="1">
	<tr><th>ID</th><th>Type</th></tr>  -->

	<p style=" font-size: 10px; font-weight: bold;">
		<span style="color: rgb(102, 102, 102);">Total found:</span>
		<span style="color: rgb(0, 0, 0);"> <?=$total_records;?> houses / <?=$pages;?> pages </span>
	</p>
	<table>
	<?

	// print_r($result);
	$count=0;
	 foreach($result as $k)
	{
	  $count++;
	  ?>
	  <tr>
	  	<td>
	  		<img alt="<?=$k['type'].$k['no'];?>" src="../booking/<?=$k['pic'];?>" width="153" height="103">
	  	</td>
	  	<td valign="top">
	  	<p><span style="color: rgb(51, 153, 255); font-size: 12px; font-weight: bold;"><?=$k['type'];?> Villa No. <?=$k['no'];?> - (Max. <?=$k['capacity'];?> persons) </span>
	  	 <br><b>Details:</b> Size:<?=$k['m2'];?>m&sup2; / <?=$k['ft2'];?>ft&sup2;, <?=$k['bed'];?>  Air conditioned bedrooms, <?=$k['bath'];?>&nbsp;full&nbsp;Bathrooms, private pool, charcoal BBQ, Free WI-Fi.
	  	 <br/>
	  	 	<b><span style="color: rgb(0, 0, 0); font-size: 10px; font-weight: bold;">Price per night:</span>
	  	 	<span style="color: rgb(0, 0, 0); font-size: 10px; font-weight: bold;">&nbsp;
	  	 	(<span style="color: rgb(102, 102, 102);"><u>Apr 05-Dec 15</u></span> - <?=$k['p_low'];?> US$/
	  	 	<span style="color: rgb(102, 102, 102);"><u>Dec 16-Apr 04</u></span> - <?=$k['p_high'];?> US$) + 16% VAT Taxes.</span></b>
	  	 	<br>
       		<span style="color: rgb(0, 0, 0); font-size: 10px; font-weight: bold;">
       			<a href="http://localhost/casalindacity/contact.php">Ask for more info</a> - <a style="cursor: pointer;" onmouseover="this.style.cursor='hand';this.style.cursor='pointer';" onclick="house('01'); return false;">See Pictures</a> - <a href="book_search.php">Rent</a></span>

	  	 <br>
	  	 </p>
	  	</td>
	  </tr>
	  <?
	 //echo "<tr><td>".$k['id']. "</td><td>"."-".$k['type']. "</td></tr>";
	}
	?>
	 </table><hr/>
	 <?
	 // let's create the dynamic links now
	if ($screen > 0) {	  isset($search1) ? $url = "index.php?page=".($screen)."&search=".$search1."&by=".$by : $url = "index.php?page=" .($screen);

	  echo "<a href=\"$url\">Previous</a>\n";
	}
	// page numbering links now
	for ($i = 1; $i <= $pages; $i++) {
	 isset($search1) ? $url = "index.php?page=".($i)."&search=".$search1."&by=".$by : $url = "index.php?page=" .($i);
	 // $url = "villas_for_rent.php?page=" . ($i);
	  if($i<>($screen+1)){echo " | <a href=\"$url\">Page $i</a> | ";}else{echo " | Page $i | ";};
	}
	if ($screen < ($pages-1)) {
	  isset($search1) ? $url = "index.php?page=".($screen+2)."&search=".$search1."&by=".$by : $url = "index.php?page=" .($screen+2);
	  //$url = "villas_for_rent.php?page=" .($screen+2);
	  echo "<a href=\"$url\">Next</a>\n";
	}
}
  ?>

<!--</table>-->