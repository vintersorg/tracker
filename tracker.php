<?php	
include_once "/var/www/tracker/protected/components/BDecode.php";
$bdec = new BDecode;

echo $bdec->bencode(array(
	'interval' => 100,
	'peers' => array(
		'ip' => '5.149.144.190',
		'port' => 100500,
		'peer_id' => 100500)
	)
);

?>