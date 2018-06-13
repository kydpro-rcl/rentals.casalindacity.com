<?
$consulta=new getQueries();
//$villasrcl=$consulta->all_villas();
 //if($_GET['villa']){ $_POST['villa_id']=$_GET['villa']; }
?>


<h1>Delete statements</h1>


<hr/>
<?php
 $db=new DATA();//connect to database
 if ($_POST['go']){

     //$statement_uploaded=$db->search_uploaded($_POST['villa_id'], $month='0', $year='all');
 }
?>

<?

switch($_GET['f']){
	case 1:
		 $db->delete_single_file($id=$_GET['id'], $file=$_GET['f']);
		 echo "<h2 style=\"color:red;\">Estado file have been deleted</h2>";
		 break;
	case 2:
		$db->delete_single_file($id=$_GET['id'], $file=$_GET['f']);
		echo "<h2 style=\"color:red;\">Electricidad file have been deleted</h2>";
		break;
	case 3:
		$db->delete_single_file($id=$_GET['id'], $file=$_GET['f']);
		echo "<h2 style=\"color:red;\">Subdivision file have been deleted</h2>";
		break;
	case 4:
		$db->delete_single_file($id=$_GET['id'], $file=$_GET['f']);
		echo "<h2 style=\"color:red;\">Services file have been deleted</h2>";
		break;
	default:
		if($_GET['id']){
		   $db->borrar($v=$_GET['id'], 'statements');
		   echo "<h2 style=\"color:red;\">All files have been deleted</h2>";
		}
}

  
  
  
  
   ?>





