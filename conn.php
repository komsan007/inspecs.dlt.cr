<?php
  ini_set('display_errors', 1);
  error_reporting(~0);
  $serverName = "localhost";
  $userName = "check_rdschian_u";
  $userPassword = "P@ssWord!2017";
  $dbName = "check_rdschian_db";
  
  // $userName = "root";
  // $userPassword = "";
  // $dbName = "inspec_rec";
  
  $conn = mysqli_connect($serverName,$userName,$userPassword,$dbName);
	if (mysqli_connect_errno()) {
		echo "Database Connect Failed : " . mysqli_connect_error();
	} 
  mysqli_query($conn, "set names 'utf8'");  
?>