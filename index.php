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
?>
<!DOCTYPE html>
<html>

<head>
    <title>Paws And Hearts</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/lineicons.css" />
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/materialdesignicons.min.css" />
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/fullcalendar.css" />
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/main.css" />
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/custom-theme.css" />
</head>

<body>
    <!-- ======== Preloader =========== -->
    <div id="preloader" style="display: none;">
        <div class="spinner"></div>
    </div>
    <!-- ======== Preloader =========== -->

    <!-- ======== main-wrapper start =========== -->
    <main>

        <!-- ========== Hero Section ========== -->
        <section class="hero-section py-5">
            <div class="container">
                <div class="row align-items-center min-vh-100">
                    <div class="col-sm-6">
                        <h1 class="display-4 fw-bold mb-4">Paws And Hearts</h1>
                        <p class="lead mb-4">Giving stray animals a second chance at life. We rescue, care for, and find loving homes for animals in need.</p>
                        <div class="d-flex gap-3">
                            <button class="btn btn-light btn-lg" onclick="document.getElementById('pets-section').scrollIntoView({behavior: 'smooth'})">Find a Pet</button>
                            <button class="btn btn-lg" style="background-color: white; color: var(--primary-color); border: none; font-weight: 600;" onclick="document.getElementById('about-section').scrollIntoView({behavior: 'smooth'})">Learn More</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- ========== Hero Section End ========== -->

        <!-- ========== About Section ========== -->
        <section id="about-section" class="about-section py-5 bg-light">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center mb-5">
                        <h2 class="h1 fw-bold mb-3">Our Mission</h2>
                        <p class="lead text-muted">We are dedicated to rescuing and rehabilitating stray animals, providing them with the care they deserve.</p>
                    </div>
                </div>
                <div class="row g-4">
                    <div class="col-md-6 col-lg-3">
                        <div class="card border-0 shadow-sm h-100 text-center">
                            <div class="card-body">
                                <div class="h1 mb-3">🛟</div>
                                <h5 class="card-title fw-bold">Rescue</h5>
                                <p class="card-text text-muted">We rescue stray animals from the streets and provide them immediate care and shelter.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="card border-0 shadow-sm h-100 text-center">
                            <div class="card-body">
                                <div class="h1 mb-3">💊</div>
                                <h5 class="card-title fw-bold">Care</h5>
                                <p class="card-text text-muted">Our team provides medical treatment, nutrition, and rehabilitation for all our animals.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="card border-0 shadow-sm h-100 text-center">
                            <div class="card-body">
                                <div class="h1 mb-3">🏠</div>
                                <h5 class="card-title fw-bold">Home</h5>
                                <p class="card-text text-muted">We provide safe, comfortable homes where animals can recover and find happiness.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="card border-0 shadow-sm h-100 text-center">
                            <div class="card-body">
                                <div class="h1 mb-3">❤️</div>
                                <h5 class="card-title fw-bold">Adoption</h5>
                                <p class="card-text text-muted">We match animals with caring families, ensuring they find the perfect forever home.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- ========== About Section End ========== -->

        <!-- ========== Pets Section ========== -->
        <section id="pets-section" class="pets-section py-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center mb-5">
                        <h2 class="h1 fw-bold mb-3">Find Your Perfect Companion</h2>
                        <p class="lead text-muted">Browse our available animals waiting for their forever homes.</p>
                    </div>
                </div>

                <!-- Filter Section -->
                <div class="row mb-5">
                    <div class="col-lg-12">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body p-4">
                                <div class="row g-3">
                                    <div class="col-md-6 col-lg-3">
                                        <label class="form-label fw-bold">Search Pet</label>
                                        <input type="text" class="form-control" id="searchPet" placeholder="Enter pet name...">
                                    </div>
                                    <div class="col-md-6 col-lg-3">
                                        <label class="form-label fw-bold">Species</label>
                                        <select class="form-select" id="filterSpecies">
                                            <option value="">All Species</option>
                                            <option value="dog">Dog</option>
                                            <option value="cat">Cat</option>
                                            <option value="rabbit">Rabbit</option>
                                            <option value="bird">Bird</option>
                                            <option value="other">Other</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pets Display Area -->
                <div class="row" id="petsContainer">
                    <div class="col-lg-12 text-center py-5">
                        <p class="text-muted">Loading pets...</p>
                    </div>
                </div>

                <!-- Load More Button -->
                <div class="row mt-5">
                    <div class="col-lg-12 text-center">
                        <button class="btn btn-lg btn-outline-primary" id="loadMoreBtn" onclick="loadMorePets()" style="display: none;">
                            Load More Pets
                        </button>
                    </div>
                </div>
            </div>
        </section> 
        <!-- ========== Pets Section End ========== -->

        <!-- ========== Contact Section ========== -->
        <section class="contact-section py-5" style="background-color: var(--primary-color);">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center mb-5">
                        <h2 class="h1 fw-bold mb-3">Get In Touch</h2>
                        <p class="lead text-muted">Have questions? Want to help? We'd love to hear from you!</p>
                    </div>
                </div>
                <div class="row g-4">
                    <div class="col-md-6 col-lg-4">
                        <div class="text-center">
                            <div class="h4 mb-2">📧 Email</div>
                            <p class="text-muted">contact@pawsandhearts.com</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="text-center">
                            <div class="h4 mb-2">📱 Phone</div>
                            <p class="text-muted">+1 (555) 123-4567</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="text-center">
                            <div class="h4 mb-2">📍 Location</div>
                            <p class="text-muted">Visit us to meet our animals</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- ========== Contact Section End ========== -->

    </main>
    <!-- ======== main-wrapper end =========== -->

    <!-- ========== Pet Details Modal ========== -->
    <div class="modal fade" id="petModal" tabindex="-1" aria-labelledby="petModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content border-0">
                <div class="modal-header bg-primary text-white border-0">
                    <h5 class="modal-title" id="petModalLabel">Pet Details</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="petModalBody">
                    <!-- Pet details will be loaded here -->
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Adopt Now</button>
                </div>
            </div>
        </div>
    </div>
    <!-- ========== Pet Details Modal End =========== -->

    <script src="<?= BASE_URL ?>assets/js/bootstrap.bundle.min.js"></script>
    <script>
        // Initialize modal once
        let petModalInstance = null;
        
        // Setup modal event listeners for proper cleanup
        document.addEventListener('DOMContentLoaded', function() {
            const petModalElement = document.getElementById('petModal');
            if (petModalElement) {
                petModalElement.addEventListener('hidden.bs.modal', function() {
                    // Remove backdrop if it exists
                    const backdrops = document.querySelectorAll('.modal-backdrop');
                    backdrops.forEach(backdrop => backdrop.remove());
                    // Ensure body is scrollable
                    document.body.classList.remove('modal-open');
                    document.body.style.overflow = '';
                });
            }
        });
        
        // Pet data from database
        const samplePets = <?php echo json_encode($dbPets); ?>;
        
        // Map database field names if they differ
        const mappedPets = samplePets.map(pet => ({
            id: pet.id,
            name: pet.name,
            species: (pet.species || 'dog').toLowerCase(),
            status: 'available',
            image: pet.image_path || 'assets/images/logo/logo.png',
            breed: pet.breed || '',
            description: pet.description || ''
        }));

        // Pagination settings
        let currentPage = 0;
        let petsPerPage = 8;
        let filteredPets = [];
        let allDisplayedPets = [];

        function displayPets(pets, isLoadMore = false) {
            const container = document.getElementById('petsContainer');

            if (pets.length === 0) {
                container.innerHTML = '<div class="col-lg-12 text-center py-5"><p class="text-muted">No pets found matching your criteria.</p></div>';
                return;
            }

            filteredPets = pets;
            if (!isLoadMore) {
                currentPage = 0;
                allDisplayedPets = [];
            }

            const startIndex = currentPage * petsPerPage;
            const endIndex = startIndex + petsPerPage;
            const petsToDisplay = filteredPets.slice(startIndex, endIndex);

            const petsHTML = petsToDisplay.map(pet => `
                <div class="col-md-6 col-lg-3 mb-4">
                    <div class="card border-0 shadow-sm h-100">
                        <img src="${pet.image}" class="card-img-top" alt="${pet.name}" style="height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title fw-bold">${pet.name}</h5>
                            <p class="card-text text-muted mb-2">
                                <small>
                                    <span class="badge bg-info text-dark">${pet.species}</span>
                                </small>
                            </p>
                            <p class="card-text mb-3">
                                <span class="badge bg-success">Available</span>
                            </p>
                            <button class="btn btn-sm btn-primary w-100" type="button" data-bs-toggle="modal" data-bs-target="#petModal" onclick="showPetModal(${pet.id})">Learn More</button>
                        </div>
                    </div>
                </div>
            `).join('');

            if (!isLoadMore) {
                container.innerHTML = petsHTML;
            } else {
                container.innerHTML += petsHTML;
            }

            // Show/hide load more button
            const loadMoreBtn = document.getElementById('loadMoreBtn');
            const totalDisplayed = (currentPage + 1) * petsPerPage;

            if (loadMoreBtn) {
                if (totalDisplayed < filteredPets.length) {
                    loadMoreBtn.style.display = 'block';
                } else {
                    loadMoreBtn.style.display = 'none';
                }
            }

            currentPage++;
        }

        function showPetModal(petId) {
            // Convert to number to ensure proper matching
            petId = parseInt(petId);
            const pet = mappedPets.find(p => parseInt(p.id) === petId);
            if (!pet) {
                console.log('Pet not found:', petId);
                console.log('Available pets:', mappedPets);
                return;
            }

            const modalBody = document.getElementById('petModalBody');
            const petModalElement = document.getElementById('petModal');
            
            if (!modalBody || !petModalElement) {
                console.log('Modal elements not found');
                return;
            }

            modalBody.innerHTML = `
                <div class="row">
                    <div class="col-md-6">
                        <img src="${pet.image}" class="img-fluid rounded" alt="${pet.name}" style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                    <div class="col-md-6 ps-3">
                        <h3 class="fw-bold mb-3">${pet.name}</h3>
                        <p class="mb-3"><strong>Species:</strong> ${pet.species.charAt(0).toUpperCase() + pet.species.slice(1)}</p>
                        <h5 class="fw-bold mb-2">About</h5>
                        <p class="text-muted">${pet.description || 'No description available.'}</p>
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

        // Event listeners for filters
        document.getElementById('searchPet').addEventListener('input', filterPets);
        document.getElementById('filterSpecies').addEventListener('change', filterPets);

        // Initial display
        window.addEventListener('load', () => {
            displayPets(mappedPets);
        });
    </script>