<?php

/* Example for adding a VPN user */

require('master/routeros_api.class.php');

$API = new RouterosAPI();

//$API->debug = true;

if ($API->connect('9.9.9.1', 'dedyeska', 'acerTravelmate')) {


	$ARRAY = $API->comm("/ip/dhcp-server/lease/print", array(
      
      "?active-address" => "9.9.1.64"
   ));
   
	//$ips = $API->read();

   /*
   for($i=0;$i<count($ips);$i++) {
     echo "nyiakk";
   }
*/
   print_r($ARRAY);

   $API->disconnect();

}

?>