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

    $name = $_POST['adopter_name'];
    $contact = $_POST['contact'];
    $gender = $_POST['gender'];
    $street_address = $_POST['street_address'];
    $city = $_POST['city'];

    $query = "INSERT INTO adopter (name, gender, contact, street_address, city) VALUES ('$name', '$gender', '$contact', '$street_address', '$city')";
    mysqli_query($conn, $query);

    header('Location: ' . BASE_URL . 'pages/adopters.php');
    exit;
}

if ($action == "update") {
    $id = (int) $_POST['id'];

    $name = $_POST['adopter_name'];
    $contact = $_POST['contact'];
    $gender = $_POST['gender'];
    $street_address = $_POST['street_address'];
    $city = $_POST['city'];

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
