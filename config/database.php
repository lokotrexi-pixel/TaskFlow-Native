<?php

$host = "localhost";
$user = "root";
$password = "";
$database = "taskflow_native";

$conn = mysqli_connect($host, $user, $password, $database);

if (!$conn) {
    die("Koneksi database gagal!");
}