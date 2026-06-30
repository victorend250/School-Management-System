<?php
$mysqli = new mysqli('127.0.0.1', 'root', '', 'rposystem', 3307);
if ($mysqli->connect_error) {
    echo 'Error: ' . $mysqli->connect_error;
} else {
    echo 'Success';
}
