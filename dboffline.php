<?php
// Enter your Host, username, password, database below.
// I left password empty because i do not set password on localhost.
header('Content-Type: text/html; charset=utf-8');
 $conn = mysqli_connect("localhost","root","","alex");
 mysqli_query($conn,"SET NAMES 'utf8'");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  
  

 
?>