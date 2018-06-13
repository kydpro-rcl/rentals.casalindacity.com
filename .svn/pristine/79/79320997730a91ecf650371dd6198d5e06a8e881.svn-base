<?php
//LEFT COLUM
define("MCABECERA","plantillas/m.cabeza.php");
define("MPIE","plantillas/m.pie.php");

define("CABECERA","plantillas/cabeza.php");
define("PIECOL","plantillas/pie_col.php");
//ALL THE CONTENT (NO COLUM)
/*define("CABECERA_NOCOL","plantillas/cabeza_nocol.php");*/
define("PIE","plantillas/pie.php");
//ENCABEZADO LIMPIO
define("CABECERA_CLEAN","plantillas/cabeza_empty.php");
define("PIE_CLEAN","plantillas/pie_empty.php");

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