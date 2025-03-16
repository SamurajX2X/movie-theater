<?php
require_once 'includes/hidden.php';

// sprawdz czy uzytkownik jest zalogowany
if (!is_logged_in()) {
    redirect(url('accounts/login.php'));
}

// sprawdz czy sa potrzebne dane
if (empty($_POST['screening_id']) || empty($_POST['selected_seats'])) {
    redirect(url('index.php'));
}

$screening_id = (int) $_POST['screening_id'];
$user_id = (int) $_SESSION['user_id'];
$selected_seats = explode(',', $_POST['selected_seats']);

// rozpocznij transakcje
$mysqli->begin_transaction();

// dodaj rezerwacje
$query = "INSERT INTO reservations (user_id, screening_id, reservation_time) 
          VALUES ($user_id, $screening_id, NOW())";

if (!$mysqli->query($query)) {
    $mysqli->rollback();
    redirect(url('index.php'));
}

$reservation_id = $mysqli->insert_id;

// dodaj miejsca do rezerwacji
$success = true;
foreach ($selected_seats as $seat_id) {
    $seat_id = (int) $seat_id;
    $query = "INSERT INTO reserved_seats (reservation_id, seat_id) 
              VALUES ($reservation_id, $seat_id)";

    if (!$mysqli->query($query)) {
        $success = false;
        break;
    }
}

// zatwierdz lub cofnij zmiany
if ($success) {
    $mysqli->commit();
    redirect(url('accounts/profile.php'));
} else {
    $mysqli->rollback();
    redirect(url('index.php'));
}