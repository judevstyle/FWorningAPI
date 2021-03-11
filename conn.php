<?php
$conn = mysqli_connect("localhost","root","","worning_db");
// $conn = mysqli_connect("mysql.hostinger.in.th","u384895136_judbs","ju211137","u384895136_judb");
// $conn = mysqli_connect("mysql.hostinger.in.th","u702573817_root","smart255403","u702573817_smart");

mysqli_query($conn, "SET character_set_results = utf8");
mysqli_query($conn, "SET character_set_results=utf8");
mysqli_query($conn, "SET character_set_client=utf8");
mysqli_query($conn, "SET character_set_connection=utf8");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
?>