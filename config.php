<?php
// auth token
// auth token generisete u vasem gpanelu pod stavkom "Profil"
// ako ga regenerisete, moracete da izmenite ovaj config i unesete novi token !
$config['tokens'] = array("1a2s3d1a2s3d1a2s3d1a2s3d1a2s3d1a2s3d1a2s3d1a2s3d");

// Broj provera
// Preporuceno je da stavite broj izmedju 3 i 5
$config['broj_skeniranja'] = 3;

//id servera za koje zelite da ukljucite NGPR
//primer array('123','32','11','11')
$config['serverid'] = array('123')

// link ka GPanel API-ju (ne menjati ako ne znate za sta sluzi !)
$config['apilink'] = "http://nerds-hosting.com/";
?>
