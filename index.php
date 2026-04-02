<?php
include_once __DIR__ . '/config/config.php';
include_once BASE_PATH . '/config/database.php';

// Fetch pets from database (only not adopted pets - status = 1)
$pets_query = "SELECT id, name, image_path, pet_specie as species, breed, COALESCE(description, '') as description FROM pets WHERE status = 1";
$pets_result = mysqli_query($conn, $pets_query);
$dbPets = [];
if ($pets_result) {
    while ($pet = mysqli_fetch_assoc($pets_result)) {
        $dbPets[] = $pet;
    }
}

// Count stats
$total_pets = count($dbPets);
$total_adoptions = 0;
$adoption_result = mysqli_query($conn, "SELECT COUNT(*) as count FROM adoption");
if ($adoption_result) {
    $total_adoptions = mysqli_fetch_assoc($adoption_result)['count'];
}
$total_caretakers = 0;
$caretaker_result = mysqli_query($conn, "SELECT COUNT(*) as count FROM caretaker");
if ($caretaker_result) {
    $total_caretakers = mysqli_fetch_assoc($caretaker_result)['count'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paws & Hearts — Find Your Perfect Companion</title>
    <meta name="description" content="Giving stray animals a second chance at life. Rescue, care, and find loving homes for animals in need.">
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/lineicons.css" />
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --pink: #ec4899;
            --pink-dark: #be185d;
            --pink-light: #fce7f3;
            --pink-lighter: #fdf2f8;
            --dark: #0f172a;
            --dark-secondary: #1e293b;
            --text-body: #334155;
            --text-muted: #64748b;
            --text-light: #94a3b8;
            --border: #e2e8f0;
            --bg: #f8fafc;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: var(--text-body);
            background: #fff;
            -webkit-font-smoothing: antialiased;
            overflow-x: hidden;
        }

        /* ========== NAVBAR ========== */
        .site-navbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            padding: 16px 0;
            transition: all 0.3s ease;
        }

        .site-navbar.scrolled {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(12px);
            box-shadow: 0 1px 3px rgba(0,0,0,0.06);
            padding: 12px 0;
        }

        .navbar-brand-text {
            font-size: 22px;
            font-weight: 800;
            color: #fff;
            text-decoration: none;
            letter-spacing: -0.5px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .navbar-brand-text .brand-dot {
            width: 10px;
            height: 10px;
            background: var(--pink);
            border-radius: 50%;
            display: inline-block;
        }

        .site-navbar.scrolled .navbar-brand-text { color: var(--dark); }

        .nav-links { display: flex; gap: 32px; align-items: center; list-style: none; margin: 0; padding: 0; }
        .nav-links a {
            color: rgba(255,255,255,0.85);
            text-decoration: none;
            font-weight: 600;
            font-size: 15px;
            transition: color 0.2s;
        }
        .nav-links a:hover { color: #fff; }
        .site-navbar.scrolled .nav-links a { color: var(--text-muted); }
        .site-navbar.scrolled .nav-links a:hover { color: var(--pink); }

        .nav-btn {
            background: var(--pink);
            color: #fff !important;
            padding: 10px 24px;
            border-radius: 8px;
            font-weight: 700;
            font-size: 14px;
            text-decoration: none;
            transition: all 0.2s;
            border: none;
        }
        .nav-btn:hover { background: var(--pink-dark); transform: translateY(-1px); }


        /* ========== HERO ========== */
        .hero {
            min-height: 100vh;
            display: flex;
            align-items: center;
            position: relative;
            background: var(--dark);
            overflow: hidden;
        }

        .hero-bg {
            position: absolute;
            inset: 0;
            z-index: 1;
        }

        .hero-bg img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            opacity: 0.35;
        }

        .hero-content {
            position: relative;
            z-index: 2;
            max-width: 640px;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(255,255,255,0.1);
            border: 1px solid rgba(255,255,255,0.15);
            padding: 8px 16px;
            border-radius: 100px;
            color: rgba(255,255,255,0.9);
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 24px;
            backdrop-filter: blur(4px);
        }

        .hero-badge .dot { width: 8px; height: 8px; background: var(--pink); border-radius: 50%; }

        .hero h1 {
            font-size: 56px;
            font-weight: 800;
            color: #fff;
            line-height: 1.1;
            letter-spacing: -1.5px;
            margin-bottom: 20px;
        }

        .hero h1 span { color: var(--pink); }

        .hero p {
            font-size: 18px;
            color: rgba(255,255,255,0.7);
            line-height: 1.7;
            margin-bottom: 36px;
            max-width: 480px;
        }

        .hero-actions { display: flex; gap: 12px; flex-wrap: wrap; }

        .btn-hero-primary {
            background: var(--pink);
            color: #fff;
            padding: 14px 32px;
            border-radius: 10px;
            font-weight: 700;
            font-size: 16px;
            text-decoration: none;
            border: none;
            cursor: pointer;
            transition: all 0.2s;
        }
        .btn-hero-primary:hover { background: var(--pink-dark); color: #fff; }

        .btn-hero-secondary {
            background: rgba(255,255,255,0.1);
            color: #fff;
            padding: 14px 32px;
            border-radius: 10px;
            font-weight: 700;
            font-size: 16px;
            text-decoration: none;
            border: 1px solid rgba(255,255,255,0.2);
            cursor: pointer;
            transition: all 0.2s;
        }
        .btn-hero-secondary:hover { background: rgba(255,255,255,0.2); color: #fff; }

        /* Stats strip */
        .hero-stats {
            margin-top: 64px;
            display: flex;
            gap: 48px;
        }

        .hero-stat h3 {
            font-size: 36px;
            font-weight: 800;
            color: #fff;
            margin-bottom: 4px;
            line-height: 1;
        }
        .hero-stat h3 span { color: var(--pink); font-size: 24px; }

        .hero-stat p {
            font-size: 14px;
            color: rgba(255,255,255,0.5);
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin: 0;
        }


        /* ========== SECTION STYLES ========== */
        .section-padding { padding: 100px 0; }

        .section-header {
            text-align: center;
            max-width: 560px;
            margin: 0 auto 60px;
        }

        .section-label {
            display: inline-block;
            font-size: 13px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: var(--pink);
            margin-bottom: 12px;
        }

        .section-header h2 {
            font-size: 40px;
            font-weight: 800;
            color: var(--dark);
            letter-spacing: -1px;
            line-height: 1.2;
            margin-bottom: 16px;
        }

        .section-header p {
            font-size: 17px;
            color: var(--text-muted);
            line-height: 1.7;
        }


        /* ========== MISSION CARDS ========== */
        .mission-card {
            background: #fff;
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 36px 28px;
            text-align: center;
            transition: all 0.3s ease;
            height: 100%;
        }

        .mission-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 32px rgba(0,0,0,0.06);
            border-color: var(--pink-light);
        }

        .mission-icon {
            width: 64px;
            height: 64px;
            border-radius: 16px;
            background: var(--pink-light);
            color: var(--pink);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            margin: 0 auto 20px;
        }

        .mission-card h5 {
            font-size: 18px;
            font-weight: 800;
            color: var(--dark);
            margin-bottom: 10px;
        }

        .mission-card p {
            font-size: 15px;
            color: var(--text-muted);
            line-height: 1.6;
            margin: 0;
        }


        /* ========== PETS SECTION ========== */
        .bg-soft { background: var(--bg); }

        .filter-bar {
            background: #fff;
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: 24px 28px;
            margin-bottom: 40px;
        }

        .filter-bar label {
            font-size: 13px;
            font-weight: 700;
            color: var(--dark);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .filter-bar .form-control,
        .filter-bar .form-select {
            border: 1px solid var(--border) !important;
            border-radius: 10px !important;
            padding: 10px 16px !important;
            font-size: 14px;
            font-weight: 500;
            background: var(--bg) !important;
        }

        .filter-bar .form-control:focus,
        .filter-bar .form-select:focus {
            border-color: var(--pink) !important;
            box-shadow: 0 0 0 3px rgba(236,72,153,0.1) !important;
            background: #fff !important;
        }

        /* Pet Card */
        .pet-card {
            background: #fff;
            border: 1px solid var(--border);
            border-radius: 16px;
            overflow: hidden;
            transition: all 0.3s ease;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .pet-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 32px rgba(0,0,0,0.08);
            border-color: var(--pink-light);
        }

        .pet-card-img {
            height: 220px;
            overflow: hidden;
            position: relative;
        }

        .pet-card-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .pet-card:hover .pet-card-img img {
            transform: scale(1.06);
        }

        .pet-card-species {
            position: absolute;
            top: 12px;
            right: 12px;
            background: #fff;
            color: var(--dark);
            font-size: 11px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 5px 12px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        .pet-card-body {
            padding: 20px 24px 24px;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .pet-card-body h5 {
            font-size: 18px;
            font-weight: 800;
            color: var(--dark);
            margin-bottom: 6px;
        }

        .pet-card-body .breed {
            font-size: 14px;
            color: var(--text-muted);
            font-weight: 500;
            margin-bottom: 16px;
        }

        .pet-card-status {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 12px;
            font-weight: 700;
            color: #059669;
            margin-bottom: 16px;
        }

        .pet-card-status .status-dot {
            width: 7px;
            height: 7px;
            background: #10b981;
            border-radius: 50%;
        }

        .btn-pet {
            width: 100%;
            background: var(--pink-lighter);
            color: var(--pink-dark);
            border: none;
            padding: 11px;
            border-radius: 10px;
            font-weight: 700;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.2s;
            margin-top: auto;
        }

        .btn-pet:hover {
            background: var(--pink);
            color: #fff;
        }

        .btn-load-more {
            background: #fff;
            color: var(--dark);
            border: 2px solid var(--border);
            padding: 14px 40px;
            border-radius: 10px;
            font-weight: 700;
            font-size: 15px;
            cursor: pointer;
            transition: all 0.2s;
        }
        .btn-load-more:hover { border-color: var(--pink); color: var(--pink); }


        /* ========== ADOPT NOW FORM ========== */
        .adopt-form-card {
            background: #fff;
            border: 1px solid var(--border);
            border-radius: 20px;
            padding: 44px 40px;
            max-width: 680px;
            margin: 0 auto;
        }

        .adopt-form-card .form-group {
            margin-bottom: 20px;
        }

        .adopt-form-card label {
            display: block;
            font-size: 13px;
            font-weight: 700;
            color: var(--dark);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 6px;
        }

        .adopt-form-card input,
        .adopt-form-card select {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid var(--border);
            border-radius: 10px;
            font-size: 15px;
            font-weight: 500;
            font-family: inherit;
            background: var(--bg);
            color: var(--dark);
            transition: all 0.2s;
            outline: none;
        }

        .adopt-form-card input::placeholder { color: var(--text-muted); font-weight: 400; }

        .adopt-form-card input:focus,
        .adopt-form-card select:focus {
            border-color: var(--pink);
            background: #fff;
            box-shadow: 0 0 0 3px rgba(236, 72, 153, 0.1);
        }

        .btn-adopt-submit {
            width: 100%;
            background: var(--pink);
            color: #fff;
            border: none;
            padding: 14px;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 700;
            font-family: inherit;
            cursor: pointer;
            transition: all 0.2s;
            margin-top: 8px;
        }
        .btn-adopt-submit:hover { background: var(--pink-dark); }

        .adopt-feature {
            display: flex;
            align-items: flex-start;
            gap: 16px;
            margin-bottom: 28px;
        }

        .adopt-feature-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            background: var(--pink-light);
            color: var(--pink);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            flex-shrink: 0;
        }

        .adopt-feature h6 {
            font-size: 16px;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 4px;
        }

        .adopt-feature p {
            font-size: 14px;
            color: var(--text-muted);
            line-height: 1.5;
            margin: 0;
        }

        .selected-pet-preview {
            background: var(--pink-lighter);
            border: 1px solid var(--pink-light);
            border-radius: 12px;
            padding: 16px 20px;
            margin-bottom: 24px;
            display: none;
            align-items: center;
            gap: 14px;
        }

        .selected-pet-preview img {
            width: 52px;
            height: 52px;
            border-radius: 10px;
            object-fit: cover;
        }

        .selected-pet-preview .pet-info h6 {
            font-size: 15px;
            font-weight: 700;
            color: var(--dark);
            margin: 0 0 2px;
        }

        .selected-pet-preview .pet-info span {
            font-size: 12px;
            color: var(--pink-dark);
            font-weight: 600;
        }

        .selected-pet-preview .remove-pet {
            margin-left: auto;
            background: none;
            border: none;
            color: var(--text-muted);
            cursor: pointer;
            font-size: 18px;
            padding: 4px;
        }
        .selected-pet-preview .remove-pet:hover { color: var(--pink-dark); }

        .alert-adopt {
            padding: 16px 20px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 14px;
            margin-bottom: 24px;
        }

        .alert-adopt.success {
            background: #ecfdf5;
            color: #065f46;
            border: 1px solid #a7f3d0;
        }

        .alert-adopt.error {
            background: #fef2f2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }


        /* ========== CONTACT / CTA ========== */
        .cta-section {
            background: var(--dark);
            color: #fff;
        }

        .cta-section h2 {
            font-size: 40px;
            font-weight: 800;
            letter-spacing: -1px;
            margin-bottom: 16px;
        }

        .cta-section p {
            font-size: 17px;
            color: rgba(255,255,255,0.6);
            line-height: 1.7;
        }

        .contact-card {
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 14px;
            padding: 28px 24px;
            text-align: center;
            transition: all 0.3s ease;
        }

        .contact-card:hover {
            background: rgba(255,255,255,0.08);
            border-color: rgba(255,255,255,0.15);
        }

        .contact-icon {
            width: 52px;
            height: 52px;
            border-radius: 12px;
            background: var(--pink);
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            margin: 0 auto 16px;
        }

        .contact-card h6 {
            font-size: 16px;
            font-weight: 700;
            color: #fff;
            margin-bottom: 6px;
        }

        .contact-card p {
            font-size: 14px;
            color: rgba(255,255,255,0.5);
            margin: 0;
        }


        /* ========== FOOTER ========== */
        .site-footer {
            background: var(--dark-secondary);
            padding: 40px 0;
            text-align: center;
        }

        .site-footer p {
            color: rgba(255,255,255,0.4);
            font-size: 14px;
            font-weight: 500;
            margin: 0;
        }

        .site-footer a { color: var(--pink); text-decoration: none; }


        /* ========== MODAL ========== */
        .modal-content { border: none; border-radius: 16px; overflow: hidden; }
        .modal-header { background: var(--pink); border: none; }
        .modal-header .modal-title { font-weight: 800; }
        .modal-footer { border: none; }
        .modal-footer .btn-primary { background: var(--pink); border: none; font-weight: 700; border-radius: 8px; }
        .modal-footer .btn-primary:hover { background: var(--pink-dark); }
        .modal-footer .btn-secondary { border-radius: 8px; font-weight: 600; }

        .modal-body h3 { font-weight: 800; color: var(--dark); }
        .modal-body h5 { font-weight: 700; color: var(--dark); }


        /* ========== RESPONSIVE ========== */
        @media (max-width: 768px) {
            .hero h1 { font-size: 36px; }
            .hero-stats { gap: 24px; flex-wrap: wrap; }
            .hero-stat h3 { font-size: 28px; }
            .section-header h2 { font-size: 28px; }
            .cta-section h2 { font-size: 28px; }
            .nav-links { display: none; }
        }
    </style>
</head>

<body>

    <!-- ========== NAVBAR ========== -->
    <nav class="site-navbar" id="siteNavbar">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <a href="<?= BASE_URL ?>" class="navbar-brand-text">
                    <span class="brand-dot"></span>
                    Paws & Hearts
                </a>
                <ul class="nav-links">
                    <li><a href="#about-section">About</a></li>
                    <li><a href="#pets-section">Pets</a></li>
                    <li><a href="#adopt-section">Adopt Now</a></li>
                    <li><a href="#contact-section">Contact</a></li>
                </ul>
            </div>
        </div>
    </nav>


    <!-- ========== HERO ========== -->
    <section class="hero">
        <div class="hero-bg">
            <img src="<?= BASE_URL ?>assets/images/hero.jpg" alt="Happy animals">
        </div>
        <div class="container">
            <div class="hero-content">
                <div class="hero-badge">
                    <span class="dot"></span>
                    Rescue · Care · Adopt
                </div>
                <h1>Every Animal Deserves a <span>Loving Home</span></h1>
                <p>We rescue stray animals, give them the care they need, and match them with amazing families. Your next best friend is waiting.</p>
                <div class="hero-actions">
                    <button class="btn-hero-primary" onclick="document.getElementById('pets-section').scrollIntoView({behavior: 'smooth'})">
                        Find a Pet
                    </button>
                    <button class="btn-hero-secondary" onclick="document.getElementById('about-section').scrollIntoView({behavior: 'smooth'})">
                        Our Mission
                    </button>
                </div>

                <div class="hero-stats">
                    <div class="hero-stat">
                        <h3><?= $total_pets ?><span>+</span></h3>
                        <p>Pets Available</p>
                    </div>
                    <div class="hero-stat">
                        <h3><?= $total_adoptions ?><span>+</span></h3>
                        <p>Adopted</p>
                    </div>
                    <div class="hero-stat">
                        <h3><?= $total_caretakers ?><span>+</span></h3>
                        <p>Caretakers</p>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- ========== ABOUT / MISSION ========== -->
    <section id="about-section" class="section-padding">
        <div class="container">
            <div class="section-header">
                <span class="section-label">What We Do</span>
                <h2>Saving Lives, One Paw at a Time</h2>
                <p>We're dedicated to rescuing, rehabilitating, and rehoming animals in need. Here's how we make a difference.</p>
            </div>
            <div class="row g-4">
                <div class="col-md-6 col-lg-3">
                    <div class="mission-card">
                        <div class="mission-icon">🛟</div>
                        <h5>Rescue</h5>
                        <p>We rescue stray animals from the streets and provide them immediate care and safety.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="mission-card">
                        <div class="mission-icon">💊</div>
                        <h5>Rehabilitate</h5>
                        <p>Our team provides medical treatment, nutrition, and rehabilitation for every animal.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="mission-card">
                        <div class="mission-icon">🏠</div>
                        <h5>Shelter</h5>
                        <p>We provide safe, comfortable homes where animals can recover and feel loved.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="mission-card">
                        <div class="mission-icon">❤️</div>
                        <h5>Adopt</h5>
                        <p>We match animals with loving families, ensuring the perfect forever home.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- ========== PETS SECTION ========== -->
    <section id="pets-section" class="section-padding bg-soft">
        <div class="container">
            <div class="section-header">
                <span class="section-label">Adopt a Friend</span>
                <h2>Find Your Perfect Companion</h2>
                <p>Browse our available animals waiting for their forever homes.</p>
            </div>

            <!-- Filter Bar -->
            <div class="filter-bar">
                <div class="row g-3 align-items-end">
                    <div class="col-md-5">
                        <label class="form-label">Search</label>
                        <input type="text" class="form-control" id="searchPet" placeholder="Search by name...">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Species</label>
                        <select class="form-select" id="filterSpecies">
                            <option value="">All Species</option>
                            <option value="dog">Dog</option>
                            <option value="cat">Cat</option>
                            <option value="rabbit">Rabbit</option>
                            <option value="bird">Bird</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <button class="btn-hero-primary w-100" onclick="filterPets()" style="padding: 11px 24px; font-size: 14px;">
                            <i class="lni lni-search-alt me-2"></i> Search
                        </button>
                    </div>
                </div>
            </div>

            <!-- Pets Grid -->
            <div class="row g-4" id="petsContainer">
                <div class="col-lg-12 text-center py-5">
                    <p class="text-muted">Loading pets...</p>
                </div>
            </div>

            <!-- Load More -->
            <div class="text-center mt-5">
                <button class="btn-load-more" id="loadMoreBtn" onclick="loadMorePets()" style="display: none;">
                    Load More Pets
                </button>
            </div>
        </div>
    </section>


    <!-- ========== ADOPT NOW SECTION ========== -->
    <section id="adopt-section" class="section-padding">
        <div class="container">
            <div class="section-header">
                <span class="section-label">Start the Journey</span>
                <h2>Adopt a Furry Friend</h2>
                <p>Fill out the form below to submit your adoption application. Our team will get back to you soon!</p>
            </div>

            <div class="row g-5 align-items-start">
                <!-- Left: Benefits -->
                <div class="col-lg-5">
                    <div class="adopt-feature">
                        <div class="adopt-feature-icon">📋</div>
                        <div>
                            <h6>Simple Process</h6>
                            <p>Fill out the form and our team reviews your application within 24 hours.</p>
                        </div>
                    </div>
                    <div class="adopt-feature">
                        <div class="adopt-feature-icon">🏠</div>
                        <div>
                            <h6>Home Visit</h6>
                            <p>We'll schedule a quick home visit to ensure the best match for you and the pet.</p>
                        </div>
                    </div>
                    <div class="adopt-feature">
                        <div class="adopt-feature-icon">💕</div>
                        <div>
                            <h6>Forever Family</h6>
                            <p>Once approved, you'll take your new best friend home with all medical records.</p>
                        </div>
                    </div>
                    <div class="adopt-feature">
                        <div class="adopt-feature-icon">📞</div>
                        <div>
                            <h6>Ongoing Support</h6>
                            <p>We provide post-adoption support to help you and your pet adjust smoothly.</p>
                        </div>
                    </div>
                </div>

                <!-- Right: Form -->
                <div class="col-lg-7">
                    <div class="adopt-form-card">
                        <?php if (isset($_GET['adopt_success'])): ?>
                            <div class="alert-adopt success">✅ Your adoption application has been submitted! We'll contact you soon.</div>
                        <?php endif; ?>
                        <?php if (isset($_GET['adopt_error'])): ?>
                            <div class="alert-adopt error">❌ <?= htmlspecialchars($_GET['adopt_error']) ?></div>
                        <?php endif; ?>

                        <!-- Selected pet preview -->
                        <div class="selected-pet-preview" id="selectedPetPreview">
                            <img id="selectedPetImg" src="" alt="">
                            <div class="pet-info">
                                <h6 id="selectedPetName">-</h6>
                                <span id="selectedPetSpecies">-</span>
                            </div>
                            <button type="button" class="remove-pet" onclick="clearSelectedPet()">&times;</button>
                        </div>

                        <form action="<?= BASE_URL ?>actions/public-adopt-action.php" method="post" id="adoptForm">
                            <input type="hidden" name="action" value="public_adopt">
                            <input type="hidden" name="pet_id" id="adoptPetId" value="">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Full Name *</label>
                                        <input type="text" name="name" placeholder="John Doe" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Contact / Email *</label>
                                        <input type="text" name="contact" placeholder="you@email.com" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Gender *</label>
                                        <select name="gender" required>
                                            <option value="">Select gender</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                            <option value="Other">Other</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>City *</label>
                                        <input type="text" name="city" placeholder="Your city" required>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Street Address *</label>
                                <input type="text" name="street_address" placeholder="123 Main Street" required>
                            </div>

                            <div class="form-group">
                                <label>Which pet would you like to adopt? *</label>
                                <select name="pet_select" id="petSelectDropdown" required>
                                    <option value="">Select a pet</option>
                                    <?php foreach ($dbPets as $pet): ?>
                                        <option value="<?= $pet['id'] ?>"><?= htmlspecialchars($pet['name']) ?> (<?= htmlspecialchars($pet['species']) ?>)</option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <button type="submit" name="submit" value="submit" class="btn-adopt-submit">
                                Submit Adoption Application
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- ========== CONTACT / CTA ========== -->
    <section id="contact-section" class="cta-section section-padding">
        <div class="container">
            <div class="text-center mb-5" style="max-width: 520px; margin: 0 auto;">
                <span class="section-label">Get In Touch</span>
                <h2>Ready to Make a Difference?</h2>
                <p>Have questions or want to adopt? We'd love to hear from you.</p>
            </div>
            <div class="row g-4 justify-content-center">
                <div class="col-md-4">
                    <div class="contact-card">
                        <div class="contact-icon"><i class="lni lni-envelope"></i></div>
                        <h6>Email Us</h6>
                        <p>contact@pawsandhearts.com</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="contact-card">
                        <div class="contact-icon"><i class="lni lni-phone"></i></div>
                        <h6>Call Us</h6>
                        <p>+1 (555) 123-4567</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="contact-card">
                        <div class="contact-icon"><i class="lni lni-map-marker"></i></div>
                        <h6>Visit Us</h6>
                        <p>Come meet our animals!</p>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- ========== FOOTER ========== -->
    <footer class="site-footer">
        <div class="container">
            <p>© <?= date('Y') ?> <a href="<?= BASE_URL ?>">Paws & Hearts</a>. All rights reserved. Made with ❤️ for animals.</p>
        </div>
    </footer>


    <!-- ========== Pet Details Modal ========== -->
    <div class="modal fade" id="petModal" tabindex="-1" aria-labelledby="petModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header text-white">
                    <h5 class="modal-title" id="petModalLabel">Pet Details</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4" id="petModalBody">
                    <!-- Pet details loaded here -->
                </div>
                <div class="modal-footer px-4 pb-4">
                    <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary px-4" id="modalAdoptBtn" onclick="adoptFromModal()">Adopt Now</button>
                </div>
            </div>
        </div>
    </div>


    <script src="<?= BASE_URL ?>assets/js/bootstrap.bundle.min.js"></script>
    <script>
        // ========== NAVBAR SCROLL ==========
        const navbar = document.getElementById('siteNavbar');
        window.addEventListener('scroll', () => {
            navbar.classList.toggle('scrolled', window.scrollY > 60);
        });

        // ========== SMOOTH SCROLL FOR ANCHOR LINKS ==========
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) target.scrollIntoView({ behavior: 'smooth', block: 'start' });
            });
        });

        // ========== MODAL SETUP ==========
        let petModalInstance = null;
        document.addEventListener('DOMContentLoaded', function() {
            const petModalElement = document.getElementById('petModal');
            if (petModalElement) {
                petModalElement.addEventListener('hidden.bs.modal', function() {
                    document.querySelectorAll('.modal-backdrop').forEach(b => b.remove());
                    document.body.classList.remove('modal-open');
                    document.body.style.overflow = '';
                });
            }
        });

        // ========== PET DATA ==========
        const samplePets = <?php echo json_encode($dbPets); ?>;
        const mappedPets = samplePets.map(pet => ({
            id: pet.id,
            name: pet.name,
            species: (pet.species || 'dog').toLowerCase(),
            status: 'available',
            image: pet.image_path ? '<?= BASE_URL ?>' + pet.image_path : '<?= BASE_URL ?>assets/images/logo/logo.png',
            breed: pet.breed || '',
            description: pet.description || ''
        }));

        // ========== PAGINATION ==========
        let currentPage = 0;
        let petsPerPage = 8;
        let filteredPets = [];

        function displayPets(pets, isLoadMore = false) {
            const container = document.getElementById('petsContainer');

            if (pets.length === 0) {
                container.innerHTML = `
                    <div class="col-12 text-center py-5">
                        <div style="font-size: 48px; margin-bottom: 16px;">🐾</div>
                        <h5 style="font-weight: 700; color: var(--dark);">No pets found</h5>
                        <p style="color: var(--text-muted);">Try adjusting your search or filters.</p>
                    </div>`;
                return;
            }

            filteredPets = pets;
            if (!isLoadMore) {
                currentPage = 0;
            }

            const startIndex = currentPage * petsPerPage;
            const endIndex = startIndex + petsPerPage;
            const petsToDisplay = filteredPets.slice(startIndex, endIndex);

            const petsHTML = petsToDisplay.map(pet => `
                <div class="col-md-6 col-lg-3">
                    <div class="pet-card">
                        <div class="pet-card-img">
                            <img src="${pet.image}" alt="${pet.name}">
                            <span class="pet-card-species">${pet.species}</span>
                        </div>
                        <div class="pet-card-body">
                            <h5>${pet.name}</h5>
                            <div class="breed">${pet.breed || pet.species}</div>
                            <div class="pet-card-status">
                                <span class="status-dot"></span>
                                Available for Adoption
                            </div>
                            <button class="btn-pet" onclick="showPetModal(${pet.id})">
                                View Details
                            </button>
                        </div>
                    </div>
                </div>
            `).join('');

            if (!isLoadMore) {
                container.innerHTML = petsHTML;
            } else {
                container.innerHTML += petsHTML;
            }

            const loadMoreBtn = document.getElementById('loadMoreBtn');
            const totalDisplayed = (currentPage + 1) * petsPerPage;
            if (loadMoreBtn) {
                loadMoreBtn.style.display = totalDisplayed < filteredPets.length ? 'inline-block' : 'none';
            }

            currentPage++;
        }

        function showPetModal(petId) {
            petId = parseInt(petId);
            const pet = mappedPets.find(p => parseInt(p.id) === petId);
            if (!pet) return;

            const modalBody = document.getElementById('petModalBody');
            const petModalElement = document.getElementById('petModal');
            if (!modalBody || !petModalElement) return;

            modalBody.innerHTML = `
                <div class="row">
                    <div class="col-md-6 mb-3 mb-md-0">
                        <img src="${pet.image}" class="img-fluid rounded-3" alt="${pet.name}" style="width: 100%; height: 320px; object-fit: cover;">
                    </div>
                    <div class="col-md-6">
                        <h3 class="mb-2">${pet.name}</h3>
                        <div class="mb-3">
                            <span style="display: inline-block; background: var(--pink-light); color: var(--pink-dark); padding: 4px 12px; border-radius: 6px; font-size: 13px; font-weight: 700;">${pet.species.charAt(0).toUpperCase() + pet.species.slice(1)}</span>
                            ${pet.breed ? `<span style="display: inline-block; background: var(--bg); color: var(--text-muted); padding: 4px 12px; border-radius: 6px; font-size: 13px; font-weight: 600; margin-left: 6px;">${pet.breed}</span>` : ''}
                        </div>
                        <h5 class="mt-4 mb-2">About</h5>
                        <p style="color: var(--text-muted); line-height: 1.7;">${pet.description || 'This lovely pet is looking for a forever home. Contact us to learn more about adoption!'}</p>
                    </div>
                </div>
            `;

            try {
                if (!petModalInstance) {
                    petModalInstance = new bootstrap.Modal(petModalElement);
                }
                petModalInstance.show();
            } catch(e) {
                console.log('Error showing modal:', e);
            }
        }

        function filterPets() {
            const searchTerm = document.getElementById('searchPet').value.toLowerCase();
            const species = document.getElementById('filterSpecies').value;

            let filtered = mappedPets.filter(pet => {
                const matchesSearch = pet.name.toLowerCase().includes(searchTerm);
                const matchesSpecies = !species || pet.species === species;
                return matchesSearch && matchesSpecies;
            });

            displayPets(filtered);
        }

        function loadMorePets() {
            displayPets(filteredPets, true);
        }

        // Event listeners
        document.getElementById('searchPet').addEventListener('input', filterPets);
        document.getElementById('filterSpecies').addEventListener('change', filterPets);

        // Initial display
        window.addEventListener('load', () => displayPets(mappedPets));


        // ========== ADOPT NOW FLOW ==========
        let currentModalPetId = null;

        // Store which pet is open in the modal
        function showPetModalOriginal(petId) {
            currentModalPetId = parseInt(petId);
        }

        // When "Adopt Now" is clicked in the modal
        function adoptFromModal() {
            if (!currentModalPetId) return;

            const pet = mappedPets.find(p => parseInt(p.id) === currentModalPetId);
            if (!pet) return;

            // Close modal
            if (petModalInstance) {
                petModalInstance.hide();
            }

            // Show selected pet preview
            const preview = document.getElementById('selectedPetPreview');
            document.getElementById('selectedPetImg').src = pet.image;
            document.getElementById('selectedPetName').textContent = pet.name;
            document.getElementById('selectedPetSpecies').textContent = pet.species.charAt(0).toUpperCase() + pet.species.slice(1) + (pet.breed ? ' · ' + pet.breed : '');
            preview.style.display = 'flex';

            // Set hidden pet_id field
            document.getElementById('adoptPetId').value = pet.id;

            // Set dropdown
            const dropdown = document.getElementById('petSelectDropdown');
            if (dropdown) {
                dropdown.value = pet.id;
            }

            // Scroll to adopt section
            setTimeout(() => {
                document.getElementById('adopt-section').scrollIntoView({ behavior: 'smooth', block: 'start' });
            }, 400);
        }

        function clearSelectedPet() {
            document.getElementById('selectedPetPreview').style.display = 'none';
            document.getElementById('adoptPetId').value = '';
            document.getElementById('petSelectDropdown').value = '';
        }

        // Sync dropdown with hidden field
        document.getElementById('petSelectDropdown').addEventListener('change', function() {
            document.getElementById('adoptPetId').value = this.value;

            // Also show preview if a pet is selected
            if (this.value) {
                const pet = mappedPets.find(p => parseInt(p.id) === parseInt(this.value));
                if (pet) {
                    const preview = document.getElementById('selectedPetPreview');
                    document.getElementById('selectedPetImg').src = pet.image;
                    document.getElementById('selectedPetName').textContent = pet.name;
                    document.getElementById('selectedPetSpecies').textContent = pet.species.charAt(0).toUpperCase() + pet.species.slice(1) + (pet.breed ? ' · ' + pet.breed : '');
                    preview.style.display = 'flex';
                }
            } else {
                clearSelectedPet();
            }
        });

        // Override showPetModal to track current pet
        const _originalShowPetModal = showPetModal;
        showPetModal = function(petId) {
            currentModalPetId = parseInt(petId);
            _originalShowPetModal(petId);
        };
    </script>

</body>
</html>