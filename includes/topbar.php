<?php 
include_once __DIR__ . '/../config/config.php'; 
include_once __DIR__ . '/../config/database.php';

// Fetch current user details
$currentUser = null;
if (isset($_SESSION['user_id'])) {
    $userId = (int)$_SESSION['user_id'];
    $currentUserResult = mysqli_query($conn, "SELECT username, email FROM user WHERE id = $userId");
    if ($currentUserResult && mysqli_num_rows($currentUserResult) > 0) {
        $currentUser = mysqli_fetch_assoc($currentUserResult);
    }
}

$username = $currentUser ? htmlspecialchars($currentUser['username']) : 'Admin';
$email = $currentUser ? htmlspecialchars($currentUser['email']) : 'admin@pawsandhearts.com';
$initial = strtoupper(substr($username, 0, 1));
?>

<header class="header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-5 col-md-5 col-6">
                <div class="header-left d-flex align-items-center">
                    <div class="menu-toggle-btn mr-15">
                        <button id="menu-toggle" class="main-btn primary-btn btn-hover rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; padding: 0;">
                            <i class="lni lni-menu"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 col-md-7 col-6">
                <div class="header-right">
                    <!-- profile start -->
                    <div class="profile-box ml-15">
                        <button class="dropdown-toggle bg-transparent border-0" type="button" id="profile"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <div class="profile-info">
                                <div class="info d-flex align-items-center">
                                    <div class="avatar bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-2 shadow-sm" style="width: 42px; height: 42px; font-weight: 700; font-size: 18px; background: var(--pink) !important;">
                                        <?= $initial ?>
                                    </div>
                                    <div class="text-start d-none d-md-block ms-2">
                                        <h6 class="fw-bold mb-0 text-dark"><?= $username ?></h6>
                                        <p class="text-muted mb-0" style="font-size: 12px; font-weight: 600;">Administrator</p>
                                    </div>
                                </div>
                            </div>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end shadow border-0" aria-labelledby="profile" style="border-radius: 12px; padding: 12px; min-width: 220px; top: 100%; margin-top: 10px;">
                            <li>
                                <div class="author-info d-flex align-items-center p-2 mb-2">
                                    <div class="avatar bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 46px; height: 46px; font-weight: 700; font-size: 20px; background: var(--pink) !important;">
                                        <?= $initial ?>
                                    </div>
                                    <div class="content">
                                        <h6 class="mb-1 text-dark fw-bold" style="line-height: 1;"><?= $username ?></h6>
                                        <p class="text-muted mb-0" style="font-size: 12px; overflow: hidden; text-overflow: ellipsis; max-width: 140px;"><?= $email ?></p>
                                    </div>
                                </div>
                            </li>
                            <li><hr class="dropdown-divider mb-2"></li>
                            <li>
                                <form action="<?= BASE_URL ?>actions/auth-actions.php" method="post" class="m-0">
                                    <input type="hidden" name="action" value="logout">
                                    <button type="submit" name="submit" value="submit" class="dropdown-item d-flex align-items-center text-danger rounded" style="font-weight: 600; padding: 10px 14px; cursor: pointer;">
                                        <i class="lni lni-exit me-2"></i> Sign Out
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                    <!-- profile end -->
                </div>
            </div>
        </div>
    </div>
</header>