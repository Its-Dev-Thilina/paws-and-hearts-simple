<?php
include_once '../includes/header.php';
include_once BASE_PATH . 'includes/sidebar.php';
include_once BASE_PATH . 'config/database.php';
?>

<?php

$query = "SELECT adoption.id as id, adoption.status as status, pets.name as pet, caretaker.name as caretaker, adopter.name as adopter FROM adoption 
JOIN pets ON adoption.pet = pets.id 
JOIN caretaker ON adoption.caretaker = caretaker.id 
JOIN adopter ON adoption.adopter = adopter.id";

$adoptions = mysqli_query($conn, $query)->fetch_all(MYSQLI_ASSOC);
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
                                <h2>Adoption</h2>
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
                                            <a href="#0">Adoption</a>
                                        </li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                        <!-- end col -->
                    </div>

                    <div class="d-flex justify-content-between flex-wrap align-items-center mb-4">
                        <p class="text-sm text-muted mb-2 mb-md-0">Manage and track all successful adoptions.</p>
                        <a href="<?= BASE_URL ?>pages/adoption-add.php" class="main-btn primary-btn btn-hover rounded-pill px-4 shadow-sm shadow-primary">
                            <i class="lni lni-plus me-2"></i> Register Adoption
                        </a>
                    </div>
                    
                    <div class="card-style mb-30 border-0 shadow-sm p-0 overflow-hidden" style="border-radius: 16px;">
                        <div class="table-wrapper table-responsive">
                            <table class="table mb-0">
                                <thead>
                                    <tr>
                                        <th class="ps-4"><h6>Pet Name</h6></th>
                                        <th><h6>Adopter</h6></th>
                                        <th><h6>Assigned Caretaker</h6></th>
                                        <th><h6>Status</h6></th>
                                        <th class="text-end pe-4"><h6>Actions</h6></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($adoptions as $adoption): ?>
                                        <tr>
                                            <td class="min-width ps-4">
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3 shadow-sm" style="width: 40px; height: 40px; font-weight: bold; background: var(--primary-color) !important;">
                                                        <i class="lni lni-heart"></i>
                                                    </div>
                                                    <div>
                                                        <h6 class="mb-0 text-dark" style="font-weight: 700;"><?= htmlspecialchars($adoption['pet']) ?></h6>
                                                        <span class="text-xs text-muted">ID: #<?= $adoption['id'] ?></span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="min-width">
                                                <p class="text-sm font-weight-500 mb-0 d-flex align-items-center text-dark">
                                                    <i class="lni lni-user text-primary me-2"></i> <?= htmlspecialchars($adoption['adopter']) ?>
                                                </p>
                                            </td>
                                            <td class="min-width">
                                                <p class="text-sm font-weight-500 mb-0 d-flex align-items-center text-muted">
                                                    <?= htmlspecialchars($adoption['caretaker']) ?>
                                                </p>
                                            </td>
                                            <td class="min-width">
                                                <?php if ((int)$adoption['status'] === 0): ?>
                                                    <span class="badge bg-warning text-dark text-xs py-1 px-3 rounded-pill" style="font-weight: 700;">Pending</span>
                                                <?php else: ?>
                                                    <span class="badge bg-success text-white text-xs py-1 px-3 rounded-pill" style="font-weight: 700;">Approved</span>
                                                <?php endif; ?>
                                            </td>
                                            <td class="text-end pe-4">
                                                <div class="action d-flex justify-content-end">
                                                    <?php if ((int)$adoption['status'] === 0): ?>
                                                    <form action="<?= BASE_URL ?>actions/adoption-actions.php" method="post" onsubmit="return confirm('Approve this adoption request?');" class="m-0 me-2">
                                                        <input type="hidden" name="adoption_id" value="<?= $adoption['id'] ?>">
                                                        <input type="hidden" name="action" value="approve">
                                                        <button class="text-success bg-light rounded-circle d-flex border-0" type="submit" name="submit" value="submit" style="width: 35px; height: 35px; align-items: center; justify-content: center;" title="Approve">
                                                            <i class="lni lni-checkmark"></i>
                                                        </button>
                                                    </form>
                                                    <?php endif; ?>
                                                    
                                                    <a href="<?= BASE_URL ?>pages/adoption-edit.php?id=<?= $adoption['id'] ?>"
                                                        class="text-info me-2 bg-light rounded-circle d-flex" style="width: 35px; height: 35px; align-items: center; justify-content: center;" title="Edit">
                                                        <i class="lni lni-pencil-alt"></i>
                                                    </a>
                                                    
                                                    <form action="<?= BASE_URL ?>actions/adoption-actions.php" method="post" onsubmit="return confirm('Remove this adoption record?');" class="m-0">
                                                        <input type="hidden" name="adoption_id" value="<?= $adoption['id'] ?>">
                                                        <input type="hidden" name="action" value="delete">
                                                        <button class="text-danger bg-light rounded-circle d-flex border-0" type="submit" name="submit" value="submit" style="width: 35px; height: 35px; align-items: center; justify-content: center;" title="<?= (int)$adoption['status'] === 0 ? 'Reject' : 'Delete' ?>">
                                                            <i class="lni lni-trash-can"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                    
                                    <?php if(empty($adoptions)): ?>
                                    <tr>
                                        <td colspan="4" class="text-center py-5 text-muted">
                                            No adoptions found.
                                        </td>
                                    </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
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