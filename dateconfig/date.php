<?php

/*
 * Author: y.dago@afriquepesage.com
 * This File is used to Set the Date 
 * Ce Fichier est utilisé pour Configurer la date
 */

$timezone = date_default_timezone_get();
//echo "The current server timezone is: " . $timezone;
$UTC = new DateTimeZone("UTC");
$date_time = date('l j F Y, H:i'). "<br>";
 setlocale(LC_TIME, 'fr_FR.UTF8');
// setlocale(LC_TIME, 'fr_FR');
// setlocale(LC_TIME, 'fr');
setlocale(LC_TIME, 'fra_fra');
 
//echo strftime('%Y-%m-%d %H:%M:%S');  // 2012-10-11 16:03:04
echo strftime('%A %d %B %Y, %H:%M'); // jeudi 11 octobre 2012, 16:03
//echo strftime('%d %B %Y');           // 11 octobre 2012
//echo strftime('%d/%m/%y');           // 11/10/12