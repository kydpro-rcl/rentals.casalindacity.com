 <script type="text/javascript">
				$(document).ready(function(name) {
				$("#news1").fancybox({
						'width'				: '90%',
						'height'			: '90%',
						'autoScale'			: true,
						'transitionIn'		: 'elastic',
						'transitionOut'		: 'elastic',
						'type'				: 'iframe'
					});
				});
</script>
 <script type="text/javascript">
				$(document).ready(function(name) {
				$("#news2").fancybox({
						'width'				: '800px',
						'height'			: '900',
						'autoScale'			: true,
						'transitionIn'		: 'elastic',
						'transitionOut'		: 'elastic',
						'type'				: 'iframe'
					});
				});
</script>

<h2>Welcome, <?=$_SESSION['owner']['name']." ".$_SESSION['owner']['lastname']?></h2>
<p style="clear:both;">&nbsp;</p>
  <hr style="border:1px solid #f9a80b;" />
  <?
  	//$data= new getQueries ();
	//$owners=$data->show_id('owners', $_SESSION['owner']['id']);
	//echo $_GET['id'];
	//$ow=$owners[0];
  ?>
<p>CLICK ON THE ENGLISH OR SPANISH VERSION OF THE RULES TO VIEW</p>
  <? if($_GET['note']){?>
	<div style="border: 1px solid #767778; padding:5px; margin:5px; background-color: #06C; color:#FFF; font-weight:bold; text-align:center;"><?=$_GET['note']?></div>
 <? }?>
     <div style="border: 1px solid #FF7328; padding:0; margin:0; margin:5px; padding:5px; margin-left:25px;margin-right:25px; background-color:#ECECEC;">
       <table  width="100%">
		<tr>
		<td  width="50%">
			<a id="news" style="text-decoration:none;" href="news/RCL_Issues_Tracking_List_June_2015.pdf" target="_blank">June-2015-Casa Linda Homeowner's issues tracking register<br/>
			<img src="news/RCL-Issues-Tracking-List-June-2015-1.jpg"  width="311" height="345"  alt=""/></a>
		</td>
		<td>
			&nbsp;
		</td>
	</tr>
	
	<tr>
		<td  width="50%">
			<a id="news" style="text-decoration:none;" href="news/Owner_Committee_Meeting_Minutes_With_RCL_02-23-2015.pdf" target="_blank">Feb 23-2015-Owner's Committee Meeting with Casa Linda<br/>
			<img src="news/Owner_Committee_Meeting_Minutes_With_RCL_02-23-2015-1.jpg"  width="311" height="345"  alt=""/></a>
		</td>
		<td>
			<a id="news" style="text-decoration:none;" href="news/RCL_Issues_Tracking_List 01-29-15_To_Owners_Rev 1.pdf" target="_blank">Jan 29-2015-Owner's Committee Meeting with Casa Linda<br/>
			<img src="news/ownerCommiteeAndRCL29Jan2015.PNG"  width="311" height="345"  alt=""/></a>
		</td>
	</tr>
	<tr>
	   <td  width="50%">
			<a id="news" style="text-decoration:none;" href="news/Basic Rules and Regulations 2014.pdf" target="_blank">May 2014-English Rules<br/>
			<img src="news/eng_thumb.png" alt=""/></a>
		</td>
		<td>
			<a id="news" style="text-decoration:none;" href="news/Basic Rules and Regulations 2014 - spanish.pdf" target="_blank">May 2014 -Spanish Rules<br/>
			<img src="news/spa_thumb.png" alt=""/></a>
			&nbsp;
		</td>
	</tr>
</table>

    </div>
