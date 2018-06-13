<? include('menu_CSS/menu-admin.php');?>
<?
//go to db and take current seasons
$db= new getQueries ();
$season=$db->show_id('seasons2', 1);
$s=$season[0];
/*echo "<pre>";
print_r($season);
echo "</pre>";*/
?>
<p>&nbsp;</p>
<table align="center" cellpadding="0" cellspacing="0"><tr><td>
<form name="seasons" method="post" action="seasons2.php">
<fieldset><legend>Update</legend>

    <!--start nex season-->
    <p class="blue_light">Low Season:<br/>  <span style="color:black">from:
    <select name="lsm">
    <? for ($i=1; $i<=12; $i++) {

        ?>
        <option value="<?=$i?>" <? if ($s['low_start_month']==$i) echo "selected=\"selected\"";?>><? echo dame_nombre_mes($i);?></option>
    <? } ?>
    </select>

    <select name="lsd">
    <? for ($i=1; $i<=31; $i++) {

        ?>
        <option value="<?=$i?>" <? if ($s['low_start_day']==$i) echo "selected=\"selected\"";?>><?=$i?></option>
    <? } ?>
    </select>

   to:</span>

    <select name="lem">
    <? for ($i=1; $i<=12; $i++) {
        //echo $i.'<br />';
        ?>
        <option value="<?=$i?>" <? if ($s['low_end_month']==$i) echo "selected=\"selected\"";?>><? echo dame_nombre_mes($i);?></option>
    <? } ?>
    </select>

    <select name="led">
    <? for ($i=1; $i<=31; $i++) {
        //echo $i.'<br />';
        ?>
        <option value="<?=$i?>" <? if ($s['low_end_day']==$i) echo "selected=\"selected\"";?>><?=$i?></option>
    <? } ?>
    </select>
    </p>

    <!--start nex season-->
    <p class="blue_light">Shoulder Season:<br/>  <span style="color:black">from:
    <select name="ssm">
    <? for ($i=1; $i<=12; $i++) {

        ?>
        <option value="<?=$i?>" <? if ($s['sh_start_month']==$i) echo "selected=\"selected\"";?>><? echo dame_nombre_mes($i);?></option>
    <? } ?>
    </select>

    <select name="ssd">
    <? for ($i=1; $i<=31; $i++) {

        ?>
        <option value="<?=$i?>" <? if ($s['sh_start_day']==$i) echo "selected=\"selected\"";?>><?=$i?></option>
    <? } ?>
    </select>

     to:</span>

    <select name="sem">
    <? for ($i=1; $i<=12; $i++) {
        //echo $i.'<br />';
        ?>
        <option value="<?=$i?>" <? if ($s['sh_end_month']==$i) echo "selected=\"selected\"";?>><? echo dame_nombre_mes($i);?></option>
    <? } ?>
    </select>

    <select name="sed">
    <? for ($i=1; $i<=31; $i++) {
        //echo $i.'<br />';
        ?>
        <option value="<?=$i?>" <? if ($s['sh_end_day']==$i) echo "selected=\"selected\"";?>><?=$i?></option>
    <? } ?>
    </select>
	
	<br/>  <span style="color:black">from:
    <select name="ssm2">
    <? for ($i=1; $i<=12; $i++) {

        ?>
        <option value="<?=$i?>" <? if ($s['sh2_sm']==$i) echo "selected=\"selected\"";?>><? echo dame_nombre_mes($i);?></option>
    <? } ?>
    </select>

    <select name="ssd2">
    <? for ($i=1; $i<=31; $i++) {

        ?>
        <option value="<?=$i?>" <? if ($s['sh2_sd']==$i) echo "selected=\"selected\"";?>><?=$i?></option>
    <? } ?>
    </select>

     to:</span>

    <select name="sem2">
    <? for ($i=1; $i<=12; $i++) {
        //echo $i.'<br />';
        ?>
        <option value="<?=$i?>" <? if ($s['sh2_em']==$i) echo "selected=\"selected\"";?>><? echo dame_nombre_mes($i);?></option>
    <? } ?>
    </select>

    <select name="sed2">
    <? for ($i=1; $i<=31; $i++) {
        //echo $i.'<br />';
        ?>
        <option value="<?=$i?>" <? if ($s['sh2_ed']==$i) echo "selected=\"selected\"";?>><?=$i?></option>
    <? } ?>
    </select>


    </p>



    <p class="blue_light">High Season:<br/> <span style="color:black">from:
    <select name="hsm">
    <? for ($i=1; $i<=12; $i++) {
        //echo $i.'<br />';
        ?>
        <option value="<?=$i?>" <? if ($s['high_start_month']==$i) echo "selected=\"selected\"";?>><? echo dame_nombre_mes($i);?></option>
    <? } ?>
    </select>

    <select name="hsd">
    <? for ($i=1; $i<=31; $i++) {
        //echo $i.'<br />';
        ?>
        <option value="<?=$i?>" <? if ($s['high_start_day']==$i) echo "selected=\"selected\"";?>><?=$i?></option>
    <? } ?>
    </select>

   to:</span>

     <select name="hem">
    <? for ($i=1; $i<=12; $i++) {
        //echo $i.'<br />';
        ?>
        <option value="<?=$i?>" <? if ($s['high_end_month']==$i) echo "selected=\"selected\"";?>><? echo dame_nombre_mes($i);?></option>
    <? } ?>
    </select>

    <select name="hed">
    <? for ($i=1; $i<=31; $i++) {
        //echo $i.'<br />';
        ?>
        <option value="<?=$i?>" <? if ($s['high_end_day']==$i) echo "selected=\"selected\"";?>><?=$i?></option>
    <? } ?>
    </select>

    </p>
	<input type="hidden" name="idseason" value="<?=$season[0]['id']?>"  title="update seasons"/>
    <input class="book_but" type="submit" name="update" value="update"  title="update seasons"/>
   </fieldset>
</form>
</td></tr></table>
<hr />
<p style="font-weight:bold; color:red; background-color:yellow; text-align:center;"><?=$_GET['error_hs'];?></p>
<p style="font-weight:bold; color:blue; background-color:lime; text-align:center;"><?=$_GET['susscee_hs'];?></p>
<!--<h2 style="text-align:center;">Current Seasons</h2>
<table align="center"><tr><td>

<p class="blue_light">Low <br/><span style="color:black">From</span> <span class="blue_dark"><u><?=$season[0]['l_starting']?></u></span> To <span class="blue_dark"><u><?=$season[0]['l_ending']?></u></span> </p>
<p class="blue_light">Shoulder <br/><span style="color:black">From</span> <span class="blue_dark"><u><?=$season[0]['l_starting']?></u></span> To <span class="blue_dark"><u><?=$season[0]['l_ending']?></u></span> </p>
<p class="blue_light">High <br/><span style="color:black">From</span> <span class="blue_dark"><u><?=$season[0]['h_starting']?></u></span> To <span class="blue_dark"><u><?=$season[0]['h_ending']?></u></span>  </p>

</td></tr></table>-->