<?php

//This is the file that linked to the database

    $con=mysqli_connect("localhost","USERNAME","PASSWORD","SYS");
    if (mysqli_connect_errno()) {
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
	exit;
    }
?>


