<?php $current_page = basename($_SERVER['PHP_SELF']); ?>
<!-- ======== sidebar-nav start =========== -->
<aside class="sidebar-nav-wrapper">
  <!-- Brand Logo Area -->
  <div class="sidebar-brand">
    <a href="<?= BASE_URL ?>pages/dashboard.php" class="brand-link">
      <div class="brand-icon">
        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="currentColor">
          <path d="M4.5 11.5C5.33 11.5 6 10.83 6 10S5.33 8.5 4.5 8.5 3 9.17 3 10 3.67 11.5 4.5 11.5M7.5 7C8.33 7 9 6.33 9 5.5S8.33 4 7.5 4 6 4.67 6 5.5 6.67 7 7.5 7M16.5 7C17.33 7 18 6.33 18 5.5S17.33 4 16.5 4 15 4.67 15 5.5 15.67 7 16.5 7M19.5 11.5C20.33 11.5 21 10.83 21 10S20.33 8.5 19.5 8.5 18 9.17 18 10 18.67 11.5 19.5 11.5M17.34 14.86C16.27 13.33 13.93 12 12 12S7.73 13.33 6.66 14.86C6.18 15.55 6 16.35 6 17.15C6 19.28 7.8 21 10 21H14C16.2 21 18 19.28 18 17.15C18 16.35 17.82 15.55 17.34 14.86Z"/>
        </svg>
      </div>
      <div class="brand-text">
        <span class="brand-name">Paws & Hearts</span>
        <span class="brand-tagline">Admin Panel</span>
      </div>
    </a>
  </div>

  <!-- Navigation -->
  <nav class="sidebar-nav">
    <ul>
      <!-- Main Section -->
      <li class="nav-section-title">Main</li>

      <li class="nav-item">
        <a href="<?= BASE_URL ?>pages/dashboard.php" class="<?= ($current_page == 'dashboard.php') ? 'active' : '' ?>">
          <span class="nav-icon">
            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M8.74999 18.3333C12.2376 18.3333 15.1364 15.8128 15.7244 12.4941C15.8448 11.8143 15.2737 11.25 14.5833 11.25H9.99999C9.30966 11.25 8.74999 10.6903 8.74999 10V5.41666C8.74999 4.7263 8.18563 4.15512 7.50586 4.27556C4.18711 4.86357 1.66666 7.76243 1.66666 11.25C1.66666 15.162 4.83797 18.3333 8.74999 18.3333Z"></path>
              <path d="M17.0833 10C17.7737 10 18.3432 9.43708 18.2408 8.75433C17.7005 5.14918 14.8508 2.29947 11.2457 1.75912C10.5629 1.6568 10 2.2263 10 2.91665V9.16666C10 9.62691 10.3731 10 10.8333 10H17.0833Z"></path>
            </svg>
          </span>
          <span class="nav-label">Dashboard</span>
        </a>
      </li>

      <!-- Management Section -->
      <li class="nav-section-title">Management</li>

      <li class="nav-item">
        <a href="<?= BASE_URL ?>pages/adoption.php" class="<?= (strpos($current_page, 'adoption') !== false) ? 'active' : '' ?>">
          <span class="nav-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
              <path d="M12.1,18.55L12,18.65L11.89,18.55C7.14,14.24 4,11.39 4,8.5C4,6.5 5.5,5 7.5,5C9.04,5 10.54,6 11.07,7.36H12.93C13.46,6 14.96,5 16.5,5C18.5,5 20,6.5 20,8.5C20,11.39 16.86,14.24 12.1,18.55M16.5,3C14.76,3 13.09,3.81 12,5.08C10.91,3.81 9.24,3 7.5,3C4.42,3 2,5.41 2,8.5C2,12.27 5.4,15.36 10.55,20.03L12,21.35L13.45,20.03C18.6,15.36 22,12.27 22,8.5C22,5.41 19.58,3 16.5,3Z" />
            </svg>
          </span>
          <span class="nav-label">Adoptions</span>
          <span class="nav-badge">New</span>
        </a>
      </li>

      <li class="nav-item">
        <a href="<?= BASE_URL ?>pages/pets.php" class="<?= (strpos($current_page, 'pet') !== false) ? 'active' : '' ?>">
          <span class="nav-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
              <path d="M4.5 11.5C5.33 11.5 6 10.83 6 10S5.33 8.5 4.5 8.5 3 9.17 3 10 3.67 11.5 4.5 11.5M7.5 7C8.33 7 9 6.33 9 5.5S8.33 4 7.5 4 6 4.67 6 5.5 6.67 7 7.5 7M16.5 7C17.33 7 18 6.33 18 5.5S17.33 4 16.5 4 15 4.67 15 5.5 15.67 7 16.5 7M19.5 11.5C20.33 11.5 21 10.83 21 10S20.33 8.5 19.5 8.5 18 9.17 18 10 18.67 11.5 19.5 11.5M17.34 14.86C16.27 13.33 13.93 12 12 12S7.73 13.33 6.66 14.86C6.18 15.55 6 16.35 6 17.15C6 19.28 7.8 21 10 21H14C16.2 21 18 19.28 18 17.15C18 16.35 17.82 15.55 17.34 14.86Z"/>
            </svg>
          </span>
          <span class="nav-label">Pets</span>
        </a>
      </li>

      <!-- People Section -->
      <li class="nav-section-title">People</li>

      <li class="nav-item">
        <a href="<?= BASE_URL ?>pages/caretakers.php" class="<?= (strpos($current_page, 'caretaker') !== false) ? 'active' : '' ?>">
          <span class="nav-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
              <path d="M12 12C14.21 12 16 10.21 16 8S14.21 4 12 4 8 5.79 8 8 9.79 12 12 12M12 14C9.33 14 4 15.34 4 18V20H20V18C20 15.34 14.67 14 12 14Z" />
            </svg>
          </span>
          <span class="nav-label">Caretakers</span>
        </a>
      </li>

      <li class="nav-item">
        <a href="<?= BASE_URL ?>pages/adopters.php" class="<?= (strpos($current_page, 'adopter') !== false) ? 'active' : '' ?>">
          <span class="nav-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
              <path d="M16 17V19H2V17S2 13 9 13 16 17 16 17M12.5 7.5A3.5 3.5 0 1 0 9 11A3.5 3.5 0 0 0 12.5 7.5M15.94 13A5.32 5.32 0 0 1 18 17V19H22V17S22 13.37 15.94 13M15 4A3.39 3.39 0 0 0 13.07 4.59A5 5 0 0 1 13.07 10.41A3.39 3.39 0 0 0 15 11A3.5 3.5 0 0 0 15 4Z" />
            </svg>
          </span>
          <span class="nav-label">Adopters</span>
        </a>
      </li>

      <!-- System Section -->
      <li class="nav-section-title">System</li>

      <li class="nav-item">
        <a href="<?= BASE_URL ?>pages/users.php" class="<?= (strpos($current_page, 'user') !== false) ? 'active' : '' ?>">
          <span class="nav-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
              <path d="M12 1L3 5V11C3 16.55 6.84 21.74 12 23C17.16 21.74 21 16.55 21 11V5L12 1M12 11.99H19C18.47 16.11 15.72 19.78 12 20.93V12H5V6.3L12 3.19V11.99Z" />
            </svg>
          </span>
          <span class="nav-label">Users</span>
        </a>
      </li>

    </ul>
  </nav>

  <!-- Sidebar Footer -->
  <div class="sidebar-footer">
    <div class="sidebar-footer-inner">
      <div class="sidebar-footer-icon">🐾</div>
      <div class="sidebar-footer-text">
        <span class="footer-title">Paws & Hearts</span>
        <span class="footer-version">v1.0.0</span>
      </div>
    </div>
  </div>
</aside>
<div class="overlay"></div>
<!-- ======== sidebar-nav end =========== -->