<?php

$conn = mysqli_connect('localhost', 'root', '', 'paws_and_hearts');

if (!$conn) {
    die('DB connection failed');
}