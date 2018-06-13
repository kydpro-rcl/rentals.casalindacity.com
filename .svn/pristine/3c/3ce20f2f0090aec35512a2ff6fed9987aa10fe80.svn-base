<? include('menu_CSS/menu-admin.php');?>
<?
//go to db and take current seasons
$db= new getQueries ();
$season=$db->show_id('seasons', 1);
//echo date("M-d-Y", easter_date(2010));  //easter day of an year   (Domingo Santo)

$inicio_t_alta=$season[0]['h_starting'];
$fin_t_alta=$season[0]['h_ending'];
$inicio_t_baja=$season[0]['l_starting'];
$fin_t_baja=$season[0]['l_ending'];

//echo $inicio_t_alta;
 //  $date = explode('/', $date);
 $HS_inicio=explode('-', $inicio_t_alta);
 $HS_fin=explode('-', $fin_t_alta);
 $LS_inicio=explode('-', $inicio_t_baja);
 $LS_fin=explode('-', $fin_t_baja);

?>
<p>&nbsp;</p>
<table align="center" cellpadding="0" cellspacing="0"><tr><td>
<form name="seasons" method="post" action="seasons.php">
<fieldset><legend>Update</legend>
    <p class="blue_light">High Season From:
    <select name="high_month_f">
    <? for ($i=1; $i<=12; $i++) {
        //echo $i.'<br />';
        ?>
        <option value="<?=$i?>" <? if ($HS_inicio[1]==$i) echo "selected=\"selected\"";?>><? echo dame_nombre_mes($i);?></option>
    <? } ?>
    </select>

    <select name="high_day_f">
    <? for ($i=1; $i<=31; $i++) {
        //echo $i.'<br />';
        ?>
        <option value="<?=$i?>" <? if ($HS_inicio[2]==$i) echo "selected=\"selected\"";?>><?=$i?></option>
    <? } ?>
    </select>

    <select name="high_year_f">

        <?
        $year=date('Y');
        ?>
    <? for ($i=-1; $i<=2; $i++) {
         $year_actual=$year+$i;
        ?>
        <option value="<?=$year_actual?>" <? if ($HS_inicio[0]==$year_actual) echo "selected=\"selected\"";?>><?=$year_actual?></option>
    <? } ?>
    </select> To:

     <select name="high_month_t">
    <? for ($i=1; $i<=12; $i++) {
        //echo $i.'<br />';
        ?>
        <option value="<?=$i?>" <? if ($HS_fin[1]==$i) echo "selected=\"selected\"";?>><? echo dame_nombre_mes($i);?></option>
    <? } ?>
    </select>

    <select name="high_day_t">
    <? for ($i=1; $i<=31; $i++) {
        //echo $i.'<br />';
        ?>
        <option value="<?=$i?>" <? if ($HS_fin[2]==$i) echo "selected=\"selected\"";?>><?=$i?></option>
    <? } ?>
    </select>

    <select name="high_year_t">

         <?
        $year=date('Y');
        ?>
    <? for ($i=-1; $i<=2; $i++) {
         $year_actual=$year+$i;
        ?>
        <option value="<?=$year_actual?>" <? if ($HS_fin[0]==$year_actual) echo "selected=\"selected\"";?>><?=$year_actual?></option>
    <? } ?>
    </select>

    </p>
    <!--start nex season-->
    <p class="blue_light">Low Season From:
    <select name="low_month_f">
    <? for ($i=1; $i<=12; $i++) {

        ?>
        <option value="<?=$i?>" <? if ($LS_inicio[1]==$i) echo "selected=\"selected\"";?>><? echo dame_nombre_mes($i);?></option>
    <? } ?>
    </select>

    <select name="low_day_f">
    <? for ($i=1; $i<=31; $i++) {

        ?>
        <option value="<?=$i?>" <? if ($LS_inicio[2]==$i) echo "selected=\"selected\"";?>><?=$i?></option>
    <? } ?>
    </select>

    <select name="low_year_f">

         <?
        $year=date('Y');
        ?>
    <? for ($i=-1; $i<=2; $i++) {
         $year_actual=$year+$i;
        ?>
        <option value="<?=$year_actual?>" <? if ($LS_inicio[0]==$year_actual) echo "selected=\"selected\"";?>><?=$year_actual?></option>
    <? } ?>

    </select> To:

    <select name="low_month_t">
    <? for ($i=1; $i<=12; $i++) {
        //echo $i.'<br />';
        ?>
        <option value="<?=$i?>" <? if ($LS_fin[1]==$i) echo "selected=\"selected\"";?>><? echo dame_nombre_mes($i);?></option>
    <? } ?>
    </select>

    <select name="low_day_t">
    <? for ($i=1; $i<=31; $i++) {
        //echo $i.'<br />';
        ?>
        <option value="<?=$i?>" <? if ($LS_fin[2]==$i) echo "selected=\"selected\"";?>><?=$i?></option>
    <? } ?>
    </select>

    <select name="low_year_t">

        <?
        $year=date('Y');
        ?>
    <? for ($i=-1; $i<=2; $i++) {
         $year_actual=$year+$i;
        ?>
        <option value="<?=$year_actual?>" <? if ($LS_fin[0]==$year_actual) echo "selected=\"selected\"";?>><?=$year_actual?></option>
    <? } ?>
    </select>

    </p>
    <input class="book_but" type="submit" name="update" value="update"  title="update seasons"/>
   </fieldset>
</form>
</td></tr></table>
<hr />
<p style="font-weight:bold; color:red; background-color:yellow; text-align:center;"><?=$_GET['error_hs'];?></p>
<p style="font-weight:bold; color:blue; background-color:lime; text-align:center;"><?=$_GET['susscee_hs'];?></p>
<h2 style="text-align:center;">Current Seasons</h2>
<table align="center"><tr><td>

<p class="blue_light">High From <span class="blue_dark"><u><?=formatear_fecha($season[0]['h_starting'])?></u></span> To <span class="blue_dark"><u><?=formatear_fecha($season[0]['h_ending'])?></u></span>  </p>
<p class="blue_light">Low From <span class="blue_dark"><u><?=formatear_fecha($season[0]['l_starting'])?></u></span> To <span class="blue_dark"><u><?=formatear_fecha($season[0]['l_ending'])?></u></span> </p>
</td></tr></table>