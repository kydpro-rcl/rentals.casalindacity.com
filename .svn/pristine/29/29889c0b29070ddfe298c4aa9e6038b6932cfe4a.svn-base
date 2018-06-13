<?php
 session_start();
if ($_SESSION['info']){	if ($_SESSION['info']['level']==1){
		$_GET['p']='ad'; $_GET['s']='ad.s';
		require_once('init.php');
		//guardar datos si post
		if ($_POST){			if (($_POST['high_year_f']+1)==($_POST['high_year_t'])){		      $high_from=array($_POST['high_year_f'], $_POST['high_month_f'], $_POST['high_day_f']);
		      $low_from=array($_POST['low_year_f'], $_POST['low_month_f'], $_POST['low_day_f']);
		      $high_to=array($_POST['high_year_t'],$_POST['high_month_t'], $_POST['high_day_t']);
		      $low_to=array($_POST['low_year_t'], $_POST['low_month_t'], $_POST['low_day_t']);
			  $low_season_from=implode('-',$low_from);
			  $low_season_to=implode('-',$low_to);
			  $high_season_from=implode('-',$high_from);
			  $high_season_to=implode('-',$high_to);
			 /* echo date('Y-m-d', strtotime($low_season_from)).'<br/>';
			  echo date('Y-m-d', strtotime($low_season_to)).'<br/>';
			  echo date('Y-m-d', strtotime($high_season_from)).'<br/>';
			  echo date('Y-m-d', strtotime($high_season_to)).'<br/>';  */

			   $LF=date('Y-m-d', strtotime($low_season_from));  $LT=date('Y-m-d', strtotime($low_season_to));
			   $HF=date('Y-m-d', strtotime($high_season_from)); $HT=date('Y-m-d', strtotime($high_season_to));
		       $date=date("Y-m-d G:i:s");
		      # echo $HF; echo $HT; echo $LF; echo $LT;
		       $link= new DB();
		       $update_season=$link->upd_seasons(1, $date, $HF, $HT, $LF, $LT);
		       if (!$update_season){ echo 'error updating seasons'; die();}
		       $_GET['susscee_hs']="New HS had been successfully saved.";
		    }else{             $_GET['error_hs']="Starting year HS must be one year less than the ending one";
		    display('seasons');
		    die();		    }

		}
		display('seasons');
	}else{
		header('Location:home-welcome.php');
		die();
	}
}else{
	header('Location:login.php');
	die();
}
?>