<?php
include_once '../includes/header.php';
include_once BASE_PATH . 'includes/sidebar.php';
include_once BASE_PATH . 'config/database.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$adoption_res = mysqli_query($conn, "SELECT * FROM adoption WHERE id = $id");
if (!$adoption_res || mysqli_num_rows($adoption_res) == 0) {
    header('Location: ' . BASE_URL . 'pages/adoption.php');
    exit;
}
$adoption = mysqli_fetch_assoc($adoption_res);

// Get available pets OR the pet currently assigned to this adoption
$pets = mysqli_query($conn, "SELECT id, name, breed FROM pets WHERE status=1 OR id={$adoption['pet']}")->fetch_all(MYSQLI_ASSOC);
$caretakers = mysqli_query($conn, "SELECT id, name FROM caretaker")->fetch_all(MYSQLI_ASSOC);
$adopters = mysqli_query($conn, "SELECT id, name FROM adopter")->fetch_all(MYSQLI_ASSOC);
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
                                <h2>Edit Adoption</h2>
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

                    <div class="card-style mb-30">
                        <form action="<?= BASE_URL ?>actions/adoption-actions.php" method="post">
                            <input type="hidden" name="action" value="update">
                            <input type="hidden" name="id" value="<?= $adoption['id'] ?>">
                            
                            <div class="row mb-3">
                                <div class="col">
                                    <label>Pet</label>
                                    <div class="select-position">
                                        <select class="light-bg form-control" name="pet_id" required>
                                            <option value="">Select Pet</option>
                                            <?php foreach ($pets as $pet): ?>
                                                <option value="<?= $pet['id'] ?>" <?= $pet['id'] == $adoption['pet'] ? 'selected' : '' ?>><?= $pet['name'] ?> (<?= $pet['breed'] ?>)</option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <label>Caretaker</label>
                                    <div class="select-position">
                                        <select class="light-bg form-control" name="caretaker_id" required>
                                            <option value="">Select Caretaker</option>
                                            <?php foreach ($caretakers as $caretaker): ?>
                                                <option value="<?= $caretaker['id'] ?>" <?= $caretaker['id'] == $adoption['caretaker'] ? 'selected' : '' ?>><?= $caretaker['name'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <label>Adopter</label>
                                    <div class="select-position">
                                        <select class="light-bg form-control" name="adopter_id" required>
                                            <option value="">Select Adopter</option>
                                            <?php foreach ($adopters as $adopter): ?>
                                                <option value="<?= $adopter['id'] ?>" <?= $adopter['id'] == $adoption['adopter'] ? 'selected' : '' ?>><?= $adopter['name'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-4">
                                <a href="<?= BASE_URL ?>pages/adoption.php" class="main-btn btn-sm light-btn btn-hover">Back</a>
                                <input type="submit" value="Save" name="submit" class="main-btn btn-sm primary-btn btn-hover">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        
        <?php include_once BASE_PATH . 'includes/footer.php'; ?>
