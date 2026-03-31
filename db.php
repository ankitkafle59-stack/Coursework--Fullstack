<?php

  $mysqli = new mysqli("localhost","2445883","Kangaroo@123","db2445883");

  if ($mysqli -> connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
    exit();
  }
?>
