<?php
// this will avoid mysql_connect() deprecation error.
error_reporting( ~E_DEPRECATED & ~E_NOTICE );

$connect = new mysqli ('localhost','root','Deadend6!','cr12_valeria_travelmatic');

if ($connect->connect_errno) {
   die("Failed to connect to MySQL: " . $connect->connect_error);
}
// else {echo "connected";}
?>


