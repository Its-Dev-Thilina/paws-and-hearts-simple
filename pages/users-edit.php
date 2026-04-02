<?php
include_once '../includes/header.php';
include_once BASE_PATH . 'includes/sidebar.php';
include_once BASE_PATH . 'config/database.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$user_res = mysqli_query($conn, "SELECT * FROM user WHERE id = $id");
if (!$user_res || mysqli_num_rows($user_res) == 0) {
    header('Location: ' . BASE_URL . 'pages/users.php');
    exit;
}
$user = mysqli_fetch_assoc($user_res);
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
                                <h2>Edit User</h2>
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
                                            <a href="#0">Users</a>
                                        </li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                        <!-- end col -->
                    </div>

                    <div class="card-style mb-30">
                        <form action="<?= BASE_URL ?>actions/user-actions.php" method="post">
                            <input type="hidden" name="action" value="update">
                            <input type="hidden" name="id" value="<?= $user['id'] ?>">
                            <div class="row mb-3">
                                <div class="col-6">
                                    <input type="text" class="form-control" placeholder="Username"
                                        aria-label="First name" name="username" value="<?= htmlspecialchars($user['username']) ?>">
                                </div>
                                <div class="col-6">
                                    <input type="email" class="form-control" placeholder="Email" name="email" value="<?= htmlspecialchars($user['email']) ?>">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <input type="password" class="form-control" placeholder="New Password (Leave blank to keep current)" name="password">
                                </div>
                                <div class="col-6">
                                    <input type="password" class="form-control" placeholder="Re-Enter New Password" name="password_confirm">
                                </div>
                            </div>

                            <div class="mt-4">
                                <a href="<?= BASE_URL ?>pages/users.php"
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
