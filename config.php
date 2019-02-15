<?php
// auth token
// auth token generisete u vasem gpanelu pod stavkom "Profil"
// ako ga regenerisete, moracete da izmenite ovaj config i unesete novi token !
$config['tokens'] = array("1a2s3d1a2s3d1a2s3d1a2s3d1a2s3d1a2s3d1a2s3d1a2s3d");

// Broj provera
// Preporuceno je da stavite broj izmedju 3 i 5
$config['broj_skeniranja'] = 3;

// Ignorisanje servera
// U ovaj niz stavljate ID od Servera koji mozete videti u game panelu.
// Server koji se nalazi u ovoj listi nece biti prikazan u listi.
// Primer: 	array('25140', '26254', '28141')
$config['ignorisi'] = array();

// link ka GPanel API-ju (ne menjati ako ne znate za sta sluzi !)
$config['apilink'] = "http://nerds-hosting.com/";
?>
