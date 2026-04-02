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
    $pet_id = (int)$_POST['pet_id'];
    $caretaker_id = (int)$_POST['caretaker_id'];
    $adopter_id = (int)$_POST['adopter_id'];

    $query = "INSERT INTO adoption (pet, caretaker, adopter) VALUES ($pet_id, $caretaker_id, $adopter_id)";
    mysqli_query($conn, $query);

    mysqli_query($conn, "UPDATE pets SET status=0 WHERE id=$pet_id");

    header('Location: ' . BASE_URL . 'pages/adoption.php');
    exit;
}

if ($action == "update") {
    $id = (int) $_POST['id'];

    $pet_id = (int)$_POST['pet_id'];
    $caretaker_id = (int)$_POST['caretaker_id'];
    $adopter_id = (int)$_POST['adopter_id'];

    $old_pet_query = mysqli_query($conn, "SELECT pet FROM adoption WHERE id=$id");
    if ($old_pet_query && mysqli_num_rows($old_pet_query) > 0) {
        $old_pet = mysqli_fetch_assoc($old_pet_query)['pet'];
        if ($old_pet != $pet_id) {
            mysqli_query($conn, "UPDATE pets SET status=1 WHERE id=$old_pet");
            mysqli_query($conn, "UPDATE pets SET status=0 WHERE id=$pet_id");
        }
    }

    mysqli_query(
        $conn,
        "UPDATE adoption SET pet=$pet_id, caretaker=$caretaker_id, adopter=$adopter_id WHERE id=$id"
    );

    header('Location: ' . BASE_URL . 'pages/adoption.php');
    exit;
}

if ($action == "approve") {
    $id = (int) $_POST['adoption_id'];

    mysqli_query($conn, "UPDATE adoption SET status=1 WHERE id=$id");

    header('Location: ' . BASE_URL . 'pages/adoption.php');
    exit;
}

if ($action == "delete") {
    $id = (int) $_POST['adoption_id'];

    $old_pet_query = mysqli_query($conn, "SELECT pet FROM adoption WHERE id=$id");
    if ($old_pet_query && mysqli_num_rows($old_pet_query) > 0) {
        $old_pet = mysqli_fetch_assoc($old_pet_query)['pet'];
        mysqli_query($conn, "UPDATE pets SET status=1 WHERE id=$old_pet");
    }

    mysqli_query($conn, "DELETE FROM adoption WHERE id=$id");

    header('Location: ' . BASE_URL . 'pages/adoption.php');
    exit;
}
