<?php
require_once 'includes/hidden.php';  // Remove session_start() since it's in hidden.php

if (!is_logged_in()) {
    redirect(url('accounts/login.php'));
}

// Check if screening_id is provided
if (!isset($_GET['screening_id'])) {
    redirect(url('index.php'));
}

$screening_id = $_GET['screening_id'];

// Get taken seats for this screening
$stmt = $pdo->prepare("
    SELECT s.seat_id 
    FROM reserved_seats rs
    JOIN seats s ON rs.seat_id = s.seat_id
    JOIN reservations r ON rs.reservation_id = r.reservation_id
    WHERE r.screening_id = ?
");
$stmt->execute([$screening_id]);
$taken_seats = $stmt->fetchAll(PDO::FETCH_COLUMN);

?>

<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wybierz miejsca</title>
    <link rel="stylesheet" href="<?= url('css/style.css') ?>">
    <script src="<?= url('js/script.js') ?>" defer></script>
</head>

<body>
    <nav class="navbar">
        <div class="nav-left">
            <a href="<?= url('index.php') ?>" class="logo">KINO</a>
        </div>
        <div class="nav-right">
            <a href="<?= url('accounts/profile.php') ?>" class="nav-link">PROFIL</a>
            <a href="<?= url('accounts/logout.php') ?>" class="nav-link">WYLOGUJ</a>
        </div>
    </nav>

    <div class="container">
        <h2>Wybierz miejsca</h2>
        <div class="screen">EKRAN</div>
        <div class="seat-grid">
            <?php for ($row = 1; $row <= 15; $row++): ?>
                <div class="seat-row">
                    <div class="row-number"><?= $row ?></div>
                    <?php for ($seat = 1; $seat <= 20; $seat++): ?>
                        <?php
                        $seat_id = ($row - 1) * 20 + $seat;
                        $is_taken = in_array($seat_id, $taken_seats);
                        ?>
                        <div class="seat <?= $is_taken ? 'taken' : '' ?>" data-seat-id="<?= $seat_id ?>"
                            onclick="toggleSeat(this)">
                            <?= $seat ?>
                        </div>
                    <?php endfor; ?>
                </div>
            <?php endfor; ?>
        </div>

        <form id="seatForm" method="POST" action="<?= url('reserve.php') ?>">
            <input type="hidden" name="screening_id" value="<?= htmlspecialchars($screening_id) ?>">
            <input type="hidden" name="selected_seats" id="selectedSeats" value="">
            <button type="submit" class="btn" id="reserveButton" disabled>Zarezerwuj miejsca</button>
        </form>
    </div>

    <footer class="footer">
        <p>Kino Orange &copy; Wszelkie prawa zastrzeżone.</p>
    </footer>
</body>

</html>