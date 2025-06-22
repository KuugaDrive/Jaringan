<?php
// connection access
$servername = "103.185.53.64";
$username = "dantever_annie";
$password = "JohanLiebert74";
$dbname = "dantever_mobprog";

// create connection
$conn = mysqli_connect($servername, $username, $password, $dbname); 
 
// check connection
if (mysqli_connect_errno()) {
  die("Connection failed: ".mysqli_connect_error());
}
header('Content-Type: application/json');
?> 