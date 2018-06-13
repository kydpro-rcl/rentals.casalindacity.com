<html>
<head>
</head>
<body>

<form name="search" method="post" action="villas_for_rent.php">
Search<input type="text" name="stuff" value="<?=$_POST['stuff']?>"> by <select name="by">
  <option value="p_low">Max. prices</option>
  <option value="bed">bedrooms</option>
  <option value="bath">bathrooms</option>
  <option value="capacity">Max. people</option>
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
$result=$db->showSearch($v,$id,$search1,$by);
$total_records=$db->getAffectedRows();
$result=$db->showSearch_page($v,$id,$limit,$search1,$by);
}else{
$result1=$db->showTable($v,$id);
$total_records=$db->getAffectedRows();
$result=$db->showTable_page($v,$id,$limit);
}
if (empty($result)){echo "We sorry, No Result Found<hr/></body>
</html>";
die();}
$pages=ceil($total_records/$rows_per_page);
$row=$db->getAffectedRows();
  ?>
<!-- <table border="1">
<tr><th>ID</th><th>Type</th></tr>  -->

<p>Total villas found: <?=$total_records;?> </p>
<p>Total pages: <?=$pages;?> </p>
<table>
<?

// print_r($result);
$count=0;
 foreach($result as $k)
{
  $count++;
  ?>
  <tr><td><img alt="<?=$k['type'].$k['no'];?>" src="<?=$k['pic'];?>" with="153" height="103"> </td><td>Villa No.<b><?=$k['no'];?></b> Bath: <b><?=$k['bath'];?></b> Bedrooms: <b><?=$k['bed'];?></b> Price: <b><?=$k['p_low'];?></b> Max. People: <b><?=$k['capacity'];?></b></td></tr>
  <?
 //echo "<tr><td>".$k['id']. "</td><td>"."-".$k['type']. "</td></tr>";
}
?>
 </table><hr/>
 <?
 // let's create the dynamic links now
if ($screen > 0) {  isset($search1) ? $url = "villas_for_rent.php?page=".($screen)."&search=".$search1."&by=".$by : $url = "villas_for_rent.php?page=" .($screen);

  echo "<a href=\"$url\">Previous</a>\n";
}
// page numbering links now
for ($i = 1; $i <= $pages; $i++) {
 isset($search1) ? $url = "villas_for_rent.php?page=".($i)."&search=".$search1."&by=".$by : $url = "villas_for_rent.php?page=" .($i);
 // $url = "villas_for_rent.php?page=" . ($i);
  if($i<>($screen+1)){echo " | <a href=\"$url\">Page $i</a> | ";}else{echo " | Page $i | ";};
}
if ($screen < ($pages-1)) {
  isset($search1) ? $url = "villas_for_rent.php?page=".($screen+2)."&search=".$search1."&by=".$by : $url = "villas_for_rent.php?page=" .($screen+2);
  //$url = "villas_for_rent.php?page=" .($screen+2);
  echo "<a href=\"$url\">Next</a>\n";
}
  ?>

<!--</table>-->
</body>
</html>