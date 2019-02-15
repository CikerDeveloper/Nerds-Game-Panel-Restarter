<?php
include "main.php";
$br_skeniranja = $config['broj_skeniranja'];

if ($_POST['task']=="status") {
	$server = $restarter->skenirajServer($serverid);

	if($server=="Offline")
	{
	$new_row["status"] = "Offline";
        $row_set[] = $new_row;
	$return = json_encode(row_set, JSON_PRETTY_PRINT);
    	echo $return; 
	} else {
	$new_row["status"] = "Online";
        $row_set[] = $new_row;
	$return = json_encode(row_set, JSON_PRETTY_PRINT);
    	echo $return; 
	}

} else if ($_POST['task']=="restartServer") {
	$serverid = (int)$_POST['serverid'];
	$token = $config['tokens'][$temp];
	$server = $restarter->skenirajServer($serverid);

		if ($server=="Online") {
			$return['msg'] = "Server online";
		} else {
			$return['msg'] = $restarter->restartujServer($serverid, $token);
		}
	}

	die(json_encode($return));

}
?>
