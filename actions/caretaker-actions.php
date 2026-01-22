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

    $name = $_POST['name'];
    $type = $_POST['type'];

    $query = "INSERT INTO pets (name, type) VALUES ('$name', '$type')";
    mysqli_query($conn, $query);

    header('Location: ' . BASE_URL . 'pages/caretakers.php');
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

    header('Location: ' . BASE_URL . 'pages/caretakers.php');
    exit;
}

if ($action == "delete") {
    $id = (int) $_POST['id'];

    mysqli_query($conn, "DELETE FROM pets WHERE id=$id");

    header('Location: ' . BASE_URL . 'pages/caretakers.php');
    exit;
}