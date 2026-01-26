<?php

include_once '../config/config.php';
include_once BASE_PATH . '/config/database.php';

$action = $_POST['action'] ?? null;
$submit = $_POST['submit'] ?? null;

if (!$submit || !$action) {
    header('Location: ' . BASE_URL);
    exit;
}

if ($action == 'login') {
    $email = $_POST['email'] ?? null;
    $password = $_POST['password'] ?? null;

    $user = mysqli_query($conn, "SELECT * from user WHERE email='$email'")->fetch_assoc();

    if (!$user) {
        header('Location: ' . BASE_URL . 'login.php');
        exit;
    }

    if (!password_verify($password, $user['password'])) {
        header('Location: ' . BASE_URL . 'login.php');
        exit;
    }

    session_start();
    $_SESSION['user_id'] = $user['id'];

    header('Location: ' . BASE_URL . 'pages/dashboard.php');
    exit;
}

if ($action == 'logout') {
    session_start();
    session_unset();
    session_destroy();
    
    if (!isset($_SESSION['user_id'])) {
        header('Location: ' . BASE_URL . 'login.php');
        exit;
    }
}
