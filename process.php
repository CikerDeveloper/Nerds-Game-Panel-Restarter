<?php
include "main.php";
$br_skeniranja = $config['broj_skeniranja'];

if ($_POST['task']=="status") {
	$server = $restarter->skenirajServer($serverid);

	if($server=="Offline")
	{
		return "Offline";
	} else {
		return "Online";
	}

} else if ($_POST['task']=="restartServer") {
	$serverid = (int)$_POST['serverid'];
	$temp = (int)$_POST['auth'];
	$token = $config['tokens'][$temp];
	$server = $restarter->skenirajServer($serverid);

	if (!$server || in_array($serverid, $config['ignorisi'])) {
		$return['msg'] = "No server";
	} else {
		if ($server=="Online") {
			$return['msg'] = "Server online";
		} else {
			$return['msg'] = $restarter->restartujServer($serverid, $token);
		}
	}

	die(json_encode($return));

}
?>
