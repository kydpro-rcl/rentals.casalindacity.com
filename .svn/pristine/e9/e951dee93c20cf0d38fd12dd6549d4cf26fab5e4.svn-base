<?
$id=$_GET['id'];
$ref=$_GET['r'];

if (!$_GET['id']) $id=$_POST['id'];
if (!$_GET['r']) $ref=$_POST['r'];
$db=new getQueries();
$oc=$db->see_occupancy_ref($_GET['ref']);
?>
<p>&nbsp;</p>
<p style="text-align:center"><img src="images/TripAdvisor2.jpg" alt="" width="200px;" height="171px"/></p>

<!--<p>&nbsp;</p>
<p>&nbsp;</p>-->

<style>
.boton_h:hover{
	background-position:left bottom; 
	}
</style>
<form method="post" action="check_out_confirm.php">
<input type="hidden" name="ref" value="<?=$_GET['ref']?>" />
<input type="hidden" name="id" value="<?=$_GET['id']?>" />
<table><tr><td>
<? tripadvisor_question(); ?>
</td><td>
<p style="text-align:center;"> <input type="submit" class="boton_h" name="continue" value="" style="background-image:url(images/btsiysq.png);width:225px;height:72px;display:block; color:white; background-color:transparent; border:0px;" border="0" /></p>
</td></tr></table>
<p><strong>Booking Note:</strong> <? if($oc[0]['rc']){ echo $oc[0]['rc']; }else{ echo "There is not comments";}?></p>
</form>
