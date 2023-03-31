<?php

$servername = "localhost";
$username = "cont5941_admin";
$passworddb = "mOyQa@!7(0u5(!uV";
$db = "cont5941_site";

$conn = mysqli_connect($servername, $username, $passworddb, $db);
$conn->set_charset('utf8');

if(!$conn){
   die("Connection failed: " . mysqli_connect_error());
}

?>