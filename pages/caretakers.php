<?php
include_once '../includes/header.php';
?>


<?php
$caretakers = mysqli_query($conn, "SELECT * FROM caretaker")->fetch_all(MYSQLI_ASSOC);
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
                                <h2>Caretakers</h2>
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
                                            <a href="#0">Caretakers</a>
                                        </li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                        <!-- end col -->
                    </div>

                    <div class="d-flex justify-content-between flex-wrap align-items-center mb-4">
                        <p class="text-sm text-muted mb-2 mb-md-0">Manage caretakers and staff here.</p>
                        <a href="<?= BASE_URL ?>pages/caretakers-add.php" class="main-btn primary-btn btn-hover rounded-pill px-4 shadow-sm shadow-primary">
                            <i class="lni lni-plus me-2"></i> Add Caretaker
                        </a>
                    </div>

                    <div class="row">
                        <?php foreach ($caretakers as $caretaker): ?>
                        <div class="col-xl-4 col-lg-6 col-md-6 mb-30">
                            <div class="card-style h-100 p-4 border-0 shadow-sm transition-base" style="border-radius: 16px; background: #fff; border: 1px solid var(--border-light) !important;">
                                <div class="d-flex align-items-center mb-4">
                                    <div class="avatar bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 60px; height: 60px; font-size: 24px; font-weight: bold; flex-shrink: 0; box-shadow: 0 4px 10px rgba(236,72,153,0.3); background: var(--primary-color) !important;">
                                        <?= strtoupper(substr($caretaker['name'], 0, 1)) ?>
                                    </div>
                                    <div>
                                        <h5 class="text-dark mb-1" style="font-weight: 700;"><?= htmlspecialchars($caretaker['name']) ?></h5>
                                        <p class="text-xs text-muted mb-0 text-uppercase" style="letter-spacing: 0.5px;"><i class="lni lni-user me-1"></i> <?= htmlspecialchars($caretaker['gender']) ?></p>
                                    </div>
                                </div>
                                
                                <div class="info-list mb-4">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="icon-sm rounded d-flex align-items-center justify-content-center me-3 shadow-sm" style="width: 32px; height: 32px; background: rgba(236, 72, 153, 0.1); color: var(--primary-color);">
                                            <i class="lni lni-phone"></i>
                                        </div>
                                        <span class="text-sm text-dark font-weight-500"><?= htmlspecialchars($caretaker['contact']) ?></span>
                                    </div>
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="icon-sm rounded d-flex align-items-center justify-content-center me-3 shadow-sm" style="width: 32px; height: 32px; background: rgba(236, 72, 153, 0.1); color: var(--primary-color);">
                                            <i class="lni lni-calendar"></i>
                                        </div>
                                        <span class="text-sm text-dark font-weight-500">Born: <?= htmlspecialchars($caretaker['dob']) ?></span>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <div class="icon-sm rounded d-flex align-items-center justify-content-center me-3 shadow-sm" style="width: 32px; height: 32px; background: rgba(236, 72, 153, 0.1); color: var(--primary-color);">
                                            <i class="lni lni-star-filled"></i>
                                        </div>
                                        <span class="text-sm text-dark font-weight-500"><?= htmlspecialchars($caretaker['experience']) ?></span>
                                    </div>
                                </div>
                                
                                <div class="d-flex justify-content-end align-items-center pt-3 mt-auto" style="border-top: 1px dashed var(--border-light);">
                                    <a href="<?= BASE_URL ?>pages/caretakers-edit.php?id=<?= $caretaker['id'] ?>" class="btn btn-sm btn-outline-primary rounded-pill px-3 me-2" style="font-weight: 600; border-width: 2px;">Edit</a>
                                    
                                    <form action="<?= BASE_URL ?>actions/caretaker-actions.php" method="post" class="m-0" onsubmit="return confirm('Delete this caretaker?');">
                                        <input type="hidden" name="caretaker_id" value="<?= $caretaker['id'] ?>">
                                        <input type="hidden" name="action" value="delete">
                                        <button type="submit" name="submit" value="submit" class="btn btn-sm btn-outline-danger rounded-pill px-3" style="font-weight: 600; border-width: 2px;">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                        
                        <?php if(empty($caretakers)): ?>
                        <div class="col-12">
                            <div class="card-style text-center py-5">
                                <i class="lni lni-empty-file text-muted" style="font-size: 48px;"></i>
                                <h4 class="mt-3 text-muted">No caretakers found</h4>
                                <p class="text-sm">Click "Add Caretaker" to get started.</p>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>

                    <!-- end row -->
                </div>
                <!-- ========== title-wrapper end ========== -->
            </div>
            <!-- end container -->
        </section>
        <!-- ========== section end ========== -->

        <?php include_once BASE_PATH . 'includes/footer.php'; ?>