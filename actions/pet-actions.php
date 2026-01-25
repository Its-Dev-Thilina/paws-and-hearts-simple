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

    $uploadFilePath = uploadImage($_FILES['image']);

    $name = $_POST['pet_name'];
    $specie = $_POST['pet_specie'];
    $breed = $_POST['breed'];
    $description = $_POST['description'];
    $image_path = $uploadFilePath;

    $query = "INSERT INTO pets (name, image_path, pet_specie, breed, description) VALUES ('$name', '$image_path', '$specie', '$breed', '$description')";
    mysqli_query($conn, $query);

    header('Location: ' . BASE_URL . 'pages/pets.php');
    exit;
}

if ($action == "update") {
    $id = (int) $_POST['id'];
    
    if($_FILES['image']['error'] === UPLOAD_ERR_NO_FILE){
        $uploadFilePath = $_POST['image_path'];
    } else {
        $uploadFilePath = uploadImage($_FILES['image']);
    }

    $name = $_POST['pet_name'];
    $specie = $_POST['pet_specie'];
    $breed = $_POST['breed'];
    $image_path = $uploadFilePath;

    mysqli_query(
        $conn,
        "UPDATE pets SET name='$name', pet_specie='$specie', breed='$breed', image_path='$image_path' WHERE id=$id"
    );

    header('Location: ' . BASE_URL . 'pages/pets.php');
    exit;
}

if ($action == "delete") {
    $id = (int) $_POST['pet_id'];

    mysqli_query($conn, "DELETE FROM pets WHERE id=$id");

    header('Location: ' . BASE_URL . 'pages/pets.php');
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

    $uploadFilePath = 'assets/uploads/pets/' . $fileName;

    move_uploaded_file($fileTmp, $uploadDir . $fileName);

    return $uploadFilePath;
}