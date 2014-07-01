<?php

$host="localhost";
$usuario="scala";
$senha="scala";
$bd="scala";
$porta="5432";

$conectar = pg_connect("host=$host port=$porta dbname=$bd user=$usuario password=$senha") or die ("erro");


?>
