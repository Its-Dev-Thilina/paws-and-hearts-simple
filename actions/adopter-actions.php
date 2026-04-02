<?php

include_once '../config/config.php';
include_once BASE_PATH . '/config/database.php';

$action = $_POST['action'] ?? null;
$submit = $_POST['submit'] ?? null;

if (!$submit || !$action) {
    header('Location: ' . BASE_URL . 'pages/dashboard.php');
    exit;
}

if ($action == "store") {
    $name = mysqli_real_escape_string($conn, $_POST['adopter_name']);
    $contact = mysqli_real_escape_string($conn, $_POST['contact']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $street_address = mysqli_real_escape_string($conn, $_POST['street_address']);
    $city = mysqli_real_escape_string($conn, $_POST['city']);

    $query = "INSERT INTO adopter (name, gender, contact, street_address, city) VALUES ('$name', '$gender', '$contact', '$street_address', '$city')";
    mysqli_query($conn, $query);

    header('Location: ' . BASE_URL . 'pages/adopters.php');
    exit;
}

if ($action == "update") {
    $id = (int) $_POST['id'];

    $name = mysqli_real_escape_string($conn, $_POST['adopter_name']);
    $contact = mysqli_real_escape_string($conn, $_POST['contact']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $street_address = mysqli_real_escape_string($conn, $_POST['street_address']);
    $city = mysqli_real_escape_string($conn, $_POST['city']);

    mysqli_query(
        $conn,
        "UPDATE adopter SET name='$name', contact='$contact', gender='$gender', street_address='$street_address', city='$city' WHERE id=$id"
    );

    header('Location: ' . BASE_URL . 'pages/adopters.php');
    exit;
}

if ($action == "delete") {
    $id = (int) $_POST['adopter_id'];

    mysqli_query($conn, "DELETE FROM adopter WHERE id=$id");

    header('Location: ' . BASE_URL . 'pages/adopters.php');
    exit;
}
