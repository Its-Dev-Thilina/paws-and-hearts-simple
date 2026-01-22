<?php
session_start();
include_once __DIR__ . '/../config/database.php';
include_once __DIR__ . '/../config/config.php';
// include_once BASE_PATH.'/includes/auth.php';
?>
<!DOCTYPE html>
<html>

<head>
    <title>Paws And Hearts</title>
    <!-- <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/main.css"> -->
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/lineicons.css" />
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/materialdesignicons.min.css" />
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/fullcalendar.css" />
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/main.css" />
</head>

<body>