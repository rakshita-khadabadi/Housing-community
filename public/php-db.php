<?php

// DB credentials required to connect
$db_host = "localhost";
$db_name = "city_view_database";
$db_user = "root";
$db_pass = "";

// function to connect to the DB
$mysqli = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

// checkng if the connection was successful
if (mysqli_connect_error()) {
	echo mysqli_connect_error();
	exit;
} else {
	echo "connected successfully";
}