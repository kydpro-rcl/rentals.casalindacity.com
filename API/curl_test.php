<?php
//
// A very simple PHP example that sends a HTTP POST to a remote site
//

$ch = curl_init();

//curl_setopt($ch, CURLOPT_URL,"http://www.example.com/tester.phtml");
curl_setopt($ch, CURLOPT_URL,"http://localhost/rentals.casalindacity.com/API/XML/create_booking.php");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS,
            "token=098f6bcd4621d373cade4e832627b4f6&property_id=25&postvar3=value3");

// in real life you should use something like:
// curl_setopt($ch, CURLOPT_POSTFIELDS, 
//          http_build_query(array('postvar1' => 'value1')));

// receive server response ...
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$server_output = curl_exec ($ch);

curl_close ($ch);

echo $server_output;
// further processing ....
if ($server_output == "OK") {  } else {  }

?>