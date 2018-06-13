<h2>Welcome, <?=$_SESSION['owner']['name']." ".$_SESSION['owner']['lastname']?></h2>
<p style="clear:both;">&nbsp;</p>
  <hr style="border:1px solid #f9a80b;" />
 <? if($_GET['error']){?>
	<div style="border: 1px solid #767778; padding:0; margin:0; background-color: #FF0; color:#F00; font-weight:bold; text-align:center;"><?=$_GET['error']?></div>
 <? }?>
  <? if($_GET['sent']){?>

	<div style="border: 1px solid #767778; padding:5px; margin:5px; background-color:#2A6EBB; color:#FFFFFF; font-weight:bold; text-align:center;"><?=$_GET['sent']?></div>
	<img src="images/email_icon_small.jpg" alt=""/>
 <? }?>

  <? if(!$_GET['sent']){?>
     <form method="post" action="communicate.php">
     <div style="border: 1px solid #FF7328; padding:0; margin:0; margin:5px; padding:5px; margin-left:25px;margin-right:25px; background-color:#ECECEC;">
        <p ><span style="color:#084482; font-weight:bold; text-transform:uppercase;">* My question is about:</span> <select name="question">
                                    <option value="1" <? if ($_POST['question']==1) echo 'selected="selected"'; ?>>Occupancy or Availability</option>
                                    <option value="2" <? if ($_POST['question']==2) echo 'selected="selected"'; ?>>Accounting</option>
                                    <option value="3" <? if ($_POST['question']==3) echo 'selected="selected"'; ?>>Villas Sales</option>
                                    <option value="4" <? if ($_POST['question']==4) echo 'selected="selected"'; ?>>Contracts and Agreements</option>
                                    <option value="5" <? if ($_POST['question']==5) echo 'selected="selected"'; ?>>Services (Pool/Garden, Maid, Maintenance)</option>
                                    <option value="6" <? if ($_POST['question']==6) echo 'selected="selected"'; ?>>Amenities (Shuttle Bus, Chef, Massage, etc)</option>
                                    <option value="7" <? if ($_POST['question']==7) echo 'selected="selected"'; ?>>Security</option>
                                    <option value="8" <? if ($_POST['question']==8) echo 'selected="selected"'; ?>>Other</option>
                                </select>
        </p>

        <p><span style="color:#084482; font-weight:bold; text-transform:uppercase;">* Message:</span><br/><span style="color:#084482;">Please be specific </span><textarea name="mensaje" cols="100" rows="20"><?=$_POST['mensaje']?></textarea>  </p>
        <p style="padding:0; margin:0; text-align:left; font-size:11px;"><span style="color:#084482; font-weight:bold; text-transform:uppercase;">Note: We will send reply about this message to <i>"<?=$_SESSION['owner']['email']?>"</i></span></p>
        <input type="hidden" name="owner_email" value="<?=$_SESSION['owner']['email']?>" />
        <input type="hidden" name="owner_id" value="<?=$_SESSION['owner']['id']?>" />
        <p><input type="submit" name="Send" style="color:#FFFFFF; background-color:#FF7328; font-weight:bold; border: 1px solid #767778;" value="Send Inquiry"/>  </p>
    </div>
    </form>
 <? }?>
