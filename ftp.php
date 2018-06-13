<html>

<head>
  <title></title>
</head>

<body>

<?php
require_once('admin_owner_portal/required/funciones.php');
$ftp_user="casalindacity-ssl";  $ftp_pass="Laget0806"; $tsite="www.casalindacity.com";
echo $conn_id=connect_ftp($tsite,$ftp_user, $ftp_pass);

?>

<?php
/*
$ftp_server = "www.casalindacity.com";
$ftp_user = "casalindacity-ssl";
$ftp_pass = "Laget0806";

// set up a connection or die
$conn_id = ftp_connect($ftp_server) or die("Couldn't connect to $ftp_server");

// try to login
if (@ftp_login($conn_id, $ftp_user, $ftp_pass)) {
    echo "Connected as $ftp_user@$ftp_server\n";
} else {
    echo "Couldn't connect as $ftp_user\n";
}

// close the connection
ftp_close($conn_id);
*/
?>

</body>

</html>