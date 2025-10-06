<?php
$servername = "db";
$username = "root";
$password = "qwerty";
$database = "db1";

$conn = mysqli_connect($servername, $username, $password);
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

$query = "CREATE DATABASE IF NOT EXISTS $database";
if (!mysqli_query($conn, $query)) {
    echo "Failed to create database";
}
mysqli_close($conn);

$conn = mysqli_connect($servername, $username, $password, $database);
if (!$conn) {
    die("Failed to connect to database: " . mysqli_connect_error());
}

$query = "CREATE TABLE IF NOT EXISTS users (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(15) NOT NULL,
    email VARCHAR(50) NOT NULL,
    password VARCHAR(20) NOT NULL
)";
if (!mysqli_query($conn, $query)) {
    echo "Failed to create Users table: " . mysqli_error($conn);
}

$query = "CREATE TABLE IF NOT EXISTS posts (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(50) NOT NULL,
    content VARCHAR(1000) NOT NULL
)";
if (!mysqli_query($conn, $query)) {
    echo "Failed to create Posts table";
}

$check_column = mysqli_query($conn, "SHOW COLUMNS FROM posts LIKE 'image_path'");
if (mysqli_num_rows($check_column) === 0) {
    $query = "ALTER TABLE posts ADD COLUMN image_path VARCHAR(255) NULL";
    if (!mysqli_query($conn, $query)) {
        echo "Failed to add image_path column: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>