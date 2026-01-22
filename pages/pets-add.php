<?php
include_once '../includes/header.php';
include_once BASE_PATH . 'includes/sidebar.php';
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
                                <h2>Pets</h2>
                            </div>
                        </div>
                        <!-- end col -->
                        <div class="col-md-6">
                            <div class="breadcrumb-wrapper">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item">
                                            <a href="#0">Dashboard</a>
                                        </li>
                                        <li class="breadcrumb-item active">
                                            <a href="#0">Pets</a>
                                        </li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                        <!-- end col -->
                    </div>

                    <div class="card-style mb-30">

                        <form action="<?= BASE_URL ?>actions/pet-actions.php" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="action" value="store">
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Pet Image</label>
                                <input class="form-control" type="file" id="formFile" name="image">
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <input type="text" class="form-control" placeholder="Pet Name"
                                        aria-label="First name" name="pet_name">
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control" placeholder="Pet Specie ( Dog | Cat )"
                                        aria-label="Last name" name="pet_specie">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <input type="text" class="form-control" placeholder="Breed" aria-label="Breed" name="breed">
                                </div>
                            </div>
                            <div class="mt-4">
                                <a href="<?= BASE_URL ?>pages/pets.php"
                                    class="main-btn btn-sm light-btn btn-hover">Back</a>
                                <input type="submit" value="Save" name="submit"
                                    class="main-btn btn-sm primary-btn btn-hover">
                            </div>
                        </form>

                    </div>

                    <!-- end row -->
                </div>
                <!-- ========== title-wrapper end ========== -->
            </div>
            <!-- end container -->
        </section>
        <!-- ========== section end ========== -->

        <?php include_once BASE_PATH . 'includes/footer.php'; ?>