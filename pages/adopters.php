<?php
include_once '../includes/header.php';
include_once BASE_PATH . 'includes/sidebar.php';
?>

<?php
$adopters = mysqli_query($conn, "SELECT * FROM adopter")->fetch_all(MYSQLI_ASSOC);
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
                    <!-- end row -->
                    <div class="card-style mb-30">
                        <a href="<?= BASE_URL ?>pages/adopters-add.php"
                            class="main-btn btn-sm primary-btn btn-hover">Add
                            Adopter</a>
                        <div class="table-wrapper table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="lead-info">
                                            <h6>Name</h6>
                                        </th>
                                        <th class="lead-email">
                                            <h6>Contact</h6>
                                        </th>
                                        <th class="lead-phone">
                                            <h6>Gender</h6>
                                        </th>
                                        <th class="lead-company">
                                            <h6>Address</h6>
                                        </th>
                                        <th>
                                            <h6>Action</h6>
                                        </th>
                                    </tr>
                                    <!-- end table row-->
                                </thead>
                                <tbody>
                                    <?php foreach ($adopters as $adopter): ?>
                                        <tr>
                                            <td class="min-width">
                                                <div class="lead-text">
                                                    <p><?= $adopter['name'] ?></p>
                                                </div>
                                            </td>
                                            <td class="min-width">
                                                <p><a href="#0"><?= $adopter['contact'] ?></a></p>
                                            </td>
                                            <td class="min-width">
                                                <p><?= $adopter['gender'] ?></p>
                                            </td>
                                            <td class="min-width">
                                                <p><?= $adopter['street_address'] ?>, <?= $adopter['city'] ?></p>
                                            </td>
                                            <td>
                                                <div class="action">
                                                    <a href="<?= BASE_URL ?>pages/adopters-edit.php?id=<?= $adopter['id'] ?>"
                                                        class="text-success me-2">
                                                        <i class="lni lni-pencil-alt"></i>
                                                    </a>
                                                    <form action="<?= BASE_URL ?>actions/adopter-actions.php" method="post">
                                                        <input type="hidden" name="adopter_id" value="<?= $adopter['id'] ?>">
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

                </div>
                <!-- ========== title-wrapper end ========== -->
            </div>
            <!-- end container -->
        </section>
        <!-- ========== section end ========== -->

        <?php include_once BASE_PATH . 'includes/footer.php'; ?>