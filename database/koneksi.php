<?php
$mysqli = new mysqli('localhost', 'root', '', 'tpq');

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
