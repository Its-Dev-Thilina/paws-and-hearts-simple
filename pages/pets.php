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

                    <div class="d-flex justify-content-between flex-wrap align-items-center mb-4">
                        <p class="text-sm text-muted mb-2 mb-md-0">Manage all registered pets here.</p>
                        <a href="<?= BASE_URL ?>pages/pets-add.php" class="main-btn primary-btn btn-hover rounded-pill px-4 shadow-sm shadow-primary">
                            <i class="lni lni-plus me-2"></i> Add New Pet
                        </a>
                    </div>

                    <div class="row">
                        <?php foreach ($pets as $pet): ?>
                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 mb-30">
                            <div class="card-style h-100 p-0 overflow-hidden position-relative profile-card-hover" style="border-radius: 20px;">
                                <div class="image-wrapper position-relative" style="height: 220px;">
                                    <img src="<?= BASE_URL ?><?= $pet['image_path'] ?>" class="w-100 h-100 object-fit-cover" alt="<?= $pet['name'] ?>" style="transition: transform 0.5s ease;">
                                    <div class="overlay-gradient" style="position: absolute; bottom: 0; left: 0; right: 0; background: linear-gradient(0deg, rgba(0,0,0,0.8) 0%, rgba(0,0,0,0) 100%); height: 50%;"></div>
                                    <span class="badge position-absolute top-0 end-0 m-3 text-uppercase shadow-sm" style="font-size: 11px; padding: 6px 12px; background: rgba(255,255,255,0.9); color: var(--primary-dark); font-weight: 800; border-radius: 8px;">
                                        <?= htmlspecialchars($pet['pet_specie']) ?>
                                    </span>
                                </div>
                                <div class="content p-4 bg-white position-relative" style="margin-top: -20px; border-radius: 20px 20px 0 0;">
                                    <h4 class="mb-1 text-dark" style="font-weight: 800; font-size: 20px;"><?= htmlspecialchars($pet['name']) ?></h4>
                                    <p class="text-sm text-muted mb-4 d-flex align-items-center" style="font-weight: 600;">
                                        <i class="lni lni-tag text-primary me-2"></i> <?= htmlspecialchars($pet['breed']) ?>
                                    </p>
                                    
                                    <div class="actions d-flex justify-content-between align-items-center pt-3 mt-auto" style="border-top: 1px dashed var(--border-light);">
                                        <a href="<?= BASE_URL ?>pages/pets-edit.php?id=<?= $pet['id'] ?>" class="text-info d-flex align-items-center" style="font-weight: 700; font-size: 14px; text-decoration: none;">
                                            <div class="icon bg-info text-white rounded-circle d-flex align-items-center justify-content-center me-2 shadow-sm" style="width: 32px; height: 32px; opacity: 0.9;">
                                                <i class="lni lni-pencil-alt text-white"></i>
                                            </div>
                                            Edit
                                        </a>
                                        <form action="<?= BASE_URL ?>actions/pet-actions.php" method="post" class="m-0" onsubmit="return confirm('Delete this pet?');">
                                            <input type="hidden" name="pet_id" value="<?= $pet['id'] ?>">
                                            <input type="hidden" name="action" value="delete">
                                            <button type="submit" name="submit" value="submit" class="text-danger d-flex align-items-center bg-transparent border-0" style="font-weight: 700; font-size: 14px; padding: 0;">
                                                <div class="icon bg-danger text-white rounded-circle d-flex align-items-center justify-content-center ms-2 shadow-sm order-2" style="width: 32px; height: 32px; opacity: 0.9;">
                                                    <i class="lni lni-trash-can text-white"></i>
                                                </div>
                                                <span class="order-1">Delete</span>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                        
                        <?php if(empty($pets)): ?>
                        <div class="col-12">
                            <div class="card-style text-center py-5">
                                <i class="lni lni-empty-file text-muted" style="font-size: 48px;"></i>
                                <h4 class="mt-3 text-muted">No pets found</h4>
                                <p class="text-sm">Click "Add New Pet" to get started.</p>
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