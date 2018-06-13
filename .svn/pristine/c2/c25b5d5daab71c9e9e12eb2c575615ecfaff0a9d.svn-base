
	<?
    $data= new getQueries ();
    $service=$data->show_id('excursions', $_GET['i']);

   // print_r($service);
    $se=$service[0];
    ?>
<p class="header">Change Excursion</p>
<hr />
<form name="new_villa" method="post"  action="change_excursion.php" enctype="multipart/form-data">
<table border="0" align="center" width="700" cellpadding="2" cellspacing="0"> <tr><td width="50%">

<p id="fields">Title: <input class="input" type="text" name="ti"  size="40" value="<?=$se['title']?>" /></p>

<p id="fields">Description: <textarea name="de" cols="80" rows="10"><?=$se['desc']?></textarea></p>

<p id="fields">Price Adults: <input class="input" type="text" name="pa"  size="20" value="<?=$se['price_a']?>" />
Price Kids: <input class="input" type="text" name="pk"  size="20" value="<?=$se['price_c']?>" /></p>

<p id="fields">Link_title: <input class="input" type="text" name="lt"  size="40" value="<?=$se['link_t']?>" /></p>
<p id="fields">Link: <input class="input" type="text" name="li"  size="100" value="<?=$se['link']?>" /><br /></p>
<p id="fields">Picture: <input type="hidden" name="MAX_FILE_SIZE" value="500000"><!--500 KB-->
<input class="input" name="photo" type="file" value="">
<br /><span id="error_s"><?=$_GET['error']['photo']?></span></p>
<input type="hidden" name="photo_old" value="<?=$se['pic']?>"/>

</td></tr><tr><td >
<input type="hidden" name="id" value="<?=$_GET['i']?>"/>
<input type="submit" name="new"  value="Change" class="book_but" />&nbsp;</td></tr></table>
</form>
<hr />