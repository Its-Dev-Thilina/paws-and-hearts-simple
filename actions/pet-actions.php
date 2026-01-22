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

    // Uploading the image file to the server

    if (!isset($_FILES['image']) || $_FILES['image']['error'] !== UPLOAD_ERR_OK) {
        die('Error uploading file.');
    }

    $uploadDir = BASE_PATH . '/assets/uploads/pets/';

    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    $fileTmp  = $_FILES['image']['tmp_name'];
    $fileName = basename($_FILES['image']['name']);

    // Save Path to the Database
    $uploadFilePath = '/assets/uploads/pets/' . $fileName;

    move_uploaded_file($fileTmp, $uploadDir . $fileName);

    // Start to Insert Data into Database

    $name = $_POST['pet_name'];
    $specie = $_POST['pet_specie'];
    $breed = $_POST['breed'];
    $image_path = $uploadFilePath;

    $query = "INSERT INTO pets (name, image_path, pet_specie, breed) VALUES ('$name', '$image_path', '$specie', '$breed')";
    mysqli_query($conn, $query);

    header('Location: ' . BASE_URL . 'pages/pets.php');
    exit;
}

if ($action == "update") {
    $id = (int) $_POST['id'];
    $name = $_POST['name'];
    $type = $_POST['type'];

    mysqli_query(
        $conn,
        "UPDATE pets SET name='$name', type='$type' WHERE id=$id"
    );

    header('Location: ' . BASE_URL . 'pages/pets.php');
    exit;
}

if ($action == "delete") {
    $id = (int) $_POST['id'];

    mysqli_query($conn, "DELETE FROM pets WHERE id=$id");

    header('Location: ' . BASE_URL . 'pages/pets.php');
    exit;
}