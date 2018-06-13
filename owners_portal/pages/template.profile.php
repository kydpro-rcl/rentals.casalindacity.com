<h2>Welcome, <?=$_SESSION['owner']['name']." ".$_SESSION['owner']['lastname']?></h2>
<p style="clear:both;">&nbsp;</p>
  <hr style="border:1px solid #f9a80b;" />
  <?
  	$data= new getQueries ();
	$owners=$data->show_id('owners', $_SESSION['owner']['id']);
	//echo $_GET['id'];
	$ow=$owners[0];
  ?>

  <? if($_GET['note']){?>
	<div style="border: 1px solid #767778; padding:5px; margin:5px; background-color: #06C; color:#FFF; font-weight:bold; text-align:center;"><?=$_GET['note']?></div>
 <? }?>
     <div style="border: 1px solid #FF7328; padding:0; margin:0; margin:5px; padding:5px; margin-left:25px;margin-right:25px; background-color:#ECECEC;">
       <table  width="100%"><tr><td  width="50%">
        <p ><span style="color:#084482; font-weight:bold; text-transform:uppercase;">Name:</span> <?=$ow['name']?>  </p>
        <p ><span style="color:#084482; font-weight:bold; text-transform:uppercase;">Last Name:</span> <?=$ow['lastname']?>  </p>
        <p ><span style="color:#084482; font-weight:bold; text-transform:uppercase;">Email:</span> <?=$ow['email']?>  </p>
        <p ><span style="color:#084482; font-weight:bold; text-transform:uppercase;">Phone:</span>  <?=$ow['phone']?> </p>
        <p ><span style="color:#084482; font-weight:bold; text-transform:uppercase;">Mobile:</span>  <?=$ow['movil']?> </p>
         <p ><span style="color:#084482; font-weight:bold; text-transform:uppercase;">Address:</span>  <?=$ow['address']?> </p>
        <p ><span style="color:#084482; font-weight:bold; text-transform:uppercase;">Username:</span>  <?=$ow['user']?> </p>
        <p ><span style="color:#084482; font-weight:bold; text-transform:uppercase;">Password:</span> *******</p>
        <p ><span style="color:#084482; font-weight:bold; text-transform:uppercase;">Language:</span> <? $idiomas=languageArray();  echo $idiomas[$ow['language']];?>  <?/*=$_SESSION['owner']['language']*/?> </p>
        <p ><span style="color:#084482; font-weight:bold; text-transform:uppercase;">Country:</span> <? $paises=countryArray();  echo $paises[$ow['country']];?> <?/*=$_SESSION['owner']['country']*/?> </p>
</td><td width="50%">
<p style="text-align:left; color:#084482; font-weight:bold; text-transform:uppercase;">Profile Picture</p>
<div style="border: 1px solid #FF7328; padding:0; margin:0;  background-color:#FFFFFF; width:150px; height:150px;">
<img width="150px;" height="150px;" src="../booking/<?=$ow['photo']?>" alt="" />

</div>

<p style="text-align:left; font-weight:bold; text-transform:uppercase;"><a href="edit_profile.php" alt="" style="color:#F00;">Edit Your Profile</a></p>
</td></tr></table>

    </div>
