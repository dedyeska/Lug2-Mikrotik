<?php

/* Example for adding a VPN user */

require('master/routeros_api.class.php');

$API = new RouterosAPI();

$API->debug = true;

if ($API->connect('192.168.1.1', 'admin', '')) {


   $API->comm("/ip/address/add", array(
   		"address" => "9.9.9.100/20",
   		"interface" => "ether1"
   	));

   $API->comm("/ip/pool/add", array(
   		"name" => "lug2_pool",
   		"ranges" => "192.168.1.100-192.168.1"
   	));

   $API->comm("/ip/dhcp-server/network/add",array(
   		"address" => "192.168.1.0/24",
   		"gateway" => "192.168.1.1",
   		"dns-server" => "192.168.1.1"
   	));

   $API->comm("/ip/dhcp-server/add",array(
   		"name" => "lug2_dhcp1",
   		"interface" => "ether2",
   		"lease-time" => "3d",
   		"address-pool" => "lug2_pool",
   		"disabled" => "no"
   	));

   $API->comm("/ip/dns/set", array(
   		"servers" => "9.9.9.1",
   		"allow-remote-requests" => "yes"
   	));

   $API->comm("/ip/firewall/nat/add", array(
   		"chain" => "srcnat",
   		"action" => "masquerade"
   	));

   $API->comm("/ip/firewall/nat/add", array(
      "chain"     => "dstnat",
      "protocol" => "tcp",
      "dst-port" => "1002",
      "action"  => "dst-nat",
      "to-addresses"  => "192.168.1.2",
      "to-ports" => "80"
   ));

   $API->comm("/ip/route/add", array(
   		"gateway" => "9.9.9.1",
   		"distance" => "1"
   	));
/*
   $API->comm("user/set/admin",array(
   		"password" => "acerTravelmate"
   	));
*/

}

?>