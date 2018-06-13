<?
//echo date('Y m d H:i:s', $_SESSION['time'])."<br />";
//echo date($_SESSION['time'])."<br />";

//--------------GUARDAR LA SESSION DE LOGIN DE ESTE USUARIO----------------------------
#$db=new DB;
#$db->insert_user_access($user_id=$_SESSION['info']['id'], $date_time=date("Y-m-d G:i:s"), $in_out='2', $session=$_SESSION['log']['id_session'], $ip=$_SERVER['REMOTE_ADDR']);
//-----------------------------------------------------------------------------------
unset($_SESSION['time']);
unset($_SESSION['user_id']);
unset($_SESSION['rqc']);
session_destroy(); //When this function is executed, all the session variables that you set up for the user will be destroyed.
echo("<meta http-equiv=\"refresh\" content=\"0;url=login.php\">");
?>
<table width="100%" align="center"><tr><td align="center">
<h2>Successfuly loged out</h2>

<a href="login.php">Login Again</a><br>
<img src="images/loading.gif"/>
You will be sent to Login in 0 seconds...
</td></tr></table>