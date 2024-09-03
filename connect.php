<?php

$servername = "localhost";
 $username = "root";
 $password = "root";
 $databasename = "crud";

  $conn = new mysqli($servername ,$username ,$password ,$databasename);

  if($conn->connect_error){
    $die("connection error".$connection_error);
  }

  ?>