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

    $name = $_POST['care_name'];
    $contact = $_POST['contact'];
    $experience = $_POST['experience'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];

    $query = "INSERT INTO caretaker (name, contact, experience, dob, gender) VALUES ('$name', '$contact', '$experience', '$dob', '$gender')";
    mysqli_query($conn, $query);

    header('Location: ' . BASE_URL . 'pages/caretakers.php');
    exit;
}

if ($action == "update") {
    $id = (int) $_POST['id'];

    $name = $_POST['caretaker_name'];
    $contact = $_POST['contact'];
    $experience = $_POST['experience'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];

    mysqli_query(
        $conn,
        "UPDATE caretaker SET name='$name', contact='$contact', experience='$experience', dob='$dob', gender='$gender' WHERE id=$id"
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


function uploadImage($file)
{
    $uploadDir = BASE_PATH . '/assets/uploads/pets/';

    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    $fileTmp  = $file['tmp_name'];
    $fileName = basename($file['name']);

    $uploadFilePath = '/assets/uploads/pets/' . $fileName;

    move_uploaded_file($fileTmp, $uploadDir . $fileName);

    return $uploadFilePath;
}