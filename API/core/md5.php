<?php
//$str = 'Morales';

/*if (md5($str) === '1f3870be274f6c49b3e31a0c6728957f') {
    echo "Would you like a green or red apple?";
}*/
if($_GET['p']){
	echo "Token:";
	echo md5($str=$_GET['p']);
	echo "<br>String:";
	echo $_GET['p'];
}