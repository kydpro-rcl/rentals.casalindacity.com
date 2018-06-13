<?php

define("HEADERRESP","template/header.php");
define("FOOTERRESP","template/footer.php");

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