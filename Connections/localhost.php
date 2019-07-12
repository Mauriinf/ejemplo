<?php
 
$hostname_localhost = "localhost";
$database_localhost = "gym";
$username_localhost = "root";
$password_localhost = "root";
$localhost = mysqli_pconnect($hostname_localhost, $username_localhost, $password_localhost) or trigger_error(mysqli_error(),E_USER_ERROR); 
?>