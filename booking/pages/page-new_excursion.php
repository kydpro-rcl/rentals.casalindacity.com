<? include('menu_CSS/menu-services.php');?>
<p class="header">New Excursion</p>
<hr />
<form name="new_villa" method="post"  action="new_excursion.php" enctype="multipart/form-data">
<table border="0" align="center" width="700" cellpadding="2" cellspacing="0"> <tr><td width="50%">

<p id="fields">Title: <input class="input" type="text" name="ti"  size="40" value="<?=$_POST['ti']?>" /></p>

<p id="fields">Description: <textarea name="de" cols="80" rows="10"><?=$_POST['de']?></textarea></p>

<p id="fields">Price Adults: <input class="input" type="text" name="pa"  size="20" value="<?=$_POST['pa']?>" />
Price Kids: <input class="input" type="text" name="pk"  size="20" value="<?=$_POST['pk']?>" /></p>

<p id="fields">Link_title: <input class="input" type="text" name="lt"  size="40" value="<?=$_POST['lt']?>" /></p>
<p id="fields">Link: <input class="input" type="text" name="li"  size="100" value="<?=$_POST['li']?>" /><br /></p>
<p id="fields">Picture: <input type="hidden" name="MAX_FILE_SIZE" value="500000"><!--500 KB-->
<input class="input" name="photo" type="file" value="">
<br /><span id="error_s"><?=$_GET['error']['photo']?></span></p>

</td></tr><tr><td >

<input type="submit" name="new"  value="Create" class="book_but" />&nbsp;<input type="reset" name="clear"  value="Clean" class="book_but" /></td></tr></table>
</form>
<hr />