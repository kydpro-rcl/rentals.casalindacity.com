<h2>Welcome, <?=$_SESSION['owner']['name']." ".$_SESSION['owner']['lastname']?></h2>
<p style="clear:both;">&nbsp;</p>
  <hr style="border:1px solid #f9a80b;" />

  <?
  	$data= new getQueries ();
	$owners=$data->show_id('owners', $_SESSION['owner']['id']);
	//echo $_GET['id'];
	$ow=$owners[0];
  ?>

  <? /* print_r($_SESSION['owner']); ?>
  <? echo $_SESSION['owner']['id']; echo " id session<br/>"; ?>
  <? echo $_SESSION['owner'][0]['id']; echo "id con cero de session<br/>";*/?>
 <? if($_GET['error']){?>
	<div style="border: 1px solid #767778; padding:5px; margin:5px; background-color: #FF0; color:#F00; font-weight:bold; text-align:center;"><?=$_GET['error']?></div>
 <? }?>


  <form method="post" action="edit_profile.php" enctype="multipart/form-data">
  	<input type="hidden" name="id" value="<?=$_SESSION['owner']['id']?>" />
     <div style="border: 1px solid #FF7328; padding:0; margin:0; margin:5px; padding:5px; margin-left:25px;margin-right:25px; background-color:#ECECEC;">
       <table  width="100%" border="0"><tr><td  width="50%">

           <table border="0">
            <tr>
                <td valign="top"><span style="color:#084482; font-weight:bold; text-transform:uppercase;">Name:</span></td>
                <td><?=$ow['name']?></td></tr>

             <tr>
                <td valign="top"><span style="color:#084482; font-weight:bold; text-transform:uppercase;">Last Name:</span></td>
                <td><?=$ow['lastname']?></td></tr>
             <tr>
                <td valign="top"><span style="color:#084482; font-weight:bold; text-transform:uppercase;">Email:</span></td>
                <td><input type="text" name="email" value="<?=$ow['email']?>"  /> <span style="color: #F00; font-size:10px">Required</span></td></tr>
             <tr>
                <td valign="top"> <span style="color:#084482; font-weight:bold; text-transform:uppercase;">Phone:</span></td>
                <td><input type="text" name="phone" value="<?=$ow['phone']?>"  /> <span style="color: #F00; font-size:10px">Required</span></td></tr>
             <tr>
                <td valign="top"><span style="color:#084482; font-weight:bold; text-transform:uppercase;">Mobile:</span></td>
                <td><input type="text" name="movil" value="<?=$ow['movil']?>" /></td></tr>
             <tr>
                <td valign="top"><span style="color:#084482; font-weight:bold; text-transform:uppercase;">Address:</span></td>
                <td><textarea cols="30" rows="2" name="address"><?=$ow['address']?></textarea></td></tr>
             <tr>
                <td valign="top"><span style="color:#084482; font-weight:bold; text-transform:uppercase;">Username:</span></td>
                <td><input type="text" name="user" value="<?=$ow['user']?>" /> <span style="color: #F00; font-size:10px">Required</span></td></tr>
             <tr>
                <td  valign="top"><span style="color:#084482; font-weight:bold; text-transform:uppercase;">Actual Password:</span></td>
                <td><input type="password" name="actual_pass" value=""  /><br /><span style="font-size:10px; color:#333;">Type only if you wish to change it</span></td></tr>
                 <tr>
                <td valign="top" ><span style="color:#084482; font-weight:bold; text-transform:uppercase;">New Password:</span></td>
                <td><input type="password" name="new_pass"  /><br /><span style="font-size:10px; color:#333;">Only required if actual password</span></td></tr>
                 <tr>
                <td valign="top"><span style="color:#084482; font-weight:bold; text-transform:uppercase;">Confirm new Password:</span></td>
                <td><input type="password" name="confirm_pass"  /><br /><span style="font-size:10px; color:#333;">Must be same as in New Password</span></td></tr>
              <tr>
                <td valign="top"> <span style="color:#084482; font-weight:bold; text-transform:uppercase;">Language:</span></td>
                <td><select class="input" name="language" ><!--only for admin empty for others-->
				<?
                $idiomas=languageArray();
                foreach($idiomas as $k=>$v){?>
                    <option value="<?=$k?>" <? if ($ow['language']==$k) echo "selected='selected'"; ?> ><?=$v?></option>
                    <?
                    }
                ?>

                </select>
                </td></tr>
             <tr>
                <td  valign="top"><span style="color:#084482; font-weight:bold; text-transform:uppercase;">Country:</span></td>
                <td><?
						$country=countryArray();
						echo "<select class='input' size=1 name='country' style='font-size:9px'>";
						foreach($country as $k=>$v){
							?>
							<option value="<?=$k?>" <? if ($ow['country']==$k) echo "selected='selected'"; ?> style="font-size:9px"><?=$v?></option>";
							<?
							}
							echo "</select>";
						?>
					 </td></tr>
            </table>

</td><td width="50%">
<p style="text-align:left; color:#084482; font-weight:bold; text-transform:uppercase;">Profile Picture</p>
<div style="border: 1px solid #FF7328; padding:0; margin:0;  background-color:#FFFFFF; width:150px; height:150px;">
<img width="150px;" height="150px;" src="../booking/<?=$ow['photo']?>" alt="" />

</div>
<input type="hidden" name="MAX_FILE_SIZE" value="900000"><!--900 KB-->
<p style="text-align:left; font-weight:bold; text-transform:uppercase;">New Picture: <input type="file" name="photo" /></p>
<p><input type="submit" name="submit" value="Update Profile" style="color:#FFFFFF; background-color:#FF7328; font-weight:bold; border: 1px solid #767778;" /></p>
</td></tr></table>

    </div>
</form>