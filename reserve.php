<?php
require_once 'includes/hidden.php';

if (!is_logged_in())
    redirect('accounts/login.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $pdo->beginTransaction();

        $stmt = $pdo->prepare("
            INSERT INTO reservations (user_id, screening_id)
            VALUES (?, ?)
        ");
        $stmt->execute([$_SESSION['user_id'], $_POST['screening_id']]);
        $reservation_id = $pdo->lastInsertId();

        $seats = explode(',', $_POST['selected_seats']);
        foreach ($seats as $seat_id) {
            $stmt = $pdo->prepare("
                INSERT INTO reserved_seats (reservation_id, seat_id)
                VALUES (?, ?)
            ");
            $stmt->execute([$reservation_id, $seat_id]);
        }

        $pdo->commit();
        $_SESSION['success'] = "Rezerwacja zakończona pomyślnie!";
        redirect('accounts/profile.php');
    } catch (Exception $e) {
        $pdo->rollBack();
        die("Błąd rezerwacji: " . $e->getMessage());
    }
}