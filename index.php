<?php
include_once 'includes/header.php';
?>

<body>
    <!-- ======== Preloader =========== -->
    <div id="preloader" style="display: none;">
        <div class="spinner"></div>
    </div>
    <!-- ======== Preloader =========== -->

    <!-- ======== main-wrapper start =========== -->
    <main>

        <!-- ========== Hero Section ========== -->
        <section class="hero-section py-5" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
            <div class="container">
                <div class="row align-items-center min-vh-100">
                    <div class="col-lg-6">
                        <h1 class="display-4 fw-bold mb-4">Paws And Hearts</h1>
                        <p class="lead mb-4">Giving stray animals a second chance at life. We rescue, care for, and find loving homes for animals in need.</p>
                        <div class="d-flex gap-3">
                            <button class="btn btn-light btn-lg" onclick="document.getElementById('pets-section').scrollIntoView({behavior: 'smooth'})">Find a Pet</button>
                            <button class="btn btn-outline-light btn-lg" onclick="document.getElementById('about-section').scrollIntoView({behavior: 'smooth'})">Learn More</button>
                        </div>
                    </div>
                    <div class="col-lg-6 text-center">
                        <div class="display-1 mb-4">🐾</div>
                        <p class="h5 text-white-50">Every animal deserves a loving home</p>
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
                                    <div class="col-md-6 col-lg-3">
                                        <label class="form-label fw-bold">Age Group</label>
                                        <select class="form-select" id="filterAge">
                                            <option value="">All Ages</option>
                                            <option value="young">Young (0-2 years)</option>
                                            <option value="adult">Adult (2-7 years)</option>
                                            <option value="senior">Senior (7+ years)</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 col-lg-3">
                                        <label class="form-label fw-bold">Status</label>
                                        <select class="form-select" id="filterStatus">
                                            <option value="">All Status</option>
                                            <option value="available">Available</option>
                                            <option value="adopted">Adopted</option>
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
        <section class="contact-section py-5 bg-light">
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
        // Sample pet data - replace with actual data from your database
        const samplePets = [
            { id: 1, name: "Max", species: "dog", age: "young", status: "available", image: "assets/images/logo/logo.png" },
            { id: 2, name: "Luna", species: "cat", age: "adult", status: "available", image: "assets/images/logo/logo.png" },
            { id: 3, name: "Charlie", species: "dog", age: "adult", status: "adopted", image: "assets/images/logo/logo.png" },
            { id: 4, name: "Bella", species: "cat", age: "young", status: "available", image: "assets/images/logo/logo.png" },
            { id: 5, name: "Rocky", species: "dog", age: "young", status: "available", image: "assets/images/logo/logo.png" },
            { id: 6, name: "Whiskers", species: "cat", age: "adult", status: "available", image: "assets/images/logo/logo.png" },
            { id: 7, name: "Daisy", species: "rabbit", age: "young", status: "available", image: "assets/images/logo/logo.png" },
            { id: 8, name: "Oscar", species: "dog", age: "senior", status: "available", image: "assets/images/logo/logo.png" },
            { id: 9, name: "Mittens", species: "cat", age: "young", status: "adopted", image: "assets/images/logo/logo.png" },
            { id: 10, name: "Buddy", species: "dog", age: "adult", status: "available", image: "assets/images/logo/logo.png" },
            { id: 11, name: "Simba", species: "cat", age: "senior", status: "available", image: "assets/images/logo/logo.png" },
            { id: 12, name: "Bailey", species: "dog", age: "young", status: "available", image: "assets/images/logo/logo.png" },
            { id: 13, name: "Cleo", species: "cat", age: "adult", status: "available", image: "assets/images/logo/logo.png" },
            { id: 14, name: "Zeus", species: "dog", age: "adult", status: "available", image: "assets/images/logo/logo.png" },
            { id: 15, name: "Pepper", species: "rabbit", age: "adult", status: "adopted", image: "assets/images/logo/logo.png" },
            { id: 16, name: "Shadow", species: "cat", age: "young", status: "available", image: "assets/images/logo/logo.png" },
            { id: 17, name: "Duke", species: "dog", age: "young", status: "available", image: "assets/images/logo/logo.png" },
            { id: 18, name: "Fluffy", species: "rabbit", age: "young", status: "available", image: "assets/images/logo/logo.png" },
            { id: 19, name: "Ginger", species: "cat", age: "senior", status: "available", image: "assets/images/logo/logo.png" },
            { id: 20, name: "Cooper", species: "dog", age: "adult", status: "adopted", image: "assets/images/logo/logo.png" },
        ];

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
                                    <span class="badge bg-warning text-dark">${pet.age}</span>
                                </small>
                            </p>
                            <p class="card-text mb-3">
                                ${pet.status === 'available' ? '<span class="badge bg-success">Available</span>' : '<span class="badge bg-secondary">Adopted</span>'}
                            </p>
                            <button class="btn btn-sm btn-primary w-100" onclick="showPetModal(${pet.id})">${pet.status === 'available' ? 'Learn More' : 'Success Story'}</button>
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
            const pet = samplePets.find(p => p.id === petId);
            if (!pet) return;

            const modalBody = document.getElementById('petModalBody');
            modalBody.innerHTML = `
                <div class="row">
                    <div class="col-md-6">
                        <img src="${pet.image}" class="img-fluid rounded" alt="${pet.name}" style="width: 100%; height: 300px; object-fit: cover;">
                    </div>
                    <div class="col-md-6">
                        <h3 class="fw-bold mb-3">${pet.name}</h3>
                        <div class="mb-3">
                            <p class="mb-2"><strong>Species:</strong> ${pet.species.charAt(0).toUpperCase() + pet.species.slice(1)}</p>
                            <p class="mb-2"><strong>Age Group:</strong> ${pet.age.charAt(0).toUpperCase() + pet.age.slice(1)}</p>
                            <p class="mb-2"><strong>Status:</strong> ${pet.status === 'available' ? '<span class="badge bg-success">Available for Adoption</span>' : '<span class="badge bg-secondary">Adopted</span>'}</p>
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-12">
                        <h5 class="fw-bold mb-3">About ${pet.name}</h5>
                        <p class="text-muted">
                            ${pet.name} is a wonderful ${pet.species} who came to us as a stray. After receiving proper care and rehabilitation, 
                            ${pet.name} is now ready to find their perfect forever home. This loving companion is eager to shower their new family 
                            with unconditional love and companionship.
                        </p>
                        <h5 class="fw-bold mt-3 mb-2">Health & Care</h5>
                        <ul class="text-muted">
                            <li>Fully vaccinated and microchipped</li>
                            <li>Spayed/Neutered</li>
                            <li>Regular health checkups completed</li>
                            <li>Socialized and ready for family life</li>
                        </ul>
                    </div>
                </div>
            `;

            const petModal = new bootstrap.Modal(document.getElementById('petModal'));
            petModal.show();
        }

        function filterPets() {
            const searchTerm = document.getElementById('searchPet').value.toLowerCase();
            const species = document.getElementById('filterSpecies').value;
            const age = document.getElementById('filterAge').value;
            const status = document.getElementById('filterStatus').value;

            let filtered = samplePets.filter(pet => {
                const matchesSearch = pet.name.toLowerCase().includes(searchTerm);
                const matchesSpecies = !species || pet.species === species;
                const matchesAge = !age || pet.age === age;
                const matchesStatus = !status || pet.status === status;

                return matchesSearch && matchesSpecies && matchesAge && matchesStatus;
            });

            displayPets(filtered);
        }

        function loadMorePets() {
            displayPets(filteredPets, true);
        }

        // Event listeners for filters
        document.getElementById('searchPet').addEventListener('input', filterPets);
        document.getElementById('filterSpecies').addEventListener('change', filterPets);
        document.getElementById('filterAge').addEventListener('change', filterPets);
        document.getElementById('filterStatus').addEventListener('change', filterPets);

        // Initial display
        window.addEventListener('load', () => {
            displayPets(samplePets);
        });
    </script>