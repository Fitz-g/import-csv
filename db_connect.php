<?php

$servername = "ec2-54-247-188-107.eu-west-1.compute.amazonaws.com";
$username = "euossvdygnoajb";
$password = "51eece037b16585ae414dbb3c5d2bac3baafe71ecc9f98d359193314abe3d811";
//$servername = "localhost";
//$username = "root";
//$password = "";

try {
    $db = new PDO("pgsql:host=$servername;dbname=dfk502e7iihnet",$username,$password);
    // set the PDO error mode to exception
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
