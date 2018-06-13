<? include('menu_CSS/menu-admin.php');?>
<?
//go to db and take current seasons
$db= new getQueries ();
//$season=$db->show_id('seasons2', 1);
//$s=$season[0];
/*echo "<pre>";
print_r($season);
echo "</pre>";*/
$ls=$db->display_table($table='seasons3', $condition=" type='1' AND active='1'", $order='id');//low season [order DESC]
$ss=$db->show_data($table='seasons3', $condition=" type='2' AND active='1'", $order='id');//shoulder season [order ASC]
$hs=$db->display_table($table='seasons3', $condition=" type='3' AND active='1'", $order='id');//high season [order DESC]


$rand = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f');
$color = '#'.$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)];

if($_GET['susscee_hs']){
?>
<p style="font-weight:bold; color:red; background-color:yellow; text-align:center;"><?=$_GET['error_hs'];?></p>
<p style="font-weight:bold; color:white; background-color:<?=$color?>; text-align:center;padding:10px; margin:10px;"><?=$_GET['susscee_hs'];?></p>
<?}?>
<hr />


<p>&nbsp;</p>
<table align="center" cellpadding="0" cellspacing="0"><tr><td>
<form name="seasons" method="post" action="seasons3.php">
<fieldset><legend>Update</legend>

    <!--start nex season-->
    <p class="blue_light">Low Season:<br/>  <span style="color:black">from:
    <select name="lsm">
    <? for ($i=1; $i<=12; $i++) {

        ?>
        <option value="<?=$i?>" <? if ($ls[0]['start_mont']==$i) echo "selected=\"selected\"";?>><? echo dame_nombre_mes($i);?></option>
    <? } ?>
    </select>

    <select name="lsd">
    <? for ($i=1; $i<=31; $i++) {

        ?>
        <option value="<?=$i?>" <? if ($ls[0]['start_day']==$i) echo "selected=\"selected\"";?>><?=$i?></option>
    <? } ?>
    </select>

   to:</span>

    <select name="lem">
    <? for ($i=1; $i<=12; $i++) {
        //echo $i.'<br />';
        ?>
        <option value="<?=$i?>" <? if ($ls[0]['end_mont']==$i) echo "selected=\"selected\"";?>><? echo dame_nombre_mes($i);?></option>
    <? } ?>
    </select>

    <select name="led">
    <? for ($i=1; $i<=31; $i++) {
        //echo $i.'<br />';
        ?>
        <option value="<?=$i?>" <? if ($ls[0]['end_day']==$i) echo "selected=\"selected\"";?>><?=$i?></option>
    <? } ?>
    </select>
	<input type="hidden" name="lowseasontype" value="1"/>
    </p>

    <!--start nex season-->
    <p class="blue_light">Shoulder Season:<br/>  <span style="color:black">from:
    <select name="ssm">
    <? for ($i=1; $i<=12; $i++) {

        ?>
        <option value="<?=$i?>" <? if ($ss[0]['start_mont']==$i) echo "selected=\"selected\"";?>><? echo dame_nombre_mes($i);?></option>
    <? } ?>
    </select>

    <select name="ssd">
    <? for ($i=1; $i<=31; $i++) {

        ?>
        <option value="<?=$i?>" <? if ($ss[0]['start_day']==$i) echo "selected=\"selected\"";?>><?=$i?></option>
    <? } ?>
    </select>

     to:</span>

    <select name="sem">
    <? for ($i=1; $i<=12; $i++) {
        //echo $i.'<br />';
        ?>
        <option value="<?=$i?>" <? if ($ss[0]['end_mont']==$i) echo "selected=\"selected\"";?>><? echo dame_nombre_mes($i);?></option>
    <? } ?>
    </select>

    <select name="sed">
    <? for ($i=1; $i<=31; $i++) {
        //echo $i.'<br />';
        ?>
        <option value="<?=$i?>" <? if ($ss[0]['end_day']==$i) echo "selected=\"selected\"";?>><?=$i?></option>
    <? } ?>
    </select>
	
	<br/>  <span style="color:black">from:
    <select name="ssm2">
    <? for ($i=1; $i<=12; $i++) {

        ?>
        <option value="<?=$i?>" <? if ($ss[1]['start_mont']==$i) echo "selected=\"selected\"";?>><? echo dame_nombre_mes($i);?></option>
    <? } ?>
    </select>

    <select name="ssd2">
    <? for ($i=1; $i<=31; $i++) {

        ?>
        <option value="<?=$i?>" <? if ($ss[1]['start_day']==$i) echo "selected=\"selected\"";?>><?=$i?></option>
    <? } ?>
    </select>

     to:</span>

    <select name="sem2">
    <? for ($i=1; $i<=12; $i++) {
        //echo $i.'<br />';
        ?>
        <option value="<?=$i?>" <? if ($ss[1]['end_mont']==$i) echo "selected=\"selected\"";?>><? echo dame_nombre_mes($i);?></option>
    <? } ?>
    </select>

    <select name="sed2">
    <? for ($i=1; $i<=31; $i++) {
        //echo $i.'<br />';
        ?>
        <option value="<?=$i?>" <? if ($ss[1]['end_day']==$i) echo "selected=\"selected\"";?>><?=$i?></option>
    <? } ?>
    </select>

	<input type="hidden" name="shoulderseasontype" value="2"/>
    </p>



    <p class="blue_light">High Season:<br/> <span style="color:black">from:
    <select name="hsm">
    <? for ($i=1; $i<=12; $i++) {
        //echo $i.'<br />';
        ?>
        <option value="<?=$i?>" <? if ($hs[0]['start_mont']==$i) echo "selected=\"selected\"";?>><? echo dame_nombre_mes($i);?></option>
    <? } ?>
    </select>

    <select name="hsd">
    <? for ($i=1; $i<=31; $i++) {
        //echo $i.'<br />';
        ?>
        <option value="<?=$i?>" <? if ($hs[0]['start_day']==$i) echo "selected=\"selected\"";?>><?=$i?></option>
    <? } ?>
    </select>

   to:</span>

     <select name="hem">
    <? for ($i=1; $i<=12; $i++) {
        //echo $i.'<br />';
        ?>
        <option value="<?=$i?>" <? if ($hs[0]['end_mont']==$i) echo "selected=\"selected\"";?>><? echo dame_nombre_mes($i);?></option>
    <? } ?>
    </select>

    <select name="hed">
    <? for ($i=1; $i<=31; $i++) {
        //echo $i.'<br />';
        ?>
        <option value="<?=$i?>" <? if ($hs[0]['end_day']==$i) echo "selected=\"selected\"";?>><?=$i?></option>
    <? } ?>
    </select>
	<input type="hidden" name="highseasontype" value="3"/>
    </p>
	<input type="hidden" name="idlow" value="<?=$ls[0]['id']?>" />
	<input type="hidden" name="idsh" value="<?=$ss[0]['id']?>" />
	<input type="hidden" name="idsh2" value="<?=$ss[1]['id']?>" />
	<input type="hidden" name="idhigh" value="<?=$hs[0]['id']?>" />
	
	<!--<input type="hidden" name="idseason" value="<?=$season[0]['id']?>"  title="update seasons"/>-->
    <input class="book_but" type="submit" name="update" value="update"  title="update seasons"/>
   </fieldset>
</form>
</td></tr></table>

<!--<h2 style="text-align:center;">Current Seasons</h2>
<table align="center"><tr><td>

<p class="blue_light">Low <br/><span style="color:black">From</span> <span class="blue_dark"><u><?=$season[0]['l_starting']?></u></span> To <span class="blue_dark"><u><?=$season[0]['l_ending']?></u></span> </p>
<p class="blue_light">Shoulder <br/><span style="color:black">From</span> <span class="blue_dark"><u><?=$season[0]['l_starting']?></u></span> To <span class="blue_dark"><u><?=$season[0]['l_ending']?></u></span> </p>
<p class="blue_light">High <br/><span style="color:black">From</span> <span class="blue_dark"><u><?=$season[0]['h_starting']?></u></span> To <span class="blue_dark"><u><?=$season[0]['h_ending']?></u></span>  </p>

</td></tr></table>-->