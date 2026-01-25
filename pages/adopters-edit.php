<?php
include_once '../includes/header.php';
include_once BASE_PATH . 'includes/sidebar.php';
?>

<?php 
    $adopter = mysqli_query($conn, "SELECT * FROM adopter WHERE id=" . (int)$_GET['id'])->fetch_assoc();
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
                                <h2>Adopters</h2>
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
                                            <a href="#0">Adopters</a>
                                        </li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                        <!-- end col -->
                    </div>

                    <div class="card-style mb-30">

                        <form action="<?= BASE_URL ?>actions/adopter-actions.php" method="post">
                            <input type="hidden" name="action" value="update">
                            <input type="hidden" name="id" value="<?= $adopter['id'] ?>">
                            <div class="row mb-3">
                                <div class="col">
                                    <input type="text" class="form-control" placeholder="Name" aria-label="First name" name="adopter_name" value="<?= $adopter['name'] ?>">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <input type="text" class="form-control" placeholder="Contact"
                                        aria-label="Last name" name="contact" value="<?= $adopter['contact'] ?>">
                                </div>
                                <div class="col">
                                    <div class="select-position">
                                        <select class="light-bg form-control" name="gender">
                                            <option value="">Select Gender</option>
                                            <option value="Male" <?= $adopter['gender'] == 'Male' ? 'selected' : '' ?>>Male</option>
                                            <option value="Female" <?= $adopter['gender'] == 'Female' ? 'selected' : '' ?>>Female</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label for="" class="form-control border-0">Address</label>
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control" placeholder="Street Address" aria-label="Breed" name="street_address" value="<?= $adopter['street_address'] ?>">
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control" placeholder="City" aria-label="Breed" name="city" value="<?= $adopter['city'] ?>">
                                </div>
                            </div>
                            <div class="mt-4">
                                <a href="<?= BASE_URL ?>pages/adopters.php"
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