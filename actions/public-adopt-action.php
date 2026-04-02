<?php
/**
 * Public Adoption Action
 * Handles adoption form submissions from the homepage.
 * Creates an adopter record, then creates an adoption record,
 * and marks the pet as adopted (status=0).
 */

include_once '../config/config.php';
include_once BASE_PATH . '/config/database.php';

$action = $_POST['action'] ?? null;
$submit = $_POST['submit'] ?? null;

if (!$submit || $action !== 'public_adopt') {
    header('Location: ' . BASE_URL);
    exit;
}

// Sanitize inputs
$name = trim($_POST['name'] ?? '');
$contact = trim($_POST['contact'] ?? '');
$gender = trim($_POST['gender'] ?? '');
$city = trim($_POST['city'] ?? '');
$street_address = trim($_POST['street_address'] ?? '');
$pet_id = (int)($_POST['pet_id'] ?? $_POST['pet_select'] ?? 0);

// Validate required fields
if (empty($name) || empty($contact) || empty($gender) || empty($city) || empty($street_address) || $pet_id <= 0) {
    header('Location: ' . BASE_URL . '?adopt_error=Please fill in all required fields.#adopt-section');
    exit;
}

// Check if pet exists and is available (status = 1)
$pet_check = mysqli_query($conn, "SELECT id, status FROM pets WHERE id = $pet_id");
if (!$pet_check || mysqli_num_rows($pet_check) === 0) {
    header('Location: ' . BASE_URL . '?adopt_error=Pet not found.#adopt-section');
    exit;
}

$pet_data = mysqli_fetch_assoc($pet_check);
if ((int)$pet_data['status'] !== 1) {
    header('Location: ' . BASE_URL . '?adopt_error=This pet has already been adopted.#adopt-section');
    exit;
}

// Escape strings for DB
$name_safe = mysqli_real_escape_string($conn, $name);
$contact_safe = mysqli_real_escape_string($conn, $contact);
$gender_safe = mysqli_real_escape_string($conn, $gender);
$city_safe = mysqli_real_escape_string($conn, $city);
$street_safe = mysqli_real_escape_string($conn, $street_address);

// 1. Create the adopter record
$adopter_query = "INSERT INTO adopter (name, gender, contact, street_address, city) 
                  VALUES ('$name_safe', '$gender_safe', '$contact_safe', '$street_safe', '$city_safe')";

if (!mysqli_query($conn, $adopter_query)) {
    header('Location: ' . BASE_URL . '?adopt_error=Could not create adopter record. Please try again.#adopt-section');
    exit;
}

$adopter_id = mysqli_insert_id($conn);

// 2. Get the first available caretaker (assign automatically)
$caretaker_query = mysqli_query($conn, "SELECT id FROM caretaker ORDER BY id ASC LIMIT 1");
$caretaker_id = 0;
if ($caretaker_query && mysqli_num_rows($caretaker_query) > 0) {
    $caretaker_id = (int)mysqli_fetch_assoc($caretaker_query)['id'];
} else {
    // No caretaker exists — still proceed, but log this
    header('Location: ' . BASE_URL . '?adopt_error=No caretakers available. Please contact us directly.#adopt-section');
    exit;
}

// 3. Create the adoption record (status 0 = pending)
$adoption_query = "INSERT INTO adoption (pet, caretaker, adopter, status) VALUES ($pet_id, $caretaker_id, $adopter_id, 0)";

if (!mysqli_query($conn, $adoption_query)) {
    header('Location: ' . BASE_URL . '?adopt_error=Could not process adoption. Please try again.#adopt-section');
    exit;
}

// 4. Update pet status to adopted (0)
mysqli_query($conn, "UPDATE pets SET status = 0 WHERE id = $pet_id");

// 5. Redirect with success
header('Location: ' . BASE_URL . '?adopt_success=1#adopt-section');
exit;
