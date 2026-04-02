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
    $name = mysqli_real_escape_string($conn, $_POST['care_name']);
    $contact = mysqli_real_escape_string($conn, $_POST['contact']);
    $experience = (int)$_POST['experience'];
    $dob = mysqli_real_escape_string($conn, $_POST['dob']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);

    $query = "INSERT INTO caretaker (name, contact, experience, dob, gender) VALUES ('$name', '$contact', '$experience', '$dob', '$gender')";
    mysqli_query($conn, $query);

    header('Location: ' . BASE_URL . 'pages/caretakers.php');
    exit;
}

if ($action == "update") {
    $id = (int) $_POST['id'];

    $name = mysqli_real_escape_string($conn, $_POST['caretaker_name']);
    $contact = mysqli_real_escape_string($conn, $_POST['contact']);
    $experience = (int)$_POST['experience'];
    $dob = mysqli_real_escape_string($conn, $_POST['dob']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);

    mysqli_query(
        $conn,
        "UPDATE caretaker SET name='$name', contact='$contact', experience=$experience, dob='$dob', gender='$gender' WHERE id=$id"
    );

    header('Location: ' . BASE_URL . 'pages/caretakers.php');
    exit;
}

if ($action == "delete") {
    $id = (int) $_POST['caretaker_id'];

    mysqli_query($conn, "DELETE FROM caretaker WHERE id=$id");

    header('Location: ' . BASE_URL . 'pages/caretakers.php');
    exit;
}

