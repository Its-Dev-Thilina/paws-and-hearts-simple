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
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];

    if($password !== $password_confirm) {
        header('Location: ' . BASE_URL . 'pages/users.php');
        exit;
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $query = "INSERT INTO user (username, email, password) VALUES ('$username', '$email', '$hashed_password')";
    mysqli_query($conn, $query);

    header('Location: ' . BASE_URL . 'pages/users.php');
    exit;
}

if ($action == "update") {
    $id = (int) $_POST['id'];
    
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    if (!empty($_POST['password'])) {
        if ($_POST['password'] === $_POST['password_confirm']) {
            $hashed_password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            mysqli_query($conn, "UPDATE user SET username='$username', email='$email', password='$hashed_password' WHERE id=$id");
        }
    } else {
        mysqli_query($conn, "UPDATE user SET username='$username', email='$email' WHERE id=$id");
    }

    header('Location: ' . BASE_URL . 'pages/users.php');
    exit;
}

if ($action == "delete") {
    $id = (int) $_POST['user_id'];

    mysqli_query($conn, "DELETE FROM user WHERE id=$id");

    header('Location: ' . BASE_URL . 'pages/users.php');
    exit;
}
