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
                    <div class="d-flex justify-content-between flex-wrap align-items-center mb-4">
                        <p class="text-sm text-muted mb-2 mb-md-0">Manage all pet adopters.</p>
                        <a href="<?= BASE_URL ?>pages/adopters-add.php" class="main-btn primary-btn btn-hover rounded-pill px-4 shadow-sm shadow-primary">
                            <i class="lni lni-plus me-2"></i> Add Adopter
                        </a>
                    </div>
                    
                    <div class="card-style mb-30 border-0 shadow-sm p-0 overflow-hidden" style="border-radius: 16px;">
                        <div class="table-wrapper table-responsive">
                            <table class="table mb-0">
                                <thead>
                                    <tr>
                                        <th class="ps-4"><h6>Adopter</h6></th>
                                        <th><h6>Contact</h6></th>
                                        <th><h6>Gender</h6></th>
                                        <th><h6>Location</h6></th>
                                        <th class="text-end pe-4"><h6>Actions</h6></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($adopters as $adopter): ?>
                                        <tr>
                                            <td class="min-width ps-4">
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar bg-primary-light text-primary rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px; font-weight: bold; background: rgba(236, 72, 153, 0.1);">
                                                        <?= strtoupper(substr($adopter['name'], 0, 1)) ?>
                                                    </div>
                                                    <div>
                                                        <h6 class="mb-0 text-dark" style="font-weight: 700;"><?= htmlspecialchars($adopter['name']) ?></h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="min-width">
                                                <p class="text-sm font-weight-500 mb-0 d-flex align-items-center">
                                                    <i class="lni lni-phone text-muted me-2"></i> <?= htmlspecialchars($adopter['contact']) ?>
                                                </p>
                                            </td>
                                            <td class="min-width">
                                                <span class="badge bg-light text-dark border px-3 py-2 rounded-pill"><?= htmlspecialchars($adopter['gender']) ?></span>
                                            </td>
                                            <td class="min-width">
                                                <p class="text-sm text-muted mb-0"><i class="lni lni-map-marker me-1"></i> <?= htmlspecialchars($adopter['street_address']) ?>, <?= htmlspecialchars($adopter['city']) ?></p>
                                            </td>
                                            <td class="text-end pe-4">
                                                <div class="action d-flex justify-content-end">
                                                    <a href="<?= BASE_URL ?>pages/adopters-edit.php?id=<?= $adopter['id'] ?>"
                                                        class="text-info me-3 bg-light rounded-circle d-flex" style="width: 35px; height: 35px; align-items: center; justify-content: center;">
                                                        <i class="lni lni-pencil-alt"></i>
                                                    </a>
                                                    <form action="<?= BASE_URL ?>actions/adopter-actions.php" method="post" onsubmit="return confirm('Delete adopter?');" class="m-0">
                                                        <input type="hidden" name="adopter_id" value="<?= $adopter['id'] ?>">
                                                        <input type="hidden" name="action" value="delete">
                                                        <button class="text-danger bg-light rounded-circle d-flex border-0" type="submit" name="submit" value="submit" style="width: 35px; height: 35px; align-items: center; justify-content: center;">
                                                            <i class="lni lni-trash-can"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                    
                                    <?php if(empty($adopters)): ?>
                                    <tr>
                                        <td colspan="5" class="text-center py-5 text-muted">
                                            No adopters found.
                                        </td>
                                    </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
                <!-- ========== title-wrapper end ========== -->
            </div>
            <!-- end container -->
        </section>
        <!-- ========== section end ========== -->

        <?php include_once BASE_PATH . 'includes/footer.php'; ?>