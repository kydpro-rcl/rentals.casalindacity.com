<?php
define("CABECERA","template/header.php");
define("PIE","template/footer.php");
define("CABECERA1","template/header1.php");
define("PIE1","template/footer1.php");

function month_letters(){
	return array(
	 '01'=>'Jan',
	 '02'=>'Feb',
	 '03'=>'Mar',
	 '04'=>'Apr',
	 '05'=>'May',
	 '06'=>'Jun',
	 '07'=>'Jul',
	 '08'=>'Aug',
	 '09'=>'Sep',
	 '10'=>'Oct',
	 '11'=>'Nov',
	 '12'=>'Dec'
	);
}
 /*  //FUNCTION ALREADY DECLARED IN FUNCIONS IN BOOKING FOLDERS
function is_date( $str ) //check a valid date
{
  $stamp = strtotime( $str );

  if (!is_numeric($stamp))
  {
     return FALSE;
  }
  $month = date( 'm', $stamp );
  $day   = date( 'd', $stamp );
  $year  = date( 'Y', $stamp );

  if (checkdate($month, $day, $year))
  {
     return TRUE;
  }

  return FALSE;
} */


/**

 * The letter l (lowercase L) and the number 1

 * have been removed, as they can be mistaken

 * for each other.

 */



function createRandomPassword() {



    $chars = "abcdefghijkmnopqrstuvwxyz023456789";

    srand((double)microtime()*1000000);

    $i = 0;

    $pass = '' ;



    while ($i <= 7) {

        $num = rand() % 33;

        $tmp = substr($chars, $num, 1);

        $pass = $pass . $tmp;

        $i++;

    }



    return $pass;



}





?>