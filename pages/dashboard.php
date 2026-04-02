<?php
include_once '../includes/header.php';
include_once BASE_PATH . 'includes/sidebar.php';
include_once BASE_PATH . 'config/database.php';

$pets_count = mysqli_query($conn, "SELECT COUNT(*) as count FROM pets")->fetch_assoc()['count'];
$adopters_count = mysqli_query($conn, "SELECT COUNT(*) as count FROM adopter")->fetch_assoc()['count'];
$caretakers_count = mysqli_query($conn, "SELECT COUNT(*) as count FROM caretaker")->fetch_assoc()['count'];

$adoptions_query = mysqli_query($conn, "SHOW TABLES LIKE 'adoption'");
if (mysqli_num_rows($adoptions_query) > 0) {
    $adoptions_count = mysqli_query($conn, "SELECT COUNT(*) as count FROM adoption")->fetch_assoc()['count'];
} else {
    $adoptions_count = 0;
}
?>

<body>
    <!-- ======== Preloader =========== -->
    <div id="preloader" style="display: none;">
        <div class="spinner"></div>
    </div>
    <!-- ======== Preloader =========== -->

    <?php include_once BASE_PATH . '/includes/sidebar.php' ?>

    <!-- ======== main-wrapper start =========== -->
    <main class="main-wrapper">
        <!-- ========== header start ========== -->
        <?php include_once BASE_PATH . '/includes/topbar.php' ?>
        <!-- ========== header end ========== -->

        <!-- ========== section start ========== -->
        <section class="section">
            <div class="container-fluid">
                <!-- ========== title-wrapper start ========== -->
                <div class="title-wrapper pt-30">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <div class="title">
                                <h2>Dashboard</h2>
                            </div>
                        </div>
                        <!-- end col -->
                        <div class="col-md-6">
                            <div class="breadcrumb-wrapper">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item active">
                                            <a href="#0">Dashboard</a>
                                        </li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                        <!-- end col -->
                    </div>
                    <!-- end row -->

                    <div class="row mt-4">
                        <div class="col-xl-3 col-lg-4 col-sm-6">
                            <div class="icon-card mb-30 card-style">
                                <div class="content">
                                    <h6 class="mb-10">Total Pets</h6>
                                    <h3 class="text-bold mb-10"><?= $pets_count ?></h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-4 col-sm-6">
                            <div class="icon-card mb-30 card-style">
                                <div class="content">
                                    <h6 class="mb-10">Total Adopters</h6>
                                    <h3 class="text-bold mb-10"><?= $adopters_count ?></h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-4 col-sm-6">
                            <div class="icon-card mb-30 card-style">
                                <div class="content">
                                    <h6 class="mb-10">Total Caretakers</h6>
                                    <h3 class="text-bold mb-10"><?= $caretakers_count ?></h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-4 col-sm-6">
                            <div class="icon-card mb-30 card-style">
                                <div class="content">
                                    <h6 class="mb-10">Total Adoptions</h6>
                                    <h3 class="text-bold mb-10"><?= $adoptions_count ?></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ========== title-wrapper end ========== -->
            </div>
            <!-- end container -->
        </section>
        <!-- ========== section end ========== -->

        <?php include_once BASE_PATH . 'includes/footer.php'; ?>