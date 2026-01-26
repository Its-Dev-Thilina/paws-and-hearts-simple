<?php
include_once '../includes/header.php';
include_once BASE_PATH . 'config/database.php';
?>

<?php
    $users = mysqli_query($conn, "SELECT * FROM user")->fetch_all(MYSQLI_ASSOC) ?? "";
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
                                <h2>Users</h2>
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
                        <a href="<?= BASE_URL ?>pages/users-add.php" class="main-btn btn-sm primary-btn btn-hover">Add
                            User</a>
                        <div class="table-wrapper table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>
                                            <h6>#</h6>
                                        </th>
                                        <th>
                                            <h6>Username</h6>
                                        </th>
                                        <th>
                                            <h6>Email</h6>
                                        </th>
                                        <th>
                                            <h6>Actions</h6>
                                        </th>
                                    </tr>
                                    <!-- end table row-->
                                </thead>
                                <tbody>
                                    <?php $index = 1 ?>
                                    <?php foreach ($users as $user): ?>
                                        <tr>
                                            <td style="width: 40px;">
                                                <p><?= $index ?></p>
                                            </td>
                                            <td class="min-width">
                                                <p><a href="#0"><?= $user['username'] ?></a></p>
                                            </td>
                                            <td class="min-width">
                                                <p><?= $user['email'] ?></p>
                                            </td>
                                            <td>
                                                <div class="action">
                                                    <a href="<?= BASE_URL ?>pages/users-edit.php?id=<?= $user['id'] ?>" class="text-success me-2">
                                                        <i class="lni lni-pencil-alt"></i>
                                                    </a>
                                                    <form action="<?= BASE_URL ?>actions/user-actions.php" method="post">
                                                        <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                                                        <input type="hidden" name="action" value="delete">
                                                        <button class="text-danger" type="submit" name="submit"
                                                            value="submit">
                                                            <i class="lni lni-trash-can"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php $index++ ?>
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