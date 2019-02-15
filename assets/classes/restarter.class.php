<?php

class Restarter {
	
	//kolko loš KGB API ZA RESTARTER NAPISAO U 2 FUNKCIJE ONI U 50..LOL
	//sad je lepše
	/*
	 * Metoda restartuje server pozivom NERDS API-ja
	 */
	function restartujServer($serverid,$token) {
		global $config;
		$api = $config['apilink']."api.php?token=".$token."&task=restart&id=".$serverid;
		$data = $data = file_get_contents($api);
		$serverprocess = json_decode($data);
		if($serverprocess[0]->status=="ok")
		{
			return true;
		} else {
			return false;
		}
	}

	/*
	 * metoda skenira server na Nerds API 
	 */
	function skenirajServer($serverid, $token) {
		global $config;
		$api = $config['apilink'].'api.php?token=$token';
		$data = file_get_contents($api); 
		$br_skeniranja = $config['broj_skeniranja'];
		while (($br_skeniranja--)>0) {
			$server = json_decode($data);
			$status = $server[0]->status;
			if($status == 0)
			{
				return "Offline";
			} else {
			  	return "Online";
			}
		}
	}

}

$restarter = new Restarter();

?>
