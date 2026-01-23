<?php
include_once '../includes/header.php';
include_once BASE_PATH . 'includes/sidebar.php';
include_once BASE_PATH . 'config/database.php';
?>

<?php
$pets = mysqli_query($conn, "SELECT * FROM pets")->fetch_all(MYSQLI_ASSOC);
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
                        <a href="<?= BASE_URL ?>pages/pets-add.php" class="main-btn btn-sm primary-btn btn-hover">Add
                            Pet</a>
                        <div class="table-wrapper table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="lead-info">
                                            <h6>Pet Name</h6>
                                        </th>
                                        <th class="lead-phone">
                                            <h6>Pet Species</h6>
                                        </th>
                                        <th>
                                            <h6>Breed</h6>
                                        </th>
                                        <th>
                                            <h6>Actions</h6>
                                        </th>
                                    </tr>
                                    <!-- end table row-->
                                </thead>
                                <tbody>
                                    <?php foreach ($pets as $pet): ?>
                                        <tr>
                                            <td class="min-width">
                                                <div class="lead">
                                                    <div class="lead-image w-100" style="height: 50px;">
                                                        <img src="<?= BASE_URL ?><?= $pet['image_path'] ?>"
                                                            class="w-100 h-100 object-fit-cover" alt="">
                                                    </div>
                                                    <div class="lead-text">
                                                        <p><?= $pet['name'] ?></p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="min-width">
                                                <p><a href="#0"><?= $pet['pet_specie'] ?></a></p>
                                            </td>
                                            <td class="min-width">
                                                <p><?= $pet['breed'] ?></p>
                                            </td>
                                            <td>
                                                <div class="action">
                                                    <a href="<?= BASE_URL ?>pages/pets-edit.php?id=<?= $pet['id'] ?>" class="text-success me-2">
                                                        <i class="lni lni-pencil-alt"></i>
                                                    </a>
                                                    <form action="<?= BASE_URL ?>actions/pet-actions.php" method="post">
                                                        <input type="hidden" name="pet_id" value="<?= $pet['id'] ?>">
                                                        <input type="hidden" name="action" value="delete">
                                                        <button class="text-danger" type="submit" name="submit"
                                                            value="submit">
                                                            <i class="lni lni-trash-can"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            <!-- end table -->
                        </div>
                    </div>

                    <!-- end row -->
                </div>
                <!-- ========== title-wrapper end ========== -->
            </div>
            <!-- end container -->
        </section>
        <!-- ========== section end ========== -->

        <?php include_once BASE_PATH . 'includes/footer.php'; ?>