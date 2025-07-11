<?php
$connect = mysqli_connect('localhost', 'root', 'root', 'publicschools');

if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
}
?>

