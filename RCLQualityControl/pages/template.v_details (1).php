

<div class="art-box-body art-post-body">
<p>&nbsp;</p>
<? if(!$_GET['msg']){?>
  <form  method="post" ation="villa.php">

 <table border="0" cellspacing="0" align="center" class="main_table" >
   <tr class="row_head">
   		<td class="cell" colspan="2" align="center" style="background-color:#58c1df;"><b>CREATING A NEW VILLA</b></td>
   		<!--//<td class="cell" style="background-color:#fcd826;color:green;"  align="center"><b>RENTAL</b></td>
   		<td class="cell"  style="background-color:#0091c0;"  align="center"><b>ADMINISTRACION</b></td>//-->
   	</tr>
   	<tr class="row_head">
   		<td class="cell">Villa No.</td>
   		<td class="cell"><input type="text" name="villa" value=""/></td>

   	</tr>
   	<tr class="row_head">
   		<td class="cell" colspan="2" align="right"><input type="submit" name="submint" value="Create"/></td>
   	</tr>
   </table>
  </form>
 <?}else{?>
  <h2 style="text-align:center;background-color:Yellow; color:Green;"><?=$_GET['msg']?></h2>
 <?}?>
 <p>&nbsp;</p>

</div>