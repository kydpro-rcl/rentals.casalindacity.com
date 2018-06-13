<?
    $data= new getQueries ();
    $service=$data->show_id('service_type', $_GET['id']);
    $se=$service[0];
    /*$serv_t=$data->show_all('service_type', 'id');*/
  ?>

<p class="header">Edit Service Type</p>
<hr />
<form name="new_villa" method="post"  action="edit-service_type.php" enctype="multipart/form-data">
<table border="0" align="center" width="700" cellpadding="2" cellspacing="0"> <tr><td width="50%">
<!--<fieldset><legend>FEATURES</legend>-->
<p id="fields">Type:<input class="input" type="text" name="type"  value="<?=$se['tipo']?>" /><br /><span id="error_s"><?=$_GET['error']['name']?></span></p>

<p id="fields">Picture: <input class="input" type="file" name="pic"  /><br /><span id="error_s"><?=$_GET['error']['desc']?></span></p>
</td>
<td>
<!--<fieldset><legend>PRICES</legend>-->

<p id="fields">Online message: <input class="input" type="text" name="msg"  value="<?=$se['message']?>" /><br /><span id="error_s"><?=$_GET['error']['price']?></span></p>
<p id="fields">Link Name: <input class="input" type="text" name="nl"  value="<?=$se['name_link']?>" /><br /><span id="error_s"><?=$_GET['error']['price']?></span></p>
<p id="fields">Link URL: <input class="input" type="text" name="url"   value="<?=$se['link']?>" /><br /><span id="error_s"><?=$_GET['error']['price']?></span></p>
<input type="hidden" name="id" value="<?=$se['id']?>"/>
<input type="hidden" name="old_pic" value="<?=$se['picture']?>"/>
<!--//<p id="fields" style="text-align:center" >Comment:</p><p id="fields"><textarea class="input" name="comment" style="max-width:400px;" cols="50" rows="5"><?=$_POST['comment']?></textarea></p>//-->


<!--</fieldset>--></td></tr><tr><td colspan="2">

<input type="submit" name="new"  value="update" class="book_but" />&nbsp;<input type="reset" name="clear"  value="Clean" class="book_but" /></td></tr></table>
</form>
<hr />