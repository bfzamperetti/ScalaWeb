<?php 
$host = "localhost";
$port = "5432";
$dbname = "scala";// servidor: scala
$user = "scala";
$password = "scala"; //servidor: scala.-ufrgs 
$con_string = "host=$host port=$port dbname=$dbname user=$user password=$password";
$bdcon4 = pg_connect($con_string);
?>

