<?php

// Turns om output buffering
ob_start();

// Start Session
session_start();

$timezone = date_default_timezone_set("Africa/Cairo");

// DB Connection
$link = mysqli_connect("localhost", "Manchister", "12345679", "kemma_db");
if (mysqli_connect_errno()) {
	echo "Faild Connecting" . mysqli_connect_errno();
}


?>