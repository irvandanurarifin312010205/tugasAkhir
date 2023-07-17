<?php

$hostname = 'localhost';
$username = 'root';
$password = '';
$database = 'jadwalHarian';

// Membuat koneksi ke database
$conn = new mysqli($hostname, $username, $password, $database);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
