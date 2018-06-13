<?
 class drawingPages {
  // public $template;
  var $template;
  
  function admin_display($page) {                  // draw templates to make pages

     //  if ($template=1){
	   require_once(SUB_DIR.TEMP_COMMON.'/admin.header.php');
        require_once(SUB_DIR.TEMP_COMMON.'/admin.menu.php');
		require_once(SUB_DIR.TEMP_ADMIN.'/template.'.$page.'.php');
		require_once(SUB_DIR.TEMP_COMMON.'/admin.footer.php');

		return($draw);
	//   }else{
		   
		   
//	   }

	}

   function cust_display($page) {                  // draw templates to make pages
		//if(!isset($_COOKIE["PHPSESSID"]))  session_start();
        require_once(TEMP_COMMON.'/public.header.php');
        require_once(TEMP_COMMON.'/public.menu.php');
		require_once(TEMP_CUST.'/template.'.$page.'.php');
		require_once(TEMP_COMMON.'/public.footer.php');

		return($draw);

   }

  }
?>